<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 1:21 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CarType
 * @package nxtcar\MainBundle\Entity
 *
 * @Entity
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"one_time" = "OneTime", "recurring" = "Recurring"})
 */
class RideDate
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="is_round", type="boolean", nullable=false)
     */
    protected $isRound = false;

}