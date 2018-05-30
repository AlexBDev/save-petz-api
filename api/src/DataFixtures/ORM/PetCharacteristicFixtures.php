<?php

namespace App\DataFixtures\ORM;


use App\Entity\Pet\PetCharacteristic;
use App\Entity\Pet\PetCharacteristicValue;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class PetCharacteristicFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $characteristics = [
            'size' => [
                'label' => 'Taille',
                'values' => [
                    'Petit',
                    'Moyen',
                    'Grand',
                ]
            ],
            'color' => [
                'label' => 'Couleur',
                'values' => [
                    'Noir',
                    'Blanc',
                    'Marron',
                    'Rouge',
                ]
            ],
            'necklace' => [
                'label' => 'Colier',
                'values' => [
                    'Oui',
                    'Non'
                ]
            ],
            'fur' => [
                'label' => 'Poil',
                'values' => [
                    'Court',
                    'Moyen',
                    'Long',
                ]
            ],
            'eye' => [
                'label' => 'Yeux',
                'values' => [
                    'Noir',
                    'Blanc',
                    'Marron',
                    'Rouge',
                ]
            ],
            'race_dog' => [
                'label' => 'Race',
                'values' => self::getData(__DIR__.'/../../../fixtures/data/race_dog'),
            ],
            'race_cat' => [
                'label' => 'Race',
                'values' => self::getData(__DIR__.'/../../../fixtures/data/race_cat'),
            ],
        ];

        foreach ($characteristics as $name => $definition) {
            $ch = (new PetCharacteristic())
                ->setName($name)
                ->setLabel($definition['label']);

            foreach ($definition['values'] as $value) {
                $ch->addValue(
                    (new PetCharacteristicValue())
                        ->setCharacteristic($ch)
                        ->setValue($value)
                );
            }

            $manager->persist($ch);
        }

        $manager->flush();
    }

    private static function getData(string $path): array
    {
        return array_map(function($value) {
            return trim(trim($value, '\n'));
        }, explode(',', file_get_contents($path)));
    }

    public function getOrder()
    {
        return 1;
    }
}