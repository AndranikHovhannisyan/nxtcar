<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/20/14
 * Time: 11:23 PM
 */

namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CarColor
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 */
class CarColor extends CarProperty
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;


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
     * Set title
     *
     * @param string $title
     * @return CarColor
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
