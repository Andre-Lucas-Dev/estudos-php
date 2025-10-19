<?php

namespace App\Rules;

use App\Constants\Geral;

class UsuarioRule
{
    public function isProprietario()
    {
        $isProprietario = auth()->user()->tipo->tipo == 'Proprietário';

        if($isProprietario == false){
            $this->failedAuthorization();
        }

        return $isProprietario;
    }

    public function isAdmin()
    {
        $isAdmin = auth()->user()->tipo->tipo == 'Admin';

        if($isAdmin == false){
            $this->failedAuthorization();
        }

        return $isAdmin;
    }

    private function failedAuthorization()
    {
        $message = Geral::USUARIO_SEM_PERMISSAO;
        abort(403, $message);
    }
}