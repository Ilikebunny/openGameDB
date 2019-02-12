<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('searchstring', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Search...',
                    ))
                )
                ->add('type', ChoiceType::class, array(
                    'label' => false,
                    'choices' => array(
                        'Game' => 0,
                        'Platform' => 1,
//        'Company' => 2,
//        'People' => 3,
            )))
                ->add('Search', SubmitType::class, array(
                    'attr' => array(
                        'class' => 'btn btn-outline-success my-2 my-sm-0',
                    )))
        ;
    }

}
