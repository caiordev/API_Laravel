# API TAREFAS

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
[![Licence](https://img.shields.io/github/license/Ileriayo/markdown-badges?style=for-the-badge)](./LICENSE)

Este projeto é uma API para o teste da Inforgeneses usando **PHP, Laravel, MySQL**

Esta API foi criada seguindo os passos do TDD e clean code, com testes de todos os endpoints. A API inclue:

-   Testes funcionais✅
-   Validação de entrada✅
-   Commits utilizando a Conventional Commits Pattern✅

## Tabela de Conteúdos

-   [Instalação](#installation)
-   [Configuração](#configuration)
-   [Uso](#usage)
-   [API Endpoints](#api-endpoints)
-   [Banco de Dados](#database)
-   [Contributing](#contributing)

## Installation

1. Clone o repositório:

```bash
git clone https://github.com/caiordev/API_Laravel.git
```

2. Instale as dependências com:

```bash
composer install
```

## Database

Este projeto utiliza o [MySQL](https://docs.oracle.com/en-us/iaas/mysql-database/doc/getting-started.html) como o banco de dados:  
-No arquivo .env defina o nome do banco de dados.  
-Configure a senha e usuário do seu MySQL.

Rode as migrações com:

```bash
php artisan migrate
```

## USO

1. Comece a aplicação com o artisan:

```bash
php artisan serve
```

2. A API poderá ser acessada em http://127.0.0.1:8000 (lembrando que é preciso adicionar /api antes da rota)

## TESTES

1. Para rodar os testes use o comando:

```bash
php artisan test
```

## API Endpoints

A API provê os seguintes endpoints:

**GET TAREFA**

```markdown
GET /tarefa - Retorna uma lista de todas as tarefas.
```

```json
[
    {
        "id": 1,
        "titulo": "fazer atividade",
        "decricao": "fazer atividade de matemática",
        "status": false,
        "created_at": "2023-11-22T23:17:46.000000Z",
        "updated_at": "2023-11-23T15:58:46.000000Z"
    },
    {
        "id": 2,
        "titulo": "ler um livro",
        "decricao": "ler o livro do Game Of Thrones",
        "status": false,
        "created_at": "2023-11-22T23:17:46.000000Z",
        "updated_at": "2023-11-23T15:58:46.000000Z"
    }
]
```

**POST TAREFA**

```markdown
POST /tarefa - Registra uma nova tarefa.
```

```json
{
    "titulo": "resolver teste Inforgeneses",
    "descricao": "Adicionar novos endpoints na api"
}
```

**PUT TAREFA**

```markdown
PUT /tarefa/id - Atualiza a tarefa.
```

```json
{
    "titulo": "novo titulo",
    "descricao": "nova descricao"
}
```

**DELETE TAREFA**

```markdown
DELETE /tarefa/id - Deleta uma tarefa.
```
