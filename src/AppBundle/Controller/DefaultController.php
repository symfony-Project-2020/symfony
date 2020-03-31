<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EnCours;
use AppBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
  
    
    public function indexAction()
    {
      
        $repositoryProduit = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $repositoryProduit->findAll();

       
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'produits' => $produits,
           
            ]);
    }

    
}
