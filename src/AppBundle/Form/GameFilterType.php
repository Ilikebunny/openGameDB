<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;


class GameFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', Filters\NumberFilterType::class)
            ->add('title', Filters\TextFilterType::class)
            ->add('releaseDate', Filters\DateFilterType::class)
            ->add('players', Filters\NumberFilterType::class)
            ->add('coop', Filters\BooleanFilterType::class)
        
            ->add('platform', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\Platform',
                    'choice_label' => 'name',
            )) 
//            ->add('developers', Filters\EntityFilterType::class, array(
//                    'choice_label' => 'name',
//            )) 
//            ->add('publishers', Filters\EntityFilterType::class, array(
//                    'class' => 'AppBundle\Entity\Company',
//                    'choice_label' => 'name',
//            )) 
//            ->add('genres', Filters\EntityFilterType::class, array(
//                    'class' => 'AppBundle\Entity\Genre',
//                    'choice_label' => 'name',
//            )) 
            ->add('contentRatings', Filters\EntityFilterType::class, array(
                    'class' => 'AppBundle\Entity\ContentRating',
                    'choice_label' => 'rating',
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
