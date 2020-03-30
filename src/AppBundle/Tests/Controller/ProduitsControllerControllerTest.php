<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitsControllerControllerTest extends WebTestCase
{
    public function testAllproduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/allProduct');
    }

}
