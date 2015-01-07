<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/21/14
 * Time: 1:58 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Class InWeek
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class InWeek extends InOutWeek
{
    /**
     * @var integer
     * @Groups({"inWeek"})
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Recurring", inversedBy="inDates")
     * @ORm\JoinColumn(name="recurring_id", referencedColumnName="id")
     * @Groups({"inWeek_recurring"})
     */
    protected $recurring;

    /**
     * @var integer
     * @Groups({"inWeek"})
     */
    protected $hour;

    /**
     * @var integer
     * @Groups({"inWeek"})
     */
    protected $minute;

    /**
     * @var \nxtcar\MainBundle\Entity\WeekDay
     * @Groups({"inWeek_weekDay"})
     */
    protected $weekDay;

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
     * Set hour
     *
     * @param integer $hour
     * @return InWeek
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return integer 
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set minute
     *
     * @param integer $minute
     * @return InWeek
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * Get minute
     *
     * @return integer 
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set recurring
     *
     * @param \nxtcar\MainBundle\Entity\Recurring $recurring
     * @return InWeek
     */
    public function setRecurring(\nxtcar\MainBundle\Entity\Recurring $recurring = null)
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     * Get recurring
     *
     * @return \nxtcar\MainBundle\Entity\Recurring 
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * Set weekDay
     *
     * @param \nxtcar\MainBundle\Entity\WeekDay $weekDay
     * @return InWeek
     */
    public function setWeekDay(\nxtcar\MainBundle\Entity\WeekDay $weekDay = null)
    {
        $this->weekDay = $weekDay;

        return $this;
    }

    /**
     * Get weekDay
     *
     * @return \nxtcar\MainBundle\Entity\WeekDay 
     */
    public function getWeekDay()
    {
        return $this->weekDay;
    }
}
