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


    // Alteração da Gabriele - realiza o login
    public function login(Request $request)
    {
        // Alteração da Gabriele - valida os dados
        $dados = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'Informe sua senha.',
        ]);


        // Alteração da Gabriele - somente usuários ativos podem acessar o painel
        if (Auth::attempt([
            'email' => $dados['email'],
            'password' => $dados['password'],
            'status' => 'ATIVO',
        ], $request->boolean('remember'))) {

            // Alteração da Gabriele - gera uma nova sessão
            $request->session()->regenerate();


            // Alteração da Gabriele - direciona para o painel administrativo
            return redirect()
                ->intended(route('admin.dashboard'));
        }


        // Alteração da Gabriele - mensagem caso o login esteja incorreto
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


        // Alteração da Gabriele - invalida a sessão atual
        $request->session()->invalidate();


        // Alteração da Gabriele - gera um novo token
        $request->session()->regenerateToken();


        // Alteração da Gabriele - volta para a tela de login
        return redirect()
            ->route('login')
            ->with('success', 'Logout realizado com sucesso.');
    }
}