<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface {

    use ContainerAwareTrait;

    public function subGameMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav nav-pills nav-justified',
            ),
        ));

        $menu->addChild('Browse', array('route' => 'game'));
        $menu->addChild('Add', array('route' => 'homepage'));
        $menu->addChild('Top Rated', array('route' => 'homepage'));
        $menu->addChild('Recently added', array('route' => 'homepage'));
        $menu->addChild('Recently updated', array('route' => 'homepage'));
        $menu->addChild('Upcoming', array('route' => 'homepage'));
        $menu->addChild('Release calendar', array('route' => 'homepage'));

        return $menu;
    }

}
