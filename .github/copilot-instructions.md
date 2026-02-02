## Instrucciones para agentes Copilot

Este repositorio es una aplicación Laravel (PHP 8.2) con frontend gestionado por Vite. Las decisiones y convenciones importantes están documentadas en puntos concisos para que un agente (o desarrollador nuevo) sea productivo rápidamente.

- **Arquitectura general:** Laravel MVC. Controladores en [app/Http/Controllers](app/Http/Controllers), modelos en [app/Models](app/Models), rutas en [routes/web.php](routes/web.php#L1-L200) y vistas en [resources/views](resources/views).
- **Assets / JS:** Vite + `resources/js` y `package.json` (`dev` y `build` scripts). Ver [package.json](package.json#L1-L50).
- **Dependencias y comandos útiles:** `composer install`, copiar `.env` desde `.env.example`, `php artisan key:generate`, `php artisan migrate`, `npm install`, `npm run build`. Hay un `composer` script `setup` que encadena estos pasos (véase [composer.json](composer.json#L1-L120)).

- **Desarrollo en caliente:** El script `dev` en `composer.json` usa `concurrently` para levantar `php artisan serve`, cola (`php artisan queue:listen`) y `npm run dev`. Para tareas independientes usar `php artisan serve` y `npm run dev`.
- **Pruebas:** Ejecutar `composer test` o `php artisan test`. PHPUnit está disponible en `require-dev`.

- **Patrones del proyecto (específicos):**
  - Soft deletes en `Obra` y `Trabajador` (ver [app/Models/Obra.php](app/Models/Obra.php) y [app/Models/Trabajador.php](app/Models/Trabajador.php)). El proyecto expone rutas de papelera/restore/eliminar-definitivo en [routes/web.php](routes/web.php#L1-L200).
  - Relación muchos-a-muchos `obra_trabajador` con campos pivot `fecha_asignacion` y `fecha_fin` (definido en `Obra::trabajadores()` y `Trabajador::obras()`). Ejemplo: [app/Models/Obra.php](app/Models/Obra.php#L1-L200).
  - Modelo `Fichaje` registra `hora_entrada`, `hora_salida` y `horas_trabajadas`; existen rutas y controladores para iniciar/finalizar jornadas (ver `FichajeController` y rutas en [routes/web.php](routes/web.php#L1-L200)).

- **Convenciones de código:**
  - Uso de `protected $fillable` en modelos; seguir para mass-assignment.
  - Resource controllers (use `Route::resource`) para CRUD estándar (ej. `trabajadores`, `obras`).
  - Los controladores usan nombres en español y rutas nombradas (p. ej. `trabajadores.papelera`, `obras.quitarTrabajador`). Mantener consistencia al crear nuevas rutas.

- **Migrations / Seeders:** Revisar `database/migrations` y `database/seeders` para estructura de tablas y datos de ejemplo. Correr `php artisan migrate --seed` en entornos locales si es necesario.

- **Integraciones y procesos en background:** El `composer dev` incluye `php artisan queue:listen` y `laravel/pail`. Si trabajas en features que encolan jobs, revisa la configuración de `queue` en `config/queue.php` y cómo se publica/consume en desarrollo.

- **Qué revisar antes de un cambio grande:**
  - Migraciones conflictivas en `database/migrations` (buscar duplicados de tablas como `obra_trabajador`).
  - Impacto en pivotes (fecha_asignacion/fecha_fin) al modificar relaciones.

Si algo en estas notas queda incompleto o quieres que incluya ejemplos de endpoints/llamados concretos (por ejemplo, payloads de `POST /fichajes` o comandos para levantar el entorno dockerizado), dime qué sección ampliar y lo actualizo.
