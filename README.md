# Pessoas Api

Projeto realizado em php com o framework laravel. <br>
Banco de dados escolhido foi o mongodb, e está hospedado em um [cluster do Atlas](https://www.mongodb.com/atlas/database) 

## Sobre ambiente
Todos os arquivos do docker estão disponíveis no projeto. <br>
para iniciar o ambiente, basta rodar:
`docker compose up -d` <br>

Para funcionamento do projeto, é necessário adicionar o arquivo .env , contendo a conexão com o banco de dados, <br>
este arquivo foi enviado junto com o link do projeto.

## Postman Documentation
Documentação da Api foi publicada no postman: [Documentação api pessoas](https://documenter.getpostman.com/view/10787241/2s9Ye8hFjk). <br>
Adicionalmente, o arquivo da collection pessoas está disponível no repositório, sinta-se a vontade para importar no seu postman. <br>

## Sobre o projeto

+ Desenvolvimento completo das 4 api's solicitadas, com as funcionalidades pedidas, devidas validações e retornos dos http status code.
+ Todas as funcionalidades possuem testes automatizados.
+ Banco de dados está publicado em um cluster oficial do atlas mongodb.
+ Projeto está dockerizado.
+ Pipeline integrada no github para rodar os testes a cada pull request ou commit.
