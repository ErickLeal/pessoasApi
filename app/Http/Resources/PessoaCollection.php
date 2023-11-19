<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PessoaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($pessoa) {
            return [
                'id' =>  $pessoa->id,
                'apelido' => $pessoa->apelido,
                'nome' => $pessoa->nome,
                'nascimento' => $pessoa->nascimento->toDateTime()->format('d/m/Y'),
                'stack' => $pessoa->stack,

            ];
        })->all();
    }
}
