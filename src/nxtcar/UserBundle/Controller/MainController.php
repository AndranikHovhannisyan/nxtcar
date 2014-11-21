<?php
/**
 * Created by PhpStorm.
 * User: hazarapet
 * Date: 11/12/14
 * Time: 9:57 PM
 */

namespace nxtcar\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MainController extends Controller
{
    /**
     * @Route("/preferences", name="preferences")
     * @Template("nxtcarUserBundle:Profile:preferences.html.twig")
     */
    public function indexAction()
    {
        return array();
    }
}