<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/20/14
 * Time: 11:24 PM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CarProperty
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="car_property")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"brand" = "CarBrand", "model" = "CarModel", "color" = "CarColor", "type" = "CarType"})
 */
class CarProperty
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\COlumn(name="title", type="string", length=25, nullable=false)
     */
    protected $title;

    /**
     * @return string
     */
    public function __toString()
    {
        return ($this->title) ? $this->title : '';
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
     * @return CarProperty
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
}
