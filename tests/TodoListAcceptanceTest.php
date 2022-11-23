<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class TodoListAcceptanceTest extends ApiTestCase
{
    /** @test */
    public function asUserICanAddATaskToTheList(): void
    {
        $client = static::createClient();
        $payload = [
            'task' => 'task description'
        ];
        $client->request(
            'POST',
            '/api/todo',
            [
                'headers' => ['content_type' => 'application/json'],
                'body' => json_encode($payload, JSON_THROW_ON_ERROR)
            ]
        );

        $response = $client->request(
                'GET',
                '/api/todo',
                [
                    'content_type' => 'application/json',
                ]
        );
        $expected = [
            '[ ] 1. task description'
        ];
        self::assertJsonEquals($expected, $response->getContent());
    }
}
