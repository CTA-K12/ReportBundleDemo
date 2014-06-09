<?php

namespace Mesd\ReportDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * ReportController
 *
 * Handles the actions for display the list of reports, the report input control forms, and generating the reports
 */
class ReportController extends Controller
{
    ///////////////
    // CONSTANTS //
    ///////////////

    const ICON_REPORT = '<span class="fa fa-file"></span> ';
    const ICON_FOLDER = '<span class="fa fa-folder"></span> ';

    //////////////////////
    // RENDERED ACTIONS //
    //////////////////////


    /**
     * Renders the list of reports under the default folder on the Report Server
     *
     * @return RenderedResponse The rendered response
     */
    public function listAction() {
        //Render the list twig
        return $this->render('MesdReportDemoBundle:Report:list.html.twig');
    }


    /**
     * Displays the inputs for a form
     *
     * @param  string $reportUri The jasper server uri for the report 
     * 
     * @return RenderedResponse  The rendered response
     */
    public function formAction($reportUri) {
        //Get the reports input controls in a symfony form
        $form = $this->get('mesd.jasper.report.client')->buildReportInputForm(urldecode($reportUri), 'MesdReportDemoBundle_reports_run', 
            array('routeParameters' => array('reportUri' => $reportUri)));

        //Display the form
        return $this->render('MesdReportDemoBundle:Report:form.html.twig', array('form' => $form->createView()));
    }


    /**
     * Runs a report
     *
     * @param  string  $reportUri The jasper server uri for the report 
     * @param  Request $request   The request from the submitted request input form
     *
     * @return RenderedResponse    The rendered reponse
     */
    public function runAction($reportUri, Request $request) {
        //Decode the report uri
        $reportUri = urldecode($reportUri);

        //Get the form again
        $form = $this->get('mesd.jasper.report.client')->buildReportInputForm($reportUri);

        //Process the form
        $form->handleRequest($request);

        //If any errors
        if (!$form->isValid()) {
            //Redisplay the form
            return $this->render('MesdReportDemoBundle:Report:form.html.twig', array('form' => $form->createView()));
        }

        //Build the report
        $rb = $this->get('mesd.jasper.report.client')->createReportBuilder($reportUri);
        $rb->setInputParametersArray($form->getData());
        $rb->setFormat('html');
        $rb->setPage(1);

        //Run the report and get the request id back
        $requestId = $rb->runReport();

        //forward to the display report page action
        return $this->forward('MesdReportDemoBundle:Report:displayPage', array(
                'requestId' => $requestId,
                'page'      => 1
            )
        );
    }

    /**
     * Display a requested page from a report
     *
     * @param  string $requestId The request id of the cached report
     * @param  string $page      The page number to display
     *
     * @return RenderedResponse  The rendered page
     */
    public function displayPageAction($requestId, $page) {
        $rl = $this->get('mesd.jasper.report.loader')->getReportLoader();
        $report = $rl->getCachedReport($requestId, 'html', array('page' => $page));

        return $this->render( 'MesdReportDemoBundle:Report:reportView.html.twig'
            , array(
                'report' => $report
            )
        );
    }


    //////////////////
    // JSON ACTIONS //
    //////////////////


    /**
     * Gets the resources contained in the requested folder
     *
     * Folder name comes in via a query string parameter ('#' to use the default)
     *
     * @return JsonResponse   The Json Object of the returned resources
     */
    public function listJsonAction() {
        //Get the folder
        $folderUri = $this->getRequest()->query->get('id');

        //Set folder uri to null to use the default if the root is requested ('#')
        if ('#' === $folderUri) {
            $folder = null;
        } else {
            $folder = $folderUri;
        }

        //Get the resource descriptors (not recursively)
        $resources = $this->get('mesd.jasper.report.client')->getResourceList($folder, false);

        //Convert the resources into an array to encode in json in the way jstree can read them
        $response = array();
        foreach($resources as $resource) {
            $data = array();
            $data['id'] = $resource->getUriString();
            $data['parent'] = $folderUri;
            $data['icon'] = false;

            if ('reportUnit' === $resource->getWsType()) {
                //Report object specific settings
                $data['text'] = self::ICON_REPORT . $resource->getLabel();
                $data['children'] = false;
                //Set the href to the report input form
                $data['a_attr'] = array('href' => $this->generateUrl('MesdReportDemoBundle_reports_form', array('reportUri' => urlencode($resource->getUriString()))));
            } elseif ('folder' === $resource->getWsType()) {
                //Folder object specific settings
                $data['text'] = self::ICON_FOLDER . $resource->getLabel();
                $data['children'] = true;
            }

            $response[] = $data;
        }

        //Get the resources
        return new JsonResponse($response);
    }
}