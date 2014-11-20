<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/20/14
 * Time: 11:43 PM
 */

namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Car
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="car")
 */
class Car
{
    const COMFORT_BASIC         = 0;
    const COMFORT_NORMAL        = 1;
    const COMFORT_COMFORTABLE   = 2;
    const COMFORT_LUXURY        = 3;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="CarModel")
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     */
    protected $model;

    /**
     * @ORM\Column(name="comfort", type="smallint")
     */
    protected $comfort;

    /**
     * @ORM\Column(name="number_of_sets", type="smallint")
     */
    protected $numberOfSets;

    /**
     * @ORM\ManyToOne(targetEntity="CarColor")
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     */
    protected $color;

    /**
     * @ORM\ManyToOne(targetEntity="CarType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="nxtcar\UserBundle\Entity\User", inversedBy="car")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @return string
     */
    public function __toString()
    {
        return '';
    }

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
     * Set comfort
     *
     * @param integer $comfort
     * @return Car
     */
    public function setComfort($comfort)
    {
        $this->comfort = $comfort;

        return $this;
    }

    /**
     * Get comfort
     *
     * @return integer 
     */
    public function getComfort()
    {
        return $this->comfort;
    }

    /**
     * Set numberOfSets
     *
     * @param integer $numberOfSets
     * @return Car
     */
    public function setNumberOfSets($numberOfSets)
    {
        $this->numberOfSets = $numberOfSets;

        return $this;
    }

    /**
     * Get numberOfSets
     *
     * @return integer 
     */
    public function getNumberOfSets()
    {
        return $this->numberOfSets;
    }

    /**
     * Set model
     *
     * @param \nxtcar\MainBundle\Entity\CarModel $model
     * @return Car
     */
    public function setModel(\nxtcar\MainBundle\Entity\CarModel $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \nxtcar\MainBundle\Entity\CarModel 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set color
     *
     * @param \nxtcar\MainBundle\Entity\CarColor $color
     * @return Car
     */
    public function setColor(\nxtcar\MainBundle\Entity\CarColor $color = null)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \nxtcar\MainBundle\Entity\CarColor 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set type
     *
     * @param \nxtcar\MainBundle\Entity\CarType $type
     * @return Car
     */
    public function setType(\nxtcar\MainBundle\Entity\CarType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \nxtcar\MainBundle\Entity\CarType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \nxtcar\UserBundle\Entity\User $user
     * @return Car
     */
    public function setUser(\nxtcar\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \nxtcar\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
