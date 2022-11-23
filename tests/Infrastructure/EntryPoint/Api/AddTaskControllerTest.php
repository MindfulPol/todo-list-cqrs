<?php

namespace App\Tests\Infrastructure\EntryPoint\Api;

use App\Application\AddTask;
use App\Application\AddTaskHandler;
use App\Infrastructure\EntryPoint\Api\AddTaskController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class AddTaskControllerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAddATask() : void
    {
        $addTaskUseCase = $this->createMock(AddTaskHandler::class);
        $addTaskUseCase
            ->expects($this->once())
            ->method('__invoke')
            ->with(new AddTask('Test Task'))
        ;

        $payload = ['task' => 'Write a test'];
        $addTaskController = new AddTaskController($addTaskUseCase);
        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            ['content_type' => 'application/json'],
            json_encode($payload)
        );
        $response = ($addTaskController)($request);

        self::assertEquals(201, $response->getStatusCode());
    }
}
