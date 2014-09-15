<?php

namespace Blogger\UsuariosBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MessagesRepository extends EntityRepository {

    public function findMessages($from_date) {
        return $this->getEntityManager()
            ->createQuery('SELECT *
                           FROM messages')
            ->getResult();
    }
}