<?php

namespace App\Faker\Provider;

use App\Entity\Pet\PetCharacteristicValue;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;

final class PetCharacteristicValueProvider extends BaseProvider
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * RaceProvider constructor.
     * @param Generator $generator
     * @param EntityManager $manager
     */
    public function __construct(Generator $generator, EntityManagerInterface $manager)
    {
        parent::__construct($generator);
        $this->manager = $manager;
    }

    public function pet_characteristic_value(string $type)
    {
        $values = $this->manager->getRepository(PetCharacteristicValue::class)->createQueryBuilder('pcv')
            ->join('pcv.characteristic', 'c')
            ->where('c.name = :type')
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();

        return $values[array_rand($values, 1)];
    }
}