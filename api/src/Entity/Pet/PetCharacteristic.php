<?php

namespace App\Entity\Pet;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity
 * @ORM\Table(name="pet_characteristic")
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"get", "type"}, "enable_max_depth"="true"},
 *     },
 *     itemOperations={
 *          "get",
 *          "put"={"normalization_context"={"groups"={"put"}}}
 *     }
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={"name": "exact"})
 */
class PetCharacteristic
{
    /**
     * @var int The id of this book.
     * @Groups({"get", "type"})
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"get", "type"})
     * @var string
     * @ORM\Column(type="string", length=40, unique=true)
     */
    private $name;

    /**
     * @Groups({"get", "type"})
     * @var string
     * @ORM\Column(type="string", length=40)
     */
    private $label;

    /**
     * @Groups({"type"})
     * @var Collection|PetCharacteristicValue[]
     * @ORM\OneToMany(targetEntity="PetCharacteristicValue", mappedBy="characteristic", cascade={"persist"})
     */
    private $values;

    /**
     * PetCharacteristic constructor.
     */
    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PetCharacteristic
     */
    public function setName(string $name): PetCharacteristic
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return PetCharacteristic
     */
    public function setLabel(string $label): PetCharacteristic
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return PetCharacteristicValue[]|Collection
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    /**
     * @param PetCharacteristicValue[]|Collection $values
     * @return PetCharacteristic
     */
    public function setValues(Collection $values)
    {
        foreach ($values as $value) {
            $this->addValue($value);
        }

        return $this;
    }

    /**
     * @param PetCharacteristicValue $value
     * @return PetCharacteristic
     */
    public function addValue(PetCharacteristicValue $value): PetCharacteristic
    {
        if (!$this->values->contains($value)) {
            $this->values[] = $value;
        }

        return $this;
    }
}