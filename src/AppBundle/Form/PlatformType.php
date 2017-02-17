<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PlatformType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
//                ->add('overview')
                ->add('overview', TextareaType::class, array('attr' => array(
                        'rows' => '4',
            )))
                ->add('slug')
                ->add('cpu')
                ->add('memory')
                ->add('graphics')
                ->add('soundInfo')
                ->add('display')
                ->add('maxcontrollers')
                ->add('type', EntityType::class, array(
                    'class' => 'AppBundle\Entity\PlatformType',
                    'choice_label' => 'name',
                    'placeholder' => 'Please choose',
                    'empty_data' => null,
                    'required' => false
                ))
                ->add('developers', null, array('attr' => array(
                        'class' => 'chosen-select'
            )))
                ->add('manufacturers', null, array('attr' => array(
                        'class' => 'chosen-select'
            )))
//            ->add('developers', EntityType::class, array(
//                'class' => 'AppBundle\Entity\Company',
//                'choice_label' => 'name',
//
//                'expanded' => true,
//                'multiple' => true
//            )) 
//            ->add('manufacturers', EntityType::class, array(
//                'class' => 'AppBundle\Entity\Company',
//                'choice_label' => 'name',
//
//                'expanded' => true,
//                'multiple' => true
//            )) 
                ->add('generation', EntityType::class, array(
                    'class' => 'AppBundle\Entity\Generation',
                    'choice_label' => 'name',
                    'placeholder' => 'Please choose',
                    'empty_data' => null,
                    'required' => false
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Platform'
        ));
    }

}
