<?php

namespace AppBundle\Form;



use AppBundle\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends ApplicationType
{
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class , $this->getConfiguration('Product title', 
                        'Your product title here !'))
                ->add('description', TextareaType::class , $this->getConfiguration('Product description', 
                        'Your product description here !'))
                ->add('urlImage',UrlType::class, $this->getConfiguration('Product image', 
                        'Select your product image here !'))
                ->add('price', MoneyType::class, $this->getConfiguration('Product price', 
                        'Your product price here !'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_produit';
    }


}
