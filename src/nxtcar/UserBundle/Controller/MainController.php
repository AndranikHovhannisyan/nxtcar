<?php
/**
 * Created by PhpStorm.
 * User: hazarapet
 * Date: 11/12/14
 * Time: 9:57 PM
 */

namespace nxtcar\UserBundle\Controller;

use FOS\RestBundle\Util\Codes;
use nxtcar\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MainController extends Controller
{
    /**
     * @Route("/profile/preferences", name="profile_preferences")
     * @Template("nxtcarUserBundle:Profile:preferences.html.twig")
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
     */
    public function photoAction()
    {
        return array();
    }
}