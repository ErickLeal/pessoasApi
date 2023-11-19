<?php

namespace Tests\Feature\pessoa;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Pessoa;

use Tests\TestCase;

class BuscarPessoaTest extends TestCase
{
    use DatabaseMigrations;

    public function test_buscar_pessoa_por_id_deve_funcionar()
    {

        $pessoa = Pessoa::factory()->create([
            'apelido' => 'Teste',
        ]);

        $response =  $this->getJson('/api/pessoas/' . $pessoa->id);

        $response->assertStatus(200);

        $response = $response->json();

        $this->assertEquals(
            $pessoa->id,
            $response['pessoa']['id']
        );

        $this->assertEquals(
            $pessoa->apelido,
            $response['pessoa']['apelido']
        );
    }

    public function test_buscar_pessoa_por_id_deve_retornar_erro_caso_id_nao_exista()
    {

        $response =  $this->getJson('/api/pessoas/' . '123');
    
        $response->assertStatus(404);
    
    }

    public function test_buscar_pessoa_por_termo_deve_retornar_erro_request_invalida()
    {

        $response =  $this->getJson('/api/pessoas?termo=Php');
    
        $response->assertStatus(400)
        ->assertJsonCount(1, "errors.t");
        
    }

    public function test_contar_pessoas_deve_funcionar()
    {
        $qtdPessoas = 5;

        Pessoa::factory($qtdPessoas)->create();
        $response =  $this->getJson('/api/contagem-pessoas');
        
        $response->assertStatus(200);
        
        $response = $response->json();

        $this->assertEquals(
            $qtdPessoas,
            $response['total_pessoas']
        );
    
    }

    
}
