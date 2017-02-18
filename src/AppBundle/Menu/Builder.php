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
                'class' => 'nav navbar-nav',
            ),
        ));

        $menu->addChild('Games', array('route' => 'game'));
        $menu->addChild('Platforms', array('route' => 'platform'));
        $menu->addChild('Stats', array('route' => 'homepage'));
        $menu->addChild('API', array('route' => 'homepage'));
        $menu->addChild('Add new game', array('route' => 'homepage', 'class' => 'label label-default vertical-align'));

        return $menu;
    }

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
        $menu->addChild('Release calendar', array('route' => 'game_calendar'));

        return $menu;
    }

    public function subPlatformMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav nav-pills nav-justified',
            ),
        ));

        $menu->addChild('Browse', array('route' => 'platform'));
        $menu->addChild('Recently added', array('route' => 'homepage'));
        $menu->addChild('Recently updated', array('route' => 'homepage'));

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
        ))->setExtra('translation_domain', 'FOSUserBundle');

        //Divider
        $menu->addChild('', array('attributes' => array(
                'role' => 'separator',
                'class' => 'divider',
        )));

        $menu->addChild('layout.login', array(
            'route' => 'fos_user_security_login',
        ))->setExtra('translation_domain', 'FOSUserBundle');

        $menu->addChild('resetting.request.submit', array(
            'route' => 'fos_user_resetting_request',
        ))->setExtra('translation_domain', 'FOSUserBundle');

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
        ))->setExtra('translation_domain', 'FOSUserBundle');

        $menu->addChild('change_password.submit', array(
            'route' => 'fos_user_change_password',
        ))->setExtra('translation_domain', 'FOSUserBundle');

        //Divider
        $menu->addChild('', array('attributes' => array(
                'role' => 'separator',
                'class' => 'divider',
        )));


        $menu->addChild('layout.logout', array(
            'route' => 'fos_user_security_logout',
        ))->setExtra('translation_domain', 'FOSUserBundle');

        return $menu;
    }

}
