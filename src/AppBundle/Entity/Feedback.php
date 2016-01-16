<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FeedbackRepository")
 */
class Feedback
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;
 

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Feedback
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }



    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Feedback
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Feedback
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }


    /**
     * @var UserDoctor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserDoctor", inversedBy="feedbacks")
     */
    private $doctor;

    /**
     * @var UserClient
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserClient", inversedBy="feedbacks")
     */
    private $client;



    /**
     * Set doctor
     *
     * @param \AppBundle\Entity\UserDoctor $doctor
     *
     * @return Feedback
     */
    public function setDoctor(\AppBundle\Entity\UserDoctor $doctor = null)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get doctor
     *
     * @return \AppBundle\Entity\UserDoctor
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\UserClient $client
     *
     * @return Feedback
     */
    public function setClient(\AppBundle\Entity\UserClient $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\UserClient
     */
    public function getClient()
    {
        return $this->client;
    }
}
