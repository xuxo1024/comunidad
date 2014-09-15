<?php

namespace Blogger\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Blogger\UsuariosBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Blogger\UsuariosBundle\Form\Users\RegisterUser;



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
			
			$salt = uniqid(mt_rand());	
			$usuario->setSalt($salt);
			$pass = $form->get('password')->getData();
			$email = $form->get('email')->getData();
			$login = $form->get('login')->getData();
			$roles = array('ROLE_USER');

			$validateEmail = self::loadUserByEmail($email);
			$validateLogin = self::loadUserByLogin($login);

			if ($validateEmail == 1) //validacion de email duplicado
			{
				
				$txt = $this->get('translator')->trans('Duplicated Email');
				$error = new FormError($txt);
				$form->get('email')->addError($error);
				return $this->render('UsuariosBundle:Usuarios:create.html.twig', array('form' => $form->createView()));
			}
			elseif ($validateLogin == 1) //validacion de login duplicado
			{
			
				$txt = $this->get('translator')->trans('Login exists');
				$error = new FormError($txt);
				$form->get('login')->addError($error);
				return $this->render('UsuariosBundle:Usuarios:create.html.twig', array('form' => $form->createView()));		
			}
			else
			{
				//codificamos la contraseña
				$encoder = $this->container->get('security.encoder_factory')->getEncoder($usuario);
				$password = Users::getEncodedPassword($pass,$encoder,$salt);
				$usuario->setPassword($password);
				//asignamos el rol correspondiente
				$usuario->setRoles($roles);
				//lo marcamos como activo
				$usuario->setActive(1);

				$em = $this->getDoctrine()->getManager();
				$em->persist($usuario);
				$em->flush();
				$logger = $this->get('logger');
				$logger->info('usuario creado');

				//redirigimos al usuario ya logado
				$token = new UsernamePasswordToken($usuario,null,'main',$usuario->getRoles());
				$this->get('security.context')->setToken($token);
				$this->get('session')->set('_security_main',serialize($token));

				return $this->redirect($this->generateUrl('BloggerBlogBundle_homepage'));


				//return $this->redirect($this->generateUrl('usuarios_create_show',array('id' => $usuario->getId()))); 
			}

			
		}
		return $this->render('UsuariosBundle:Usuarios:create.html.twig', array('form' => $form->createView()));
	}

	public function loadUserByEmail($email)
	{

		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UsuariosBundle:Users')->findOneBy(array("email" => $email));
		$valor = ($user) ? 1 : 0 ;
		return $valor;

	}


	public function loadUserByLogin($login)
	{

		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UsuariosBundle:Users')->findOneBy(array("login" => $login));
		$valor = ($user) ? 1 : 0 ;
		return $valor;

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
			
			$pass = $form->get('password')->getData();
			$encoder = $this->container->get('security.encoder_factory')->getEncoder($usuario);
			$password = Users::getEncodedPassword($pass,$encoder,$usuario->getSalt());
			$usuario->setPassword($password);

			$em->flush();
			$logger = $this->get('logger');
			$logger->info('edicion usuario:'.$id);
			return $this->redirect($this->generateUrl('usuarios_listado'));
		}

		$build['form'] = $form->createView();
		return $this->render('UsuariosBundle:Admin:create.html.twig', $build);
	}

}