<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/22/14
 * Time: 11:43 PM
 */
namespace nxtcar\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RideController extends Controller
{
    /**
     * @Route("/ride/find", name="ride_find")
     * @Template("nxtcarMainBundle:Ride:find.html.twig")
     */
    public function findAction()
    {
        return array();
    }

    /**
     * @Route("/ride/offer", name="ride_offer")
     * @Template("nxtcarMainBundle:Ride:offer.html.twig")
     */
    public function offerAction()
    {
        return array();
    }
}