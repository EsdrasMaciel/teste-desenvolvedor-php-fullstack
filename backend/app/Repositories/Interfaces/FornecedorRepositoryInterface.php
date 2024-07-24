<?php

namespace App\Repositories\Interfaces;

use App\DTO\{
    CreateFornecedorDTO,
    UpdateFornecedorDTO
};
use stdClass;

interface FornecedorRepositoryInterface{
    public function getAll(string $filter = null): array;
    public function getOne(string $id): stdClass|null;
    public function delete(string $id): stdClass|null;
    public function create(CreateFornecedorDTO $dto): stdClass;
    public function update(UpdateFornecedorDTO $dto): stdClass|null;
}
