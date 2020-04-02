<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Client;
use AppBundle\Entity\EnCours;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Commande;
use AppBundle\Entity\LignesCommande;
use AppBundle\Controller\CheckerController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ClientController extends Controller
{


    /**
     * @Route("/client/{id}", name="client_page")
     */
    public function indexAction(Client $client)
    {
        
        if(!$this->getUser()){
            return $this->redirectToRoute('user_login');
        }

        $commands = $this->getDoctrine()->getRepository(Commande::class)->findByClient($client);
        
        return $this->render('@App/Client/index.html.twig',[
            'client'=>$client,
            'commands'=>$commands
        ]);
    }

    /**
     * @Route("/client/command/{id}", name="command_lignes")
     */
    public function getCommandAction(Commande $command)
    {
        
        $lignesCommand = $this->getDoctrine()->getRepository(LignesCommande::class)->findByCommande($command);
        
        return $this->render('@App/Client/lignesCommand.html.twig',[
            'command'=>$command,
            'lignesCommand'=>$lignesCommand,
        ]);
    }


    /**
     * @Route("/commander", name="commander")
     */
    public function doCommandAction()
    {
        $client = $this->getUser();

        $commands = $this->getDoctrine()->getRepository(EnCours::class)->findByClient($client);
        
        return $this->render('@App/Client/commandEncours.html.twig',[
            'commands'=>$commands,
        ]);
    }


   
    /**
     * @Route("/submit", name="submit_command")
     */
    public function submitCommandAction(ObjectManager $entityManager)
    {
        $client = $this->getUser();
        
        //create a new commande
        $commande = new Commande();
        //set the client
        $commande->setClient($client);
                 
       // $entityManager->persist($commande);    
        //$entityManager->persist($commande);
        


        //get all product of this client
        $commandEncours = $this->getDoctrine()->getRepository(EnCours::class)->findByClient($client);

        $total = 0;
        foreach($commandEncours as $cmd){

            //$produit = $this->getDoctrine()->getRepository(Produit::class)->find($cmd->getProduct());
            $quantity = $cmd->getQuantity();

             //lignes of this command
             $lignesCommand = new LignesCommande();
            $lignesCommand->setCommande($commande)
                          ->setProduit($cmd->getProduit())
                          ->setQuantity($quantity);

            $entityManager->persist($lignesCommand);
            $total +=  $lignesCommand->getPrixTotal();
        }
        foreach($commandEncours as $cmd){
            $entityManager->remove($cmd);
        }

        $commande->setTotalPrice($total);
        

        $entityManager->flush();


        $this->addFlash(
            'success','Your command saved succefuly'
        );

       

        return $this->redirectToRoute('command_lignes',array('id' => $commande->getId()));
    }


    /**
     * @Route("/encours/{id}", name="command_encours")
     */
    public function deleteProductEncoursAction(EnCours $id, ObjectManager $em)
    {
        $client = $this->getUser();

        $itemEncours = $this->getDoctrine()->getRepository(EnCours::class)->find($id);
        $em -> remove($itemEncours);
        $em -> flush();
        
        return $this->redirectToRoute('commander');
    }


    

}
