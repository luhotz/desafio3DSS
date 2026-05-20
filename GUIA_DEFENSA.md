# Guía breve para explicar el proyecto

## ¿De qué trata la aplicación?

La aplicación se llama **CanchApp Reservas** y permite gestionar reservas de canchas deportivas. El sistema registra clientes, canchas, servicios adicionales y reservas.

## ¿Cuál es el recurso principal del CRUD?

El recurso principal es **reservas**. Desde el sistema se puede crear, listar, ver detalle, editar y eliminar una reserva.

## ¿Cómo se aplica MVC?

- El **Modelo** representa las tablas de la base de datos mediante Eloquent ORM.
- La **Vista** muestra la interfaz al usuario mediante Blade.
- El **Controlador** recibe las solicitudes HTTP, procesa la lógica y devuelve las vistas correspondientes.

## ¿Qué relaciones tiene la base de datos?

- Un cliente puede tener muchas reservas.
- Una cancha puede tener muchas reservas.
- Una reserva pertenece a un cliente.
- Una reserva pertenece a una cancha.
- Una reserva puede tener muchos servicios adicionales.
- Un servicio puede estar en muchas reservas.

## ¿Qué hace el controlador Resource?

El controlador `ReservationController` organiza todas las operaciones del CRUD en métodos separados: `index`, `create`, `store`, `show`, `edit`, `update` y `destroy`.

## ¿Dónde están las validaciones?

Las validaciones están en los archivos:

- `StoreReservationRequest`
- `UpdateReservationRequest`

Esto permite que el controlador quede más limpio y que las reglas de validación estén separadas.

## ¿Qué hace el cálculo automático del total?

El sistema toma la tarifa por hora de la cancha, calcula la duración de la reserva y suma los servicios adicionales seleccionados. Luego guarda ese total en la base de datos.

## ¿Por qué este proyecto cumple el desafío?

Porque utiliza Laravel MVC, modelos Eloquent, migraciones, relaciones entre tablas, un CRUD completo, Form Request, vistas Blade, MySQL/MariaDB y persistencia real de datos.
