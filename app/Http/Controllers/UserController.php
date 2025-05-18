<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UserManagementService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userManagementService;

    public function __construct(UserManagementService $userManagementService)
    {
        $this->userManagementService = $userManagementService;
    }

    public function index() {
        $users = User::paginate(3); // Paginate users, 3 per page
        return view('user-management.index', compact('users'));
    }

    public function destroy(Request $request) {
        // Validar se a senha está correta e se temos um ID
        $validated = $request->validate([
            'password' => 'required',
            'user_id' => 'required|exists:users,id', // Validar se o user_id existe na tabela users
        ]);

        try {
            // Usar o serviço para aplicar a regra de negócio
            $this->userManagementService->validatePasswordAndDeleteUser(
                $request->user_id,
                $request->password
            );
            
            return redirect()->route('users-management')->with('success', 'Usuário excluído com sucesso');
            
        } catch (\Exception $e) {
            // Lidar com os erros lançados pelo serviço
            return back()->withInput(['user_id' => $request->user_id])
                ->withErrors(['password' => $e->getMessage()], 'userDeletion');
        }
    }
    
    public function update(Request $request) {
        // Validar os dados
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user_id,
            'role' => 'required|string|in:Administrador,Estoque,Atendente',
            'password' => 'required', // Senha do usuário logado para confirmação
        ]);
        
        // Log para debug
        Log::info('Dados recebidos no controller', [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);
        
        try {
            // Usar o serviço para aplicar a regra de negócio
            $this->userManagementService->validatePasswordAndUpdateUser(
                $request->user_id,
                $request->password,
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                ]
            );
            
            return redirect()->route('users-management')->with('success', 'Usuário atualizado com sucesso');
            
        } catch (\Exception $e) {
            // Lidar com os erros lançados pelo serviço
            return back()->withInput([
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role
                ])
                ->withErrors(['password' => $e->getMessage()], 'userEdit');
        }
    }
}
