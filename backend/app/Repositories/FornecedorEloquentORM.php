<?php

namespace App\Repositories;

use App\DTO\CreateFornecedorDTO;
use App\DTO\UpdateFornecedorDTO;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\FornecedorRepositoryInterface;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

class FornecedorEloquentORM implements FornecedorRepositoryInterface
{
    public function __construct( protected Fornecedor $model) {}

    public function getAll(string $filter = null): array
    {
        return $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->Where('cpf_cnpj', 'like', "%{$filter}%");
                }
            })
            ->paginate()
            ->toArray();
    }

    public function getOne(string $id): stdClass|null
    {
        $fornecedor = $this->model->find($id);
        if (!$fornecedor) {
            return null;
        }

        return (object) $fornecedor->toArray();
    }

    public function delete(string $id): stdClass|null
    {
        $fornecedor = $this->model->find($id);
        if (!$fornecedor) {
            return null;
        }
        $fornecedor->delete();
        return $fornecedor;
    }

    public function create(CreateFornecedorDTO $dto): stdClass
    {
        $fornecedor = $this->model->create(
            (array) $dto
        );

        return (object) $fornecedor->toArray();
    }

    public function update(UpdateFornecedorDTO $dto): stdClass|null
    {
        if (!$fornecedor = $this->model->find($dto->id)) {
            return null;
        }

        $fornecedor->update(
            (array) $dto
        );

        return (object) $fornecedor->toArray();
    }

   
}
