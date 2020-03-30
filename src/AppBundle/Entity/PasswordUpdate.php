<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class PasswordUpdate
{
    
    private $ancienPassword;

    
    private $newPassword;

    /**
     * @Assert\EqualTo(propertyPath="newPassword", message="You need to confirm your password")
     */
    private $confirmPassword;

   
    public function setAncienPassword($ancienPassword):self
    {
        $this->ancienPassword = $ancienPassword;

        return $this;
    }

    public function getAncienPassword() :?string
    {
        return $this->ancienPassword;
    }

   
    public function setNewPassword($newPassword):self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

   
    public function getNewPassword():?string
    {
        return $this->newPassword;
    }

    
    public function setConfirmPassword($confirmPassword):self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

   
    public function getConfirmPassword():?string
    {
        return $this->confirmPassword;
    }
}

