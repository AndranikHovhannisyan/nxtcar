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
     * @Route("/ride/{rideId}", name="ride_show")
     * @Template()
     */
    public function publicMessagesAction($rideId, Request $request)
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

        return $this->render('nxtcarMainBundle:Ride:ride.html.twig', array(
            'comments' => $comments,
            'thread' => $thread,
            'form' => $form->createView()
        ));
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     * @Route("/ride/comment/save/{id}", name="ride_comment_save")
     * @Template()
     */
    public function newThreadCommentsAction($id)
    {
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (!$thread) {
            throw new NotFoundHttpException(sprintf('Thread with identifier of "%s" does not exist', $id));
        }

        $comment = $this->container->get('fos_comment.manager.comment')->createComment($thread);

//        $parent = $this->getValidCommentParent($thread, $this->getRequest()->query->get('parentId'));

        $form = $this->container->get('fos_comment.form_factory.comment')->createForm();
        $form->setData($comment);

        return $this->redirect($this->generateUrl('ride_show', array('id' => 1)));

//
//
//        $view = View::create()
//            ->setData(array(
//                'form' => $form->createView(),
//                'first' => 0 === $thread->getNumComments(),
//                'thread' => $thread,
//                'parent' => $parent,
//                'id' => $id,
//            ))
//            ->setTemplate(new TemplateReference('FOSCommentBundle', 'Thread', 'comment_new'));
//
//        return $this->getViewHandler()->handle($view);
    }
}