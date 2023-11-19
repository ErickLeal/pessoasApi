<?php

namespace App\Exceptions;

use Exception;

class PessoaNaoEncontradaException extends Exception
{
    public function __construct(
        string $mensagem = 'Pessoa não encontrada',
        $code = 404,
        Exception $previous = null
    ) {
        parent::__construct($mensagem, $code, $previous);
    }

    public function render()
    {
        return response()->json([
            'mensagem' => $this->getMessage(),
        ], $this->getCode());
    }
}
