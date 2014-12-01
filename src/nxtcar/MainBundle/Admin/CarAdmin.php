<?php

namespace nxtcar\MainBundle\Admin;

use nxtcar\MainBundle\Entity\Car;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CarAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('comfort')
            ->add('numberOfSets')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('comfort')
            ->add('numberOfSets')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
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
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('comfort')
            ->add('numberOfSets')
        ;
    }

    /**
     * @param mixed $object
     */
    public function prePersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $user = $container->get('security.context')->getToken()->getUser();
        $object->setUser($user);
    }
}
