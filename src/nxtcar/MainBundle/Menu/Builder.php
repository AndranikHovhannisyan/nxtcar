<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/13/14
 * Time: 11:34 PM
 */

namespace nxtcar\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    /**
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function profileMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $request = $this->container->get('request');
        $menu->setCurrentUri($request->getRequestUri());

        $menu->setChildrenAttribute('class', 'list-inline user-profil-menue');
        $menu->addChild('Dashboard', array('route' => 'dashboard'));
        $menu->addChild('Rides offered', array('route' => 'homepage'));
        $menu->addChild('Messages', array('route' => 'messages', 'routeParameters' => array('status' => 'received')));
        $menu->addChild('Ratings', array('route' => 'homepage'));
        $menu->addChild('Profile', array('route' => 'sonata_user_profile_edit'));

        $menu['Messages']->addChild('Archived messages', array('route' => 'messages', 'routeParameters' => array('status' => 'questions_answers')));
        $menu['Messages']->addChild('Private messages', array('route' => 'messages', 'routeParameters' => array('status' => 'received')));
        $menu['Messages']->addChild('Public questions', array('route' => 'messages', 'routeParameters' => array('status' => 'archived')));

        $menu['Profile']->setChildrenAttribute('class', 'list-unstyled profile-information');
        $menu['Profile']->addChild('Personal information', array('route' => 'sonata_user_profile_edit'));
        $menu['Profile']->addChild('Photo', array('route' => 'homepage'));
        $menu['Profile']->addChild('Preferences', array('route' => 'homepage'));
        $menu['Profile']->addChild('Car', array('route' => 'homepage'));
        $menu['Profile']->addChild('Password', array('route' => 'homepage'));


        return $menu;
    }
}