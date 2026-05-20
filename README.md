# CanchApp Reservas - Laravel MVC

Aplicación web académica desarrollada en Laravel para gestionar reservas de canchas deportivas.

## Tema elegido

**Sistema de Reservas de Canchas Deportivas**.

Es un tema simple, claro y efectivo porque permite demostrar MVC, Eloquent ORM, migraciones, relaciones entre tablas, CRUD, formularios, validaciones y vistas Blade sin volver el proyecto demasiado complicado.

## Funcionalidades incluidas

- Página principal con resumen del sistema.
- Listado de reservas con búsqueda y filtro por estado.
- Crear reservas.
- Ver detalle de una reserva.
- Editar reservas.
- Eliminar reservas.
- Cálculo automático del total de la reserva.
- Datos iniciales mediante seeders.
- Validaciones mediante Form Request.
- Relaciones Eloquent: `hasMany`, `belongsTo` y `belongsToMany`.
- Consulta con Query Builder en el dashboard.

## Tablas principales

1. `customers`: clientes.
2. `courts`: canchas deportivas.
3. `services`: servicios adicionales.
4. `reservations`: reservas.
5. `reservation_service`: tabla pivote para relación muchos a muchos entre reservas y servicios.

## Requisitos

- XAMPP con Apache y MySQL/MariaDB activos.
- PHP 8.1 o superior.
- Composer instalado.

## Instalación en XAMPP

1. Descomprime el ZIP dentro de:

```bash
C:\xampp\htdocs\canchapp_laravel
```

2. Abre XAMPP y activa:

- Apache
- MySQL

3. Entra a phpMyAdmin y crea una base de datos llamada:

```sql
canchapp_db
```

4. Abre una terminal dentro de la carpeta del proyecto:

```bash
cd C:\xampp\htdocs\canchapp_laravel
```

5. Instala las dependencias:

```bash
composer install
```

6. Copia el archivo de entorno:

```bash
copy .env.example .env
```

En Git Bash o Linux/Mac:

```bash
cp .env.example .env
```

7. Genera la llave de Laravel:

```bash
php artisan key:generate
```

8. Ejecuta migraciones y seeders:

```bash
php artisan migrate --seed
```

9. Levanta el servidor:

```bash
php artisan serve
```

10. Abre en el navegador:

```bash
http://127.0.0.1:8000
```

## Archivos importantes para explicar en defensa

- Modelos: `app/Models`
- Migraciones: `database/migrations`
- Controlador Resource: `app/Http/Controllers/ReservationController.php`
- Validaciones Form Request: `app/Http/Requests`
- Vistas Blade: `resources/views`
- Rutas: `routes/web.php`
- Seeders: `database/seeders/DatabaseSeeder.php`

## Comandos útiles

Limpiar caché:

```bash
php artisan optimize:clear
```

Reiniciar base de datos con datos de prueba:

```bash
php artisan migrate:fresh --seed
```
