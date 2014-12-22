<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/22/14
 * Time: 11:43 PM
 */
namespace nxtcar\MainBundle\Controller;

use FOS\RestBundle\Util\Codes;
use nxtcar\MainBundle\Entity\OneTime;
use nxtcar\MainBundle\Entity\Ride;
use nxtcar\MainBundle\Entity\RideTown;
use nxtcar\MainBundle\Entity\Town;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     * @Template()
     */
    public function offerAction(Request $request)
    {
        $obj = json_decode($request->get('ride'));
        if (!$obj) {
            return $this->render('nxtcarMainBundle:Ride:offer1.html.twig');
        }

        if (isset($obj->page) && $obj->page == 1) {
            return $this->render('nxtcarMainBundle:Ride:offer2.html.twig',
                array('ride' => $request->get('ride')));
        }
        elseif (!isset($obj->page) || $obj->page != 2) {
            throw new HttpException(Codes::HTTP_BAD_REQUEST, 'page field missing');
        }


        $ride = new Ride();
        $ride->setAllPlaces($obj->seatsNumber);
        $ride->setDriver($this->getUser());
        $ride->setLuggageSize($obj->luggageSize);
        $ride->setLeavingTime($obj->leavingTime);
        $ride->setDetour($obj->detour);
        if (isset($obj->details)) {
            $ride->setDetail($obj->details);
        }


        if ($obj->trip == 0)
        {
            $oneTime = new OneTime();
            $oneTime->setIsRound($obj->Round);
            $oneTime->setRide($ride);
            $oneTime->setOutDate($obj->departure->dateFrom);
            $oneTime->setOutHour($obj->departure->hour);
            $oneTime->setOutMinute($obj->departure->minute);

            if ($oneTime->getIsRound()) {
                $oneTime->setInDate($obj->return->dateTo);
                $oneTime->setInHour($obj->return->hour);
                $oneTime->setInMinute($obj->return->minute);
            }
        }
        else
        {

        }







        $em = $this->getDoctrine()->getManager();

        foreach($obj->places as $place)
        {
            $town = $em->getRepository('nxtcarMainBundle:Town')->findBy(array('name' => $place->city_name));
            if (!$town) {
                $town = new Town();
                $town->setFullName($place->formatted_name);
                $town->setName($place->city_name);
                $town->setD($place->location->D);
                $town->setK($place->location->k);
            }

            $rideTown = new RideTown();
            $rideTown->setBusyPlaces(0);
            $rideTown->setRide($ride);
            $rideTown->setTown($town);
            if (isset($place->priceToNearestCity)) {
                $rideTown->setPriceToNearest($place->priceToNearestCity);
            }
            $rideTown->setPositionInRide($place->index);
        }

        return new Response('ssss');
    }

    /**
     * es vonc a ches nkatel?
     * @Route("/ride/iii/{rideId}", name="ride")
     * @Template("nxtcarMainBundle:Ride:ride.html.twig")
     */
    public function rideAction($rideId, Request $request)
    {

    }

    /**
     * @Route("/ride_search_result", name="ride_search")
     * @Template("nxtcarMainBundle:Ride:ride_search.html.twig")
     */
    public function offerSearchAction(Request $request)
    {
        return array();
    }

    /**
     * @Route("/ride_comment/{rideId}", name="ride_comment")
     * @Template()
     */
    public function offerCommentsAction($rideId, Request $request)
    {
        $id = 'ride_' . $rideId;
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());

            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }

        $comment = $this->container->get('fos_comment.manager.comment')->createComment($thread);

        $form = $this->createFormBuilder($comment)
            ->setAction('#')
            ->add('body')
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $manager = $this->container->get('fos_comment.manager.comment');
            $manager->saveComment($comment);

            return $this->redirect($this->generateUrl('ride_comment', array('rideId' => $rideId)));
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);

        return $this->render('nxtcarMainBundle:Ride:ride_comment.html.twig', array(
            'comments' => $comments,
            'thread' => $thread,
            'form' => $form->createView()
        ));
    }
}