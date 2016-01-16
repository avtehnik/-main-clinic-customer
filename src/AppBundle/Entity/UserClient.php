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
    
}

