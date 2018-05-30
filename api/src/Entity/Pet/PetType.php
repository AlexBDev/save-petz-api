<?php

namespace App\Entity\Pet;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="pet_type")
 * @ApiResource
 */
class PetType
{
    /**
     * @var int The id of this book.
     *
     * @Groups("get")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("get")
     * @var string
     * @ORM\Column(type="string", length=40, unique=true)
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PetType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}