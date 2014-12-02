<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 12:49 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CarType
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class Town
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(name="full_name", type="string", length=100)
     */
    protected $fullName;

    /**
     * @ORM\Column(name="longitude", type="float")
     */
    protected $longitude;

    /**
     * @ORM\Column(name="latitude", type="float")
     */
    protected $latitude;

    /**
     * @ORM\OneToMany(targetEntity="RideTown", mappedBy="town")
     */
    protected $rideTown;
}