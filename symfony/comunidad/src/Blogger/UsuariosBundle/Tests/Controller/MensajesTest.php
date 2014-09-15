<?php

namespace Blogger\UsuariosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MensajesControllerTest extends WebTestCase
{
    
	  
   public function testCreateMessage()
   {

      $client = static::createClient();
      $crawler = $client->request('GET', '/mensaje/nuevo');
      $form = $crawler->selectButton('submit')->form();
      $form['to_user'] = 1;
      $form['message'] = "testing"; 
      $crawler = $client->submit($form);

  }
   
}
