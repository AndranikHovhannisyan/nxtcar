<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/17/14
 * Time: 11:15 PM
 */

namespace nxtcar\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $array = array();
        for($i = 1996; $i >= 1914; $i--) {
            $array[$i] = $i;
        }

        $builder
            ->add('gender', 'choice', array('empty_value' => 'Gender', 'required' => false,
                    'choices' => array(
                        'f' => 'Female',
                        'm' => 'Male')
            ))
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('email', 'email', array('required' => false))
            ->add('plainPassword', 'repeated', array(
                'required' => false,
                'type' => 'password',
                'options' => array(),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('yearOfBirth', 'choice', array('empty_value' => 'Birth year', 'choices' => $array, 'required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'nxtcar\UserBundle\Entity\User',
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'nxtcar_user_registration';
    }
}