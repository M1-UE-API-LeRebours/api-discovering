<?php

namespace App\Controller;

use App\ApiResource\SimpleCalculatorRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalculatorRequestAction extends AbstractController
{
    public function __invoke(SimpleCalculatorRequest $data): SimpleCalculatorRequest
    {
        $data->process();

        return $data;
    }
}