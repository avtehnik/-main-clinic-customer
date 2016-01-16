<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class UserClient extends User implements \JsonSerializable

{
    public function getUserType()
    {
        return self::TYPE_CLIENT;

    }


    public function jsonSerialize()
    {
        return [
            "id"          => $this->getId(),
            "fullName"    => $this->getFullName(),
            "age"         => $this->getAge(),
            "phone"       => $this->getPhone(),
            "gender"      => $this->getGender(),
            "address"     => $this->getAddress(),
            "userType"    => $this->getUserType(),
            "description" => $this->getDescription()
        ];
    }


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Offer", mappedBy="client", cascade={"remove","persist"})
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $offers;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Feedback", mappedBy="client", cascade={"remove","persist"})
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $feedbacks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->feedbacks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add offer
     *
     * @param \AppBundle\Entity\Offer $offer
     *
     * @return UserClient
     */
    public function addOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \AppBundle\Entity\Offer $offer
     */
    public function removeOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Add feedback
     *
     * @param \AppBundle\Entity\Feedback $feedback
     *
     * @return UserClient
     */
    public function addFeedback(\AppBundle\Entity\Feedback $feedback)
    {
        $this->feedbacks[] = $feedback;

        return $this;
    }

    /**
     * Remove feedback
     *
     * @param \AppBundle\Entity\Feedback $feedback
     */
    public function removeFeedback(\AppBundle\Entity\Feedback $feedback)
    {
        $this->feedbacks->removeElement($feedback);
    }

    /**
     * Get feedbacks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbacks()
    {
        return $this->feedbacks;
    }
}
