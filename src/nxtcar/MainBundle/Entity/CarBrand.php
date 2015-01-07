<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/20/14
 * Time: 11:22 PM
 */

namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Class CarBrand
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class CarBrand extends CarProperty
{
    /**
     * @ORM\OneToMany(targetEntity="CarModel", mappedBy="brand", cascade={"persist"})
     * @Groups({"brand_model"})
     */
    protected $models;

    /**
     * @var integer
     * @Groups({"brand"})
     */
    protected $id;

    /**
     * @var string
     * @Groups({"brand"})
     */
    protected $title;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->models = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return CarBrand
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
     * Add models
     *
     * @param \nxtcar\MainBundle\Entity\CarModel $models
     * @return CarBrand
     */
    public function addModel(\nxtcar\MainBundle\Entity\CarModel $models)
    {
        $this->models[] = $models;

        return $this;
    }

    /**
     * Remove models
     *
     * @param \nxtcar\MainBundle\Entity\CarModel $models
     */
    public function removeModel(\nxtcar\MainBundle\Entity\CarModel $models)
    {
        $this->models->removeElement($models);
    }

    /**
     * Get models
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModels()
    {
        return $this->models;
    }
}
