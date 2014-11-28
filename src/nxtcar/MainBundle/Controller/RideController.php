<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/22/14
 * Time: 11:43 PM
 */
namespace nxtcar\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/ride/offer1", name="ride_offer1")
     * @Template("nxtcarMainBundle:Ride:offer1.html.twig")
     */
    public function offer1Action()
    {
        return array();
    }

    /**
     * @Route("/ride/offer2", name="ride_offer2")
     * @Template("nxtcarMainBundle:Ride:offer2.html.twig")
     */
    public function offer2Action()
    {
        return array();
    }

    /**
     * @Route("/ride/{id}", name="ride_show")
     * @Template()
     */
    public function publicMessagesAction($id, Request $request)
    {
        $id = 'ride_' . $id;
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());

            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);

        return $this->render('nxtcarMainBundle:Ride:ride.html.twig', array(
            'comments' => $comments,
            'thread' => $thread,
        ));
    }
}