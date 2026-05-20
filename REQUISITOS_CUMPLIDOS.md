# Requisitos cumplidos del Desafío Práctico 3

## 1. Arquitectura MVC

- **Modelo:** se utilizan modelos Eloquent en `app/Models`.
- **Vista:** se utilizan vistas Blade en `resources/views`.
- **Controlador:** se utiliza `ReservationController` como controlador Resource para manejar la lógica de reservas.

## 2. Base de Datos y Migraciones

El proyecto incluye migraciones en `database/migrations` para crear las tablas:

- `customers`
- `courts`
- `services`
- `reservations`
- `reservation_service`

Las migraciones incluyen:

- Claves primarias con `$table->id()`.
- Claves foráneas con `foreignId()->constrained()`.
- Restricciones como `unique`, `enum`, `default`, `restrictOnDelete` y `cascadeOnDelete`.
- Timestamps con `$table->timestamps()`.

## 3. Modelos Eloquent ORM

Modelos incluidos:

- `Customer`
- `Court`
- `Service`
- `Reservation`

Cada modelo utiliza `$fillable` para definir campos permitidos.

Relaciones incluidas:

- `Customer hasMany Reservation`
- `Court hasMany Reservation`
- `Reservation belongsTo Customer`
- `Reservation belongsTo Court`
- `Reservation belongsToMany Service`
- `Service belongsToMany Reservation`

## 4. CRUD Completo

El CRUD completo se implementa para el recurso principal: **reservas**.

Controlador:

- `index`: listado de reservas.
- `create`: formulario de creación.
- `store`: guardar nueva reserva.
- `show`: detalle de reserva.
- `edit`: formulario de edición.
- `update`: actualizar reserva.
- `destroy`: eliminar reserva.

## 5. Formularios y Validaciones

Se utilizan Form Requests:

- `StoreReservationRequest`
- `UpdateReservationRequest`

Estos archivos validan cliente, cancha, fecha, horas, estado, notas y servicios adicionales.

## 6. Vistas Blade

Vistas incluidas:

- Página principal: `home.blade.php`
- Listado: `reservations/index.blade.php`
- Creación: `reservations/create.blade.php`
- Edición: `reservations/edit.blade.php`
- Detalle: `reservations/show.blade.php`
- Formulario parcial reutilizable: `reservations/partials/form.blade.php`

## 7. Persistencia en Base de Datos

La información se guarda en MySQL/MariaDB usando Eloquent ORM y migraciones. También se incluyen seeders para cargar datos iniciales.
