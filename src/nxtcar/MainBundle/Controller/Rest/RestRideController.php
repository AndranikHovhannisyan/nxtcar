<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/28/14
 * Time: 12:39 AM
 */
namespace nxtcar\MainBundle\Controller\Rest;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\RouteResource("Ride")
 * @Rest\Prefix("/api")
 * @Rest\NamePrefix("rest_")
 */
class RestRideController extends FOSRestController
{
    /**
     * @param Request $request
     * @return mixed
     * @Rest\View
     */
    public function postFindAction(Request $request)
    {
        $obj = json_decode($request->getContent());
        $em = $this->getDoctrine()->getmanager();
        $time = explode(',', $this->getField($obj, 'time'));

        return $em->getRepository('nxtcarMainBundle:Ride')
            ->findRide($this->getField($obj, 'from'),
                       $this->getField($obj, 'to'),
                       $this->getField($obj, 'isRecurring'),
                       $this->getField($obj, 'date'),
                       $time[0],
                       $time[1]
            );
    }

    private function getField($parent, $child)
    {
        if (isset($parent->$child)) {
            return $parent->$child;
        }
        return null;
    }

    /**
     * @Rest\View
     */
    public function cgetIsLoginAction()
    {
        return array('user'=>!is_null($this->getUser()));
    }
}