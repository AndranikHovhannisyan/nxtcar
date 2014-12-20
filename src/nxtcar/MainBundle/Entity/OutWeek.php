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
 */
class OutWeek
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Recurring", )
     */
    protected $recurringDate;
}