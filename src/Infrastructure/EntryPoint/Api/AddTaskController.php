<?php

namespace App\Infrastructure\EntryPoint\Api;

use App\Application\AddTask;
use App\Application\AddTaskHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTaskController
{
    private AddTaskHandler $addTaskHandler;

    public function __construct(AddTaskHandler $addTaskHandler)
    {
        $this->addTaskHandler = $addTaskHandler;
    }

    public function __invoke(Request $request) : Response
    {
        $taskDescription = $this->getTask($request);
        $addTask = new AddTask($taskDescription);
        ($this->addTaskHandler)($addTask);

        return new JsonResponse('', Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getTask(Request $request): mixed
    {
        return json_decode($request->getContent(), true)['task'];
    }
}