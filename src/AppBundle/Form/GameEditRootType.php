<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Allow custom query
use Doctrine\ORM\EntityRepository;

class GameEditRootType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('title')
//                ->add('gameroot')
                ->add('gameroot', EntityType::class, array(
                    'class' => 'AppBundle\Entity\GameRoot',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->getSmallList();
//                        return $er->createQueryBuilder('u')->orderBy('u.title', 'ASC');
                    },
                    'attr' => array(
                        'class' => 'chosen-select'
            )))
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
