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
	

	public function lastUsersAction()
	{
		$date = new \DateTime('-10 days');
		
		return array(
				      'messages' => $this->get('users.last_users')->findFrom($date)
			);
	}

	public function ListadoAction()
	{

		$em = $this->getDoctrine()->getManager();
		$listado = $em->getRepository('UsuariosBundle:Users')->findAll();

			$logger = $this->get('logger');
			$logger->info('listado Usuarios');

		return $this->render('UsuariosBundle:Usuarios:listado.html.twig',array('listado'=>$listado));	
	}

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
			$logger = $this->get('logger');
			$logger->info('usuario creado');

			return $this->redirect($this->generateUrl('usuarios_create_show',array('id' => $usuario->getId())));
		}

		return array('form'=> $form->createView());
	}

	public function ShowAction( Request $request)
	{
			return $this->render('UsuariosBundle:Usuarios:exito.html.twig');
	}

	public function EditAction( $id, Request $request )
	{
		
		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('UsuariosBundle:Users')->find($id);

		if (!$usuario) {

			$logger = $this->get('logger');
			$logger->error('edicion usuario error');
			throw $this->createNotFoundException(
              'No news found for id ' . $id
      		);
    	}

    	$form = $this->createForm(new RegisterUser, $usuario);

    	$form->handleRequest($request);

    	if ($form->isValid())
		{
			$em->flush();
			$logger = $this->get('logger');
			$logger->info('edicion usuario:'.$id);
			return $this->render('UsuariosBundle:Usuarios:exito.html.twig');
		}

		$build['form'] = $form->createView();
		return $this->render('UsuariosBundle:Usuarios:create.html.twig', $build);
	}

}