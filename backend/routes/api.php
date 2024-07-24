<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;

Route::post('/fornecedor/create', [FornecedorController::class, 'create'])->name('fornecedor.create');
Route::get('/fornecedor/{id}',[FornecedorController::class, 'getOne'])->name('fornecedor.getOne');
Route::get('/fornecedor',[FornecedorController::class, 'getAll'])->name('fornecedor.getAll');

Route::put('/fornecedor/update/{id}', [FornecedorController::class, 'update'])->name('fornecedor.update');
Route::delete('/fornecedor/delete/{id}', [FornecedorController::class, 'delete'])->name('fornecedor.delete');
