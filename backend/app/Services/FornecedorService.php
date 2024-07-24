<?php

    namespace App\Services;

use App\DTO\CreateFornecedorDTO;
use App\DTO\UpdateFornecedorDTO;
use App\Repositories\Interfaces\FornecedorRepositoryInterface ;
use stdClass;

Class FornecedorService{
    public function __construct(
        protected FornecedorRepositoryInterface $repository,
    ) {}

    public function getOne(string $id): stdClass|null
    {
        return $this->repository->getOne($id);
    }

    public function create(CreateFornecedorDTO $dto): stdClass
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateFornecedorDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): stdClass|null
    {
        return $this->repository->delete($id);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }


    
}