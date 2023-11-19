<?php

//namespace
namespace App\Repositories;

use App\Dtos\PessoaDto;
use App\Exceptions\PessoaNaoEncontradaException;
use App\Http\Resources\PessoaCollection;
use App\Http\Resources\PessoaResource;
use App\Models\Pessoa;

class PessoaRepository
{

    public function criarPessoa(PessoaDto $pessoaDto): PessoaResource
    {

        $pessoa = [
            'id' => $pessoaDto->id,
            'nome' => $pessoaDto->nome,
            'apelido' => $pessoaDto->apelido,
            'nascimento' => $pessoaDto->nascimento
        ];

        if (isset($pessoaDto->stack)) {
            $pessoa['stack'] = $pessoaDto->stack;
        }

        return new PessoaResource(
            Pessoa::create($pessoa)
        );
    }

    public function buscarPessoaPorId(string $id): PessoaResource
    {
        $pessoa = Pessoa::where('id', $id)->first();

        if (!$pessoa) {
            throw new PessoaNaoEncontradaException();
        }

        return new PessoaResource($pessoa);
    }

    public function buscarPessoasPorTermo(string $termo): PessoaCollection
    {
       
        $aggregation = [
            [
                '$search' => [
                    'text' => [
                        'query' => $termo,
                        'path' => ['nome', 'apelido', 'stack']
                    ]
                ]
            ],
            [
                '$limit' => 50
            ]
        ];
       
        $pessoas = Pessoa::raw(function ($collection) use ($aggregation) {
            return $collection->aggregate($aggregation);
        });

     
        return new PessoaCollection($pessoas);
    }

    public function contarPessoas(): Int
    {
        return Pessoa::count();

    }

   
}
