<?php

namespace App\Entity\Pet;

use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Entity\Contact;
use App\Entity\Location;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation\Timestampable;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity
 * @ORM\Table(name="pet")
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"get"}},
 *          "denormalization_context"={"groups"={"write"}},
 *          "order"={"createdAt": "DESC"},
 *          "pagination_items_per_page"=10
 *     },
 *     collectionOperations={"get", "post"}
 * )
 */
class Pet
{
    const IS_LOST = 0;
    const IS_FOUND = 1;

    /**
     * @Groups({"get", "write"})
     * @var int The id of this book.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"get", "write"})
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @Groups({"get", "write"})
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Groups({"get", "write"})
     * @var int
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @var string|null
     * @Groups({"get", "write"})
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $tatoo;

    /**
     * @var string|null
     * @Groups({"get", "write"})
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $chip;

    /**
     * @Groups({"get", "write"})
     * @var PetCharacteristicValue[]
     * @MaxDepth(1)
     * @ORM\ManyToMany(targetEntity="PetCharacteristicValue")
     * @ORM\JoinTable(name="pet_to_pet_characteristics_value",
     *      joinColumns={@ORM\JoinColumn(name="pet_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pet_characteristics_value_id", referencedColumnName="id")}
     * )
     */
    private $characteristics;

    /**
     * @Groups({"get", "write"})
     * @var Location
     * @ORM\OneToOne(targetEntity="App\Entity\Location", cascade={"persist"})
     * @ORM\JoinColumn(name="location", referencedColumnName="id")
     */
    private $location;

    /**
     * @Groups({"get", "write"})
     * @var PetType
     * @ORM\ManyToOne(targetEntity="PetType", cascade={"persist"})
     * @ORM\JoinColumn(name="pet_type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @Groups({"get", "write"})
     * @var \DateTime
     * @Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @Groups({"get", "write"})
     * @var Contact
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact", cascade={"all"})
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     * @ApiSubresource()
     */
    private $contact;

    /**
     * @Groups("get")
     * @var \DateTime
     * @Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * Pet constructor.
     */
    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?  int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?    string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Pet
     */
    public function setName(string $name): Pet
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ? string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Pet
     */
    public function setDescription(string $description): Pet
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): ?  int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Pet
     */
    public function setStatus(int $status): Pet
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return PetCharacteristicValue[]|Collection
     */
    public function getCharacteristics(): ? Collection
    {
        return $this->characteristics;
    }

    /**
     * @param PetCharacteristicValue|null $characteristic
     * @return $this
     */
    public function addCharacteristic(PetCharacteristicValue $characteristic = null)
    {
        if (!$this->characteristics->contains($characteristic)) {
            $this->characteristics[] = $characteristic;
        }

        return $this;
    }

    /**
     * @param Collection $characteristics
     * @return Pet
     */
    public function setCharacteristics(iterable $characteristics): Pet
    {
        foreach ($characteristics as $characteristic) {
            $this->addCharacteristic($characteristic);
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTatoo(): ?string
    {
        return $this->tatoo;
    }

    /**
     * @param null|string $tatoo
     * @return Pet
     */
    public function setTatoo(?string $tatoo): Pet
    {
        $this->tatoo = $tatoo;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getChip(): ?string
    {
        return $this->chip;
    }

    /**
     * @param null|string $chip
     * @return Pet
     */
    public function setChip(?string $chip): Pet
    {
        $this->chip = $chip;
        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation(): ?    Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return Pet
     */
    public function setLocation(Location $location): Pet
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return PetType
     */
    public function getType(): ?    PetType
    {
        return $this->type;
    }

    /**
     * @param PetType $type
     * @return Pet
     */
    public function setType(PetType $type): Pet
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Contact
     */
    public function getContact(): ? Contact
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return Pet
     */
    public function setContact(Contact $contact): Pet
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * Sets createdAt.
     *
     * @param  \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets updatedAt.
     *
     * @param  \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Returns updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}