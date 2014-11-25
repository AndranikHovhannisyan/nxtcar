<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 11/24/14
 * Time: 1:12 AM
 */

namespace nxtcar\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use nxtcar\MainBundle\Entity\BaseFile;

/**
 * Class Photo
 * @package nxtcar\UserBundle\Entity
 *
 * @ORM\Entity
 */
class Photo extends BaseFile
{
    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="photo")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $path;

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
     * Set name
     *
     * @param string $name
     * @return Photo
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
     * Set path
     *
     * @param string $path
     * @return Photo
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set user
     *
     * @param \nxtcar\UserBundle\Entity\User $user
     * @return Photo
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
