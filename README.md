# Segunda Entrega – CRM en Laravel

## Funcionalidades añadidas en esta entrega

- **DataTables**: Listados avanzados con búsqueda y filtros en la vista de Trabajadores.
- **Paginación**: Todos los listados principales usan paginación.
- **Subida de imágenes**: Permite subir y mostrar la foto de cada trabajador.
- **Subida y gestión de archivos**: Permite subir y descargar archivos PDF asociados a productos.
- **Sistema de roles**: Usuarios con rol `admin` o `usuario`.
- **Control de permisos**: Solo el admin puede eliminar, el usuario puede crear y editar.
- **Validación de formularios**: Todos los formularios validan los datos correctamente.
- **Uso de storage**: Las imágenes y archivos se almacenan en `storage/app/public` y se acceden vía `public/storage`.

## Instalación y uso rápido (resumen)

1. Clona el repositorio y sitúate en la rama `Segunda`.
2. Instala dependencias: `composer install` y `npm install`.
3. Configura `.env` y ejecuta `php artisan key:generate`.
4. Ejecuta las migraciones: `php artisan migrate`.
5. Crea el enlace de storage: `php artisan storage:link`.
6. Compila los assets: `npm run build`.
7. Inicia el servidor: `php artisan serve`.

## Notas de roles y permisos
- Accede con un usuario admin para ver todas las opciones (eliminar, etc.).
- Los archivos subidos se almacenan en `storage/app/public`.
- Los roles se gestionan en la tabla `users` (campo `role`).

---

Entrega lista para revisión y pruebas.

# ClearTime - Sistema de Control de Obras y Fichajes

<p align="center">
  <img src="public/img/logoClearTime.png" width="120" alt="ClearTime Logo">
</p>

Sistema completo de gestión de obras, trabajadores y fichajes desarrollado con **Laravel 12** y diseño **ClearTime** (estética pastel moderna).

---

## Características Principales

### Gestión de Trabajadores
- CRUD completo de trabajadores con soft deletes
- Papelera y restauración de trabajadores eliminados
- Eliminación definitiva con confirmación
- Asignación de trabajadores a múltiples obras

### Gestión de Obras
- CRUD completo de obras con soft deletes
- Papelera y restauración de obras
- Gestión de trabajadores asignados (agregar/quitar)
- Tracking de fechas de asignación y finalización

### Sistema de Fichajes
- Registro de entrada/salida con cálculo automático de horas
- Validación robusta de tiempos (parseo flexible de formatos)
- Visualización de historial completo de fichajes
- Dashboard con KPIs y estadísticas

### Diseño ClearTime
- Paleta pastel suave (amarillo crema, azul violeta, rosa)
- Tipografías personalizadas: *Petrona* (serif) + *Tilt Warp* (display)
- Interfaz AdminLTE con tema light personalizado
- Componentes reutilizables (cards, KPIs, tablas, botones)
- Login y autenticación con branding completo

---

## Tecnologías

- **Backend:** Laravel 12.48.1 (PHP 8.2+)
- **Frontend:** Vite + Tailwind CSS + AdminLTE
- **Base de datos:** MySQL (migraciones incluidas)
- **Testing:** PHPUnit
- **Assets:** Vite hot reload para desarrollo

---

## Instalación y Configuración

### Requisitos
- PHP 8.2 o superior
- Composer
- Node.js 18+ y npm
- MySQL/MariaDB

### Setup rápido

```bash
# 1. Clonar el repositorio
git clone <repo-url>
cd ObraControl

# 2. Instalar dependencias y configurar entorno
composer run setup
# (equivale a: composer install + npm install + .env setup + key:generate + migrate)

# 3. Levantar el entorno de desarrollo
composer run dev
# Servidor Laravel: http://127.0.0.1:8000
# Vite dev: http://127.0.0.1:5173
```

### Comandos útiles

```bash
# Levantar solo el servidor PHP
php artisan serve

# Levantar solo Vite (hot reload)
npm run dev

# Compilar assets para producción
npm run build

# Correr tests
composer test

# Limpiar cachés
php artisan optimize:clear
```

---

## Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/       # Controladores (Trabajadores, Obras, Fichajes, Asignaciones)
│   └── Requests/          # Form requests de validación
├── Models/                # Eloquent models (Trabajador, Obra, Fichaje)
├── Repositories/          # Capa de repositorios (interfaces + implementaciones)
├── Services/              # Lógica de negocio (TrabajadorService, ObraService, FichajeService)
└── View/Components/       # Componentes Blade reutilizables

resources/
├── css/
│   └── app.css           # Tema ClearTime (variables, overrides AdminLTE)
├── js/
│   └── app.js            # Entry point de Vite
├── sass/
│   └── app.scss          # Bootstrap customizado
└── views/
    ├── vendor/adminlte/  # Templates AdminLTE personalizados (auth, page, master)
    ├── trabajadores/     # Vistas CRUD trabajadores
    ├── obras/            # Vistas CRUD obras
    ├── fichajes/         # Vistas fichajes
    └── asignaciones/     # Vistas asignaciones

database/
├── migrations/           # Migraciones (users, trabajadores, obras, fichajes, pivots)
└── seeders/             # Seeders de ejemplo

config/
└── adminlte.php         # Configuración completa del menú y branding
```

---

## Arquitectura y Patrones

### Repository Pattern
Capa de abstracción entre controladores y modelos:
- `TrabajadorRepository`, `ObraRepository`, `FichajeRepository`, `AsignacionRepository`
- Inyección de dependencias via Service Container
- Interfaces registradas en `AppServiceProvider`

### Service Layer
Lógica de negocio centralizada:
- `TrabajadorService`, `ObraService`, `FichajeService`, `AsignacionService`
- Validaciones, cálculos y orquestación de repositorios

### Soft Deletes
- Modelos `Trabajador` y `Obra` usan soft deletes
- Rutas específicas para papelera, restaurar y eliminar definitivamente

### Relaciones Many-to-Many
- Pivot `obra_trabajador` con campos `fecha_asignacion` y `fecha_fin`
- Métodos en modelos: `Obra::trabajadores()`, `Trabajador::obras()`

---

## Personalización del Tema

### Variables CSS (ClearTime)
```css
:root {
  --ct-bg: #fff9dc;           /* Fondo amarillo crema */
  --ct-card: #fffdf6;         /* Cards */
  --ct-primary: #6a8cff;      /* Azul principal */
  --ct-secondary: #c18cff;    /* Violeta */
  --ct-accent: #ff9be3;       /* Rosa */
  --ct-success: #35caa6;      /* Verde */
  --ct-warning: #ffd980;      /* Amarillo */
  --ct-danger: #ff7a86;       /* Rojo */
  --ct-ink: #24233a;          /* Texto */
  --ct-muted: #6b6986;        /* Texto secundario */
}
```

### Componentes CSS
- `.ct-card`, `.ct-kpi-card`, `.ct-hero`: containers con diseño ClearTime
- `.btn-ct-primary`, `.btn-ct-secondary`: botones personalizados
- `.ct-auth-page`, `.ct-auth-box`: login con estética ClearTime
- `.ct-table`, `.ct-grid`: tablas y grids responsivos

---

## Dashboard y KPIs

El dashboard muestra:
- Número total de trabajadores activos
- Número total de obras activas
- Fichajes del día actual
- Acciones rápidas (nueva obra, nuevo trabajador, registrar fichaje)

---

## Testing

```bash
# Correr todos los tests
php artisan test

# Correr tests específicos
php artisan test --filter TrabajadorTest
```

---

## Autenticación

- Sistema de autenticación integrado con Laravel UI
- Login/registro con diseño ClearTime
- Vistas personalizadas en `resources/views/vendor/adminlte/auth/`

---

## Convenciones

### Nomenclatura
- **Controladores:** Resource controllers (ej. `TrabajadorController`)
- **Rutas nombradas:** `trabajadores.index`, `obras.papelera`, `fichajes.create`
- **Modelos:** Singular en PascalCase (`Trabajador`, `Obra`, `Fichaje`)
- **Tablas:** Plural en snake_case (`trabajadores`, `obras`, `fichajes`)

### Mass Assignment
Todos los modelos usan `protected $fillable` para definir campos asignables en masa.

---

## Desarrollo

### Levantar entorno completo
```bash
composer run dev
```
Este comando usa `concurrently` para levantar:
- `php artisan serve` (puerto 8000)
- `php artisan queue:listen` (workers)
- `npm run dev` (Vite hot reload)

### Workflow típico
1. Modificar vistas/CSS en `resources/`
2. Vite recarga automáticamente (hot reload)
3. Modificar backend en `app/`
4. Refrescar navegador para ver cambios PHP

---

## Dependencias Clave

### Backend
- `laravel/framework` (12.x)
- `jeroennoten/laravel-adminlte` (AdminLTE para Laravel)
- `laravel/ui` (scaffolding de autenticación)

### Frontend
- `vite` (bundler)
- `laravel-vite-plugin` (integración Laravel)
- `tailwindcss` (utilidades CSS)
- AdminLTE (incluido via package)

---

## Troubleshooting

### Assets no se actualizan
```bash
npm run build
php artisan optimize:clear
# Ctrl+Shift+R en el navegador (recarga dura)
```

### Errores de Vite manifest
Verifica que `resources/js/app.js` importe `resources/css/app.css`:
```javascript
import '../css/app.css';
```

### Port ya en uso
```bash
# Cambiar puerto del servidor
php artisan serve --port=8001

# Cambiar puerto de Vite
npm run dev -- --port 5174
```

---

## Licencia

Este proyecto está bajo licencia MIT.
