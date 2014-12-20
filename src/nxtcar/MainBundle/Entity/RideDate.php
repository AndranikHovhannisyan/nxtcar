<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 1:21 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CarType
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"one_time" = "OneTime", "recurring" = "Recurring"})
 */
class RideDate
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="is_round", type="boolean", nullable=false)
     */
    protected $isRound = false;

    /**
     * @ORM\OneToOne(targetEntity="Ride", inversedBy="rideDate")
     * @ORM\JoinColumn(name="ride_id", referencedColumnName="id")
     */
    protected $ride;

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
     * Set isRound
     *
     * @param boolean $isRound
     * @return RideDate
     */
    public function setIsRound($isRound)
    {
        $this->isRound = $isRound;

        return $this;
    }

    /**
     * Get isRound
     *
     * @return boolean 
     */
    public function getIsRound()
    {
        return $this->isRound;
    }

    /**
     * Set ride
     *
     * @param \nxtcar\MainBundle\Entity\Ride $ride
     * @return RideDate
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
}
