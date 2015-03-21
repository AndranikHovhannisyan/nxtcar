<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/19/14
 * Time: 12:50 AM
 */

namespace nxtcar\UserBundle\Form\Type;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditFormType extends AbstractType
{
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $array = array();
        for($i = 1996; $i >= 1914; $i--) {
            $array[$i] = $i;
        }

        $user = $this->container->get('security.context')->getToken()->getUser();
        $displayedAs1 = $user->getFirstname();
        $displayedAs2 = $user->getFirstname() . ' ' .substr($user->getLastname(), 0, 1);

        $displayArray = array();
        if ($displayedAs1 != "") {
            $displayArray = array(
                $displayedAs1 => $displayedAs1,
                $displayedAs2 => $displayedAs2
            );
        }

        $builder
            ->add('gender', 'choice', array('empty_value' => 'Gender', 'required' => false,
                'choices' => array(
                    'f' => 'Female',
                    'm' => 'Male')
            ))
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('displayedAs', 'choice', array('required' => false,
                'data' => $displayedAs1,
                'choices' => $displayArray
            ))
            ->add('email', 'email', array('required' => false, 'translation_domain' => 'FOSUserBundle'))
            ->add('locale', 'locale', array('required' => false))
            ->add('phone', null, array('required' => false))
            ->add('showPhoneNumber', null, array('required' => false))
            ->add('yearOfBirth', 'choice', array(
                'empty_value' => 'Birth year',
                'choices' => $array, 'required' => true,
            ))
            ->add('biography', 'textarea',  array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'nxtcar\UserBundle\Entity\User',
            'intention'  => 'edit',
        ));
    }

    public function getName()
    {
        return 'nxtcar_user_edit';
    }
}