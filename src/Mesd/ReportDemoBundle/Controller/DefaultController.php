<?php

namespace Mesd\ReportDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MesdReportDemoBundle:Default:index.html.twig');
    }
}
