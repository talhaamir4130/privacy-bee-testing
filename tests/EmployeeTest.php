<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeTest extends WebTestCase
{
    public function testUpdateEmployee(): void
    {
        $client = static::createClient();
        $updateData = [
            'first_name' => 'Talha',
            'middle_name' => null,
            'last_name' => 'Amir',
            'email' => ['talhaamir2018@gmail.com'],
        ];
    
        $client->request(
            Request::METHOD_PUT,
            '/employees/1',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($updateData)
        );
    
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertEquals(json_encode($updateData), $client->getResponse()->getContent());
    }

    public function testUpdateEmployeeWrongInputs(): void
    {
        $client = static::createClient();
        $updateData = [
            'first_name' => ['Talha'],
            'middle_name' => null,
            'last_name' => 0,
            'email' => 12345,
        ];

        $client->request(
            Request::METHOD_PUT,
            '/employees/1',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($updateData)
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
    }
}
