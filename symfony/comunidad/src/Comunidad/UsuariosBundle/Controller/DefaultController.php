<?php

namespace Comunidad\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /*
    public function indexAction($name)
    {
        return $this->render('UsuariosBundle:Default:index.html.twig', array('name' => $name));
    }
    */

	public function indexAction()
    {
        return $this->render('UsuariosBundle:Default:portada.html.twig');
    }
    

    public function estaticaAction($pagina)
    {
        return $this->render('UsuariosBundle:Default:'.$pagina.'.html.twig');
    }

}
