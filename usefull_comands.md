# Comandos Básicos:

## Documentação

https://filamentphp.com/

## Para conectar:

------------------------------------------------

Obs.: o projeto está configurado para utilizar docker, portanto é necessário rodar os containers

```php
    php artisan up -d
```

Se estiver com o sail configurado:

```php
    sail up -d
```

------------------------------------------------

A porta a ser conectada está configurada como 81

------------------------------------------------

Para alterar a porta:

1 - Ir no arquivo .env

2 - API_PORT= (colocar a nova porta aqui)

------------------------------------------------

```php
    http://localhost:81/
```

Antes de executar o projeto:

    ```php
        php art migrate
    ```

    obs.: se tiver configurado o sail

    ```php
        sail art
    ```

## Filament

criar novo usuário:

```php
    ./vendor/bin/sail art make:filament-user
```

Para criar um novo usuário:

```php
    ./vendor/bin/sail art make:filament-user

    // ou se estiver utilizando sail
    sail art make:filament-user
```

depois de rodar o comando acima:

name: admin
email: admin@mail.com
password: 12345678
