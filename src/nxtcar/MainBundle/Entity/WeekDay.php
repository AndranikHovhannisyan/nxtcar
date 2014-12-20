<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/20/14
 * Time: 1:26 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class WeekDay
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class WeekDay
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(name="index", type="integer", nullable=true)
     */
    protected $index;
}