<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Alteração da Gabriele - exibe a tela de login
    public function index()
    {
        return view('auth.login');
    }


    // Alteração da Gabriele - realiza o login da Vânia
    public function login(Request $request)
    {
        $dados = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'Informe sua senha.',
        ]);


        // Alteração da Gabriele - autentica usando tbl_login_vania
        if (Auth::attempt([
            'email_login_vania' => $dados['email'],
            'password' => $dados['password'],
            'status_login_vania' => 'ATIVO',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();


            return redirect()
                ->intended(route('admin.dashboard'));
        }


        return back()
            ->withErrors([
                'email' => 'E-mail ou senha incorretos.',
            ])
            ->onlyInput('email');
    }


    // Alteração da Gabriele - encerra a sessão
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()
            ->route('login')
            ->with('success', 'Logout realizado com sucesso.');
    }
}