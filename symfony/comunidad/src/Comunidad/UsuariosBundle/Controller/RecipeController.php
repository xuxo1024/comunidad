<?php

namespace Comunidad\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UsuariosBundle:Default:index.html.twig', array('name' => $name));
    }
	
	public function showidAction($id)
    {
  //       if is_int ( $id )
		// {
		// 	//llamada al modelo para sacar el nombre y la url del elemento
		// 	$name = "modelourl";
		// 	return $this->forward('UsuariosBundle:Recipe:showname',array('name' => $name));
			
		// }
		// else
		// {
		// 	return $this->forward('UsuariosBundle:Recipe:showname',array('name' => $id));
		// }
		
		
		return $this->render('UsuariosBundle:Recipe:index.html.twig', array('name' => $id));
    }
	
	public function shownameAction($name)
    {
        return $this->render('UsuariosBundle:Recipe:index.html.twig', array('name' => $name));
    }
	
}
