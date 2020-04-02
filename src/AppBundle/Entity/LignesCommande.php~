<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Produit;
use AppBundle\Entity\Commande;
use Doctrine\ORM\Mapping as ORM;

/**
 * LignesCommande
 *
 * @ORM\Table(name="lignes_commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LignesCommandeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class LignesCommande
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
     * @var Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="ligne_commande", referencedColumnName="id")
     */
    private $commande;

    /**
     * @var Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="id")
     * @ORM\JoinColumn(name="idProduit", referencedColumnName="id")
     */
    private $produit;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


    /**
     * @var float
     *
     * @ORM\Column(name="prixTotal", type="float")
     */
    private $prixTotal;
    
   


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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return LignesCommande
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    
   /**
     * @ORM\PrePersist
     */
    public function setTotalPrice(){
        $this->prixTotal = $this->produit->getPrice() * $this->quantity;
    }

    

    
    /**
     * Set commande
     *
     * @param Commande $commande
     *
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set produit
     *
     * @param Produit $produit
     *
     */
    public function setProduit($produit)
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

    /**
     * Set prixTotal
     *
     * @param float $prixTotal
     *
     * @return LignesCommande
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return float
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }
}
