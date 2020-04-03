<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\EnCours;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Commande;
use AppBundle\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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

        $user = $this->getUser();

        $repositoryCommandEncours = $this->getDoctrine()->getRepository(EnCours::class);
        $commandEncours = $repositoryCommandEncours->findAll();

        return $this->render('default/index.html.twig', [
            'produits' => $produits,
            'commandEnCours' => $commandEncours
            ]);
    }


    /**
     * permet d'ajouter un produit
     * @Route("/product/new", name="new_produit")
     * @IsGranted("ROLE_ADMIN")
     * 
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
     * @return JsonResponse
     */
    public function showProductAction($id)
    {
        
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);

        $idPro = $produit->getId();
        $title = $produit->getTitle();
        $description = $produit->getDescription();
        $image = $produit->getUrlImage();
        $price = $produit->getPrice();

        return new JsonResponse(['result' => 'ok', 
                                'id' => $idPro, 
                                'title' => $title,
                                'description' => $description,
                                'image' => $image,
                                'price'=> $price
        ]);
       

       
        //recuperation du produit qui correspant a l'id
        //return $this->render('@App/ProduitsController/productView.html.twig', ['produit' => $produit, 'test'=>$produit]);
    }


    /**
     * permet d'editerr un produit
     * @Route("/product/{id}/edit", name="produit_edit")
     * @IsGranted("ROLE_ADMIN")
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

    /**
     * tous les produit index page
     * @Route("/allClients", name="all_clients")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * 
     */
    public function allClientsAction(ObjectManager $manager)
    {
        $repositoryClient = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repositoryClient->findByDeletedAt(null);

        return $this->render('@App/ProduitsController/allClients.html.twig',['clients'=>$clients]);

    }

     /**
     * @Route("/deleteClient/{id}", name="delete_client")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteClientAction(Client $id, ObjectManager $em)
    {
       
        $id->setDeletedAt(new \DateTime());
        
        $em -> flush();
        $this->addFlash(
            'success','This client deleted succefuly'
        );
        return $this->redirectToRoute('all_clients');
    }


    /**
     * tous les produit index page
     * @Route("/allCommands", name="all_commands")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     * 
     */
    public function allCommandsAction(ObjectManager $manager)
    {
        $repositoryCommands = $this->getDoctrine()->getRepository(Commande::class);
        $commands = $repositoryCommands->findAll();

        $manager->flush();

        return $this->render('@App/ProduitsController/allCommands.html.twig',['commands'=>$commands]);

    }


    /**
     * @Route("/encours/{id}/{qte}", name="ajax_call")
     */
    public function addEncoursAction($id,$qte,ObjectManager $manager)
    {
        
        $repositoryProduit = $this->getDoctrine()->getRepository(Produit::class);
        $produit = $repositoryProduit->find($id);

        $client = $this->getUser();

        $encours = new EnCours();

        $encours->setProduit($produit)
                ->setQuantity($qte)
                ->setClient($client);

        $manager->persist($encours);
        $manager->flush();

        $id = $encours->getId();
        $idProduct = $encours->getIdProduct();
        $qte = $encours->getQuantity();
        

       
        return new JsonResponse(['result' => 'ok', 
                                    'id' => $id, 
                                    'idProduct' => $idProduct,
                                    'qte' => $qte                                    
                            ]);

    }

     



}
