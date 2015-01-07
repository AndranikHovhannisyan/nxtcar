<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 1:25 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Class CarType
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class OneTime extends RideDate
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"oneTime"})
     */
    protected $id;

    /**
     * @ORM\Column(name="out_date", type="date", nullable=false)
     * @Groups({"oneTime"})
     */
    protected $outDate;

    /**
     * @ORM\Column(name="out_hour", type="integer", nullable=false)
     * @Groups({"oneTime"})
     */
    protected $outHour;

    /**
     * @ORM\Column(name="out_minute", type="integer", nullable=false)
     * @Groups({"oneTime"})
     */
    protected $outMinute;

    /**
     * @ORM\Column(name="in_date", type="date", nullable=true)
     * @Groups({"oneTime"})
     */
    protected $inDate;

    /**
     * @ORM\Column(name="in_hour", type="integer", nullable=true)
     * @Groups({"oneTime"})
     */
    protected $inHour;

    /**
     * @ORM\Column(name="in_minute", type="integer", nullable=true)
     * @Groups({"oneTime"})
     */
    protected $inMinute;

    /**
     * @var boolean
     * @Groups({"oneTime"})
     */
    protected $isRound;

    /**
     * @var \nxtcar\MainBundle\Entity\Ride
     * @Groups({"oneTime_ride"})
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
     * Set outDate
     *
     * @param \DateTime $outDate
     * @return OneTime
     */
    public function setOutDate($outDate)
    {
        $this->outDate = $outDate;

        return $this;
    }

    /**
     * Get outDate
     *
     * @return \DateTime 
     */
    public function getOutDate()
    {
        return $this->outDate;
    }

    /**
     * Set outHour
     *
     * @param integer $outHour
     * @return OneTime
     */
    public function setOutHour($outHour)
    {
        $this->outHour = $outHour;

        return $this;
    }

    /**
     * Get outHour
     *
     * @return integer 
     */
    public function getOutHour()
    {
        return $this->outHour;
    }

    /**
     * Set outMinute
     *
     * @param integer $outMinute
     * @return OneTime
     */
    public function setOutMinute($outMinute)
    {
        $this->outMinute = $outMinute;

        return $this;
    }

    /**
     * Get outMinute
     *
     * @return integer 
     */
    public function getOutMinute()
    {
        return $this->outMinute;
    }

    /**
     * Set inDate
     *
     * @param \DateTime $inDate
     * @return OneTime
     */
    public function setInDate($inDate)
    {
        $this->inDate = $inDate;

        return $this;
    }

    /**
     * Get inDate
     *
     * @return \DateTime 
     */
    public function getInDate()
    {
        return $this->inDate;
    }

    /**
     * Set inHour
     *
     * @param integer $inHour
     * @return OneTime
     */
    public function setInHour($inHour)
    {
        $this->inHour = $inHour;

        return $this;
    }

    /**
     * Get inHour
     *
     * @return integer 
     */
    public function getInHour()
    {
        return $this->inHour;
    }

    /**
     * Set inMinute
     *
     * @param integer $inMinute
     * @return OneTime
     */
    public function setInMinute($inMinute)
    {
        $this->inMinute = $inMinute;

        return $this;
    }

    /**
     * Get inMinute
     *
     * @return integer 
     */
    public function getInMinute()
    {
        return $this->inMinute;
    }

    /**
     * Set isRound
     *
     * @param boolean $isRound
     * @return OneTime
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
     * @return OneTime
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
