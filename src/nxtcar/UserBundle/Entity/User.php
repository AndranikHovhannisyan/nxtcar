<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace nxtcar\UserBundle\Entity;

use Sonata\UserBundle\Model\UserInterface;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package nxtcar\UserBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="year_of_birth", type="integer", nullable=true)
     * @Assert\NotBlank(message="Please choose the year of your birth", groups={"Registration", "Profile"})
     */
    protected $yearOfBirth;

    /**
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstname;

    /**
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The last name is too short.",
     *     maxMessage="The last name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $lastname;

    /**
     * @Assert\NotBlank(message="Please choose your gender", groups={"Registration", "Profile"})
     */
    protected $gender = UserInterface::GENDER_UNKNOWN;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true,
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $email;

    /**
     * @var
     */
    protected $plainPassword;

    /**
     * @ORM\Column(name="displayed_as", type="string", length=20, nullable=true)
     * @Assert\NotBlank(message="Please choose your name for display", groups={"Registration", "Profile"})
     */
    protected $displayedAs;

    /**
     * @ORM\Column(name="show_phone_number", type="boolean", nullable=false)
     */
    protected $showPhoneNumber = false;

    /**
     * @ORM\OneToMany(targetEntity="nxtcar\MainBundle\Entity\Car", mappedBy="user")
     */
    protected $car;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $showPhoneNumber
     * @return $this
     */
    public function setShowPhoneNumber($showPhoneNumber)
    {
        $this->showPhoneNumber = $showPhoneNumber;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getShowPhoneNumber()
    {
        return $this->showPhoneNumber;
    }

    /**
     * @return mixed
     */
    public function getDisplayedAs()
    {
        return $this->displayedAs;
    }

    /**
     * @param $displayedAs
     * @return $this
     */
    public function setDisplayedAs($displayedAs)
    {
        $this->displayedAs = $displayedAs;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getYearOfBirth()
    {
        return $this->yearOfBirth;
    }

    /**
     * @param $year
     * @return $this
     */
    public function setYearOfBirth($year)
    {
        $this->yearOfBirth = $year;

        return $this;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        $this->username = $email;

        return $this;
    }

    /**
     * @param string $firstname
     * @return $this|void
     */
    public function setFirstname($firstname)
    {
        parent::setFirstname($firstname);
        $this->displayedAs = $firstname;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->car = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add car
     *
     * @param \nxtcar\MainBundle\Entity\Car $car
     * @return User
     */
    public function addCar(\nxtcar\MainBundle\Entity\Car $car)
    {
        $this->car[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param \nxtcar\MainBundle\Entity\Car $car
     */
    public function removeCar(\nxtcar\MainBundle\Entity\Car $car)
    {
        $this->car->removeElement($car);
    }

    /**
     * Get car
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCar()
    {
        return $this->car;
    }
}
