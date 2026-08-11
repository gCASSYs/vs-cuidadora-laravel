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