<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 1:06 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CarType
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class RideTown
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ride", inversedBy="rideTown")
     * @ORM\JoinColumn(name="ride_id", referencedColumnName="id")
     */
    protected $ride;

    /**
     * @ORM\ManyToOne(targetEntity="Town", inversedBy="rideTown")
     * @ORM\JoinColumn(name="town_id", referencedColumnName="id")
     */
    protected $town;

    /**
     * @ORM\Column(name="position_in_ride", type="integer", nullable=false)
     */
    protected $positionInRide;

    /**
     * @ORM\Column(name="busy_places_go", type="integer")
     */
    protected $busyPlacesGo;

    /**
     * @ORM\Column(name="busy_places_return", type="integer")
     */
    protected $busyPlacesReturn;

    /**
     * @ORM\Column(name="price_to_nearest", type="integer",  nullable=true)
     */
    protected $priceToNearest;

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
     * Set positionInRide
     *
     * @param integer $positionInRide
     * @return RideTown
     */
    public function setPositionInRide($positionInRide)
    {
        $this->positionInRide = $positionInRide;

        return $this;
    }

    /**
     * Get positionInRide
     *
     * @return integer 
     */
    public function getPositionInRide()
    {
        return $this->positionInRide;
    }

    /**
     * Set priceToNearest
     *
     * @param integer $priceToNearest
     * @return RideTown
     */
    public function setPriceToNearest($priceToNearest)
    {
        $this->priceToNearest = $priceToNearest;

        return $this;
    }

    /**
     * Get priceToNearest
     *
     * @return integer 
     */
    public function getPriceToNearest()
    {
        return $this->priceToNearest;
    }

    /**
     * Set ride
     *
     * @param \nxtcar\MainBundle\Entity\Ride $ride
     * @return RideTown
     */
    public function setRide(\nxtcar\MainBundle\Entity\Ride $ride = null)
    {
        $this->ride = $ride;

        return $this;
    }

    /**
     * Get ride
     *
     * @return \nxtcar\MainBundle\Entity\Ride 
     */
    public function getRide()
    {
        return $this->ride;
    }

    /**
     * Set town
     *
     * @param \nxtcar\MainBundle\Entity\Town $town
     * @return RideTown
     */
    public function setTown(\nxtcar\MainBundle\Entity\Town $town = null)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return \nxtcar\MainBundle\Entity\Town 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set busyPlacesGo
     *
     * @param integer $busyPlacesGo
     * @return RideTown
     */
    public function setBusyPlacesGo($busyPlacesGo)
    {
        $this->busyPlacesGo = $busyPlacesGo;

        return $this;
    }

    /**
     * Get busyPlacesGo
     *
     * @return integer 
     */
    public function getBusyPlacesGo()
    {
        return $this->busyPlacesGo;
    }

    /**
     * Set busyPlacesReturn
     *
     * @param integer $busyPlacesReturn
     * @return RideTown
     */
    public function setBusyPlacesReturn($busyPlacesReturn)
    {
        $this->busyPlacesReturn = $busyPlacesReturn;

        return $this;
    }

    /**
     * Get busyPlacesReturn
     *
     * @return integer 
     */
    public function getBusyPlacesReturn()
    {
        return $this->busyPlacesReturn;
    }
}
