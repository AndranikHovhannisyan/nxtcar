<?php
/**
 * Created by PhpStorm.
 * User: hazarapet
 * Date: 11/12/14
 * Time: 9:57 PM
 */

namespace nxtcar\UserBundle\Controller;

use FOS\RestBundle\Util\Codes;
use nxtcar\MainBundle\Entity\OneTime;
use nxtcar\MainBundle\Entity\Ride;
use nxtcar\MainBundle\Entity\RideDate;
use nxtcar\UserBundle\Entity\Message;
use nxtcar\UserBundle\Entity\Photo;
use nxtcar\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use JMS\SecurityExtraBundle\Annotation\Secure;

class MainController extends Controller
{
    /**
     * @Route("/profile/preferences", name="profile_preferences")
     * @Template("nxtcarUserBundle:Profile:preferences.html.twig")
     * @Secure(roles="ROLE_USER")
     */
    public function preferencesAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($request->getMethod() == "POST" && $request->get('preferences') != "") {

            $obj = json_decode($request->get('preferences'));

            if (isset($obj->chattiness) && $obj->chattiness >= 0 && $obj->chattiness <= 2) {
                $user->setChattiness($obj->chattiness);
            }
            else {
                throw new HttpException(Codes::HTTP_BAD_REQUEST);
            }

            if (isset($obj->music) && $obj->music >= 0 && $obj->music <= 2) {
                $user->setMusic($obj->music);
            }
            else {
                throw new HttpException(Codes::HTTP_BAD_REQUEST);
            }

            if (isset($obj->smoking) && $obj->smoking >= 0 && $obj->smoking <= 2) {
                $user->setSmoking($obj->smoking);
            }
            else {
                throw new HttpException(Codes::HTTP_BAD_REQUEST);
            }

            if (isset($obj->pets) && $obj->pets >= 0 && $obj->pets <= 2) {
                $user->setPets($obj->pets);
            }
            else {
                throw new HttpException(Codes::HTTP_BAD_REQUEST);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return array('user' => $user);
    }

    /**
     * @Route("/profile/photo", name="profile_photo")
     * @Template("nxtcarUserBundle:Profile:photo.html.twig")
     * @Secure(roles="ROLE_USER")
     */
    public function photoAction(Request $request)
    {
        $photo = new Photo();
        $form = $this->createFormBuilder($photo)
            ->setAction('#')
            ->add('file')
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);

        $user = $this->get('security.context')->getToken()->getUser();

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $photo->upload();

            $lastPhoto = $em->getRepository('nxtcarUserBundle:Photo')->findByUser($user);
            if (count($lastPhoto)) {
                $em->remove($lastPhoto[0]);
            }
            $photo->setUser($user);
            $user->setPhoto($photo);

            $em->persist($photo);
            $em->flush();
        }

        return array('form' => $form->createView(), 'photo' => $user->getPhoto());
    }

    /**
     * @Route("/profile/{userId}", name="user_profile", requirements={"userId" = "\d+"})
     * @Template("SonataUserBundle:Profile:show.html.twig")
     */
    public function profileAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('nxtcarUserBundle:User')->find($userId);

        return array('user' => $user);
    }

    /**
     * @Route("/message/{from}/{to}/{rideDate}", name="private_messages", requirements={"from" = "\d+", "to" = "\d+", "rideDate" = "\d+"})
     */
    public function messageAction(User $from, User $to, RideDate $rideDate)
    {
        $user = $this->getUser();
        $fromUser = null;
        $toUser = null;
        if ($user == $from && $rideDate->getRide()->getDriver() == $to) {
            $fromUser = $from;
            $toUser = $to;
        }
        elseif ($user == $to && $rideDate->getRide()->getDriver() == $to) {
            $fromUser = $to;
            $toUser = $from;
        }
        else {
            throw new HttpException(Codes::HTTP_BAD_REQUEST, 'error route parameters');
        }

        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('nxtcarUserBundle:Message')->findPrivateMessages($from, $to, $rideDate);

        $message = new Message();
        $message->setFrom($fromUser);
        $message->setTo($toUser);
        if ($rideDate instanceof OneTime && !is_null($rideDate->getRecurring())) {
            $message->setRideDate($rideDate->getRecurring());
            $message->setTempRideDate($rideDate);
        }
        else {
            $message->setRideDate($rideDate);
        }

        $form = $this->createFormBuilder($message)
            ->setAction('#')
            ->add('message')
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($this->getRequest());

        if ($form->isValid())
        {
            $message->setSendDate(new \datetime());
            $em->persist($message);
            $em->flush();

            return $this->redirect($this->generateUrl('private_messages',
                array(
                    'from'      => $from->getId(),
                    'to'        => $to->getId(),
                    'rideDate'  => $rideDate->getId()
                )
            ));
        }

        return $this->render('nxtcarUserBundle:Message:message.html.twig', array(
            'rideDate'  => $rideDate,
            'driver'    => $rideDate->getRide()->getDriver(),
            'messages'  => $messages,
            'form'      => $form->createView()
        ));
    }
}