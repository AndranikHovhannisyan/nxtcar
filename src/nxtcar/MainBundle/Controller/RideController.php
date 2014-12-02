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
        $ride = json_decode($this->getRequest()->get('ride'),true);
        //var_dump($ride);exit;
        return array('ride'=>$ride,'places'=>$ride['places'],'departure'=>$ride['departure']);
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

            return $this->redirect($this->generateUrl('ride_show', array('rideId' => $rideId)));
        }

        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);

        return $this->render('nxtcarMainBundle:Ride:ride_comment.html.twig', array(
            'comments' => $comments,
            'thread' => $thread,
            'form' => $form->createView()
        ));
    }
}