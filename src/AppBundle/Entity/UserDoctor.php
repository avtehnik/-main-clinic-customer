<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class UserDoctor extends User implements \JsonSerializable
{


    public function getUserType()
    {
        return self::TYPE_DOCTOR;

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


}

