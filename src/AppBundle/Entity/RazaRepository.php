<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

/**
 * RazaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RazaRepository extends EntityRepository
{
    public function especie_raza($especie_id){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('a')
            ->from('FrontBundle:Raza', 'a')
            ->where('a.especie_id = :especie_id')
            ->setParameters('especie_id',$especie_id)
            ->getQuery();

        return $queryBuilder->getResult();
    }
    public function findRaza($param){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('e')
            ->from('FrontBundle:Raza','e')
            ->where('e.nombre LIKE :param')
            ->setParameter('param', '%'.$param.'%')
            ->getQuery();
        return $queryBuilder->getResult();
    }




}