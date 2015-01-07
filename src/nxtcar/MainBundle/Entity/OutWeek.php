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
 * Class OutWeek
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class OutWeek extends InOutWeek
{
    /**
     * @var integer
     * @Groups({"outWeek"})
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Recurring", inversedBy="outDates")
     * @ORM\JoinColumn(name="recurring_id", referencedColumnName="id")
     * @Groups({"outWeek_recurring"})
     */
    protected $recurring;

    /**
     * @var integer
     * @Groups({"outWeek"})
     */
    protected $hour;

    /**
     * @var integer
     * @Groups({"outWeek"})
     */
    protected $minute;

    /**
     * @var \nxtcar\MainBundle\Entity\WeekDay
     * @Groups({"outWeek_weekDay"})
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
     * @return OutWeek
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
     * @return OutWeek
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
     * @return OutWeek
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
     * @return OutWeek
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
