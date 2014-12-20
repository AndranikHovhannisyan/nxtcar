<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 1:05 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CarType
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class Ride
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="RideTown", mappedBy="ride")
     */
    protected $rideTown;

    /**
     * @ORM\ManyToOne(targetEntity="nxtcar\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    protected $driver;

    /**
     * @ORM\Column(name="all_places", type="integer")
     */
    protected $allPlaces;

    /**
     * @ORM\OneToOne(targetEntity="RideDate", mappedBy="ride")
     */
    protected $rideDate;

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
     * Set allPlaces
     *
     * @param integer $allPlaces
     * @return Ride
     */
    public function setAllPlaces($allPlaces)
    {
        $this->allPlaces = $allPlaces;

        return $this;
    }

    /**
     * Get allPlaces
     *
     * @return integer 
     */
    public function getAllPlaces()
    {
        return $this->allPlaces;
    }

    /**
     * Add rideTown
     *
     * @param \nxtcar\MainBundle\Entity\RideTown $rideTown
     * @return Ride
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

    /**
     * Set driver
     *
     * @param \nxtcar\UserBundle\Entity\User $driver
     * @return Ride
     */
    public function setDriver(\nxtcar\UserBundle\Entity\User $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \nxtcar\UserBundle\Entity\User 
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set rideDate
     *
     * @param \nxtcar\MainBundle\Entity\RideDate $rideDate
     * @return Ride
     */
    public function setRideDate(\nxtcar\MainBundle\Entity\RideDate $rideDate = null)
    {
        $this->rideDate = $rideDate;

        return $this;
    }

    /**
     * Get rideDate
     *
     * @return \nxtcar\MainBundle\Entity\RideDate 
     */
    public function getRideDate()
    {
        return $this->rideDate;
    }
}
