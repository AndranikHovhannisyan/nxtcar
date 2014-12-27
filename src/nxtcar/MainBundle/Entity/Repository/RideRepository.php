<?php

namespace nxtcar\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RideRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RideRepository extends EntityRepository
{
    public function findRide($from, $to)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT mainRide
                           FROM nxtcarMainBundle:Ride mainRide
                           JOIN mainRide.rideTown rideTown1
                           JOIN mainRide.rideTown rideTown2
                           JOIN mainRide.rideDate rideDate
                           JOIN rideTown1.town town1
                           JOIN rideTown2.town town2
                           WHERE
                           town1.name LIKE :townFrom AND
                           town2.name LIKE :townTo AND
                           ((
                               rideTown1.positionInRide < rideTown2.positionInRide
                               AND NOT EXISTS (SELECT rideTown3
                                               FROM nxtcarMainBundle:RideTown rideTown3
                                               JOIN rideTown3.ride ride1
                                               WHERE rideTown3.positionInRide >= rideTown1.positionInRide
                                               AND rideTown3.positionInRide < rideTown2.positionInRide
                                               AND rideTown3.busyPlacesGo = ride1.allPlaces
                                               AND ride1 = rideTown2.ride)
                           )
                           OR
                           (
                               rideTown1.positionInRide > rideTown2.positionInRide
                               AND rideDate.isRound = true
                               AND NOT EXISTS (SELECT rideTown4
                                               FROM nxtcarMainBundle:RideTown rideTown4
                                               JOIN rideTown4.ride ride2
                                               WHERE rideTown4.positionInRide > rideTown2.positionInRide
                                               AND rideTown4.positionInRide <= rideTown1.positionInRide
                                               AND rideTown4.busyPlacesReturn = ride2.allPlaces
                                               AND ride2 = rideTown2.ride)
                           ))
                           ")
            ->setParameter('townFrom', $from)
            ->setParameter('townTo', $to)
            ->getResult();


        return $this->getEntityManager()
            ->createQuery("SELECT rideTown1
                           FROM nxtcarMainBundle:RideTown rideTown1
                           JOIN rideTown1.ride mainRide
                           JOIN mainRide.rideDate rideDate
                           JOIN nxtcarMainBundle:RideTown rideTown2
                           WITH rideTown1.ride = rideTown2.ride
                           JOIN rideTown1.town town1
                           JOIN rideTown2.town town2
                           WHERE
                           town1.name LIKE :townFrom AND
                           town2.name LIKE :townTo AND
                           (
                               rideTown1.positionInRide < rideTown2.positionInRide
                               AND NOT EXISTS (SELECT rideTown3
                                               FROM nxtcarMainBundle:RideTown rideTown3
                                               JOIN rideTown3.ride ride
                                               WHERE rideTown3.positionInRide >= rideTown1.positionInRide
                                               AND rideTown3.positionInRide < rideTown2.positionInRide
                                               AND rideTown3.busyPlaces = ride.allPlaces
                                               AND ride = rideTown2.ride)
                           )
                           ")
            ->setParameter('townFrom', $from)
            ->setParameter('townTo', $to)
            ->getResult();
    }
}