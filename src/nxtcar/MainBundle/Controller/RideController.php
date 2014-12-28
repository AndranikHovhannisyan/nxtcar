<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/22/14
 * Time: 11:43 PM
 */
namespace nxtcar\MainBundle\Controller;

use FOS\RestBundle\Util\Codes;
use nxtcar\MainBundle\Entity\InWeek;
use nxtcar\MainBundle\Entity\OneTime;
use nxtcar\MainBundle\Entity\OutWeek;
use nxtcar\MainBundle\Entity\Recurring;
use nxtcar\MainBundle\Entity\Ride;
use nxtcar\MainBundle\Entity\RideTown;
use nxtcar\MainBundle\Entity\Town;
use nxtcar\MainBundle\Entity\WeekDay;
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
     * @Template()
     */
    public function findAction(Request $request)
    {
        $obj = json_decode($request->get('ride'));

        if ($obj && isset($obj->from) && isset($obj->to)) {
            return $this->render("nxtcarMainBundle:Ride:ride_search.html.twig",
                array(
                    'from' => $obj->from->city_name,
                    'to' => $obj->to->city_name,
                )
            );
        }

        return $this->render("nxtcarMainBundle:Ride:find.html.twig");
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

        $em = $this->getDoctrine()->getManager();

        $ride = new Ride();
        if (!$this->getUser()) {
            throw new HttpException(Codes::HTTP_FORBIDDEN, "user doesn't authenticated");
        }

        $ride->setDriver($this->getUser());
        $ride->setAllPlaces($obj->seatsNumber);
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
            $oneTime->setOutDate(new \datetime($obj->departure->dateFrom));
            $oneTime->setOutHour($obj->departure->hour);
            $oneTime->setOutMinute($obj->departure->minute);

            if ($oneTime->getIsRound()) {
                $oneTime->setInDate(new \datetime($obj->return->dateTo));
                $oneTime->setInHour($obj->return->hour);
                $oneTime->setInMinute($obj->return->minute);
            }

            $em->persist($oneTime);
        }
        else
        {
            $recurring = new Recurring();
            $recurring->setIsRound($obj->Round);
            $recurring->setRide($ride);
            $recurring->setStartDate(new \datetime($obj->dateRecurringFrom));
            $recurring->setEndDate(new \datetime($obj->dateRecurringTo));
            for ($i = 0; $i <= 6; $i++)
            {
                if ((isset($obj->outWeek[$i]) && $obj->outWeek[$i]) || (isset($obj->returnWeek[$i]) && $obj->returnWeek[$i])) {
                    $weekDay = $em->getRepository('nxtcarMainBundle:WeekDay')->findBy(array('index' => $i));
                    if (!$weekDay) {
                        $weekDay = new WeekDay();
                        $weekDay->setIndex($i);
                        $em->persist($weekDay);
                    }
                    else {
                        $weekDay = $weekDay[0];
                    }

                    if (isset($obj->outWeek[$i]) && $obj->outWeek[$i]) {
                        $outWeek = new OutWeek();
                        $outWeek->setWeekDay($weekDay);
                        $outWeek->setHour($obj->outboundRecurring->hour);
                        $outWeek->setMinute($obj->outboundRecurring->minute);
                        $outWeek->setRecurring($recurring);

                        $em->persist($outWeek);
                    }

                    if ($recurring->getIsRound() && isset($obj->returnWeek[$i]) && $obj->returnWeek[$i]) {
                        $inWeek = new InWeek();
                        $inWeek->setWeekDay($weekDay);
                        $inWeek->setHour($obj->returnRecurring->hour);
                        $inWeek->setMinute($obj->returnRecurring->minute);
                        $inWeek->setRecurring($recurring);

                        $em->persist($inWeek);
                    }
                }
            }

            $em->persist($recurring);
        }

        foreach($obj->places as $place)
        {
            $town = $em->getRepository('nxtcarMainBundle:Town')->findBy(array('name' => $place->city_name));
            if (!$town) {
                $town = new Town();
                $town->setFullName($place->formatted_name);
                $town->setName($place->city_name);
                $town->setD($place->location->D);
                $town->setK($place->location->k);

                $em->persist($town);
            }
            else {
                $town = $town[0];
            }

            $rideTown = new RideTown();
            $rideTown->setBusyPlacesGo(0);
            $rideTown->setBusyPlacesReturn(0);
            $rideTown->setRide($ride);
            $rideTown->setTown($town);
            if (isset($place->priceToNearestCity)) {
                $rideTown->setPriceToNearest($place->priceToNearestCity);
            }
            $rideTown->setPositionInRide($place->index);

            $em->persist($rideTown);
        }

        $em->persist($ride);
        $em->flush();

        return new Response('ssss');
    }

    /**
     * es vonc a ches nkatel?
     * @Route("/ride/{rideId}", name="ride", requirements={"rideId" = "\d+"})
     * @Template("nxtcarMainBundle:Ride:ride.html.twig")
     */
    public function rideAction($rideId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ride = $em->getRepository('nxtcarMainBundle:Ride')->find($rideId);


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

            return $this->redirect($this->generateUrl('ride', array('rideId' => $rideId)));
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);

        return $this->render('nxtcarMainBundle:Ride:ride.html.twig', array(
            'ride' => $ride,
            'driverId'  => $ride->getDriver()->getId(),
            'comments'  => $comments,
            'thread'    => $thread,
            'form'      => $form->createView()
        ));
    }

    /**
     * @Route("/ride_search_result", name="ride_search")
     * @Template("nxtcarMainBundle:Ride:ride_search.html.twig")
     */
    public function offerSearchAction(Request $request)
    {
        return array();
    }
}