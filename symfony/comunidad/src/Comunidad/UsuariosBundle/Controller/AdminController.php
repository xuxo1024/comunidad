<?php

namespace Comunidad\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    
	public function indexAction()
    {
        return $this->render('UsuariosBundle:Admin:index.html.twig');
    }
    

    

}