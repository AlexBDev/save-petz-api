<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 16/10/17
 * Time: 15:07
 */

namespace App\Repository\Elastica;


use App\Builder\ElasticaApiQueryBuilder;
use App\Model\ApiQuery;
use FOS\ElasticaBundle\Repository;

class PetRepository extends Repository
{
    public function search(ApiQuery $api)
    {
        $query = ElasticaApiQueryBuilder::build($api);

        return $this->find($query, $api->getLimit(), [
            'from' => $api->getOffset(),
        ]);
    }
}