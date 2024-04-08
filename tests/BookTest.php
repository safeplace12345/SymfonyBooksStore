<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookTest extends WebTestCase
{
    // public function testAllBooksRoute(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/books');
    //     $crawler = $client->getResponse()->getStatusCode();

    //     $this->assertResponseStatusCodeSame('200', $client->getResponse()->getStatusCode());
    //     // $this->assertSelectorTextContains('h1', 'Hello Mate :)');
    // }

    public function testAddBookRoute(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/books',
            [ 'headers' => [
              'Accept' => 'application/json',
              'Content-Type' => 'application/json',
            ],
                'json' =>  [
                    "authorName" => "authorName",
                    "authorSName" => "authorSName",
                ]
            ]);
        // $code = $client->getResponse()->getStatusCode();
        // $data = $client->getResponse()->getContent();

        $this->assertResponseStatusCodeSame('200', $client->getResponse()->getStatusCode());
        // $this->assertEquals(['title'=> 'Danger'], $data);
    }
    // public function testUpdateBookRoute(): void
    // {
    //     $client = static::createClient();
    //     $client->request('POST', '/books');
    //     $crawler = $client->getResponse()->getStatusCode();

    //     $this->assertResponseStatusCodeSame('200', $client->getResponse()->getStatusCode());
    //     // $this->assertSelectorTextContains('h1', 'Hello Mate :)');
    // }
}
