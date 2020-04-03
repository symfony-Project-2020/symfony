<?php

namespace AppBundle\Controller;

use DateTime;
use Faker\Factory;
use AppBundle\Entity\Role;
use AppBundle\Entity\Client;
use AppBundle\Entity\EnCours;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Commande;
use AppBundle\Entity\LignesCommande;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FakeControllerController extends Controller
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    /**
     * @Route("/database")
     */
    public function addAction(ObjectManager $em)
    {
        $faker = Factory::create();

        $entityManager = $this->getDoctrine()->getManager();


        //creation des produits dans la base de donnees
        $produits = [];
        for ($i = 0; $i < 20; $i++) {
            $product = new Produit();
            $product->setTitle($faker->word)
                    ->setDescription($faker->word)
                    ->setPrice(mt_rand(90,1000)/3)
                    ->setUrlImage($faker->imageUrl(640,480));
    
            $produits[] = $product;
            $em->persist($product);
        }

        //creation des clients dans la base de donnes
        $clients = [];

        $genres = ['men','female'];

       for($i = 0; $i < 20; $i++){

            $client = new Client();

            $genre = $faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99) . '.jpg';
            $picture .= ($genre == 'men' ? 'men/' : 'women/') . $pictureId;
            $hash = $this->encoder->encodePassword($client, 'pass');

            $client->setEmail($faker->email)
                   ->setPassword($hash)
                   ->setUrlAvatar($picture);

                   $clients[] = $client;

                   $em->persist($client);
        }

        //creation des commandes aleatoirement
        $commands = [];
        for($i = 0; $i < 20; $i++){
                $client = $clients[mt_rand(0, count($clients) - 1)];
                $commande = new Commande();
                $commande->setClient($client)
                         ->setTotalPrice(mt_rand(10, 100));

                $commands[] = $commande;
                $em->persist($commande);
            }


            //inserer les lignes de commandes pour des commandes
            for($i = 0; $i < 60; $i++){
                
                $ligneCommand = new LignesCommande();
                $myProduct = $produits[mt_rand(0,count($produits) - 1)];
                $ligneCommand->setCommande($commands[mt_rand(0,count($commands) - 1)])
                              ->setProduit($myProduct)
                              ->setQuantity(mt_rand(1,3));
                              
                $entityManager->persist($ligneCommand);
            }


    
    
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('created');
    } 


    /**
     * @Route("/adminCreator")
     */
    public function addAdminAction(ObjectManager $em)
    {
        $faker = Factory::create();
        $client = new Client();
        $picture = 'https://randomuser.me/api/portraits/';
        $pictureId = $faker->numberBetween(1, 99) . '.jpg';
        $picture .= 'men/'. $pictureId;
        $hash = $this->encoder->encodePassword($client, 'pass');

        $client->setEmail('admin@admin.com')
               ->setPassword($hash)
               ->setUrlAvatar($picture);

               $em->persist($client);
               $em->flush();
               return new Response('admin created');
    }
}
