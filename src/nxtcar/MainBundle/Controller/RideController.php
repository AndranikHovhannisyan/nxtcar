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
use JMS\SecurityExtraBundle\Annotation\Secure;

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
     * @Secure(roles="ROLE_USER")
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

        if (!$this->getUser()) {
            throw new HttpException(Codes::HTTP_FORBIDDEN, "user doesn't authenticated");
        }

        $em = $this->getDoctrine()->getManager();
        //create main ride in set it's fields
        $ride = new Ride();
        $ride->setDriver($this->getUser());
        $ride->setAllPlaces($obj->seatsNumber);
        $ride->setLuggageSize($obj->luggageSize);
        $ride->setLeavingTime($obj->leavingTime);
        $ride->setDetour($obj->detour);
        if (isset($obj->details)) {
            $ride->setDetail($obj->details);
        }

        //set ride places
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

        //set ride dates
        if ($obj->trip == 0)
        {
            //if ride isn't recurring
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
            //to generate URL
            $ride->setMainRideDate($oneTime);
        }
        else
        {
            //if ride recurring
            $recurring = new Recurring();
            $recurring->setIsRound($obj->Round);
            $recurring->setRide($ride);
            $ride->addRideDate($recurring);
            $recurring->setStartDate(new \datetime($obj->dateRecurringFrom));
            $recurring->setEndDate(new \datetime($obj->dateRecurringTo));
            for ($i = 0; $i <= 6; $i++)
            {
                if ((isset($obj->tripWeek[$i]) && $obj->tripWeek[$i]) ||
                    (isset($obj->outWeek[$i]) && $obj->outWeek[$i]) ||
                    (isset($obj->returnWeek[$i]) && $obj->returnWeek[$i]))
                {
                    $weekDay = $em->getRepository('nxtcarMainBundle:WeekDay')->findBy(array('index' => $i));
                    if (!$weekDay) {
                        $weekDay = new WeekDay();
                        $weekDay->setIndex($i);
                        $em->persist($weekDay);
                    }
                    else {
                        $weekDay = $weekDay[0];
                    }

                    if (($recurring->getIsRound() && isset($obj->outWeek[$i]) && $obj->outWeek[$i]) ||
                        (!$recurring->getIsRound() && isset($obj->tripWeek[$i]) && $obj->tripWeek[$i])) {
                        $outWeek = new OutWeek();
                        $outWeek->setWeekDay($weekDay);
                        if ($recurring->getIsRound()) {
                            $outWeek->setHour($obj->outboundRecurring->hour);
                            $outWeek->setMinute($obj->outboundRecurring->minute);
                        }
                        else {
                            $outWeek->setHour($obj->tripRecurring->hour);
                            $outWeek->setMinute($obj->tripRecurring->minute);
                        }
                        $outWeek->setRecurring($recurring);

                        $recurring->addOutDate($outWeek);
                        $em->persist($outWeek);
                    }

                    if ($recurring->getIsRound() && isset($obj->returnWeek[$i]) && $obj->returnWeek[$i]) {
                        $inWeek = new InWeek();
                        $inWeek->setWeekDay($weekDay);
                        $inWeek->setHour($obj->returnRecurring->hour);
                        $inWeek->setMinute($obj->returnRecurring->minute);
                        $inWeek->setRecurring($recurring);

                        $recurring->addInDate($inWeek);
                        $em->persist($inWeek);
                    }
                }
            }

            $em->persist($recurring);
            //to generate URL
            $ride->setMainRideDate($recurring);

            if (count($recurring->getOutDates()) < count($recurring->getInDates())) {
                throw new HttpException(Codes::HTTP_BAD_REQUEST, 'in dates is more than out dates');
            }

            $inIndex = 0;
            $inDates = $recurring->getInDates();
            foreach($recurring->getOutDates() as $outDate) {

                $weekIndex = (int) $recurring->getStartDate()->format('w');
                $dateDiffOut = $outDate->getWeekDay()->getIndex() - $weekIndex;
                if ($dateDiffOut  < 0) {
                    $dateDiffOut  = 7 + $dateDiffOut;
                }
                $serialDateOut = clone $recurring->getStartDate();
                $serialDateOut->modify("+$dateDiffOut days");

                //dates to return
                $serialDateIn = new \datetime();
                if (isset($inDates[$inIndex])) {
                    $dateDiffIn = $inDates[$inIndex]->getWeekDay()->getIndex() - $weekIndex;
                    if ($dateDiffIn  < 0) {
                        $dateDiffIn  = 7 + $dateDiffIn;
                    }
                    $serialDateIn = clone $recurring->getStartDate();
                    $serialDateIn->modify("+$dateDiffIn days");
                }


                while ($serialDateOut < $recurring->getEndDate()) {
                    $oneTime = new OneTime();
                    $oneTime->setRecurring($recurring);
                    $oneTime->setRide($ride);
                    $oneTime->setOutDate(clone $serialDateOut);
                    $oneTime->setOutHour($outDate->getHour());
                    $oneTime->setOutMinute($outDate->getMinute());
                    $ride->addRideDate($oneTime);

                    if (isset($inDates[$inIndex])) {
                        $oneTime->setInDate(clone $serialDateIn);
                        $oneTime->setInHour($inDates[$inIndex]->getHour());
                        $oneTime->setInMinute($inDates[$inIndex]->getMinute());
                        $serialDateIn->modify("+1 week");
                        $oneTime->setIsRound(true);
                    }
                    else {
                        $oneTime->setIsRound(false);
                    }

                    $em->persist($oneTime);
                    $serialDateOut->modify("+1 week");
                }

                $inIndex++;
            }
        }

        $em->persist($ride);
        $em->flush();

        return $this->redirect($this->generateUrl('ride', array('rideDateId' => $ride->getMainRideDate()->getid())));
    }

    /**
     * @Route("/ride/{rideDateId}/{direction}", name="ride", requirements={"rideDateId" = "\d+", "direction" = "0|1"}, defaults={"direction" = "0"})
     * @Template("nxtcarMainBundle:Ride:ride.html.twig")
     */
    public function rideAction($rideDateId, $direction, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rideDate = $em->getRepository('nxtcarMainBundle:RideDate')->find($rideDateId);


        $id = 'ride_' . $rideDateId;
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
            $comment->setCreatedAt(new \DateTime( 'now',  new \DateTimeZone( 'UTC' ) ));
            $manager->saveComment($comment);

            return $this->redirect($this->generateUrl('ride', array('rideDateId' => $rideDateId, 'direction' => $direction)));
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);

        //TODO: May be will be changed
        if ($rideDate instanceof Recurring) {
            $direction = 0;
        }

        return $this->render('nxtcarMainBundle:Ride:ride.html.twig', array(
            'rideDate'  => $rideDate,
            'comments'  => $comments,
            'thread'    => $thread,
            'direction' => $direction,
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

    /**
     * @Route("/rides_offered/{status}", name="ride_offered", requirements={"status" = "past|upcoming"})
     * @Template("nxtcarMainBundle:Ride:rides_offered.html.twig")
     */
    public function offeredAction($status)
    {
        $user = $this->getUser();
        if (!$user) {
            throw new HttpException(Codes::HTTP_FORBIDDEN, "user doesn't found");
        }

        $isPast = false;
        if ($status == 'past') {
            $isPast = true;
        }

        $em = $this->getDoctrine()->getManager();
        $rides = $em->getRepository('nxtcarMainBundle:Ride')->findOfferedRides($this->getUser()->getId(), $isPast);

        return array('rides' => $rides);
    }
}