<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/20/14
 * Time: 11:20 PM
 */

namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Class CarModel
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class CarModel extends CarProperty
{
    /**
     * @ORM\ManyToOne(targetEntity="CarBrand", inversedBy="models")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     * @Groups({"model_brand"})
     */
    protected $brand;

    /**
     * @var integer
     * @Groups({"model"})
     */
    protected $id;

    /**
     * @var string
     * @Groups({"model"})
     */
    protected $title;

    public function __toString()
    {
        return ($this->brand) ? $this->brand->getTitle() . '_' . $this->title : '';
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
     * @return CarModel
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
     * Set brand
     *
     * @param \nxtcar\MainBundle\Entity\CarBrand $brand
     * @return CarModel
     */
    public function setBrand(\nxtcar\MainBundle\Entity\CarBrand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \nxtcar\MainBundle\Entity\CarBrand 
     */
    public function getBrand()
    {
        return $this->brand;
    }
}
