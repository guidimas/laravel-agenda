# Agenda

Agenda eletrônica desenvolvida utilizando o framework PHP [Laravel](https://laravel.com/), HTML, CSS e uma pitada de JS.

## Primeiros Passos

Siga as instruções a seguir para informações sobre download, configuração e teste da aplicação em um ambiente local.

### Pré-requisitos

* Disposição para fazer o clone!

* [Composer](https://getcomposer.org/) instalado.

* Um servidor local, com PHP na versão 7.1.3 ou superior.

* Banco de dados¹ acessível.

* Um navegador! (com JS habilitado) :P

*¹ A versão do Laravel utilizada no projeto (5.6), suporta os seguintes bancos de dados: MySQL, PostgreSQL, SQLite e SQL Server. [Clique aqui para mais detalhes e configuração.](https://laravel.com/docs/5.6/database)*

### Instalação

Inicie um terminal (CMD, prompt de comando) na pasta do projeto e execute o seguinte comando: `composer install`

### Configuração

Renomeie o arquivo *.env.example* para apenas *.env*

Altere o conteúdo deste arquivo, atualizando as informações de conexão, conforme exemplo:

    ...
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=NOME_DO_BANCO
    DB_USERNAME=USUARIO_DO_BANCO
    DB_PASSWORD=SENHA_DO_BANCO
    ...

Crie o banco de dados definido no endereço acima.

Com o SGBD no ar, pelo terminal, na pasta do projeto:

* Execute `php artisan key:generate` para dicionar uma hash de segurança no arquivo *.env*

* Execute  `php artisan migrate` para efetivar as migrações (cria as tabelas no banco)

## Iniciar a aplicação

Para iniciar a aplicação, execute o comando `php artisan serve` pelo terminal, na pasa do projeto.

A aplicação estará disponível no endereço indicado (por padrão, o endereço 
[http://127.0.0.1:8000](http://127.0.0.1:8000) é utilizado).

## Autor

**Guilherme Dimas** - *Desenvolvimento* - [GuiDimas](https://github.com/GuiDimas)

## Notas

Projeto desenvolvido como forma de estudo e utilização do framework PHP [Laravel](https://laravel.com/), em Aplicações Web.