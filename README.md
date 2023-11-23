# Desafio Places

Este é um projeto de desafio de CRUD de lugares (places). 

## Visão Geral

O objetivo deste projeto é fornecer uma API simples para gerenciar lugares, permitindo operações CRUD (Create, Read, Update, Delete) e filtros.

## Pré-requisitos

- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/)

## Configuração

### 1. Clonar o repositório:

```bash
git clone https://github.com/brunojustomagnus/desafio-places.git
```

### 2. Após acessar o diretório, abra no VSCode:
```bash
code .
```

### 3. Instalar dependências do Composer:

```bash
composer install
```

### 4. Copiar o arquivo de configuração do ambiente utilizando o 'example' para isso, pois já vem configurado:

```bash
cp .env.example .env
```

### 5. Gerar chave de aplicação:

```bash
php artisan key:generate
```

### 6. Subir o Docker com Sail:

```bash
./vendor/bin/sail up -d
```

### 7. Criar alias para o comando Sail:

```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

### 8. Executar migrações e seeders do banco de dados usando o Sail:

```bash
sail artisan migrate --seed
```

### 9. Executar os testes usando o Sail:

```bash
sail artisan test
```
