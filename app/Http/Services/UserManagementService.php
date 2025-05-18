<?php
namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserManagementService
{
    /**
     * Valida a senha do usuário autenticado e exclui o usuário especificado
     * 
     * @param int 
     * @param string 
     * @return bool 
     * @throws \Exception 
     */

    public function validatePasswordAndDeleteUser($idUsuario, $password)
    {
        // Verificar se a senha corresponde à senha do usuário logado
        $usuario = Auth::user();
        if (!Hash::check($password, $usuario->password)) {
            throw new \Exception('A senha fornecida está incorreta.');
        }

        // Verificar se o ID do usuário está presente
        if (!$idUsuario) {
            throw new \Exception('ID do usuário não encontrado.');
        }

        // Buscar e excluir o usuário
        $excluirUsuario = User::findOrFail($idUsuario);
        $excluirUsuario->delete();

        return true;
    }
}