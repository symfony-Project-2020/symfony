<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Client;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\LignesCommande;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="LignesCommande", mappedBy="Commande")
     */
    private $id;



    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="id")
     * @ORM\JoinColumn(name="client_commande", referencedColumnName="id")
     */
    private $client;

    /**
     * @var float
     *
     * @ORM\Column(name="totalPrice", type="float")
     */
    private $totalPrice;

    /**
     *
     * @ORM\Column(name="dateCommande", type="datetime", nullable=false) 
     */
    private $dateCommande;

    /**
     * @ORM\PrePersist
     */
    public function setDateForCommande()
    {
        $this->dateCommande = new \DateTime();
    }
    

     /**
     * @var float
     *
     * @ORM\Column(name="reference", type="text")
     */
    private $reference;

     /**
     * @ORM\PrePersist
     */
    public function generateRandomString($length = 15) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $this->reference = $randomString . $this->id;
    }



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
     * Set Client
     *
     * @param Client $Client
     *
     * 
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->Client;
    }

    /**
     * Set totalPrice
     *
     * @param float $totalPrice
     *
     * @return Commande
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

   

    /**
     * Set dateCommande
     *
     * @param \Date $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande(\Date $dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \Date
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Commande
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }
}
