<?php
/**
 * Created by PhpStorm.
 * User: andranik
 * Date: 12/20/14
 * Time: 6:36 PM
 */
namespace nxtcar\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FAQCategory
 * @package nxtcar\MainBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_question")
 */
class FAQQuestion
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="question", type="string", length=255, nullable=false)
     */
    protected $question;

    /**
     * @ORM\Column(name="answer", type="string", length=2000, nullable=false)
     */
    protected $answer;

    /**
     * @ORM\ManyToOne(targetEntity="FAQCategory", inversedBy="questions")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     */
    protected $category;

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->question;
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
     * Set question
     *
     * @param string $question
     * @return FAQQuestion
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return FAQQuestion
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set category
     *
     * @param \nxtcar\MainBundle\Entity\FAQCategory $category
     * @return FAQQuestion
     */
    public function setCategory(\nxtcar\MainBundle\Entity\FAQCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \nxtcar\MainBundle\Entity\FAQCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
