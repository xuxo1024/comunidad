<?php

namespace Comunidad\UsuariosBundle\Model

use Doctrine\Common\Persistence\ObjectManager

Class LastUsers
{
	
	private $repository

	public function __construc(ObjectManager $om)
	{
		$this->repository = $om->getRepository('UsuariosBundle:Users');
	}

	public function findFrom(\Datetime $from_date)
	{
		return $this->findPublishedAfter($from_date);
	}
}