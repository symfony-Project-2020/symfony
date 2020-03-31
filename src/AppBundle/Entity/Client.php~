<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Commande;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 * @UniqueEntity(
 *  fields={"email"},
 *     message="This email is already use it."
 * )
 */
class Client implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="Commande", mappedBy="Client")
     * @ORM\OneToMany(targetEntity="Encours", mappedBy="Client")
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="You need to confirm your password")
     */
    public $passwordConfirmation;

    /**
     * @var string
     *
     * @ORM\Column(name="urlAvatar", type="string", length=255)
     */
    private $urlAvatar;


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
     * Set email
     *
     * @param string $email
     *
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Client
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set urlAvatar
     *
     * @param string $urlAvatar
     *
     * @return Client
     */
    public function setUrlAvatar($urlAvatar)
    {
        $this->urlAvatar = $urlAvatar;

        return $this;
    }

    /**
     * Get urlAvatar
     *
     * @return string
     */
    public function getUrlAvatar()
    {
        return $this->urlAvatar;
    }

    public function getRoles(){
            return ['roles_user'];
    }

    public function getSalt(){}

    public function getUsername(){
        return $this->email;
    }

    public function eraseCredentials(){ }
}
