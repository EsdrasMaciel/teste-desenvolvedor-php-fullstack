<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateFornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nome_fantasia' => 'required|min:3',
            'email'=>'required|email|unique:fornecedores',
            'telefone' =>'required|min:11',
            'endereco' => 'required|min:3|',
            'bairro' =>'required|min:3',
            'cidade' =>'required|min:3',
            'estado' => 'required|min:2|max:2',
            'cpf_cnpj' =>['required',
                    'min:11',
                    'unique:fornecedores',
                    New CpfCnpj,
                ],
        ];

        if ($this->method() === 'PUT') {
            $rules['email'] = [
                'required', // 'nullable',
                'min:3',
                'max:255',
                Rule::unique('fornecedores')->ignore($this->id ?? $this->id),
            ];
            $rules['cpf_cnpj'] = [
                'required', // 'nullable',
                'min:11',
                New CpfCnpj,
                Rule::unique('fornecedores')->ignore($this->id ?? $this->id),
            ];
        }
        
        return $rules;
    }
}
