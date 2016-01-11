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
        $trans = $this->container->get('translator');
        $menu->setCurrentUri($request->getRequestUri());

        $menu->setChildrenAttribute('class', 'list-inline user-profil-menue');
        $menu->addChild('Dashboard', array('label' => $trans->trans('base.dashboard', array(), 'dashboard'), 'route' => 'dashboard'));
        $menu->addChild('Rides offered', array('label' => $trans->trans('base.rides_offered', array(), 'dashboard'), 'route' => 'ride_offered', 'routeParameters' => array('status' => 'upcoming')));
        $menu->addChild('Messages', array('label' => $trans->trans('base.messages', array(), 'dashboard'), 'route' => 'messages', 'routeParameters' => array('status' => 'received')));
        $menu->addChild('Profile', array('label' => $trans->trans('base.profile', array(), 'dashboard'), 'route' => 'sonata_user_profile_edit'));

        $menu['Messages']->setChildrenAttribute('class', 'ul-message');
        $menu['Messages']->addChild($trans->trans('base.public_questions', array(), 'dashboard'), array('route' => 'messages', 'routeParameters' => array('status' => 'questions_answers')));
        $menu['Messages']->addChild($trans->trans('base.private_messages', array(), 'dashboard'), array('route' => 'messages', 'routeParameters' => array('status' => 'received')));

        $menu['Rides offered']->setChildrenAttribute('class', 'ul-message');
        $menu['Rides offered']->addChild($trans->trans('base.upcoming_rides', array(), 'dashboard'),  array('route' => 'ride_offered', 'routeParameters' => array('status' => 'upcoming')));
        $menu['Rides offered']->addChild($trans->trans('base.past_rides', array(), 'dashboard'), array('route' => 'ride_offered', 'routeParameters' => array('status' => 'past')));


        $menu['Profile']->setChildrenAttribute('class', 'list-unstyled profile-information');
        $menu['Profile']->addChild($trans->trans('base.personal_information', array(), 'dashboard'), array('route' => 'sonata_user_profile_edit'));
        $menu['Profile']->addChild($trans->trans('base.photo', array(), 'dashboard'), array('route' => 'profile_photo'));
        $menu['Profile']->addChild($trans->trans('base.preferences', array(), 'dashboard'), array('route' => 'profile_preferences'));
        $menu['Profile']->addChild($trans->trans('base.car', array(), 'dashboard'), array('route' => 'car_list'));
        $menu['Profile']->addChild($trans->trans('base.password', array(), 'dashboard'), array('route' => 'sonata_user_change_password'));

        return $menu;
    }
}