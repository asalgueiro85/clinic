<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PelajeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PelajeRepository extends EntityRepository
{
    public function findPelaje($param){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('e')
            ->from('FrontBundle:Pelaje','e')
            ->where('e.nombre LIKE :param')
            ->setParameter('param', '%'.$param.'%')
            ->getQuery();
        return $queryBuilder->getResult();
    }
}
