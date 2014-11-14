<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/14/14
 * Time: 12:08 AM
 */

namespace nxtcar\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProfileController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @Template("nxtcarMainBundle:Dashboard:dashboard.html.twig")
     */
    public function dashboardAction()
    {
        return array();
    }

    /**
     * @Route("/messages/{status}", name="messages", requirements={"status": "archived|received|questions_answers"})
     * @Template("nxtcarMainBundle:Dashboard:messages.html.twig")
     */
    public function messageAction($status)
    {
        return array('status' => $status);
    }
}