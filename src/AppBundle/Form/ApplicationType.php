<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;

    class ApplicationType extends AbstractType
    {
        //permet d'avoir le configuration de base d'un champs
    protected function getConfiguration($label, $placeholder){
        return [
            'label'=>$label,
            'attr'=>[
                'placeholder'=>$placeholder
                ]
            ];
    }

    }