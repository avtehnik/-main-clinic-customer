<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 *
 * @ORM\Table(name="offers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RequestRepository")
 */
class Offer implements \JsonSerializable
{


    const STATUS_WAITING = 'waiting';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_FINISH = 'finish';
    const STATUS_REJECTED = 'rejected';

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
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;


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
     * @return Request
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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Request
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Request
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
     * Set status
     *
     * @param string $status
     *
     * @return Request
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * @var UserDoctor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserDoctor", inversedBy="offers")
     */
    private $doctor;

    /**
     * @var UserClient
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserClient", inversedBy="offers")
     */
    private $client;


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Service")
     */
    private $services;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set doctor
     *
     * @param \AppBundle\Entity\UserDoctor $doctor
     *
     * @return Offer
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
     * @return Offer
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

    /**
     * Add service
     *
     * @param \AppBundle\Entity\Service $service
     *
     * @return Offer
     */
    public function addService(\AppBundle\Entity\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \AppBundle\Entity\Service $service
     */
    public function removeService(\AppBundle\Entity\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {

        $duration = 0;
        $price    = 0;
        $services = [];

        /**
         * @var Service $service
         */

        foreach ($this->getServices() as $service) {
            $duration += $service->getDuration();
            $price += $service->getPrice();
            $services[] = $service->getId();
        }

        return [
            "id"             => $this->getId(),
            "doctor"         => $this->getDoctor()->getId(),
            "client"         => $this->getClient()->getId(),
            "doctorName"         => $this->getDoctor()->getFullName(),
            "clientName"         => $this->getClient()->getFullName(),
            "comment"        => $this->getComment(),
            "updated"        => $this->getUpdated()->format(DATE_ATOM),
            "created"        => $this->getCreated()->format(DATE_ATOM),
            "status"         => $this->getStatus(),
            "services"       => $this->getServices()->getValues(),
            "estimatedPrice" => $price,
            "estimatedTime"  => gmdate("H:i:s", $duration),
            "date"=> $this->getDate()->format(DATE_ATOM)
        ];
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Offer
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
