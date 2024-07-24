<?php

namespace App\Http\Controllers;

use App\DTO\CreateFornecedorDTO;
use App\DTO\UpdateFornecedorDTO;
use App\Http\Requests\StoreUpdateFornecedorRequest;
use App\Http\Resources\FornecedorResource;
use App\Services\FornecedorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FornecedorController extends Controller
{
    public function __construct(protected FornecedorService $service) {}


    public function create(StoreUpdateFornecedorRequest $request) {

        $fornecedor = $this->service->create(
                CreateFornecedorDTO::createFromRequest($request)
            );
    
            return (new FornecedorResource($fornecedor))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        
    }

    public function update(StoreUpdateFornecedorRequest $request, $id){
        $fornecedor = $this->service->update(
            UpdateFornecedorDTO::updateFromRequest($request, $id)
        );

        if (!$fornecedor) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new FornecedorResource($fornecedor);
    }

    public function delete(Request $request, $id) {
        $fornecedor = $this->service->delete($id);
        if ($fornecedor) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => 'Deletado'
        ], Response::HTTP_OK);
    }

    public function getOne(Request $request, $id) {
        if (!$fornecedor = $this->service->getOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new FornecedorResource($fornecedor);
    }

    public function getAll(Request $request){
        return $this->service->getAll();
        return;
    }

    public function list(Request $request) {
        return;
    }
}
