<?php

namespace Blogger\UsuariosBundle\Form\Users;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Blogger\UsuariosBundle\Entity\Users;

class RegisterUser extends AbstractType
{
	public function buildForm (FormBuilderInterface $builder, array $options)
	{

		//pillamos los roles de los usuarios en modo edicion
		$roles = $options["data"]->getRoles();

		if (!is_null($roles))
		{
		
		$builder 
			->add('login','text')
			->add('password','password')
			->add('email','email')
			->add('roles', 'choice', array(
        	      'choices' => Users::getRoleNames(),
        	      'data' => $roles,
                  'required' => false,'label'=>'Roles','multiple'=>true
                 )
			)
			->add('active','checkbox', array('required' => false , 'label' => 'Activo' ,'attr' => array('checked' => 'checked')))
			->add('save','submit');
		}
		else
		{

			$builder 
			->add('login','text')
			->add('password','password')
			->add('email','email')
			->add('save','submit');
		}



	}


	public function getName()
	{
		return 'users';
	}

}