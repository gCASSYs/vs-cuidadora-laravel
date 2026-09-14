        <section class="serviços">
            <div class="wow parallax animate__animated animate__fadeInUp">
                <h3>Cuidado completo para cada necessidade.</h3>
            </div>
            <div class="wow padrao ser-cards animate__animated animate__fadeInUp">
                


                @foreach ($listaTopico as $lista)

                    <article id="servico">
                        <div>
                            <img src="{{ asset("vs-cuidadora/assets/$lista->icone_servico") }}" alt="{{$lista->titulo_servico}}">
                            <h5>{{$lista->titulo_servico}}</h5>
                        </div>
                        <p>{{$lista->texto_servico}}</p>
                                                                 
                
                        <a href="{{ route('servico.categoria', $lista->id_servico_ancora) }}">Saiba Mais</a>       
                                   
                    </article>
                @endforeach
            </div>
        </section>
