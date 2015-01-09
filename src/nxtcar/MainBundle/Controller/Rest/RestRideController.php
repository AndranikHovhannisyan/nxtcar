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
     * @Rest\View(serializerGroups={"ride", "ride_rideTown", "rideTown", "rideTown_town",
     *                              "town", "ride_driver", "user", "user_photo", "photo", "ride_date",
     *                              "recurring", "recurring_outWeek", "recurring_inWeek",
     *                              "inWeek", "inWeek_weekDay", "outWeek", "outWeek_weekDay", "weekDay",
     *                              "oneTime"
     * })
     */
    public function postFindAction(Request $request)
    {
        $obj = json_decode($request->getContent());
        $em = $this->getDoctrine()->getmanager();
        $time = explode(',', $this->getField($obj, 'time'));

        $rides = $em->getRepository('nxtcarMainBundle:Ride')
            ->findRide($this->getField($obj, 'from'),
                       $this->getField($obj, 'to'),
                       $this->getField($obj, 'isRecurring'),
                       $this->getField($obj, 'date'),
                       $time[0],
                       $time[1]
            );

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
            'rides' => $rides,
            'count' => count($rides)
        );
    }

    const PRICE_ASC     = 1;
    const PRICE_DESC    = -1;
    const DATE_ASC      = 2;
    const DATE_DESC     = -2;

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