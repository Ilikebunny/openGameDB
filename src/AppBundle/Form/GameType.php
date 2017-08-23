<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Allow custom query
use Doctrine\ORM\EntityRepository;

class GameType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title')
                ->add('type', EntityType::class, array(
                    'class' => 'AppBundle\Entity\GameVersionType',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->getSmallList();
//                        return $er->createQueryBuilder('u')->orderBy('u.title', 'ASC');
                    },
                    'empty_data' => null,
                    'required' => false,
                    'attr' => array(
                        'class' => 'chosen-select',
                        'allow_single_deselect' => true,
            )))
                ->add('releaseDate')
                ->add('overview')
//                ->add('esrb')
                ->add('players')
                ->add('coop')
//                ->add('platform', EntityType::class, array(
//                    'class' => 'AppBundle\Entity\Platform',
//                    'choice_label' => 'name',
//                    'placeholder' => 'Please choose',
//                    'empty_data' => null,
//                    'required' => false
//                ))
                ->add('platform', null, array('attr' => array(
                        'class' => 'chosen-select'
            )))
                ->add('developers', null, array('attr' => array(
                        'class' => 'chosen-select'
            )))
                ->add('publishers', null, array('attr' => array(
                        'class' => 'chosen-select'
            )))
                ->add('genres', null, array('attr' => array(
                        'class' => 'chosen-select'
            )))
                ->add('contentRatings', null, array('attr' => array(
                        'class' => 'chosen-select'
            )))
//            ->add('developers', EntityType::class, array(
//                'class' => 'AppBundle\Entity\Company',
//                'choice_label' => 'name',
//
//                'expanded' => true,
//                'multiple' => true
//            )) 
//            ->add('publishers', EntityType::class, array(
//                'class' => 'AppBundle\Entity\Company',
//                'choice_label' => 'name',
//
//                'expanded' => true,
//                'multiple' => true
//            )) 
//                ->add('genres', EntityType::class, array(
//                    'class' => 'AppBundle\Entity\Genre',
//                    'choice_label' => 'name',
//                    'expanded' => true,
//                    'multiple' => true
//                ))
//                ->add('contentRatings', EntityType::class, array(
//                    'class' => 'AppBundle\Entity\ContentRating',
//                    'choice_label' => 'rating',
//                    'expanded' => true,
//                    'multiple' => true
//                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Game'
        ));
    }

}
