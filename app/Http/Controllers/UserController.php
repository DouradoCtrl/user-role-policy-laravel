<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UserManagementService;
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
}
