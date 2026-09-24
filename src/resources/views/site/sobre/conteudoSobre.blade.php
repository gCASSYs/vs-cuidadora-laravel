        <section class="padrao sobre">
            <!-- Alteração da Gabriele: conteúdo da página Sobre adaptado para contar a história da Vânia mantendo a estrutura original -->
            <div class="cuidadora">
                <div class="retrato-cuidadora">
                    <img src="{{ asset('vs-cuidadora/assets/' . $Sobre->img1_sobre) }}" alt="{{ $Sobre->titulo_sobre }}">
                </div>

                <div class="info-cuidadora">
                    <h2>{{ $Sobre->titulo_sobre }}</h2>
                    <h3>{{ $Sobre->subtitulo_sobre }}</h3>

                    <p>
                        {{ $Sobre->paragrafo1_sobre }}
                    </p>

                    <p>
                        {{ $Sobre->paragrafo2_sobre }}
                    </p>

                    <p>
                        {{ $Sobre->paragrafo3_sobre }}
                    </p>
                </div>
            </div>

            <div class="experiencias">
                <div class="info-exp">
                    <!-- Alteração da Gabriele: texto de experiência ajustado para aproximar a Vânia das famílias que procuram cuidado -->
                    <h2>{{ $Sobre->titulo_secundario_sobre }}</h2>

                    <p>
                        {{ $Sobre->paragrafo1_secundario_sobre }}
                    </p>

                    <p>
                        {{ $Sobre->paragrafo2_secundario_sobre }}
                    </p>

                    <p>
                        {{ $Sobre->paragrafo3_secundario_sobre }}
                    </p>
                </div>

                <div class="imagem-exp">
                    <img src="{{ asset('vs-cuidadora/assets/' . $Sobre->img2_sobre)}}" alt="{{ $Sobre->titulo_secundario_sobre }}">
                </div>
            </div>
            
            <hr>

          <section class="padrao diferencial">
            <div class="dif-titulo">
                <h3>Por que escolher a Vânia?</h3>
                <h2>Cuidar bem é oferecer presença, atenção e respeito em cada detalhe.</h2>
            </div>
            <div class="wow dif-cards animate__animated animate__fadeInUp">
                @foreach ($listaDiferencial as $lista)
                <article>
                    <h5>{{$lista->titulo_diferencial}}</h5>
                    <img src="{{ asset("vs-cuidadora/$lista->icone_diferencial") }}" alt="{{$lista->titulo_diferencial}}">
                    <p>{{$lista->texto_diferencial}}</p>
                </article>
                
                @endforeach
            </div>
        </section>
            <hr>

            <div class="cta-sobre">
                <div class="competencias">
                    <!-- Alteração da Gabriele: bloco final transformado em diferenciais do cuidado da Vânia, mantendo a estrutura original -->
                    <h2>{{ $SobrePainel->titulo_sobre_painel }}</h2>
                    <h3>{{ $SobrePainel->subtitulo_sobre_painel }}</h3>

                    <ul>
                        <li>
                            <p>
                                {{ $SobrePainel->primeiro_ponto_sobre_painel }}
                            </p>
                        </li>

                        <li>
                            <p>
                                {{ $SobrePainel->segundo_ponto_sobre_painel }}

                            </p>
                        </li>

                        <li>
                            <p>
                                {{ $SobrePainel->terceiro_ponto_sobre_painel }}

                            </p>
                        </li>
                    </ul>
                </div>
                
                <div class="fale-conosco">
                    <!-- Alteração da Gabriele: chamada final ajustada para incentivar contato sem parecer venda agressiva -->
                    <h3>Quer entender se o atendimento da Vânia combina com a necessidade da sua família?</h3>
                    <a href="{{ route('home') }}#form-contat">
                        Entre em contato
                    </a>
                </div>
            </div>
        </section>

        <a href="#" target="_blank" class="btn-whatsapp"><img src="{{ asset('vs-cuidadora/assets/whatsapp-24.png')}}" alt="Botão Flutuante Whatsapp"></a>