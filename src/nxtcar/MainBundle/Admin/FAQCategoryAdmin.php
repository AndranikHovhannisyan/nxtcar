<?php

namespace nxtcar\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FAQCategoryAdmin extends Admin
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
            ->add('subCategories', null, array('admin_code' => 'nxtcar_main.admin.faq_sub_category'))
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
            ->add('subCategories', 'sonata_type_collection', array(
                'label' => 'SubCategory',
                'required' => false,
                'by_reference' => true,
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'allow_delete' => true,
                'admin_code' => 'nxtcar_main.admin.faq_sub_category',
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
     * @return mixed|void
     */
    public function prePersist($object)
    {
        foreach($object->getSubCategories() as $category) {
            $category->setParentCategory($object);
        }
    }

    /**
     * @param mixed $object
     * @return mixed|void
     */
    public function preUpdate($object)
    {
        foreach($object->getSubCategories() as $category) {
            $category->setParentCategory($object);
        }
    }
}
