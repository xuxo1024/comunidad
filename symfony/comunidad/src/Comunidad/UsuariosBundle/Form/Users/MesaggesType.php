<?php

namespace Comunidad\UsuariosBundle\Form\Users;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class MesaggesType extends AbstractType
{
	public function buildForm (FormBuilderInterface $builder, array $options)
	{

		$builder 
			->add('id_user','text')
			->add('to_user','text')
			->add('message','text')
			->add('save','submit');
	}


	public function getName()
	{
		return 'mesagges';
	}
}