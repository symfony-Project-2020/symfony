<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminRepository")
 */
class Admin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAdmin", type="string", length=255)
     */
    private $emailAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="passwordAdmin", type="string", length=255)
     */
    private $passwordAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="avatarAdmin", type="string", length=255)
     */
    private $avatarAdmin;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set emailAdmin
     *
     * @param string $emailAdmin
     *
     * @return Admin
     */
    public function setEmailAdmin($emailAdmin)
    {
        $this->emailAdmin = $emailAdmin;

        return $this;
    }

    /**
     * Get emailAdmin
     *
     * @return string
     */
    public function getEmailAdmin()
    {
        return $this->emailAdmin;
    }

    /**
     * Set passwordAdmin
     *
     * @param string $passwordAdmin
     *
     * @return Admin
     */
    public function setPasswordAdmin($passwordAdmin)
    {
        $this->passwordAdmin = $passwordAdmin;

        return $this;
    }

    /**
     * Get passwordAdmin
     *
     * @return string
     */
    public function getPasswordAdmin()
    {
        return $this->passwordAdmin;
    }

    /**
     * Set avatarAdmin
     *
     * @param string $avatarAdmin
     *
     * @return Admin
     */
    public function setAvatarAdmin($avatarAdmin)
    {
        $this->avatarAdmin = $avatarAdmin;

        return $this;
    }

    /**
     * Get avatarAdmin
     *
     * @return string
     */
    public function getAvatarAdmin()
    {
        return $this->avatarAdmin;
    }
}
