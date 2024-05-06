<?php

namespace App\Controller;

use App\ApiResource\MultiOperandCalculatorRequest;
use App\ApiResource\SimpleCalculatorRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MultiOperandCalculatorRequestAction extends AbstractController
{
    public function __invoke(MultiOperandCalculatorRequest $data): MultiOperandCalculatorRequest
    {
        $data->process();

        return $data;
    }
}