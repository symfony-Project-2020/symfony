<?php

namespace AppBundle\Form;





use AppBundle\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ClientType extends ApplicationType
{
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', TextType::class, $this->getConfiguration("Email","Write your email ..."))
                ->add('password', PasswordType::class, $this->getConfiguration("Password","Write your password ..."))
                ->add('passwordConfirmation', PasswordType::class, $this->getConfiguration("Password confirmation","Write your password confirmation ..."))
                ->add('urlAvatar',UrlType::class, $this->getConfiguration("Profile image","Select your image"));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_client';
    }


}
