<?php

namespace Mesd\ReportDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * ReportController
 *
 * Handles the actions for display the list of reports, the report input control forms, and generating the reports
 */
class ReportController extends Controller
{
    //////////////////////
    // RENDERED ACTIONS //
    //////////////////////


    /**
     * Renders the list of reports under the default folder on the Report Server
     *
     * @return RenderedResponse The rendered response
     */
    public function listAction() {
        //Get the resources in the default folder as json
        $resources = $this->get('mesd.jasperreport.client')->getResourceList();

        //Render the list twig
        return $this->render('MesdReportDemoBundle:Report:list.html.twig', array('resources' => $resources));
    }


    //////////////////
    // JSON ACTIONS //
    //////////////////


    /**
     * Gets the resources contained in the requested folder
     *
     * @param  string $folder The Uri of the folder on the jasper server to get the contents of
     *
     * @return JsonResponse   The Json Object of the returned resources
     */
    public function resourceListAction($folder = null) {

    }
}