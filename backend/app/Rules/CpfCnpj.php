<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class CpfCnpj implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = self::extractNumber($value);
        if ($value=="") {
            $fail('O :attribute precisa ser valido.');
            return;
        }
        if(!$this->isCpfOrCnpj($value)){
            $fail('O :attribute precisa ser valido.');
            return;
        }
        if (strlen($value) === 11) {
            return;
        }
        if ($this->cnpjExist($value)) {
            $fail('O :attribute precisa está ativo.');
        }
    }

    public function cnpjExist($value) {
        $value = self::extractNumber($value);
        $response = Http::get('https://brasilapi.com.br/api/cnpj/v1/'.$value);
        if ($response->failed()) {
           return false;
        }

        $response = $response->json();
        
        if ($response['situacao_cadastral']!=='2') {
            return false;
        }
        
    }

    public static function isCpfOrCnpj(string $value): bool {
        $value = self::extractNumber($value);

        if ($value=="") {
            return false;
        }
        if (strlen($value) === 11) {
            return static::is_cpf($value);
        }

        if (strlen($value) === 14) {
            return static::is_cnpj($value);
        }

        return false;
    }

    public static function is_cnpj(string $document): bool {
        // Extrai os números
        $cnpj = self::extractNumber($document);

        // Valida tamanho
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica sequência de digitos repetidos. Ex: 11.111.111/111-11
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
        }

        // Valida dígitos verificadores
        for ($t = 12; $t < 14; $t++) {
        for ($d = 0, $m = ($t - 7), $i = 0; $i < $t; $i++) {
            $d += $cnpj[$i] * $m;
            $m = ($m == 2 ? 9 : --$m);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cnpj[$i] != $d) {
            return false;
        }
        }

        return true;
    }
    public static function is_cpf(string $cpf): bool {
        // Extrai somente os números
        $cpf = self::extractNumber($cpf);
    
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
          return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
          return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
          for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
          }
          $d = ((10 * $d) % 11) % 10;
          if ($cpf[$c] != $d) {
            return false;
          }
        }
    
        return true;
      }

      public static function  extractNumber(string $value) {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
