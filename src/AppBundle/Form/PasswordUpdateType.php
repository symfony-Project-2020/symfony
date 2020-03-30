<?php

namespace AppBundle\Form;





use AppBundle\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PasswordUpdateType extends ApplicationType
{
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ancienPassword', PasswordType::class, $this->getConfiguration("Password","Write your password ..."))
                ->add('newPassword', PasswordType::class, $this->getConfiguration("Password","Write your new password ..."))
                ->add('confirmPassword', PasswordType::class, $this->getConfiguration("Password confirmation","Write your password confirmation ..."));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PasswordUpdate'
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
