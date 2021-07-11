## Avaliação Marvel Heroes

Este projeto tem como intuito listar 3 heróis favoritos e 5 historias deles.

Este projeto foi construido utilizando duas frameworks
- Back end - Laravel
- Front end - Vue Js

## Requisitos

* PHP 7.3
* Composer 2.0.9
* vue-cli 4.5.13
* Node 14.15.5
* Npm 6.14.11

## Instalação back end

- `composer install`
- `cp -v .env.example .env`

Adicione o trecho abaixo no final de seu arquivo .env

```
MARVEL_PUBLIC_KEY=9f031ddc070bc7469bb4a3fe9551cbb6
MARVEL_PRIVATE_KEY=61698e8a8a353450fe72ad53586aee4ec498cd09
MARVEL_END_POINT=https://gateway.marvel.com/v1/public/
```

- `php artisan key:generate`
- `php artisan serve`


## Instalação front end

- `cd front_end`
- `npm install`
- `npm run serve`


## Licensa

[MIT license](https://opensource.org/licenses/MIT).
