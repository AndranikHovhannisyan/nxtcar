<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/20/14
 * Time: 7:14 PM
 */
namespace nxtcar\MainBundle\Controller;

use FOS\RestBundle\Util\Codes;
use nxtcar\MainBundle\Entity\FAQQuestion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use JMS\SecurityExtraBundle\Annotation\Secure;

class FAQController extends Controller
{
    /**
     * @Route("/faq/{id}", name="category", defaults={"id" = -1})
     */
    public function categoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = null;
        $category = null;
        if ($id == -1) {
            $categories = $em->getRepository('nxtcarMainBundle:FAQCategory')->findBy(array('parentCategory' => null));
        }
        else {
            $category = $em->getRepository('nxtcarMainBundle:FAQCategory')->find($id);
        }


        return $this->render('nxtcarMainBundle:FAQ:category.html.twig', array('categories' => $categories, 'category' => $category));
    }

    /**
     * @Route("/faq/question/{id}", name="question")
     */
    public function questionAction(FAQQuestion $question)
    {
        return $this->render('nxtcarMainBundle:FAQ:question.html.twig', array('question' => $question));
    }
}