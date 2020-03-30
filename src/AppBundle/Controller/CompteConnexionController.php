<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Form\ClientType;
use AppBundle\Form\CompteType;
use AppBundle\Entity\PasswordUpdate;
use AppBundle\Form\PasswordUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompteConnexionController extends Controller
{
    

    /**
     * Permet d'inscrire un client
     * 
     * @Route("/signin", name="user_signin")
     * 
     * @return Response
     */
    public function signInAction(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $client =  new Client();

        $form = $this->createForm(ClientType::class, $client);

        $form -> handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid() ){
            $pass = $encoder->encodePassword($client, $client->getPassword());
            $client->setPassword($pass);

            $manager->persist($client);
            $manager->flush();

            $this->addFlash(
                'success','Your account is created, you can now create your command'
            );

            return $this->redirectToRoute('index_route');


        }
        // replace this example code with whatever you need
        return $this->render('@App/ProduitsController/signin.html.twig',['form'=> $form -> createView()]);
    }



     /**
      * permet de se connecter
     * @Route("/login", name="user_login")
     * 
     */
    public function logInAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $username = $authenticationUtils->getLastUsername();

        
        return $this->render('@App/ProduitsController/login.html.twig',[
            'error' => $error !== null,
            'username' => $username
            ]);
    }

     /**
      * permet de deconnecter
     * @Route("/logout", name="user_logout")
     * 
     */
    public function logOutAction()
    {
        // replace this example code with whatever you need
        }


    /**
      * permet d'editer le profile'
     * @Route("/edit/profile", name="user_profile")
     * 
     */
    public function editProfileAction(Request $request,ObjectManager $manager)
    {
        $client = $this->getUser();
        $form = $this->createForm(CompteType::class, $client);

        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){
            $manager->persist($client);
            $manager->flush();
            $this->addFlash(
                'success','Your account is successfuly updated'
            );
        }

        return $this->render('@App/ProduitsController/profile.html.twig',[
            'form'=>$form->createView()
        ]);
    }


      /**
      * permet d'editer le profile'
     * @Route("/edit/password", name="user_password")
     * 
     */
    public function editPasswordAction(Request $request,ObjectManager $manager)
    {
        $password = new PasswordUpdate();
        
        $formForPass = $this->createForm(PasswordUpdateType::class, $password);
        
        return $this->render('@App/ProduitsController/profilePass.html.twig',[
            'form'=>$formForPass->createView()
        ]);


    }


      }
