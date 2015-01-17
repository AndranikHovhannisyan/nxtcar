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
class Recurring extends RideDate
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"recurring"})
     */
    protected $id;

    /**
     * @ORM\Column(name="start_date", type="date", nullable=false)
     * @Groups({"recurring"})
     */
    protected $startDate;

    /**
     * @ORM\Column(name="end_date", type="date", nullable=true)
     * @Groups({"recurring"})
     */
    protected $endDate;

    /**
     * @ORM\OneToMany(targetEntity="OutWeek", mappedBy="recurring")
     * @Groups({"recurring_outWeek"})
     */
    protected $outDates;

    /**
     * @ORM\OneToMany(targetEntity="InWeek", mappedBy="recurring")
     * @Groups({"recurring_inWeek"})
     */
    protected $inDates;

    /**
     * @var boolean
     * @Groups({"recurring"})
     */
    protected $isRound;

    /**
     * @var \nxtcar\MainBundle\Entity\Ride
     * @Groups({"recurring_ride"})
     */
    protected $ride;

    /**
     * @ORM\OneToMany(targetEntity="OneTime", mappedBy="recurring")
     * @Groups({"recurring_oneTime"})
     */
    protected $oneTime;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->outDates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inDates  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->oneTime  = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Recurring
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Recurring
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set isRound
     *
     * @param boolean $isRound
     * @return Recurring
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
     * Add outDates
     *
     * @param \nxtcar\MainBundle\Entity\OutWeek $outDates
     * @return Recurring
     */
    public function addOutDate(\nxtcar\MainBundle\Entity\OutWeek $outDates)
    {
        $this->outDates[] = $outDates;

        return $this;
    }

    /**
     * Remove outDates
     *
     * @param \nxtcar\MainBundle\Entity\OutWeek $outDates
     */
    public function removeOutDate(\nxtcar\MainBundle\Entity\OutWeek $outDates)
    {
        $this->outDates->removeElement($outDates);
    }

    /**
     * Get outDates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOutDates()
    {
        return $this->outDates;
    }

    /**
     * Add inDates
     *
     * @param \nxtcar\MainBundle\Entity\InWeek $inDates
     * @return Recurring
     */
    public function addInDate(\nxtcar\MainBundle\Entity\InWeek $inDates)
    {
        $this->inDates[] = $inDates;

        return $this;
    }

    /**
     * Remove inDates
     *
     * @param \nxtcar\MainBundle\Entity\InWeek $inDates
     */
    public function removeInDate(\nxtcar\MainBundle\Entity\InWeek $inDates)
    {
        $this->inDates->removeElement($inDates);
    }

    /**
     * Get inDates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInDates()
    {
        return $this->inDates;
    }

    /**
     * Set ride
     *
     * @param \nxtcar\MainBundle\Entity\Ride $ride
     * @return Recurring
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
     * Add oneTime
     *
     * @param \nxtcar\MainBundle\Entity\OneTime $oneTime
     * @return Recurring
     */
    public function addOneTime(\nxtcar\MainBundle\Entity\OneTime $oneTime)
    {
        $this->oneTime[] = $oneTime;

        return $this;
    }

    /**
     * Remove oneTime
     *
     * @param \nxtcar\MainBundle\Entity\OneTime $oneTime
     */
    public function removeOneTime(\nxtcar\MainBundle\Entity\OneTime $oneTime)
    {
        $this->oneTime->removeElement($oneTime);
    }

    /**
     * Get oneTime
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOneTime()
    {
        return $this->oneTime;
    }
}
