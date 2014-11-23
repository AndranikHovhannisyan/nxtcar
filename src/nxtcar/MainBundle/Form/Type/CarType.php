<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/21/14
 * Time: 12:00 AM
 */

namespace nxtcar\MainBundle\Form\Type;

use nxtcar\MainBundle\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('carBrand', 'entity', array('mapped' => false, 'class' => 'nxtcarMainBundle:CarBrand'))

            //TODO: Must be deleted
            ->add('model', 'entity', array('class' => 'nxtcarMainBundle:CarModel'))

            ->add('comfort', 'choice', array(
                'choices' => array(
                    Car::COMFORT_BASIC          => 'Basic',
                    Car::COMFORT_NORMAL         => 'Normal',
                    Car::COMFORT_COMFORTABLE    => 'Comfortable',
                    Car::COMFORT_LUXURY         => 'Luxury',
                )
            ))
            ->add('numberOfSets', 'choice', array(
                'choices' => array(
                    1 => 1, 2 => 2, 3 => 3,
                    4 => 4, 5 => 5, 6 => 6,
                    7 => 7, 8 => 8, 9 => 9
                )
            ))
            ->add('color', 'entity', array('class' => 'nxtcarMainBundle:CarColor'))
            ->add('type', 'entity', array('class' => 'nxtcarMainBundle:CarType'))
            ->add('save', 'submit');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'nxtcar\MainBundle\Entity\Car'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'car_type';
    }
}