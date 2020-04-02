<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Client;
use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoleRepository")
 */
class Role
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
     * @ORM\Column(name="title", type="string")
     */
    private $title;
    


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
     * Set title
     *
     * @param string $title
     *
     * @return Role
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\Client $user
     *
     * @return Role
     */
    public function addUser(\AppBundle\Entity\Client $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\Client $user
     */
    public function removeUser(\AppBundle\Entity\Client $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add title
     *
     * @param \AppBundle\Entity\Client $title
     *
     * @return Role
     */
    public function addTitle(\AppBundle\Entity\Client $title)
    {
        $this->title[] = $title;

        return $this;
    }

    /**
     * Remove title
     *
     * @param \AppBundle\Entity\Client $title
     */
    public function removeTitle(\AppBundle\Entity\Client $title)
    {
        $this->title->removeElement($title);
    }
}
