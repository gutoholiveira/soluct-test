# Soluct - Desafio Backend

Nesse desafio trabalhei no desenvolvimento de uma REST API para utilizar os dados do projeto Open Food Facts, que é um banco de dados aberto com informação nutricional de diversos produtos alimentícios.

## Linguagens utilizadas 
PHP 8.3 com Laravel 11.

# Instalação

1. Clone o repositório
    ```bash
    git clone https://github.com/gutoholiveira/soluct-test.git
    ```

2. Acesse a pasta do projeto
     ```bash
    cd soluct-test
    ```

3. Crie o arquivo `.env` <br>
    Copie `.env.example` para `.env` e configure as variáveis de ambiente.
   ```bash
   cp .env.example .env
   ```

4. Instale as dependencias via composer
    ```bash 
    composer install
    ```

5. Execute os containers da aplicação
    ```bash
    ./vendor/bin/sail up -d
    ```

6. Gere a chave do projeto
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

7. Execute as migrations para criar a estrutura do banco de dados
    ```bash
    ./vendor/bin/sail artisan migrate
    ```

## Executando a aplicação
1. Execute os containers da aplicação
    ```bash
    ./vendor/bin/sail up -d
    ```

## Comandos adicionais
1. Executar testes automatizados
   ```bash
   ./vendor/bin/sail artisan test
   ```

2. Executar schedule para execução da cron
   ```bash
   ./vendor/bin/sail artisan schedule:work
   ```

3. Interromper execução dos containers
   ```bash
   ./vendor/bin/sail down
   ```

3. Gerar a documentação com Swagger
   ```bash
   ./vendor/bin/sail artisan l5-swagger:generate
   ```

## Aplicação disponível na url
[http://localhost:86](http://localhost:86)

## Postman Collection
Solicitar a chave da collection! <br>
[Postman Collection](https://api.postman.com/collections/32843699-a9c8c341-efd5-4e24-a293-aec431b4cf37?access_key=)
   
>  This is a challenge by [Coodesh](https://coodesh.com/)
