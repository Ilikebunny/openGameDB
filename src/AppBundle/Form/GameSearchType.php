<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GameSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('search', TextType::class, array(
        'attr' => array(
        'placeholder' => 'Search...',
        ))
        )
        ->add('Type', ChoiceType::class, array(
        'choices' => array(
        'Game' => null,
        'Platform' => true,
        'Company' => false,
        'People' => false,
        )))
        ->add('Search', SubmitType::class)
        ;
    }

}
