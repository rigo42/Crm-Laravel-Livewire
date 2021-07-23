# CRM - Laravel

Hola!, CRM - Laravel es un proyecto open source con el cual podrás manejar tus prospectos, clientes y servicios de una manera bastante facil

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._


### Pre-requisitos 📋

_Que cosas necesitas para instalar el software y como instalarlas_

```
1.- PHP v7.4+
2.- Servidor XAMMP, WAMPP o Laragon
```

### Instalación 🔧

_1.- Deberás de instalar las dependencias de laravel con el siguiente comando_


```
composer install
```

_2.- Una vez que se terminen de descargar las dependencias_

```
php artisan key:generate
```
_3.- Deberás de rellenar las variables del archivo .env.example, una vez finalizado le podrás cambiar el nombre a .env_

_4.- Deberás de rellenar las variables del archivo .env.example, una vez finalizado le podrás cambiar el nombre a .env_
__

### Configuración ⚙️

Google Analytics:

_1.- Habilitar la API de google analytics en [Console Cloud Google](https://console.cloud.google.com/) _

_2.- Deberás de obtener tu credencial de cuenta de servicio de Google y colocarlo el archivo .json en ./storage/google/_

_3.- Deberás de obtener tu VIEW ID de tu página de Google Analytics y colocarlo en la variable de entorno de .env ANALYTICS_VIEW_ID=""_

_4.- Configura el archivo ./config/analytics.php con tu nombre de archivo de tu credencial de cuenta de servicio de Google_

## Ejecutando las migraciones ⚙️

```
php artisan migrate
```

## Construido con 🛠️

_Dependencias de laravel que ayudaron a la construcción del proyecto_

* "aprendible/storage-link-route": "^1.0",
* "asantibanez/livewire-charts": "^2.3",
* "fedeisas/laravel-mail-css-inliner": "^4.0",
* "intervention/image": "^2.5",
* "jantinnerezo/livewire-alert": "^2.1",
* "laravel-lang/lang": "~7.0",
* "laravel/ui": "^3.3",
* "livewire/livewire": "^2.4",
* "orangehill/iseed": "^3.0",
* "spatie/laravel-activitylog": "^3.17",
* "spatie/laravel-analytics": "^3.11",
* "spatie/laravel-backup": "^6.16",
* "spatie/laravel-permission": "^4.0"

## Autores ✒️


* **Rigoberto Villa Rodríguez** - *Programador Full Stack* - [Rigoberto Villa](https://github.com/rigo42)



---
⌨️ con ❤️ por [RigobertoVillaRodríguez](https://github.com/rigo42) 😊