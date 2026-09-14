
<header class="topo" id="topo-fixo">
    <div class="padrao">
        <!-- Alteração da Gabriele: adaptação do nome do projeto para Vânia Silva sem alterar a classe ou estrutura do topo -->
        <h1 class="marca">
            <a href="index.php" aria-label="Ir para a página inicial">
                <img src="{{ asset ('vs-cuidadora/assets/Logo Vânia Silva.png') }}" alt="Vânia Silva - Cuidadora de Idosos">
            </a>
        </h1>

        <button class="abrir-menu" aria-label="Abrir menu"></button>

        <nav class="menu">
            <button class="fechar-menu" aria-label="Fechar menu"></button>



            <ul>
                <!-- Alteração da Gabriele: ajuste dos nomes do menu para combinar com o site da Vânia, mantendo classes e estrutura -->
                <li>
                    <a class=" {{ Request()->routeIs('home') ? 'botao-ativo' : '' }}" href="{{ route ('home') }}">Início</a>
                </li>

                <li>
                    <a class=" {{ Request()->routeIs('sobre') ? 'botao-ativo' : '' }}" href="{{ route ('sobre') }}">Sobre</a>
                </li>

                <li class="dropdown">
                    <a class="servicos {{ Request()->routeIs('servico') ? 'botao-ativo' : '' }}" href="{{ route('servico') }}">
                        Serviços
                        <!-- Alteração da Gabriele: ajuste do ícone do submenu para abrir visualmente para baixo -->
                        <i class="fa-solid fa-caret-down"></i>
                    </a>

                    <!-- Alteração da Gabriele: submenu ajustado para apontar para as páginas individuais dos serviços -->
                    <ul class="submenu">

                        @foreach ($categoriaServico as $lista)
                        <li><a href="{{ route('servico.categoria', $lista->id_servico_ancora) }}">{{$lista->titulo_servico_ancora}}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="{{ route('home')}}#form-contat">Contato</a>
                </li>
            </ul>

            <ul class="redes-sociais">
                <!-- Alteração da Gabriele: atualização dos textos alternativos para Vânia Silva, mantendo os ícones existentes -->
                <li>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook da Vânia Silva">
                        <img src="{{ asset ('vs-cuidadora/assets/facebook-24.png') }}" alt="Facebook - Vânia Silva">
                    </a>
                </li>

                <li>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram da Vânia Silva">
                        <img src="{{ asset ('vs-cuidadora/assets/instagram-24.png') }}" alt="Instagram - Vânia Silva">
                    </a>
                </li>

                <li>
                    <a href="https://wa.me/5511999999999?text=Ol%C3%A1%2C%20V%C3%A2nia%21%20Vi%20seu%20site%20e%20gostaria%20de%20saber%20mais%20sobre%20o%20atendimento%20para%20idosos." target="_blank" rel="noopener noreferrer" aria-label="WhatsApp da Vânia Silva">
                        <img src="{{ asset ('vs-cuidadora/assets/whatsapp-24.png') }}" alt="WhatsApp - Vânia Silva">
                    </a>
                </li>
            </ul>

            <div class="contato">
                <!-- Alteração da Gabriele: correção do botão de contato para apontar para o formulário existente -->
                <a href="{{ route('home') }}#form-contat">Fale conosco</a>
            </div>
        </nav>
    </div>
</header>

