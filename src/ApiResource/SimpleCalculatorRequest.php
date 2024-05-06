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

    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Assert\NotNull]
    public int $firstOperand;


    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Assert\NotNull]
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