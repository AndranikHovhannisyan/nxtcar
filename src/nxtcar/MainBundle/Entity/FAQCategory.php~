<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/20/14
 * Time: 6:29 PM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FAQCategory
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_category")
 */
class FAQCategory
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="FAQCategory", mappedBy="parentCategory", cascade={"persist"})
     */
    protected $subCategories;

    /**
     * @ORM\ManyToOne(targetEntity="FAQCategory", inversedBy="subCategories")
     * @ORM\JoinColumn(name="parent_category", referencedColumnName="id")
     */
    protected $parentCategory;

    /**
     * @ORm\OneToMany(targetEntity="FAQQuestion", mappedBy="category")
     */
    protected $questions;

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->title;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FAQCategory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add subCategories
     *
     * @param \nxtcar\MainBundle\Entity\FAQCategory $subCategories
     * @return FAQCategory
     */
    public function addSubCategory(\nxtcar\MainBundle\Entity\FAQCategory $subCategories)
    {
        $this->subCategories[] = $subCategories;

        return $this;
    }

    /**
     * @param FAQCategory $subCategories
     * @return FAQCategory
     */
    public function addSubCategorie(\nxtcar\MainBundle\Entity\FAQCategory $subCategories)
    {
        return $this->addSubCategory($subCategories);
    }

    /**
     * Remove subCategories
     *
     * @param \nxtcar\MainBundle\Entity\FAQCategory $subCategories
     */
    public function removeSubCategory(\nxtcar\MainBundle\Entity\FAQCategory $subCategories)
    {
        $this->subCategories->removeElement($subCategories);
    }

    /**
     * Get subCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubCategories()
    {
        return $this->subCategories;
    }

    /**
     * Set parentCategory
     *
     * @param \nxtcar\MainBundle\Entity\FAQCategory $parentCategory
     * @return FAQCategory
     */
    public function setParentCategory(\nxtcar\MainBundle\Entity\FAQCategory $parentCategory = null)
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }

    /**
     * Get parentCategory
     *
     * @return \nxtcar\MainBundle\Entity\FAQCategory 
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }

    /**
     * Add questions
     *
     * @param \nxtcar\MainBundle\Entity\FAQQuestion $questions
     * @return FAQCategory
     */
    public function addQuestion(\nxtcar\MainBundle\Entity\FAQQuestion $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \nxtcar\MainBundle\Entity\FAQQuestion $questions
     */
    public function removeQuestion(\nxtcar\MainBundle\Entity\FAQQuestion $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
