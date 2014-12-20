<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/20/14
 * Time: 1:32 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OutWeek
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="in_out_week")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"out_week" = "OutWeek", "in_week" = "InWeek"})
 */
class InOutWeek
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="hour", type="integer", nullable=false)
     */
    protected $hour;

    /**
     * @ORm\Column(name="minute", type="integer"), nullable=false
     */
    protected $minute = 0;

    /**
     * @ORM\ManyToOne(targetEntity="WeekDay")
     * @ORm\JoinColumn(name="week_day_id", referencedColumnName="id")
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
     * @return InOutWeek
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
     * @return InOutWeek
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
     * Set weekDay
     *
     * @param \nxtcar\MainBundle\Entity\WeekDay $weekDay
     * @return InOutWeek
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
