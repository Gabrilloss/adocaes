<?php

function validaCNPJ($cnpj)
{
    // Extrai os números
    $cnpj = preg_replace('/[^0-9]/is', '', $cnpj);

    // Valida tamanho
    if (strlen($cnpj) != 14) {
        return false;
    }

    // Verifica sequência de dígitos repetidos. Ex: 11.111.111/111-11
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
?>