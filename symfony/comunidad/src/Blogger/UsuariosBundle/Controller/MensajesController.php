<?php

namespace Blogger\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Blogger\UsuariosBundle\Entity\Messages;
use Blogger\UsuariosBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Request;

use Blogger\UsuariosBundle\Form\Users\MesaggesType;

class MensajesController extends Controller
{
	/**
	 *  @Template()
	 */
	


	public function lastMessagesAction()
	{
		$date = new \DateTime('-10 days');
		return array(
				      'messages' => $this->get('my_messages.last_messages')->findFrom($date)
			);
	}

	public function ListadoAction()
	{

		$em = $this->getDoctrine()->getManager();
		$listado = $em->getRepository('UsuariosBundle:Messages')->findAll();

			$logger = $this->get('logger');
			$logger->info('listado Mensajes');

		return $this->render('UsuariosBundle:Mensajes:listado.html.twig',array('listado'=>$listado));	
	}

	public function CreateAction( Request $request)
	{
		$mensaje = new Messages;
		$usuario = new Users();

		//TODO
		//cambiar datos en función del usuario conectado.		
		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('UsuariosBundle:Users')->find(1);
		$mensaje->setIdUser($usuario->setId(1));




		$form = $this->createForm(new MesaggesType, $mensaje);

		$form->handleRequest($request);



		if ($form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			//TODO
			//descubiri por que narices no me hace la conversion solo
			$mensaje->setToUser($_POST["mesagges"]["to_user"]);
			$em->persist($mensaje);
			$em->flush();
			$logger = $this->get('logger');
			$logger->info('mensaje creado');

			return $this->redirect($this->generateUrl('usuarios_create_show',array('id' => $mensaje->getId())));
		}



		//return array('form'=> $form->createView());
		return $this->render('UsuariosBundle:Mensajes:create.html.twig', array('form' => $form->createView()));
		

		
	}

	public function ShowAction( Request $request)
	{
			return $this->render('UsuariosBundle:Mensajes:exito.html.twig');
	}

	public function EditAction( $id, Request $request )
	{
		
		$em = $this->getDoctrine()->getManager();
		$mensaje = $em->getRepository('UsuariosBundle:Messages')->find($id);

		if (!$mensaje) {
			$logger = $this->get('logger');
			$logger->error('edicion mensaje error');
      		throw $this->createNotFoundException(
              'No news found for id ' . $id
      		);
    	}

    	$form = $this->createForm(new MesaggesType, $mensaje);

    	$form->handleRequest($request);

    	if ($form->isValid())
		{
			$em->flush();
			$logger = $this->get('logger');
			$logger->info('edicion mensaje:'.$id);
			return $this->render('UsuariosBundle:Mensajes:exito.html.twig');
		}

		$build['form'] = $form->createView();
		return $this->render('UsuariosBundle:Mensajes:create.html.twig', $build);
	}
}