<p align="center"><img src="https://cdn.essentialnutrition.com.br/wysiwyg/ktmcore/ktmvelo/logo/ho.svg" width="200"></p>

<p align="center">
Essential Pharma
</p>

# Código Teste

Sistema CRUD feito com Laravel, Html5, CSS.

Ps: Melhor não rodar dentro de Xampp ou Lampp. basta seguir este arquivo.

Funciona com servidor próprio do laravel(php artisan serve).



## Começando

Clone o repositório do projeto:

opção 1: 
Caso você use HTTPS:

git clone https://github.com/dompossebon/cadastro-funcionario.git

opção 2:
Caso você use SSH:

git clone git@github.com:dompossebon/cadastro-funcionario.git

---------------------------------------------------------

Após a clonagem, entre no diretório da aplicação: 

cd cadastro-funcionario

em seguida execute o comandos abaixo:

composer install
Caso aconteça erro de permissão, lembre-se de executar: (sudo chown -R $USER .) dentro do diretorio /bussolasocial
e então repita o comando (composer install)

Na raiz do projeto localize e Duplique o arquivo .env.example e em seguida renomeie-o para .env usando o comando:

cp .env.example .env

O Trecho de Código dentro do arquivo .env foi deixado para facilitar testes(Por Segurança não deve ficar aqui)

---------------------------------------------------------


Crie Dois banco de Dados

script de criação do banco 

CREATE SCHEMA `dbEssentialPharma` DEFAULT CHARACTER SET utf8 ;

CREATE SCHEMA `dbEssentialPharma_test` DEFAULT CHARACTER SET utf8 ;


1- para produção = dbEssentialPharma

2- para testes = dbEssentialPharma_test

IMPORTANTE --- verifique a senha para acesso ao banco = DB_PASSWORD=@@123456

DB_DATABASE=dbEssentialPharma

DB_USERNAME=root

DB_PASSWORD=@@123456

Para que assim o sistema conecte-se ao seu banco e possa criar as devidas tabelas

após ter alterado e estiver testado a sua conexão execute o comando para criar as tabelas

- php artisan migrate:fresh --seed ///este comando vai popular o sistema para utilizar

ja temos dois usuarios com a mesma senha para entrar no Sistema

login = dompossebon@gmail.com

login = angela@gmail.com

senha = 88888888

---------------------------------------------------------


Então rode o comando:

- php artisan key:generate

Agora vamos criar um link simbolico para a Leitura das Imagens(IMPORTANTE)

- php artisan storage:link


e em seguida

- php artisan serve

Agora basta

visite http: // http://127.0.0.1:8000/ para ver o aplicativo em ação.


---------------------------------------------------------

Para Rodar Testes rode este comando


## vendor/bin/phpunit


---------------------------------------------------------


## Construído com
Laravel - O framework PHP para artesãos da Web


## by Possebon 
## Contato dompossebon@gmail.com

:+1: ## By Possebon






