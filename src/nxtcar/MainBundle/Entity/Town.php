<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 12:49 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CarType
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class Town
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(name="full_name", type="string", length=100)
     */
    protected $fullName;

    /**
     * @ORM\Column(name="longitude", type="float")
     */
    protected $longitude;

    /**
     * @ORM\Column(name="latitude", type="float")
     */
    protected $latitude;

    /**
     * @ORM\OneToMany(targetEntity="RideTown", mappedBy="town")
     */
    protected $rideTown;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rideTown = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Town
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     * @return Town
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Town
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Town
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Add rideTown
     *
     * @param \nxtcar\MainBundle\Entity\RideTown $rideTown
     * @return Town
     */
    public function addRideTown(\nxtcar\MainBundle\Entity\RideTown $rideTown)
    {
        $this->rideTown[] = $rideTown;

        return $this;
    }

    /**
     * Remove rideTown
     *
     * @param \nxtcar\MainBundle\Entity\RideTown $rideTown
     */
    public function removeRideTown(\nxtcar\MainBundle\Entity\RideTown $rideTown)
    {
        $this->rideTown->removeElement($rideTown);
    }

    /**
     * Get rideTown
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRideTown()
    {
        return $this->rideTown;
    }
}
