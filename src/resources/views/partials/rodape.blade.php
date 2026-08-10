<footer class="rodapé">
    <div class="padrao rodape-grid">
        <div class="left">
            <!-- Alteração da Gabriele: texto do rodapé adaptado para apresentar a Vânia de forma breve e profissional -->
            <h2>Sobre a Vânia</h2>

            <p>
                Vânia Silva atua como cuidadora de idosos, oferecendo companhia,
                atenção e apoio na rotina para famílias que buscam um cuidado
                mais humano, próximo e responsável.
            </p>
            
            <a href="{{ route('home') }}#form-contat">Fale com a Vânia</a>
        </div>

        <div class="center">
            <!-- Alteração da Gabriele: logo da Vânia ajustada no rodapé mantendo a estrutura original -->
            <img src="{{ asset ('vs-cuidadora/assets/logo_inteira.svg') }}" alt="Logo Vânia Silva Cuidadora de Idosos">

            <div class="telefone">
                <p>(11) 94998-7779</p>
            </div>

            <ul class="redes-sociais">
                <!-- Alteração da Gabriele: redes sociais ajustadas para Vânia Silva com segurança em links externos -->
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
        </div>

        <div class="right">
            <!-- Alteração da Gabriele: ajuste do bloco de atendimento para deixar a informação mais clara e profissional -->
            <h2>Atendimento</h2>

            <div class="atendimento-info">
                <div>
                    <span>Formato</span>
                    <p>Atendimento em domicílio, hospital ou instituição.</p>
                </div>

                <div>
                    <span>Região</span>
                    <p>São Paulo - Capital e Grande São Paulo.</p>
                </div>

                <div>
                    <span>Horários</span>
                    <p>Conforme combinação e disponibilidade.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="barra-final">
        <!-- Alteração da Gabriele: crédito atualizado para SintoniaWeb -->
        <p>© 2026 - Criado e desenvolvido por SintoniaWeb</p>
    </div>
</footer>

