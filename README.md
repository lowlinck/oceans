<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/yourname/ocean/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/yourname/ocean"><img src="https://img.shields.io/packagist/dt/yourname/ocean" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/yourname/ocean"><img src="https://img.shields.io/packagist/v/yourname/ocean" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/yourname/ocean"><img src="https://img.shields.io/packagist/l/yourname/ocean" alt="License"></a>
</p>

## О проекте Ocean

Проект **Ocean** предназначен для изучения  материалов в группе **Laravel Creative**. Он включает в себя разнообразные учебные модули и практические примеры, которые помогут улучшить знания и навыки работы с Laravel.
### Laravel

1. Маршрутизация (Route)
2. Контроллеры (Controller)
3. Модели и миграции (Model и migrations)
4. CRUD
5. Сервисы (Service)
6. Виды (View)
7. CRUD Vue
8. Запросы (Request)
9. Валидация (Validation)
10. Пагинация (Pagination)
    ... (и так далее вплоть до 44. Exceptions)

### Vue

1. Основы Vue (Vue)
2. Хуки (Hooks)
3. Данные (Data)
4. Методы (Methods)
5. Вычисляемые свойства (Computed)
6. Наблюдатели (Watch)
7. Ссылки (Refs)
8. Компоненты (Components)
   ... (и так далее вплоть до 14. Axios)
## Начало работы

Для начала работы с проектом **Ocean** вам потребуется установить Docker и следовать нижеуказанным инструкциям для настройки проекта на вашем локальном компьютере.

### Предварительные условия

Убедитесь, что на вашем компьютере установлены:
- Docker (последняя версия)
- PHP (последняя версия на момент создания репозитория)

### Установка

Процесс установки включает несколько шагов:

1. Создание нового проекта Laravel с помощью Sail:
   ```bash
   composer create-project laravel/laravel Ocean
2. Переход в папку проекта:
       ```bash

       cd Ocean
3. Установка Laravel Sail. Во время установки вы сможете выбрать компоненты, такие как тип базы данных или Redis:
    ```bash
    php artisan sail:install
4. Запуск Docker контейнеров:
    ```bash
    ./vendor/bin/sail up
5. Установка Laravel Breeze и интеграция с Vue:
   ```bash
    sail composer require laravel/breeze --dev
    sail artisan breeze:install vue
    sail npm run dev

6. Установленные и настроенные модули
   ```json   
   {
   "devDependencies": {
   "@inertiajs/vue3": "^1.0.0",
   "@tailwindcss/forms": "^0.5.3",
   "@vitejs/plugin-vue": "^5.0.0",
   "autoprefixer": "^10.4.12",
   "axios": "^1.6.4",
   "laravel-vite-plugin": "^1.0",
   "postcss": "^8.4.31",
   "tailwindcss": "^3.2.1",
   "vite": "^5.0",
   "vue": "^3.4.0"
   }
   }
