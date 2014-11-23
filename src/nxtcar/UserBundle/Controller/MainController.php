<?php
/**
 * Created by PhpStorm.
 * User: hazarapet
 * Date: 11/12/14
 * Time: 9:57 PM
 */

namespace nxtcar\UserBundle\Controller;

use nxtcar\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MainController extends Controller
{
    /**
     * @Route("/profile/preferences/{id}", name="profile_preferences")
     * @Template("nxtcarUserBundle:Profile:preferences.html.twig")
     */
    public function preferencesAction(User $id)
    {
        return array();
    }

    /**
     * @Route("/profile/photo", name="profile_photo")
     * @Template("nxtcarUserBundle:Profile:photo.html.twig")
     */
    public function photoAction()
    {
        return array();
    }
}