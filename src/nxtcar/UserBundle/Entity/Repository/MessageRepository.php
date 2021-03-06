<?php

namespace nxtcar\UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends EntityRepository
{
    /**
     * @param $from
     * @param $to
     * @param $rideDate
     * @return array
     */
    public function findPrivateMessages($from, $to, $rideDate)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT msg, fromUser, toUser, rideDate
                           FROM nxtcarUserBundle:Message msg
                           JOIN msg.from fromUser
                           JOIN msg.to toUser
                           JOIN msg.rideDate rideDate
                           JOIN msg.tempRideDate tempRideDate
                           WHERE
                           ((
                               fromUser = :fromUs
                               AND toUser = :toUs
                           )
                           OR (
                               fromUser = :toUs
                               AND toUser = :fromUs
                           ))
                           AND
                           (
                              rideDate = :rideDate
                              OR
                              tempRideDate = :rideDate
                           )

                           ORDER BY msg.sendDate
                           ")
            ->setParameters(array(
                'fromUs' => $from,
                'toUs'  => $to,
                'rideDate' => $rideDate
            ))
            ->getResult();
    }

    /**
     * @param $user
     * @return array
     */
    public function findMessagesByUser($user)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT message, userFrom, tempRideDate, rideDate
                           FROM nxtcarUserBundle:Message message
                           JOIN message.from userFrom
                           JOIN message.to userTo
                           LEFT JOIN message.tempRideDate tempRideDate
                           LEFT JOIN message.rideDate rideDate
                           WHERE userTo = :toUs
                           AND userFrom != :toUs
                           AND message.sendDate = (SELECT MAX(msg.sendDate)
                                                   FROM nxtcarUserBundle:Message msg
                                                   WHERE msg.rideDate = rideDate
                                                   AND msg.from = userFrom)")
            ->setParameter('toUs', $user)
            ->getResult();
    }
}
