<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\SimpleCalculatorRequestAction;
use ApiPlatform\OpenApi\Model;
use App\State\SimpleCalculatorRequestProcessor;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;


class SimpleCalculatorRequest
{

    #[Assert\Choice(choices: ['add', 'subtract', 'multiply', 'divide'])]
    public string $operation;
    #[ApiProperty(
        openapiContext: [
            'type' => 'integer'
        ]
    )]
    #[Groups(['simple_calculator_request:write'])]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Assert\NotNull]
    public int $firstOperand;

    #[ApiProperty(
        openapiContext: [
            'type' => 'integer'
        ]
    )]
    #[Groups(['simple_calculator_request:write'])]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Assert\NotNull]
    public int $secondOperand;

    #[ApiProperty(
        openapiContext: [
            'type' => 'integer'
        ]
    )]
    #[Groups(['simple_calculator_request:read'])]
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