<?php

namespace Comunidad\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Comunidad\UsuariosBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Request;

use Comunidad\UsuariosBundle\Form\Users\RegisterUser;


class UsuariosController extends Controller
{
	/**
	 *  @Template()
	 */
	
	public function CreateAction( Request $request)
	{
		$usuario = new Users;

		$form = $this->createForm(new RegisterUser, $usuario);

		$form->handleRequest($request);

		if ($form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($usuario);
			$em->flush();

			return $this->redirect($this->generateUrl('usuarios_create_show',array('id' => $usuario->getId())));
		}

		return array('form'=> $form->createView());
	}

	public function ShowAction( Request $request)
	{
			return $this->render('UsuariosBundle:Usuarios:exito.html.twig');
	}

}