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
     * @param array 
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
    
    
    public function validatePasswordAndUpdateUser($userId, $password, array $data)
    {
        // Verificar se a senha corresponde à senha do usuário logado
        $usuario = Auth::user();
        if (!Hash::check($password, $usuario->password)) {
            throw new \Exception('A senha fornecida está incorreta.');
        }

        // Verificar se o ID do usuário está presente
        if (!$userId) {
            throw new \Exception('ID do usuário não encontrado.');
        }

        // Log para debug
        Log::info('Tentando atualizar usuário', [
            'user_id' => $userId,
            'data' => $data
        ]);

        // Buscar e atualizar o usuário
        $userToUpdate = User::findOrFail($userId);
        
        // Log para debug antes de atualizar
        Log::info('Usuário antes da atualização', [
            'id' => $userToUpdate->id,
            'name' => $userToUpdate->name,
            'email' => $userToUpdate->email,
            'role' => $userToUpdate->role
        ]);
        
        // Tentar primeiro com o método update
        $updated = $userToUpdate->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role']
        ]);
        
        // Se a atualização falhar, tente atribuir diretamente
        if (!$updated) {
            $userToUpdate->name = $data['name'];
            $userToUpdate->email = $data['email'];
            $userToUpdate->role = $data['role'];
            $userToUpdate->save();
        }
        
        // Recarregar o modelo para ter certeza que está atualizado
        $userToUpdate = User::findOrFail($userId);
        
        // Log para debug após atualizar
        Log::info('Resultado da atualização', [
            'success' => $updated,
            'user_após' => [
                'id' => $userToUpdate->id,
                'name' => $userToUpdate->name,
                'email' => $userToUpdate->email,
                'role' => $userToUpdate->role
            ]
        ]);

        return true;
    }
}