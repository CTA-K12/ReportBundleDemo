<?php
// src Mesd/AuthenticationBundle/Form/Model/Registration.php
namespace Mesd\AuthenticationBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Mesd\AuthenticationBundle\Entity\AuthUser;

class Registration
{
    /**
     * @Assert\Type(type="Mesd\AuthenticationBundle\Entity\AuthUser")
     * @Assert\Valid()
     */
    protected $user;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;

    public function setUser(AuthUser $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }
}