<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = Uuid::uuid4();
        return [
            'id' => $id->toString(),
            'nome' => Str::random(15),
            'apelido' => Str::random(15),
            'nascimento' => new UTCDateTime(now()->subDays(20)),
            'stack' => ['php', 'laravel']
        ];
    }
}
