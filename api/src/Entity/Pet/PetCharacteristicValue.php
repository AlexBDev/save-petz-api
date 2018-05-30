<?php

namespace App\Entity\Pet;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ORM\Pet\PetCharacteristicValue")
 * @ORM\Table(name="pet_type_characteristic_value")
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"get", "type"}}
 *     },
 *     itemOperations={
 *          "get",
 *          "put"={"normalization_context"={"groups"={"put"}}}
 *     }
 * )
 */
class PetCharacteristicValue
{
    /**
     * @Groups({"get", "type"})
     * @var int The id of this book.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"get", "type"})
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @Groups("get")
     * @MaxDepth(1)
     * @var PetCharacteristic|null
     * @ORM\ManyToOne(targetEntity="PetCharacteristic", inversedBy="values")
     * @ORM\JoinColumn(name="characteristic_id", referencedColumnName="id")
     */
    private $characteristic;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return PetCharacteristicValue
     */
    public function setValue(string $value): PetCharacteristicValue
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return PetCharacteristic|null
     */
    public function getCharacteristic(): ?PetCharacteristic
    {
        return $this->characteristic;
    }

    /**
     * @param PetCharacteristic|null $characteristic
     * @return PetCharacteristicValue
     */
    public function setCharacteristic(PetCharacteristic $characteristic): PetCharacteristicValue
    {
        $this->characteristic = $characteristic;
        return $this;
    }
}