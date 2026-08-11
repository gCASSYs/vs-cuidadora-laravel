        <section class="avaliações">
            <div class="wow parallax animate__animated animate__fadeInUp">
                <h3>Veja o que os clientes falam de nós.</h3>
            </div>
            <div class="wow padrao ava-cards animate__animated animate__fadeInUp">


                @foreach ($listaAvaliacao as $lista)
                    @php
                        $estrela = max(
                            0,
                            min(5, (int) $lista->estrela_avaliacao)
                        );
                    @endphp
                    
                    <article>
                        <h5>{{$lista->titulo_avaliacao}}</h5>
                        <img src="{{ asset("vs-cuidadora/assets/$lista->img_avaliacao") }}" alt="Imagem do usuário">                    
                        <p>{{$lista->mensagem_avaliacao}}</p>
                        <div class="estrelas">
                       @for ($i = 0; $i < 5 ; $i++)
                            <img class="{{ $i < $estrela ? 'estrela-ativa' : 'estrela-inativa'}}" src="{{ asset('vs-cuidadora/assets/estrela.png')}}" alt="Estrelas">
                       @endfor
                       
                        </div>
                    </article>
                @endforeach
            
            </div>
        </section>