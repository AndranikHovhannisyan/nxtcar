<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 1:25 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    protected $id;

    /**
     * @ORM\Column(name="out_date", type="date", nullable=false)
     */
    protected $outDate;

    /**
     * @ORM\Column(name="out_hour", type="integer", nullable=false)
     */
    protected $outHour;

    /**
     * @ORM\Column(name="out_minute", type="integer", nullable=false)
     */
    protected $outMinute;

    /**
     * @ORM\Column(name="in_date", type="date", nullable=true)
     */
    protected $inDate;

    /**
     * @ORM\Column(name="in_hour", type="integer", nullable=true)
     */
    protected $inHour;

    /**
     * @ORM\Column(name="in_minute", type="integer", nullable=true)
     */
    protected $inMinute;
}