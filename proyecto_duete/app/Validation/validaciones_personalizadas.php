<?php

namespace App\Validation;

class validaciones_personalizadas{

    public function alpha_numeric_space_tilde(string $str, string &$error = null): bool{
        // Verifica que el string contiene solo caracteres alfanuméricos, espacios y acentos
        if (preg_match('/^[\p{L}0-9\s]+$/u', $str)) {
            return true;
        }

        $error = 'Este campo solo puede contener letras, números y espacios.';
        return false;
    }
}
