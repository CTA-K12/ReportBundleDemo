<?php

namespace Mesd\ReportDemoBundle\Entity;

use Mesd\AuthenticationBundle\Entity\AuthUser;

/**
 * ReportUser
 */
class ReportUser extends AuthUser
{
    ///////////////
    // VARIABLES //
    ///////////////


    /**
     * Users first name
     * @var string
     */
    private $firstName;

    /**
     * Users last name
     * @var string
     */
    private $lastName;


    /////////////////////////
    // GETTERS AND SETTERS //
    /////////////////////////


    /**
     * Gets the Users first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the Users first name.
     *
     * @param string $firstName the first name
     *
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Gets the Users last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the Users last name.
     *
     * @param string $lastName the last name
     *
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
}