        <section class="padrao formulario">
            <div class="for-titulo">
                <!-- Alteração da Gabriele: substituição da logo lateral por um bloco informativo mais profissional no formulário -->
                <span class="form-etiqueta">Contato</span>

                <h3>Fale com a Vânia</h3>

                <p>
                    Conte um pouco sobre a necessidade da família e do idoso.
                    Assim, fica mais fácil entender o tipo de acompanhamento ideal,
                    os horários e a disponibilidade para o atendimento.
                </p>

                <div class="form-info">
                    <div>
                        <strong>Atendimento individual</strong>
                        <span>Cuidado direto com a Vânia, de forma próxima e humanizada.</span>
                    </div>

                    <div>
                        <strong>Retorno pelo WhatsApp</strong>
                        <span>Após o envio, o contato pode ser feito para alinhar os detalhes.</span>
                    </div>

                    <div>
                        <strong>Avaliação com calma</strong>
                        <span>Cada caso pode ser analisado conforme rotina, mobilidade e necessidade do idoso.</span>
                    </div>
                </div>
            </div>
            
            <div class="wow for-cards animate__animated animate__fadeInRight" id="form-contat">
                <h5>Vamos começar com calma.<br>Como podemos lhe ajudar?</h5>
                
                
                <form action="#" method="post">
                    <div class="for-campos">
                        <img src="{{ asset('vs-cuidadora/assets/foto-de-perfil-verde.png') }}" alt="Ícone para nome">
                        <input type="text" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="for-campos">
                        <img src="{{ asset('vs-cuidadora/assets/telefone.png') }}" alt="Ícone para telefone">
                        <input type="tel" name="tele" placeholder="Telefone" required>
                    </div>
                    <div class="for-campos">
                        <img src="{{ asset('vs-cuidadora/assets/email.png') }}" alt="Ícone para email">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="for-assunto">
                        <textarea name="mens" cols="30" rows="10" placeholder="Insira sua dúvida aqui!" required></textarea>
                    </div>
                    <button class="btn-for">Enviar</button>
                </form>
            </div>
        </section>

          <a href="#" target="_blank" class="btn-whatsapp"><img src="{{ asset('vs-cuidadora/assets/whatsapp-24.png')}}" alt="Botão Flutuante Whatsapp"></a>
