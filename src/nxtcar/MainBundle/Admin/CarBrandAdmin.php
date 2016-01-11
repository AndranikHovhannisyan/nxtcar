<?php

namespace nxtcar\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CarBrandAdmin extends Admin
{
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
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
            ->add('title')
            ->add('models', 'sonata_type_collection', array(
                'required' => false,
                'by_reference' => true,
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'allow_delete' => true,
            ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
        ;
    }

    /**
     * @param mixed $object
     */
    public function prePersist($object)
    {
        foreach($object->getModels() as $model) {
            $model->setBrand($object);
        }
    }

    /**
     * @param mixed $object
     */
    public function preUpdate($object)
    {
        foreach($object->getModels() as $model) {
            $model->setBrand($object);
        }
    }
}
