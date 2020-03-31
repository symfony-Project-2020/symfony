<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\Commande;
use AppBundle\Entity\LignesCommande;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ClientController extends Controller
{
    /**
     * @Route("/client/{id}", name="client_page")
     */
    public function indexAction(Client $client)
    {
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


    

}
