<?php

//namespace
namespace App\Services;

use App\Dtos\PessoaDto;

use App\Http\Resources\PessoaCollection;
use App\Http\Resources\PessoaResource;
use App\Repositories\PessoaRepository;
use Ramsey\Uuid\Uuid;

class PessoaService
{

    private $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepository = $pessoaRepository;
    }


    public function criar(PessoaDto $pessoaDto): PessoaResource
    {

        $id = Uuid::uuid4();

        $pessoaDto->id = $id->toString();

        return $this->pessoaRepository->criarPessoa($pessoaDto);
    }

    public function buscarUmaPessoa(string $id): PessoaResource
    {

        return $this->pessoaRepository->buscarPessoaPorId($id);
    }

    public function buscarPorTermo(string $termo): PessoaCollection
    {

        return $this->pessoaRepository->buscarPessoasPorTermo($termo);
    }

    public function contar(): Int
    {

        return $this->pessoaRepository->contarPessoas();
    }

   
}
