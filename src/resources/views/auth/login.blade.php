<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | Vânia Silva - Cuidadora de Idosos</title>

    {{-- Alteração da Gabriele - fontes utilizadas no projeto VS Cuidadora --}}
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Fresca&family=Rubik:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    {{-- Alteração da Gabriele - Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    {{-- Alteração da Gabriele - CSS administrativo da VS Cuidadora --}}
    <link
        rel="stylesheet"
        href="{{ asset('admin/css/style.css') }}"
    >
</head>


<body class="vs-login-body">

    <main class="vs-login-container">

        <section class="vs-login-box">


            {{-- Alteração da Gabriele - logo da VS Cuidadora --}}
            <div class="vs-login-logo">

                <img
                    src="{{ asset('vs-cuidadora/assets/logo/logo_login.svg') }}"
                    alt="Vânia Silva - Cuidadora de Idosos"
                >

            </div>


            {{-- Alteração da Gabriele - identificação da área restrita --}}
            <div class="vs-login-header">

                <h1>Área Restrita</h1>

                <p>
                    Acesso ao painel administrativo
                </p>

            </div>



            {{-- Alteração da Gabriele - mensagem exibida após logout --}}
            @if (session('success'))

                <div class="vs-login-alert vs-login-success">

                    <i class="bi bi-check-circle me-1"></i>

                    {{ session('success') }}

                </div>

            @endif



            {{-- Alteração da Gabriele - mensagens de erro --}}
            @if ($errors->any())

                <div class="vs-login-alert vs-login-error">

                    <i class="bi bi-exclamation-circle me-1"></i>

                    {{ $errors->first() }}

                </div>

            @endif



            {{-- Alteração da Gabriele - formulário de autenticação --}}
            <form
                action="{{ route('login.auth') }}"
                method="POST"
            >

                @csrf


                <div class="vs-login-group">

                    <label for="email">
                        E-mail
                    </label>

                    <div class="vs-login-input">

                        <i
                            class="bi bi-envelope"
                            aria-hidden="true"
                        ></i>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="Digite seu e-mail"
                            required
                            autofocus
                        >

                    </div>

                </div>



                <div class="vs-login-group">

                    <label for="password">
                        Senha
                    </label>

                    <div class="vs-login-input">

                        <i
                            class="bi bi-lock"
                            aria-hidden="true"
                        ></i>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Digite sua senha"
                            required
                        >

                    </div>

                </div>



                {{-- Alteração da Gabriele - opção lembrar usuário --}}
                <div class="vs-login-options">

                    <label>

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        Manter conectado

                    </label>

                </div>



                <button
                    type="submit"
                    class="vs-login-button"
                >

                    <i class="bi bi-box-arrow-in-right me-1"></i>

                    Entrar

                </button>

            </form>



            {{-- Alteração da Gabriele - rodapé da tela de login --}}
            <div class="vs-login-footer">

                <p>
                    Vânia Silva
                </p>

                <small>
                    Cuidadora de Idosos
                </small>

            </div>


        </section>

    </main>

</body>

</html>