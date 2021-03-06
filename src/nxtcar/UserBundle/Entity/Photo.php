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
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

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
     * @Groups({"photo_user"})
     */
    protected $user;

    /**
     * @var integer
     * @Groups({"photo"})
     */
    protected $id;

    /**
     * @var string
     * @Groups({"photo"})
     */
    protected $name;

    /**
     * @var string
     * @Groups({"photo"})
     */
    protected $path;

    /**
     * @return null|string|void
     * @VirtualProperty
     * @Groups({"photo"})
     */
    public function getWebPath()
    {
        return parent::getWebPath();
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
