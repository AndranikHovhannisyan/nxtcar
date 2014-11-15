<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/15/14
 * Time: 1:16 AM
 */

namespace nxtcar\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sonata\UserBundle\Model\UserInterface;
use Sonata\UserBundle\Controller\RegistrationFOSUser1Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends RegistrationFOSUser1Controller
{
    /**
     * @return RedirectResponse
     *
     * @Route("/register", name="register")
     */
    public function registerAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user instanceof UserInterface && 'POST' === $this->container->get('request')->getMethod()) {
            $this->container->get('session')->getFlashBag()->set('sonata_user_error', 'sonata_user_already_authenticated');
            $url = $this->container->get('router')->generate('sonata_user_profile_show');

            return new RedirectResponse($url);
        }

        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $request = $this->container->get('request');

        $process = false;
        if ($request->get('gender') && $request->get('lastName') && $request->get('birthYear')) {
            $process = $formHandler->process($confirmationEnabled);
        }

        if ($process) {
            $user = $form->getData();

            $user->setGender($request->get('gender'));
            $user->setFirstName($user->getUsername());
            $user->setLastName($request->get('lastName'));
            $user->setYearOfBirth($request->get('birthYear'));
            $user->setUsername($user->getEmail());

            $em = $this->container->get('doctrine')->getManager();
            $em->flush();

            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = $this->container->get('session')->get('sonata_basket_delivery_redirect', 'sonata_user_profile_show');
                $this->container->get('session')->remove('sonata_basket_delivery_redirect');
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('session')->get('sonata_user_redirect_url');

            if (null === $url || "" === $url) {
                $url = $this->container->get('router')->generate($route);
            }

            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            return $response;
        }

        $this->container->get('session')->set('sonata_user_redirect_url', $this->container->get('request')->headers->get('referer'));

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' =>       $form->createView(),
        ));
    }
}