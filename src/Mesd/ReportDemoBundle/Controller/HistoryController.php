<?php

namespace Mesd\ReportDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HistoryController extends Controller
{
    //////////////////////
    // RENDERED ACTIONS //
    //////////////////////


    /**
     * Renders the list of report history objects
     *
     * @return RenderedResponse The view containing the list of report history
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $reports = $em->getRepository('MESDJasperReportBundle:ReportHistory')->getCachedReports();
        
        return $this->render('MesdReportDemoBundle:History:index.html.twig', array('reports' => $reports));
    }
}