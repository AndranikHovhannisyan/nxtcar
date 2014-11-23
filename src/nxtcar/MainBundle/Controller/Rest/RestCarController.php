<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/23/14
 * Time: 8:28 PM
 */
namespace nxtcar\MainBundle\Controller\Rest;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use nxtcar\MainBundle\Entity\CarBrand;

/**
 * @Rest\RouteResource("Car")
 * @Rest\Prefix("/api")
 * @Rest\NamePrefix("rest_")
 */
class RestCarController extends FOSRestController
{
    /**
     * @Rest\View(serializerGroups={"model"})
     */
    public function cgetModelAction(CarBrand $brand)
    {
        $em = $this->getDoctrine()->getManager();
        $models = $em->getRepository('nxtcarMainBundle:CarModel')->findByBrand($brand);
        return $models;
    }
}