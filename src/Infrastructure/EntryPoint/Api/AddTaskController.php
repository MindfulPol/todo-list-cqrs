<?php

namespace App\Infrastructure\EntryPoint\Api;

use http\Client\Response;

class AddTaskController
{
    public function __invoke() : Response
    {
        return new Response;
    }
}