<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


1. Comece o projeto com o comando:
composer create-project laravel/laravel nome-do-projeto

2. Após a criação, eu gosto de fazer primeiro a configuração do .env que vai armazenar
as informações sensíveis do projeto, incluindo o banco. Como é para provas,
atividades e coisas acadêmicas, não precisa de muito critério, então só precisa
configurar o local das informações do banco.

Tira as hashtags e pode alterar DB_DATABASE e DB_CONNECTION. Como
estamos usando MySQL na aula, eu optei por continuar assim. 


3. Depois que fizer isso, pode começar a criar as migrations. É muito importante ter
cuidado com a ordem de criação porque se uma tabela depende de outra, você
precisa criar a tabela "pai" primeiro. Exemplo: se você criar uma tabela de pedidos
que precisa fazer referência à tabela de produtos, mas a tabela de produtos ainda
não existe, vai dar erro. Isso acontece porque o Laravel não consegue criar uma
chave estrangeira apontando para uma tabela que não foi criada ainda. A regra é
simples: sempre crie primeiro as tabelas independentes (que não dependem de
ninguém) e depois as tabelas que fazem referência a outras. O Laravel executa as
migrations em ordem cronológica baseada no timestamp do nome do arquivo. Então,
para criar a migration use o comando:

php artisan make:migration create_nome_tabela_table

4. Quando você cria uma migration com o comando
 
 php artisan make:migration

o Laravel cria apenas um arquivo vazio com a estrutura básica.
Você precisa editar esse arquivo e adicionar manualmente todos os campos
(colunas) que sua tabela vai ter. Depois que fizer isso, poderá rodar o comando que
irá adicionar as tabelas criadas naquele banco que você configurou no arquivo .env.
O comando é esse:

php artisan migrate

8. Após criar o banco, você vai precisar criar os models. Um model é uma classe PHP
que representa uma tabela do banco de dados. É a ponte entre o código e o banco
de dados. Os models vão permitir que você interaja com os dados do banco sem
usar SQL. Em vez de fazer queries SQL manualmente, você usa métodos PHP
simples. Para cada tabela do seu banco você vai precisar de um model. Para criar
os models, tem que usar o comando:

php artisan make:model Nome

10. Agora que criou os models e configurou todos eles, você vai partir para uma das
partes mais cruciais, que são os controllers. Os controllers basicamente vão fazer o
trabalho da lógica da sua API. Eles que setam os parâmetros solicitados pelo
professor. Em resumo, são as regras de negócio. Exemplo: o pedido deve ter pelo
menos 1 pedido inserido. Para criar os controllers, tem que usar o comando:

php artisan make:controller NomeController

12. Por fim, tem as routes, que são as famosas rotas. Você vai precisar criar um arquivo
em routes chamado api.php e é lá que você vai criar as rotas. Para criar
automaticamente, pode usar:

php artisan install:api

Depois disso é só você configurar todas as rotas que criou no controller.
