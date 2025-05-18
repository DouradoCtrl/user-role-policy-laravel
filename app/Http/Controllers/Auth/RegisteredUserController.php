<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {   
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'string', 'in:Administrador,Estoque,Atendente'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            event(new Registered($user));

            // Verificar a origem da requisição (via modal ou rota padrão)
            // Se a requisição vier do painel de gerenciamento, redirecionamos para lá
            if ($request->has('from_admin_panel') || $request->headers->get('referer') && str_contains($request->headers->get('referer'), 'users-management')) {
                return redirect()->route('users-management')->with('success', 'Usuário criado com sucesso!');
            }

            // Se for registro normal, então fazemos login e redirect para dashboard
            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Se a requisição vier do painel admin, redirecionamos com os erros para o bag específico do modal
            if ($request->has('from_admin_panel')) {
                return redirect()
                    ->back()
                    ->withInput($request->all())
                    ->withErrors($e->errors(), 'userCreate');
            }
            
            // Se for um registro normal, repassamos a exceção
            throw $e;
        }
    }
}
