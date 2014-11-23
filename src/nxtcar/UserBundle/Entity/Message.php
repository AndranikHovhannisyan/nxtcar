<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/23/14
 * Time: 6:54 PM
 */

namespace nxtcar\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Message
 * @package nxtcar\UserBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="message")
 */
class Message
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="outMessages")
     * @ORM\JoinColumn(name="from_user_id", referencedColumnName="id")
     */
    protected $from;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="inMessages")
     * @ORM\JoinColumn(name="to_user_id", referencedColumnName="id")
     */
    protected $to;

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
     * Set from
     *
     * @param \nxtcar\UserBundle\Entity\User $from
     * @return Message
     */
    public function setFrom(\nxtcar\UserBundle\Entity\User $from = null)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return \nxtcar\UserBundle\Entity\User 
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param \nxtcar\UserBundle\Entity\User $to
     * @return Message
     */
    public function setTo(\nxtcar\UserBundle\Entity\User $to = null)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return \nxtcar\UserBundle\Entity\User 
     */
    public function getTo()
    {
        return $this->to;
    }
}
