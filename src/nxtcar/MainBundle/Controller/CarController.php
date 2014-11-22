<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/22/14
 * Time: 7:54 PM
 */

namespace nxtcar\MainBundle\Controller;

use FOS\RestBundle\Util\Codes;
use nxtcar\MainBundle\Entity\Car;
use nxtcar\MainBundle\Form\Type\CarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CarController extends Controller
{
    /**
     * @Route("/car/add/{id}", name="car_add", defaults={"id" = -1})
     */
    public function carAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($id == -1) {
            $car = new Car();
        }
        else {
            $car = $em->find('nxtcarMainBundle:Car', $id);
            if (!$car) {
                throw new HttpException(Codes::HTTP_NOT_FOUND);
            }
        }

        $form = $this->createForm(new CarType(), $car);

        $form->handleRequest($request);

        if ($form->isValid())
        {

            //TODO: Must be uncommented
//            $modelId = $request->get('modelId');
//            $model = $em->getREpository('nxtcarMainBundle:CarModel')->find($modelId);
//
//            if (!$model) {
//                throw new HttpException(Codes::HTTP_BAD_REQUEST, 'please check a car model');
//            }

            $user = $this->get('security.context')->getToken()->getUser();

//            $car = $form->getData();
//            $car->setModel($model);
            $car->setUser($user);
            $em->persist($car);
            $em->flush();

            return $this->redirect($this->generateUrl('car_list'));
        }

        return $this->render('nxtcarMainBundle:Car:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/car/list", name="car_list")
     */
    public function carListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $cars = $em->getRepository('nxtcarMainBundle:Car')->findCarsByUser($user);
        return $this->render('nxtcarMainBundle:Car:list.html.twig', array('cars' => $cars));
    }

    /**
     * @Route("/car/remove/{id}", name="car_remove")
     */
    public function carRemoveAction(Car $car)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($car);
        $em->flush();

        return $this->redirect($this->generateUrl('car_list'));
    }
}