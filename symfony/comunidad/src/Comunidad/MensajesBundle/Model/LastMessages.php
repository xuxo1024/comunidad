<?php

namespace Comunidad\MensajesBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

Class LastMessages
{
	
	private $repository;

	public function __construc(ObjectManager $om)
	{
		$this->repository = $om->getRepository('MensajesBundle:Messages');
	}

	public function findFrom(\Datetime $from_date)
	{
		//TODO listado mensajes fecha
		//return $this->repository->findMessages($from_date);
		return;
	}
}