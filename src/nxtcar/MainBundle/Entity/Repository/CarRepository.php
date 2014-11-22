<?php

namespace nxtcar\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CarRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarRepository extends EntityRepository
{
    /**
     * @param $user
     * @return array
     */
    public function findCarsByUser($user)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT car, model, brand
                           FROM nxtcarMainBundle:Car car
                           LEFT JOIN car.model model
                           LEFT JOIN model.brand brand
                           LEFT JOIN car.user user
                           WHERE user = :user")
            ->setParameter('user', $user)
            ->getResult();
    }
}