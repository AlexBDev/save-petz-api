<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity
 * @ORM\Table(name="location")
 */
class Location
{

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
     * @ORM\Column(type="string", length=65)
     */
    private $city;

    /**
     * @Groups({"get", "write"})
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @Groups({"get", "write"})
     * @var string
     * @ORM\Column(type="decimal", precision=8, scale=6, nullable=true)
     */
    private $latitude;


    /**
     * @Groups({"get", "write"})
     * @var string
     * @ORM\Column(type="decimal", precision=9, scale=6, nullable=true)
     */
    private $longitude;

    public function __toString()
    {
        return $this->city.' - '.$this->address;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Location
     */
    public function setCity(string $city): Location
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Location
     */
    public function setAddress(string $address): Location
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return Location
     */
    public function setLatitude(string $latitude): Location
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return Location
     */
    public function setLongitude(string $longitude): Location
    {
        $this->longitude = $longitude;
        return $this;
    }
}