<?php

namespace Comunidad\MensajesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ComunidadMensajesBundle:Default:index.html.twig', array('name' => $name));
    }
}
