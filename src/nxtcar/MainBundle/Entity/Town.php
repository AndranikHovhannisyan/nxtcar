<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/2/14
 * Time: 12:49 AM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

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
     * @Groups({"town"})
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * @Groups({"town"})
     */
    protected $name;

    /**
     * @ORM\Column(name="full_name", type="string", length=100)
     * @Groups({"town"})
     */
    protected $fullName;

    /**
     * @ORM\Column(name="k", type="float")
     * @Groups({"town"})
     */
    protected $k;

    /**
     * @ORM\Column(name="d", type="float")
     * @Groups({"town"})
     */
    protected $d;

    /**
     * @ORM\OneToMany(targetEntity="RideTown", mappedBy="town")
     * @Groups({"town_rideTown"})
     */
    protected $rideTown;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rideTown = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Town
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
     * Set fullName
     *
     * @param string $fullName
     * @return Town
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Add rideTown
     *
     * @param \nxtcar\MainBundle\Entity\RideTown $rideTown
     * @return Town
     */
    public function addRideTown(\nxtcar\MainBundle\Entity\RideTown $rideTown)
    {
        $this->rideTown[] = $rideTown;

        return $this;
    }

    /**
     * Remove rideTown
     *
     * @param \nxtcar\MainBundle\Entity\RideTown $rideTown
     */
    public function removeRideTown(\nxtcar\MainBundle\Entity\RideTown $rideTown)
    {
        $this->rideTown->removeElement($rideTown);
    }

    /**
     * Get rideTown
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRideTown()
    {
        return $this->rideTown;
    }

    /**
     * Set k
     *
     * @param float $k
     * @return Town
     */
    public function setK($k)
    {
        $this->k = $k;

        return $this;
    }

    /**
     * Get k
     *
     * @return float 
     */
    public function getK()
    {
        return $this->k;
    }

    /**
     * Set d
     *
     * @param float $d
     * @return Town
     */
    public function setD($d)
    {
        $this->d = $d;

        return $this;
    }

    /**
     * Get d
     *
     * @return float 
     */
    public function getD()
    {
        return $this->d;
    }
}
