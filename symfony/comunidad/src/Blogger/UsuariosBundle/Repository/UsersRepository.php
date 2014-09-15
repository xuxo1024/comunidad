<?php

namespace Blogger\UsuariosBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository {

    public function findUsers($from_date) {
        return $this->getEntityManager()
            ->createQuery('SELECT *
                           FROM users')
            ->getResult();
    }
}