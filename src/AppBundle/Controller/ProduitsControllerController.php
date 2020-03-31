<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EnCours;
use AppBundle\Entity\Produit;
use AppBundle\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProduitsControllerController extends Controller
{
    /**
     * tous les produit index page
     * @Route("/", name="index_route")
     */
    public function allProductAction()
    {
        $repositoryProduit = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $repositoryProduit->findAll();

        $client = $this->getUser();

        $repositoryCommandEncours = $this->getDoctrine()->getRepository(EnCours::class);
        $commandEncours = $repositoryCommandEncours->findByClient($client);

        return $this->render('default/index.html.twig', [
            'produits' => $produits,
            'commandEnCours' => $commandEncours
            ]);
    }


    /**
     * permet d'ajouter un produit
     * @Route("/product/new", name="new_produit")
     * @return Response
     */
    public function addProductAction(Request $request, ObjectManager $manager)
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($produit);
            $manager->flush();

            $this->addFlash('success',"Product <strong> {$produit->getTitle()}</strong> successfuly saved !");

            return $this->redirectToRoute('produit_show',[
                'id'=>$produit->getId()
            ]);
        }

        return $this->render('@App/ProduitsController/addProduit.html.twig',['form'=>$form->createView()]);
    }


    /**
     * permet d'afficher un seul produit
     * @Route("/product/{id}", name="produit_show")
     * @return Response
     */
    public function showProductAction($id, Produit $produit)
    {
        //recuperation du produit qui correspant a l'id
        return $this->render('@App/ProduitsController/productView.html.twig', ['produit' => $produit]);
    }


    /**
     * permet d'editerr un produit
     * @Route("/product/{id}/edit", name="produit_edit")
     * @return Response
     */
    public function editProductAction(Request $request, Produit $produit, ObjectManager $manager)
    {
       
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($produit);
            $manager->flush();

            $this->addFlash('success',"Product <strong> {$produit->getTitle()}</strong> successfuly updated !");

            return $this->redirectToRoute('produit_show',[
                'id'=>$produit->getId()
            ]);
        }


        return $this->render('@App/ProduitsController/editProduit.html.twig',['form'=>$form->createView()]);
    }

     



}
