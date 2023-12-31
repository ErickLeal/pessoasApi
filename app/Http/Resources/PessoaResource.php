<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class PessoaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'apelido' => $this->apelido,
            'nome' => $this->nome,
            'nascimento' => $this->nascimento
            ->toDateTime()->format('d/m/Y'),
            'stack' => $this->stack
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->header('Location', "/api/pessoas/".$request->id);
    }
}
