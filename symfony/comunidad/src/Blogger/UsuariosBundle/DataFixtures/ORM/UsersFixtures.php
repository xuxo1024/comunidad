<?php

namespace Blogger\UsuariosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Blogger\UsuariosBundle\Entity\Users;

class UsersFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $user = new Users();
        $user->setLogin('test');
        $user->setPassword('test');
        $user->setEmail('test@test.com');
        $user->setRoles(array('ROLE_USER'));
        $user->setActive(1);
        $manager->persist($user);
        
        $user = new Users();
        $user->setLogin('admin');
        $user->setPassword('admin');
        $user->setEmail('admin@admin.com');
        $user->setRoles(array('ROLE_USER','ROLE_ADMIN'));
        $user->setActive(1);
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
