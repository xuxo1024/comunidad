<?php

namespace Comunidad\UsuariosBundle\Form\Users;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class RegisterUser extends AbstractType
{
	public function buildForm (FormBuilderInterface $builder, array $options)
	{

		$builder 
			->add('login','text')
			->add('password','password')
			->add('email','email')
			->add('save','submit');

	}


	public function getName()
	{
		return 'users';
	}
}