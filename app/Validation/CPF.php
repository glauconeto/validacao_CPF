<?php

namespace App\Validation;

class CPF
{
    /**
     * Método responsável por verificar se um CPF é realmente válido
     * @param string $cpf
     * @return bool
     */
    public static function validar($cpf)
    {
        // Obtém somente os números
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        $cpfValidacao = substr($cpf, 0, 9);
        $cpfValidacao .= self::calcularDigitoVerificador($cpfValidacao);
        $cpfValidacao .= self::calcularDigitoVerificador($cpfValidacao);

        // Compara o CPF calculado com o CPF ENVIADO
        return $cpfValidacao == $cpf;
    }

    /**
     * Método responsável por calcular o dígito verificador com base em uma sequência numérica
     * @param string $base
     * @return string
     */
    public static function calcularDigitoVerificador($base)
    {
        // Auxiliares
        $tamanho = strlen($base);
        $multiplicador = $tamanho + 1;

        $soma = 0;

        // Itera os números do CPF
        for ($i = 0; $i < $tamanho; $i++) {
            $soma += $base[$i] * $multiplicador;
            $multiplicador--;
        }

        $resto = $soma % 11;

        return $resto > 1 ? 11 - $resto : 0;
    }
}