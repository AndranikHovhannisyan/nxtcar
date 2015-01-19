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
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     * @Rest\View(serializerGroups={"ride", "ride_rideTown", "rideTown", "rideTown_town",
     *                              "town", "ride_driver", "user", "user_photo", "photo", "ride_date",
     *                              "recurring", "recurring_outWeek", "recurring_inWeek",
     *                              "inWeek", "inWeek_weekDay", "outWeek", "outWeek_weekDay", "weekDay",
     *                              "oneTime"
     * })
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function postFindAction(Request $request)
    {
        $obj = json_decode($request->getContent());
        $em = $this->getDoctrine()->getmanager();
        $time = explode(',', $this->getField($obj, 'time'));

        if (is_null($this->getField($obj, 'from')) ||
            is_null($this->getField($obj, 'to'))) {
            throw new HttpException(Codes::HTTP_BAD_REQUEST);
        }

        $rides = $em->getRepository('nxtcarMainBundle:Ride')
            ->findRide($this->getField($obj, 'from'),
                       $this->getField($obj, 'to'),
                       $this->getField($obj, 'date'),
                       $time[0],
                       $time[1],
                       $this->getField($obj, 'sort'),
                       $page = $this->getField($obj, 'page')  ? $this->getField($obj, 'page')  : 1
            );

//        $page = $this->getField($obj, 'page')  ? $this->getField($obj, 'page')  : 1;

        if (!is_null($this->getField($obj, 'sort')) && $this->getField($obj, 'sort') == self::PRICE_ASC) {
            usort($rides, function($a, $b) {
                return $a->getPrice() > $b->getPrice();
            });
        }
        elseif (!is_null($this->getField($obj, 'sort')) && $this->getField($obj, 'sort') == self::PRICE_DESC) {
            usort($rides, function($a, $b) {
                return $a->getPrice() < $b->getPrice();
            });
        }
        elseif (!is_null($this->getField($obj, 'sort')) && $this->getField($obj, 'sort') == self::DATE_ASC) {
            usort($rides, function($a, $b) {
                return $a->getOutDate() < $b->getOutDate();
            });
        }
        elseif (!is_null($this->getField($obj, 'sort')) && $this->getField($obj, 'sort') == self::DATE_DESC) {
            usort($rides, function($a, $b) {
                return $a->getOutDate() > $b->getOutDate();
            });
        }

        return array(
            'rides' => array_slice($rides, ($page - 1) * self::PAGE_COUNT, self::PAGE_COUNT),
            'count' => count($rides)
        );
    }

    const PAGE_COUNT    =  10;
    const PRICE_ASC     =  1;
    const PRICE_DESC    = -1;
    const DATE_ASC      =  2;
    const DATE_DESC     = -2;

    /**
     * @param $parent
     * @param $child
     * @return null
     */
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
        return array('user' => true);
    }
}