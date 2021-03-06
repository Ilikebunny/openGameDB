<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface {

    use ContainerAwareTrait;

    public function mainNavBarMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'navbar-nav ml-auto',
            ),
        ));

        $menu->addChild('Games', array('route' => 'gameroot'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Platforms', array('route' => 'platform'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Stats', array('route' => 'stats'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('API', array('route' => 'nelmio_api_doc_index'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
//        $menu->addChild('Add new game', array('route' => 'homepage', 'class' => 'label label-default vertical-align'));
        $menu->addChild('Add new game', array('route' => 'homepage'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');

        return $menu;
    }

    public function subGameMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav nav-pills nav-justified',
            ),
        ));

        $menu->addChild('Browse Games', array('route' => 'gameroot'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Browse Versions', array('route' => 'game'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Add', array('route' => 'homepage'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Top Rated', array('route' => 'homepage'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Recently added', array('route' => 'homepage'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Recently updated', array('route' => 'homepage'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Upcoming', array('route' => 'homepage'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Release calendar', array('route' => 'game_calendar'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');

        return $menu;
    }

    public function subPlatformMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav nav-pills nav-justified',
            ),
        ));

        $menu->addChild('Browse', array('route' => 'platform'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Recently added', array('route' => 'homepage'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Recently updated', array('route' => 'homepage'))
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');

        return $menu;
    }

    public function subStatMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav nav-pills nav-justified',
            ),
        ));

        $menu->addChild('Game', array('route' => 'stats_game'));
        $menu->addChild('Platform', array('route' => 'stats_platform'));
        $menu->addChild('Art', array('route' => 'stats_art'));
        $menu->addChild('Companies', array('route' => 'stats_company'));

        return $menu;
    }

    public function userNotLoggedMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'dropdown-menu',
            ),
        ));

        $menu->addChild('layout.register', array(
                    'route' => 'fos_user_registration_register',
                ))->setExtra('translation_domain', 'FOSUserBundle')
                ->setLinkAttribute('class', 'nav-link');

        //Divider
        $menu->addChild('', array('attributes' => array(
                'role' => 'separator',
                'class' => 'dropdown-divider',
        )));

        $menu->addChild('layout.login', array(
                    'route' => 'fos_user_security_login',
                ))->setExtra('translation_domain', 'FOSUserBundle')
                ->setLinkAttribute('class', 'nav-link');

        $menu->addChild('resetting.request.submit', array(
                    'route' => 'fos_user_resetting_request',
                ))->setExtra('translation_domain', 'FOSUserBundle')
                ->setLinkAttribute('class', 'nav-link');

        return $menu;
    }

    public function userLoggedMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'dropdown-menu',
            ),
        ));

        $menu->addChild('Editer compte', array(
                    'route' => 'fos_user_profile_edit',
                ))->setExtra('translation_domain', 'FOSUserBundle')
                ->setLinkAttribute('class', 'nav-link');

        $menu->addChild('change_password.submit', array(
                    'route' => 'fos_user_change_password',
                ))->setExtra('translation_domain', 'FOSUserBundle')
                ->setLinkAttribute('class', 'nav-link');

        //Divider
        $menu->addChild('', array('attributes' => array(
                'role' => 'separator',
                'class' => 'dropdown-divider',
        )));


        $menu->addChild('layout.logout', array(
                    'route' => 'fos_user_security_logout',
                ))->setExtra('translation_domain', 'FOSUserBundle')
                ->setLinkAttribute('class', 'nav-link');

        return $menu;
    }

}
