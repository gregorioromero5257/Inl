# HERRAMIENTA DE MAPEO DE DECISIONES DE AGENTES DEL MINISTERIO PÚBLICO
[![version](https://img.shields.io/badge/versi%C3%B3n-1.0.0-blue.svg)](https://semver.org)

Esta Herramienta tiene por objetivo brindar información sobre cómo los Agentes del Ministerio Público de un estado toman las decisiones más importantes en el proceso penal, así como los factores regulatorios, organizacionales e individuales que influyen en éstas.

La aplicación de esta Herramienta generará dos (2) tipos de reportes (Reporte Detallado y Reporte Ejecutivo) que facilitarán la toma de decisiones a nivel interno de cada Fiscalía/Procuraduría; y, a nivel nacional para el diseño e implementación de políticas públicas.

## :black_nib: Lenguajes de programación utilizados

* PHP para el backend de la aplicación, utilizando el framework de código abierto para desarrollar aplicaciones y servicios web Laravel en su versión más reciente al 22 de marzo de 2019 5.7
* Javascript para el frontend de la aplicación, utilizando el marco de código abierto para crear interfaces de usuario y aplicaciones de una sola página Vue.js


## :computer: Instalación local de la aplicación

* `cd ` dentro del folder del proyecto.
* Correr ` composer install `
* Crear archivo `.env` a partir del archivo `.env.example` y agregar información de base de datos local.
* Correr ` php artisan key:generate` para generar api key
* Correr ` npm install ` o  ` yarn install `
* Correr ` php artisan migrate ` para migrar los modelos de la base de datos.
* Correr ` php artisan db:seed ` para agregar datos de los seeders a base de datos local
* Correr ` php artisan passport:install ` para instalar las llaves de passport

## 📦 Paquetes o dependencias utilizadas

* [axios](https://github.com/axios/axios)
* [boostrap](https://getbootstrap.com/docs/4.0/getting-started/introduction/)
* [cross-env](https://www.npmjs.com/package/cross-env)
* [jquery](https://jquery.com/)
* [laravel-mix](https://laravel.com/docs/5.8/mix)
* [lodash](https://lodash.com/)
* [popper.js](https://popper.js.org/index.html)
* [vue](https://vuejs.org/)
* [fontawesome](https://fontawesome.com/)
* [admin-lte](https://adminlte.io/themes/dev/AdminLTE/index.html)
* [laravel-vue-pagination](https://github.com/gilbitron/laravel-vue-pagination)
* [moment](https://momentjs.com/)
* [sweetalert2](https://sweetalert2.github.io/)
* [vform](https://github.com/cretueusebiu/vform)
* [vue-multiselect](https://vue-multiselect.js.org/)
* [vue-progressbar](https://github.com/hilongjw/vue-progressbar)
* [vue-router](https://router.vuejs.org/)
* [vue-i18n](http://kazupon.github.io/vue-i18n/)
* [laravel-passport](https://laravel.com/docs/5.8/passport)
* [laravel-excel](https://laravel-excel.com/)
