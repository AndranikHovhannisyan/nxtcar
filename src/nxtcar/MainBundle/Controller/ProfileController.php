<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/14/14
 * Time: 12:08 AM
 */

namespace nxtcar\MainBundle\Controller;

use FOS\RestBundle\Util\Codes;
use nxtcar\MainBundle\Form\Type\CarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    /**
     * @Route("/car/add", name="car_add")
     */
    public function carAction(Request $request)
    {
        $form = $this->createForm(new CarType());

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            //TODO: Must be uncommented
//            $modelId = $request->get('modelId');
//            $model = $em->getREpository('nxtcarMainBundle:CarModel')->find($modelId);
//
//            if (!$model) {
//                throw new HttpException(Codes::HTTP_BAD_REQUEST, 'please check a car model');
//            }

            $user = $this->get('security.context')->getToken()->getUser();

            $car = $form->getData();
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
        return $this->render('nxtcarMainBundle:Car:list.html.twig');
    }
}
