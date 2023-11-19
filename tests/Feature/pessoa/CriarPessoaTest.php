<?php

namespace Tests\Feature\pessoa;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Support\Str;

use Tests\TestCase;

class CriarPessoaTest extends TestCase
{
    use DatabaseMigrations;

    public function test_criar_pessoa_deve_funcionar(){

        $response =  $this->postJson('/api/pessoas', [
            'nome' => 'User Test',
            'apelido' => 'Test',
            'nascimento' => '2000-02-02',
            'stack' => ['PHP','MONGODB']
        ]);
        $response->assertStatus(201);
       
        $this->assertDatabaseHas('pessoas', [
            'nome' => 'User Test',
            'apelido' => 'Test'
        ]);
    }

    public function test_criar_pessoa_deve_falhar_sem_campos_obrigatorios(){

        $response =  $this->postJson('/api/pessoas', ['']);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['nome', 'apelido', 'nascimento']);
    }


    /**
     * @dataProvider provider_criar_pessoa_dados_invalidos
     */
    public function test_criar_pessoa_deve_falhar_com_dados_invalidos(
        String $campoComErro,
        String $apelido,
        String $nome,
        String $nascimento,
        mixed $stack
    ) {

        $response =  $this->postJson('/api/pessoas', [
            'apelido' => $apelido,
            'nome' => $nome,
            'nascimento' => $nascimento,
            'stack' => $stack
        ]);
      
        $response->assertStatus(422)
            ->assertJsonCount(1, "errors.$campoComErro");
    }

    public static function provider_criar_pessoa_dados_invalidos()
    {

        return [
            ['apelido', Str::random(33), Str::random(30), '2023-01-01', ['PHP']],
            ['nome', Str::random(30), Str::random(101), '2023-01-01', ['PHP']],
            ['nascimento', Str::random(30), Str::random(30), '01/01/2023', ['PHP']],
            ['stack', Str::random(30), Str::random(30), '2023-01-01', 'PHP'],
        ];
    }

}
