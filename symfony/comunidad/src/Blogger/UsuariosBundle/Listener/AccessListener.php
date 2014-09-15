<?php

namespace Blogger\UsuariosBundle\Listener;


use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AccessListener
{
    private$security;
    private $router;

    public function __construct($security, $router)
    {
        $this->security = $security;
        $this->router = $router;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
           $url = $this->router->generate('admin');
           $event->setResponse(new RedirectResponse($url));
        }
    }
}


?>