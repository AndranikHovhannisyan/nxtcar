<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/20/14
 * Time: 1:26 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

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
     * @Groups({"weekDay"})
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     * @Groups({"weekDay"})
     */
    protected $name = 'default';

    /**
     * @ORM\Column(name="week_index", type="integer", nullable=true)
     * @Groups({"weekDay"})
     */
    protected $index;

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
     * @return string
     */
    public function __toString()
    {
        return ($this->name) ? $this->name: "";
    }

    /**
     * Set name
     *
     * @param string $name
     * @return WeekDay
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set index
     *
     * @param integer $index
     * @return WeekDay
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Get index
     *
     * @return integer 
     */
    public function getIndex()
    {
        return $this->index;
    }
}
