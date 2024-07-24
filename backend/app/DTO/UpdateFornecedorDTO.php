<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateFornecedorRequest;

class UpdateFornecedorDTO
{
        public function __construct(
            public string $id,
            public string $cpf_cnpj,
            public string $nome_fantasia,
            public string $razao_social,
            public string $email,
            public string $telefone,
            public string $endereco,
            public string $numero,
            public string $bairro,
            public string $cidade,
            public string $estado,
        ) {}
    
        public static function updateFromRequest(StoreUpdateFornecedorRequest $request, $id = null): self
        {
            return new self(
                $id ?? $request->id,
                $request->cpf_cnpj,
                $request->nome_fantasia,
                $request->razao_social,
                $request->email,
                $request->telefone,
                $request->endereco,
                $request->numero,
                $request->bairro,
                $request->cidade,
                $request->estado,
            );
        }
}
