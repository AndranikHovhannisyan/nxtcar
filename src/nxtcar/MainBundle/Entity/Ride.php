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
}
