<?php

namespace Comunidad\UsuariosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsuariosControllerTest extends WebTestCase
{
    
	  
   public function testCreateUser()
   {

      $client = static::createClient();
      $crawler = $client->request('GET', '/usuarios/registro');
      $form = $crawler->selectButton('submit')->form();
      $form['login'] = "test";
      $form['password'] = "testing"; 
      $form['email'] = "testing@testing.com"; 
      $crawler = $client->submit($form);

  }
   
}
