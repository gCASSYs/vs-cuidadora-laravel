PASSO-A-PASSO DE INSTALAÇÃO DO PROJETO-CLIENTE

AGÊNCIA:
•	SintoniaWeb
INTEGRANTES
•	Ana Caroline
•	André Coelho
•	Anthony Reis
•	Gabriele Cassiano
REPOSITÓRIO:
	https://github.com/gCASSYs/vs-cuidadora-laravel - CLIENTE
	https://github.com/tonyreiz/sintonia - AGÊNCIA
BRANCH PRINCIPAL:
	Main
BANCO DE DADOS:
	db_vs_cuidadora.sql
APRESENTAÇÃO DA AGÊNCIA/CLIENTE:
	https://prezi.com/p/mguzr3rawpyh/?present=1
VÂNIA CUIDADORA
Vânia Cuidadora foi o principal projeto back-end trabalhado pela SINTONIA WEB, desenvolvido com Laravel, Docker, Nginx e MYSQL. O site e sistema foram criados para a Vânia, uma cuidadora de idosos que desejava um site para facilitar suas operações.




OBSERVAÇÕES:
 
•	O FRONT-END do site está completo e estruturado como planejamos, mas se sintam livres para modificarem ele caso tenham interesse.
•	Todas as tabelas simples de listagem estão funcionando no BACK-END.
•	O CRUD da página Sobre não foi feito, apenas o R.
•	Há algumas funcionalidades que fazia parte da regra de negócio e a SintoniaWeb implementaria na área administrativa, mas os docentes recomendaram implementar na próxima UC (especificamente o Chat): 
  o	Chat de conversa conectando CLIENTE e CUIDADORA
  o	Os relatórios criados pela Vânia devem chegar a tela do cliente, mas este não deve ter permissão de editá-lo, apenas visualizar e marcar um check de visualização. O cliente também poderia criar um chat de conversa 
  sobre este relatório
•	CLIENTE, IDOSO, AGENDAMENTO e DEPOIMENTOS estão propositalmente sem a função de criar registros pela tabela administrativa. MOTIVO: O cliente seria criado pelo mesmo no login, e o idoso seria cadastrado pelo cliente. 
O agendamento é criado pelo cliente na sua tela de agendamento, e a Vânia poderá aceitar ou não. Depoimentos também devem ser criados apenas pelo cliente quando quiser registrar uma avaliação.


1. Estrutura do projeto
vs-cuidadora
├── docker
│   └── nginx
│       └── default.conf
├── src
│   ├── app
│   ├── database
│   ├── public
│   ├── resources
│   ├── routes
│   ├── storage
│   └── composer.json
├── Dockerfile
└── docker-compose.yml

•	docker/: configurações da infraestrutura.
•	src/: aplicação Laravel.
•	docker-compose.yml: organiza os containers.
•	Dockerfile: prepara o ambiente PHP da aplicação.

2. Tecnologias utilizadas
•	Git
•	Docker
•	Docker Compose
•	Nginx
•	PHP
•	Laravel
•	MySQL
•	phpMyAdmin, quando configurado no docker-compose.yml

3. Baixar o projeto no GitHub
4. 
Escolha uma pasta dentro do Ubuntu para guardar o projeto:
cd ~/dev/senac/tipi06

Clone o repositório:
	git clone https://github.com/gCASSYs/vs-cuidadora-laravel.git
  
Entre na pasta:
	cd vs-cuidadora-laravel
  
Confira os arquivos:
	Ls
  
Devem aparecer, entre outros:
docker
src
Dockerfile
docker-compose.yml

6. Criar o arquivo .env
O Laravel usa o arquivo src/.env para guardar as configurações da aplicação e do banco. Este arquivo é ocultado pelo GITIGNORE por razões de segurança e mantido de fora do repositório no github, então é fundamental criá-lo
no projeto.

crie uma cópia do exemplo:
	cp src/.env.example src/.env
  
Abra o arquivo no VS Code:
	code  
  
Confira principalmente:
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_vs_cuidadora
DB_USERNAME=laravel
DB_PASSWORD=laravel

5. Construir e iniciar os containers

Na raiz do projeto, execute:
  docker compose up -d --build

Depois confira o estado dos serviços:
  docker compose ps

Os serviços principais devem aparecer como iniciados, por exemplo:
vs-cuidadora-app
vs-cuidadora-nginx
vs-cuidadora-mysql 
vs-cuidadora-phpmyadmin

7. Instalar as dependências do Laravel
Execute:
	docker compose exec app composer install

Depois gere a chave da aplicação:
  docker compose exec app php artisan key:generate

Limpe as configurações antigas:
  docker compose exec app php artisan config:clear

8. Corrigir permissões
Execute:

  sudo chown -R $USER:$USER .
  
  chmod -R 775 src/storage
  
  chmod -R 775 src/bootstrap/cache

Depois reinicie os containers:
  docker compose restart

9. Importar o banco
Acesse o serviço do phpMyAdmin:
	http://localhost:8081

Dados de acesso do banco:
Usuário: laravel
Senha: laravel

Apague as tabelas existentes no banco vazio, depois clique em IMPORTAR no menu superior, e por fim, ESCOLHER ARQUIVO e selecione este:
	db_vs_cuidadora.sql

11. Acessar o projeto

Aplicação Laravel
No navegador da sua escolha:
http://localhost:8000

phpMyAdmin
Quando o serviço estiver configurado no docker-compose.yml:
http://localhost:8081

Dados de acesso do banco:
Usuário: laravel
Senha: laravel
