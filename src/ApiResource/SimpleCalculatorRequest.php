<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\SimpleCalculatorRequestAction;
use App\State\SimpleCalculatorRequestProcessor;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: "/calculate/simple",
            input: SimpleCalculatorRequest::class,
            //controller: SimpleCalculatorRequestAction::class,
            output: SimpleCalculatorRequest::class,
            processor: SimpleCalculatorRequestProcessor::class
        )
    ]
)]
class SimpleCalculatorRequest
{
    public string $operation;
    public int $firstOperand;

    public int $secondOperand;

    public int $result;

    public function process(): void
    {
        if ($this->operation === 'add') {
            $this->result = $this->firstOperand + $this->secondOperand;
        } elseif ($this->operation === 'subtract') {
            $this->result = $this->firstOperand - $this->secondOperand;
        } elseif ($this->operation === 'multiply') {
            $this->result = $this->firstOperand * $this->secondOperand;
        } elseif ($this->operation === 'divide') {
            if($this->secondOperand == 0) {
                throw new \InvalidArgumentException("Division by zero is not allowed");
            }
            else {
                $this->result = $this->firstOperand / $this->secondOperand;
            }
        }
    }
}