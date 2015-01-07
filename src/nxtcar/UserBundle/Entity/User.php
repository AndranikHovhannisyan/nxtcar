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
use JMS\Serializer\Annotation\Groups;

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
     * @Groups({"user"})
     */
    protected $id;

    /**
     * @ORM\Column(name="year_of_birth", type="integer", nullable=true)
     * @Assert\NotBlank(message="Please choose the year of your birth", groups={"Registration", "Profile"})
     * @Groups({"user"})
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
     * @Groups({"user"})
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
     * @Groups({"user"})
     */
    protected $lastname;

    /**
     * @Assert\NotBlank(message="Please choose your gender", groups={"Registration", "Profile"})
     * @Groups({"user"})
     */
    protected $gender = UserInterface::GENDER_UNKNOWN;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true,
     *     groups={"Registration", "Profile"}
     * )
     * @Groups({"user"})
     */
    protected $email;

    /**
     * @var
     */
    protected $plainPassword;

    /**
     * @ORM\Column(name="displayed_as", type="string", length=20, nullable=true)
     * @Assert\NotBlank(message="Please choose your name for display", groups={"Registration", "Profile"})
     * @Groups({"user"})
     */
    protected $displayedAs;

    /**
     * @ORM\Column(name="show_phone_number", type="boolean", nullable=false)
     * @Groups({"user"})
     */
    protected $showPhoneNumber = false;

    /**
     * @ORM\OneToMany(targetEntity="nxtcar\MainBundle\Entity\Car", mappedBy="user")
     * @Groups({"user_car"})
     */
    protected $car;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="from")
     */
    protected $outMessages;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="to")
     */
    protected $inMessages;

    /**
     * @ORM\OneToMany(targetEntity="nxtcar\MainBundle\Entity\Ride", mappedBy="driver")
     */
    protected $rides;

    /**
     * @ORM\OneToOne(targetEntity="Photo", mappedBy="user")
     * @Groups({"user_photo"})
     */
    protected $photo;

    /* Preferences */

    const PREFERENCES_LOW       = 0;
    const PREFERENCES_MEDIUM    = 1;
    const PREFERENCES_HIGH      = 2;


    /**
     * @ORM\Column(name="chattiness", type="smallint", nullable=false)
     * @Groups({"user"})
     */
    protected $chattiness = self::PREFERENCES_MEDIUM;

    /**
     * @ORM\Column(name="music", type="smallint", nullable=false)
     * @Groups({"user"})
     */
    protected $music = self::PREFERENCES_MEDIUM;

    /**
     * @ORM\Column(name="smoking", type="smallint", nullable=false)
     * @Groups({"user"})
     */
    protected $smoking = self::PREFERENCES_MEDIUM;

    /**
     * @ORM\Column(name="pets", type="smallint", nullable=false)
     * @Groups({"user"})
     */
    protected $pets = self::PREFERENCES_MEDIUM;

    /**
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    protected $facebook_id;

    /**
     * @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true)
     */
    protected $facebook_access_token;

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

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->car = new \Doctrine\Common\Collections\ArrayCollection();
        $this->outMessages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inMessages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rides = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add outMessages
     *
     * @param \nxtcar\UserBundle\Entity\Message $outMessages
     * @return User
     */
    public function addOutMessage(\nxtcar\UserBundle\Entity\Message $outMessages)
    {
        $this->outMessages[] = $outMessages;

        return $this;
    }

    /**
     * Remove outMessages
     *
     * @param \nxtcar\UserBundle\Entity\Message $outMessages
     */
    public function removeOutMessage(\nxtcar\UserBundle\Entity\Message $outMessages)
    {
        $this->outMessages->removeElement($outMessages);
    }

    /**
     * Get outMessages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOutMessages()
    {
        return $this->outMessages;
    }

    /**
     * Add inMessages
     *
     * @param \nxtcar\UserBundle\Entity\Message $inMessages
     * @return User
     */
    public function addInMessage(\nxtcar\UserBundle\Entity\Message $inMessages)
    {
        $this->inMessages[] = $inMessages;

        return $this;
    }

    /**
     * Remove inMessages
     *
     * @param \nxtcar\UserBundle\Entity\Message $inMessages
     */
    public function removeInMessage(\nxtcar\UserBundle\Entity\Message $inMessages)
    {
        $this->inMessages->removeElement($inMessages);
    }

    /**
     * Get inMessages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInMessages()
    {
        return $this->inMessages;
    }

    /**
     * Set chattiness
     *
     * @param integer $chattiness
     * @return User
     */
    public function setChattiness($chattiness)
    {
        $this->chattiness = $chattiness;

        return $this;
    }

    /**
     * Get chattiness
     *
     * @return integer 
     */
    public function getChattiness()
    {
        return $this->chattiness;
    }

    /**
     * Set music
     *
     * @param integer $music
     * @return User
     */
    public function setMusic($music)
    {
        $this->music = $music;

        return $this;
    }

    /**
     * Get music
     *
     * @return integer 
     */
    public function getMusic()
    {
        return $this->music;
    }

    /**
     * Set smoking
     *
     * @param integer $smoking
     * @return User
     */
    public function setSmoking($smoking)
    {
        $this->smoking = $smoking;

        return $this;
    }

    /**
     * Get smoking
     *
     * @return integer 
     */
    public function getSmoking()
    {
        return $this->smoking;
    }

    /**
     * Set pets
     *
     * @param integer $pets
     * @return User
     */
    public function setPets($pets)
    {
        $this->pets = $pets;

        return $this;
    }

    /**
     * Get pets
     *
     * @return integer 
     */
    public function getPets()
    {
        return $this->pets;
    }

    /**
     * Set photo
     *
     * @param \nxtcar\UserBundle\Entity\Photo $photo
     * @return User
     */
    public function setPhoto(\nxtcar\UserBundle\Entity\Photo $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \nxtcar\UserBundle\Entity\Photo 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

     /**
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebook_access_token
     *
     * @return string 
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Add ride
     *
     * @param \nxtcar\MainBundle\Entity\Ride $ride
     * @return User
     */
    public function addRide(\nxtcar\MainBundle\Entity\Ride $ride)
    {
        $this->rides[] = $ride;

        return $this;
    }

    /**
     * Remove outMessages
     *
     * @param \nxtcar\MainBundle\Entity\Ride $ride
     */
    public function removeRide(\nxtcar\MainBundle\Entity\Ride $ride)
    {
        $this->rides->removeElement($ride);
    }

    /**
     * Get outMessages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRides()
    {
        return $this->rides;
    }
}
