<?php

namespace Blogger\UsuariosBundle\Form\Users;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class MesaggesType extends AbstractType
{
	public function buildForm (FormBuilderInterface $builder, array $options)
	{

		

		$builder 
			
			->add('to_user', 'entity', array(
					'mapped' => false,
					'class' => 'UsuariosBundle:Users',
					'property' => 'login'))
			
				
			//->add('to_user', 'number')
			->add('message','textarea')
			->add('save','submit');
	}


	public function getName()
	{
		return 'mesagges';
	}
}