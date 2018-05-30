<?php
/**
 * Created by PhpStorm.
 * User: alexis
 * Date: 12/03/18
 * Time: 19:56
 */

namespace App\Repository\ORM\Pet;


use Doctrine\ORM\EntityRepository;

class PetCharacteristicValue extends EntityRepository
{
    public function findForRest(array $args)
    {
        $qb = $this->createQueryBuilder('pcv');

        if (isset($args['type'])) {
            $qb->join('pcv.characteristic', 'pc')
                ->select('pcv.id AS id, pcv.value AS value')
                ->where('pc.name = :type')
                ->setParameter('type', $args['type'])
                ->addOrderBy('pc.name', 'desc')
            ;

        }

        return $qb->getQuery()->getArrayResult();
    }
}