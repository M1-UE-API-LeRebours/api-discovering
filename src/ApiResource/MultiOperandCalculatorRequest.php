<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\State\MultiOperandCalculatorRequestProcessor;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: "/calculate/multiple",
            input: MultiOperandCalculatorRequest::class,
            //controller: MultiOperandCalculatorRequestAction::class,
            output: MultiOperandCalculatorRequest::class,
            processor: MultiOperandCalculatorRequestProcessor::class
        )
    ]
)]
class MultiOperandCalculatorRequest
{
    public string $operation;
    public array $operands;

    public int $result;

    public function process(): void
    {
        if ($this->operation === 'add') {
            $this->result = array_sum($this->operands);
        } elseif ($this->operation === 'subtract') {
            $this->result = $this->operands[0];
            for ($i = 1; $i < count($this->operands); $i++) {
                $this->result -= $this->operands[$i];
            }
        } elseif ($this->operation === 'multiply') {
            $this->result = $this->operands[0];
            for ($i = 1; $i < count($this->operands); $i++) {
                $this->result *= $this->operands[$i];
            }
        }
    }
}