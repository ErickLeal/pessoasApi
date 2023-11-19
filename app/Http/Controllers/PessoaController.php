<?php

namespace App\Http\Controllers;

use App\Dtos\PessoaDto;

use App\Services\PessoaService;

use App\Http\Requests\StorePessoaRequest;
use App\Http\Requests\IndexPessoaRequest;

use MongoDB\Driver\Exception\BulkWriteException;

use Illuminate\Http\Request;

class PessoaController extends Controller
{

    private $pessoaService;

    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;
    }

    public function store(StorePessoaRequest $request)
    {

        $dados = $request->validated();

        $pessoaDto = new PessoaDto($dados);

        try {

            $pessoa = $this->pessoaService->criar($pessoaDto);
        } catch (BulkWriteException $e) {

            return response()->json([
                'menssagem' => 'Essa pessoa já está cadastrada'
            ], 409);
        }

        return response()
            ->json([
                'menssagem' => 'Pessoa registrada com sucesso',
                'pessoa' => $pessoa,
            ], 201)
            ->header('Location', 'pessoas/' . $pessoa->id);
    }

    public function show(string $id)
    {

        $pessoa = $this->pessoaService->buscarUmaPessoa($id);

        return response()->json([
            'menssagem' => 'Sucesso',
            'expense' => $pessoa,
        ], 200);
    }

    public function index(IndexPessoaRequest $request)
    {
        $dados = $request->validated();

        $pessoas = $this->pessoaService->buscarPorTermo($dados['t']);

        return response()->json([
            'menssagem' => 'Sucesso',
            'pessoas' => $pessoas,
        ], 200);
    
    }

    public function count()
    {

        $totalPessoas = $this->pessoaService->contar();

        return response()->json([
            'menssagem' => 'Sucesso',
            'total_pessoas' => $totalPessoas,
        ], 200);
    
    }

}
