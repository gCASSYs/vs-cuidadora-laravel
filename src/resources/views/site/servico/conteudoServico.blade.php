<?php

?>
<section class="padrao servico-detalhe">
    <div class="servico-hero">
        @php
            $listo = $servicoSelecionado->FuncionalServico;
            $listar = $servicoSelecionado->IncluirServico;
            $linha = $servicoSelecionado->CuidadoServico;
        @endphp

        <div class="servico-cabecalho">
            <span class="servico-etiqueta">Serviço</span>
            <h1>{{ $servicoSelecionado->titulo_servico_ancora }}</h1>
            <p class="servico-subtitulo">{{ $servicoSelecionado->subtitulo_servico_ancora }}</p>
            <p class="servico-intro">{{ $servicoSelecionado->texto_servico_ancora }}</p>
        </div>

        <div class="servico-imagem">
            <img src="{{ asset("vs-cuidadora/assets/$servicoSelecionado->img_servico_ancora") }}" alt="{{ $servicoSelecionado->titulo_servico_ancora }}">
        </div>
    </div>

    <div class="servico-conteudo">
        <article class="servico-card servico-card-texto">
            <div class="servico-titulo-linha">
                <img src="{{ asset("vs-cuidadora/assets/$listo->icone_servico_funcionamento") }}" alt="{{ $listo->titulo_servico_funcionamento }}">
                <h2>{{ $listo->titulo_servico_funcionamento }}</h2>
            </div>
            <p>{{ $listo->paragrafo_servico_funcionamento }}</p>
        </article>

        <article class="servico-card servico-card-lista">
            <h2>{{ $listar->titulo_servico_incluir }}</h2>
            <ul>
                <li>{{ $listar->paragrafo1_servico_incluir }}</li>
                <li>{{ $listar->paragrafo2_servico_incluir }}</li>
                <li>{{ $listar->paragrafo3_servico_incluir }}</li>
            </ul>
        </article>
    </div>

    <div class="servico-apoio">
        <article class="servico-card servico-card-lista">
            <h2>{{ $linha->titulo_servico_cuidado }}</h2>
            <ul>
                <li>{{ $linha->paragrafo1_servico_cuidado }}</li>
                <li>{{ $linha->paragrafo2_servico_cuidado }}</li>
                <li>{{ $linha->paragrafo3_servico_cuidado }}</li>
            </ul>
        </article>

        <article class="servico-card servico-card-cta">
            <h2>Quer conversar sobre este serviço?</h2>
            <p></p>
            <a href="index.php#form-contat">Entre em contato</a>
        </article>
    </div>
</section>

<a href="https://wa.me/5511999999999?text=Olá!+Gostaria+de+falar+sobre+o+serviço+" target="_blank" class="btn-whatsapp"><img src="{{ asset('vs-cuidadora/assets/whatsapp-24.png') }}" alt="Botão Flutuante para Whatsapp"></a>
