<?php

namespace App\Dtos;

use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

class PessoaDto
{
    public $nome;
    public $apelido;
    public $nascimento;
    public $stack;
    public $id;

    public function __construct(array $dados)
    {
        $this->nome = $dados['nome'];
        $this->apelido = $dados['apelido'];
        $this->nascimento = new UTCDateTime(
            Carbon::createFromFormat('Y-m-d', $dados['nascimento'])
        );

        $this->stack = isset($dados['stack'])
            ? $dados['stack']
            : null;

        if (isset($dados['id'])) {
            $this->id = $dados['id'];
        }
    }
}
