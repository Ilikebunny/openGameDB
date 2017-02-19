<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;


class PlatformFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('id', Filters\NumberFilterType::class)
//            ->add('name', Filters\TextFilterType::class)
//            ->add('overview', Filters\TextFilterType::class)
//            ->add('slug', Filters\TextFilterType::class)
//            ->add('cpu', Filters\TextFilterType::class)
//            ->add('memory', Filters\TextFilterType::class)
//            ->add('graphics', Filters\TextFilterType::class)
//            ->add('soundInfo', Filters\TextFilterType::class)
//            ->add('display', Filters\TextFilterType::class)
//            ->add('maxcontrollers', Filters\NumberFilterType::class)
        
            ->add('type', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\PlatformType',
                    'choice_label' => 'name',
            )) 
//            ->add('developers', Filters\EntityFilterType::class, array(
//                    'class' => 'AppBundle\Entity\Company',
//                    'choice_label' => 'name',
//            )) 
//            ->add('manufacturers', Filters\EntityFilterType::class, array(
//                    'class' => 'AppBundle\Entity\Company',
//                    'choice_label' => 'name',
//            )) 
//            ->add('games', Filters\EntityFilterType::class, array(
//                    'class' => 'AppBundle\Entity\Game',
//                    'choice_label' => 'title',
//            )) 
//            ->add('arts', Filters\EntityFilterType::class, array(
//                    'class' => 'AppBundle\Entity\Art',
//                    'choice_label' => 'type',
//            )) 
            ->add('generation', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\Generation',
                    'choice_label' => 'name',
            )) 
        ;
        $builder->setMethod("GET");


    }

    public function getBlockPrefix()
    {
        return null;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
}
