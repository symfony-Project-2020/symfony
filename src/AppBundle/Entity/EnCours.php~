<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Client;
use AppBundle\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;

/**
 * EnCours
 *
 * @ORM\Table(name="en_cours")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EnCoursRepository")
 */
class EnCours
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
     * @var Produit
     * 
     *@ORM\ManyToOne(targetEntity="Produit", inversedBy="id")
     *@ORM\JoinColumn(name="idProduit", referencedColumnName="id")
     */
    private $produit;

    /**
     * @var integer
     *
     *@ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="id")
     * @ORM\JoinColumn(name="idClient", referencedColumnName="id")
     */
    private $client;


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
     * Set client
     *
     * Client $client
     *
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return EnCours
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set produit
     *
     * @param Produit $produit
     *
     * @return EnCours
     */
    public function setProduit(Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }
}
