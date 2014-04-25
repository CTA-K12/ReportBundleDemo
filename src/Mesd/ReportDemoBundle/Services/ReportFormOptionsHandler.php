<?php

namespace Mesd\ReportDemoBundle\Services;

use MESD\Jasper\ReportBundle\Interfaces\OptionsHandlerInterface;
use MESD\Jasper\ReportBundle\InputControl\AbstractReportBundleInputControl;
use MESD\Jasper\ReportBundle\InputControl\Option;

class ReportFormOptionsHandler implements OptionsHandlerInterface
{
    ///////////////
    // VARIABLES //
    ///////////////

    /**
     * Map that maps input control ids to the function to generate their option list
     * @var array
     */
    private $methodMap;


    //////////////////
    // BASE METHODS //
    //////////////////


    /**
     * Constructor
     */
    public function __construct() {
        //This where stuff from the dependency injector will come in and class variables will be set
        //Things such as the entity manager and security context will probably be the most common

        //Call the register methods method
        $this->registerMethods();
    }


    /////////////////////////
    // IMPLEMENTED METHODS //
    /////////////////////////


    /**
     * The method that takes a input control and generates a list of options for it
     *   NOTE: this should either
     *           A: return an array of Option objects for the user to select from
     *           B: return an empty array to give the user no options to select from
     *           C: return null to inidicate that this method does not handle the requested input type (such that fallback can takeover)
     *
     * @param  AbstractReportBundleInputControl $inputControl The input control to generate options for
     *
     * @return array|null                                     The array of options or null
     */
    public function getList(AbstractReportBundleInputControl $inputControl) {
        //Check if the input control id is in the function map
        if (array_key_exists($inputControl->getId(), $this->functionMap)) {
            //call the function
            $options = call_user_func(array($this, $this->functionMap[$inputControl->getId()]));
        } else {
            //Set options to null (this way fallback mode will know to go ask Jasper for the options)
            $options = null;
        }

        //Return the options array or null
        return $options;
    }


    ///////////////////
    // CLASS METHODS //
    ///////////////////


    /**
     * A little simple method I use to centralize which input control ids call which option generating method
     */
    public function registerMethods() {
        //Init the array
        $this->methodMap = array();

        //nothing for now
    }


    ////////////////////
    // OPTION METHODS //
    ////////////////////

    //None here yet
}