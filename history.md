# 📘 Historial de desarrollo: Blog `lh:8080`

Documentación por niveles del desarrollo del blog personal educativo `lh:8080`, creado con HTML, PHP y MySQL, servido con Apache2 dentro de Docker y estilizado con Bootstrap 5.  
Este archivo sirve como bitácora de progreso y motivación personal 🧠💪

---

## 🧱 Nivel 1: Primeros cimientos
**Objetivo**: Tener un sitio corriendo en Docker con un único archivo visible desde el navegador\
🎯 *Logro desbloqueado*: Primer archivo `index.php` visible desde `localhost:8080`\
🏅 **Badge**: `🛠️ Dockerize It!`

🔧 Tareas realizadas:
- Se creó `Dockerfile` y `docker-compose.yml` básico. No alcanzó con solo el Dockerfile, tuve que agregar `docker-compose.yml` para ver los cambios al refrescar el navegador
- Montaje simple: `.:/var/www/html`
- Probado con `phpinfo()` en `index.php`

```
/
├── index.php
├── Dockerfile
└── docker-compose.yml
```

---

## 📁 Nivel 2: Primer esqueleto del sitio
**Objetivo**: Separar estructura HTML en componentes reutilizables\
🏅 **Badge**: `🔗 Modularizador`

🔧 Tareas realizadas:
- Archivos separados, donde cada componente de layout cumple con una tarea y se pueda reutilizar
- `require_once()` usado para ensamblar vistas
- Uso de `Bootstrap` para maquetado

🚫 Problemas enfrentados:
  - `index.php` y `footer.php`(importado) no estaban bien distribuidos 
  - `blog.php` se solapaba con `footer.php`(importado) cuando solucionaba el punto anterior
  - Tamaños inconsistentes en login/signup

✅ Solucionado con las clases de Bootstrap `min-vh-100` + `flex-grow-1` en `main` + `d-flex` en `body` y `flex-grow-1` en el contenedor del index.php

```
/
├── layouts/
│   ├── header.php
│   ├── nav.php
│   ├── aside.php
│   ├── footer.php
│   ├── assets/
├── blog.php
├── index.php
├── Dockerfile
└── docker-compose.yml
```

---

## 🔒  Nivel 3: Primeros formularios
**Objetivo**: Tener formularios para login y signup funcionales visualmente\
🏅 **Badge**: `🧾 Form Master`

🔧 Tareas realizadas:
- Creación de:
    - `login.php`
    - `signup.php`
- Refinamiento de diseño:
    - Espaciado entre inputs
    - Botones centrados
    - Placeholders amables y divertidos
- Links dinámicos entre login/signup (¿No tenés cuenta? <-> ¡Registrarme!)
- Testeado en pantallas pequeñas → ajustes de tamaño y márgenes

🚫 Problemas enfrentados: Los cambios en CSS no se actualizaban por caché

✅ Soluciones:
- Solución rápida: actualizar con `Ctrl + Shift + R` tanto en Chrome como Firefox
- Solución tipo hack con php: añadir `...<?php echo '?v=' . time() ?>...` en el header.php(lo mantengo por las dudas)
- 🙏 Solución a largo plazo: **usar solo Bootstrap**

```
/
├── layouts/
│   ├── header.php
│   ├── nav.php
│   ├── aside.php
│   ├── footer.php
│   ├── assets/
├── blog.php
├── index.php
├── login.php
├── signup.php
├── Dockerfile
└── docker-compose.yml
```

---

## 🗂️ Nivel 4: Organización y semántica
**Objetivo**: Mejorar estructura general de carpetas para futuro mantenimiento\
🏅 **Badge**: `📁 Arquitecto de carpetas`

🔧 Tareas realizadas:
- Reflexión sobre `/layouts`, `/assets`, `/views`, `/admin`, `/config`
- Rediseño con nuevo árbol de archivos
- Testeado desde dentro del contenedor Docker (`docker exec -it ... bash`)

🚫 Problemas enfrentados:
  - Algunas imágenes no eran cargadas correctamente  
  - Con la reorganización de carpetas todos los `require_once()` fallaban debido a rutas relativas rotas y ocasionaba que el navegador mostrara solo **Fatal Error** en las líneas donde estaban los require

✅ Soluciones:
- Al problema de imágenes: `docker exec -it lh8080 bash` dar permiso recursivo de lectura a la carpeta assets/ y reiniciar el contenedor con `docker restart lh8080`
- Al de error fatal: creé la constante `LAYOUTS` con rutas desde la raíz del proyecto en config.php y como efecto secundario los `require_once` quedaron más legibles

📦 Resultado: Estructura ordenada y legible de carpetas y archivos buscando implementar MVC 

```
/
├── public/
│   ├── index.php
│   ├── blog.php
│   ├── login.php
│   ├── signup.php
│   ├── assets/
├── App/
│   └── Layouts/
│   │   ├── aside.php
│   │   ├── footer.php
│   │   ├── header.php
│   │   └── nav.php 
│   ├── Models/
│   ├── Controllers/
│   ├── Core/
│   └── Views/ 
├── config/
│   └── apache/
│   └── php/
│   │   └── config.php
├── sql/
├── admin/
├── .env
├── README.md
├── history.md
├── Dockerfile
└── docker-compose.yml
```

---

## 📡 Nivel 5: Preparando lógica
**Objetivo**: Reflexionar sobre MVC, seguridad y rutas\
🏅 **Badge**: `🧠 Estratega de rutas`

- ¿Router o no router? Decidí implementar uno artesanal
- Complementé mis conocimientos y manejo de la configuración de Apache con el router de único acceso con PHP

---

## 🧪 Nivel 6: Implementar validaciones frontend y backend de login/signup  
**Objetivo**: Validar datos del usuario tanto en el cliente como en el servidor con mensajes consistentes y visuales\
🏅 **Badge**: `🛡️ Guardián del input`

🔧 Tareas realizadas:
- Reflexión sobre validación: los formularios deben ser amigables, claros y seguros  
- Refactor de `login.php` y `signup.php` con limpieza de código y uso de clases
- Sanitización y validación usando `JavaScript` en frontend y `PHP` en backend, y retroalimentación con clases de `Bootstrap`   
- Se agregó `messages.php` como única fuente de mensajes para ambos entornos PHP y JS  
- Se creó una clase `Lang` para acceder a los mensajes en backend y exportarlos al frontend en `lang.js.php`
- Implementación de la clase `SessionManager` para centralizar `session_start()`, regenerar ID y evitar errores de headers ya enviados  
- Reestructuración y reutilización de validadores en `inputFormValidators.js`  
- Se creó un archivo de configuración general `general.js.php` accesible desde JS  
- Preparación para soporte multilingüe con detección automática desde `locale.php`  
- Mejoras en la validación cruzada `password` y `confirm_password` (actualiza feedback si se cambia cualquiera de los dos campos)

🚫 Problemas enfrentados:
- Error Fatal al llamar `SessionManager::init()` después de imprimir HTML `require_once('header.php')`
- `lang.js.php` y `general.js.php` no exportaban correctamente (causaban errores de módulo)
- Las clases `is-valid` e `is-invalid` no se sincronizaban bien al modificar `password` después de `confirm_password`
- Mensajes de feedback ausentes o mostraban `undefined` por fallas de carga o errores de key

✅ Soluciones:
- Se movió `SessionManager::init()` antes de cualquier salida para evitar `headers already sent`
- Se usó `export const` en lugar de `export default` en JS para permitir múltiples imports
- Se agregó lógica condicional para revalidar automáticamente `confirm_password` si se cambia el campo `password`
- Se corrigieron claves faltantes o mal nombradas en `messages.php`

📦 Resultado:
- Validación inmediata y mensajes sincronizados desde una sola fuente
- Formularios `login.php` y `signup.php` consistentes con validación inmediata y retroalimentación visual

```
/
├── public/
│   ├── index.php
│   ├── blog.php
│   ├── login.php
│   ├── signup.php
│   ├── assets/
│   │   └── js/
│   │   │   ├── general.js.php
│   │   │   ├── lang.js.php
│   │   │   ├── inputFormValidators.js
│   │   │   ├── login.js
│   │   │   └── signup.js
├── App/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   └── SignupController.php
│   ├── Core/
│   └── Helpers/
│   │   ├── Config.php
│   │   ├── Lang.php
│   │   ├── Sanitizer.php
│   │   └── Validator.php
│   └── Layouts/
│   │   ├── aside.php
│   │   ├── footer.php
│   │   ├── header.php
│   │   └── nav.php 
│   ├── Models/
│   │   └── User.php
│   ├── Security/
│   │   └── SessionManager.php
│   └── Views/
├── config/
│   └── apache/
│   └── php/
│   │   ├── general.php
│   │   ├── locale.php
│   │   └── paths.php
├── handlers/
│   ├── login_handler.php
│   └── signup_handler.php
├── lang/
│   ├── es/
│   │   └── messages.php
├── sql/
├── admin/
├── .env
├── README.md
├── history.md
├── Dockerfile
└── docker-compose.yml
```

---

## 🧪 Nivel 7: Implementar base de datos
**Objetivo**: Conectar correctamente la base de datos para verificar el registro y login de usuarios permitiendo el almacenamiento seguro de credenciales y feedback coherente entre frontend y backend controlando desde la BBDD\
🏅 **Badges**: `💾 SQL Ready`, `🔐 Login funcional`

🔧 Tareas realizadas:
- Lo primero era agregar servicios MySQL docker-compose.yml y configurar Dockerfile para el servidor de BBDD
- Configurar el servidor web con `apache.conf` y reglas de enrutamiento con `.htaccess`
- Implementar la conexión a la BBDD desde PHP usando variables de environment
- Verificar desde el servidor la existencia del usuario y validez de contraseña
- Asegurar que el signup registre correctamente nuevos usuarios con hash seguro y avatar generado con API de dicebear.com 

🚫 Problemas enfrentados:
- El nombre del host de la base de datos no coincidía con el nombre del servicio definido en Docker
- El autocompletado del IDE traía mal el nombre de algunos campos de la tabla users
- Algunos problemas en las respuestas visuales del ingreso de input para el login
- Docker copiaba al contenedor archivos sensibles, logs y configuraciones locales o del IDE

✅ Soluciones:
- Usar el nombre del `service:` de Docker (db, mysql, etc.) como host en la conexión a la base de datos
- Por más tonto que parecía, la solución era verificar que la consulta SQL tuviera el nombre correcto del campo a consultar
- Simplificar las funciones de `inputFormValidators.js` y reutilizar las que ponen las clases de Bootstrap para que no muestre el feedback verde al ingresar un input no vacío
- Crear un archivo `.dockerignore` para excluir del contenedor archivos innecesarios o sensibles

📦 Resultado: Base de datos, registro de usuarios y login funcionales

```
/
├── admin/
├── public/
│   ├── index.php
│   ├── blog.php
│   ├── login.php
│   ├── signup.php
│   ├── assets/
│   │   └── js/
│   │   │   ├── general.js.php
│   │   │   ├── lang.js.php
│   │   │   ├── inputFormValidators.js
│   │   │   ├── login.js
│   │   │   └── signup.js
├── App/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   └── SignupController.php
│   ├── Core/
│   │   └── Database.php
│   └── Helpers/
│   │   ├── Config.php
│   │   ├── Lang.php
│   │   ├── Sanitizer.php
│   │   └── Validator.php
│   └── Layouts/
│   │   ├── aside.php
│   │   ├── footer.php
│   │   ├── header.php
│   │   └── nav.php 
│   ├── Models/
│   │   └── User.php
│   ├── Security/
│   │   └── SessionManager.php
│   └── Views/
├── config/
│   └── apache/
│   └── php/
│   │   ├── general.php
│   │   ├── locale.php
│   │   └── paths.php
├── handlers/
│   ├── login_handler.php
│   └── signup_handler.php
├── lang/
│   ├── es/
│   │   └── messages.php
├── sql/
├── .env
├── .gitignore
├── .dockerignore
├── README.md
├── history.md
├── Dockerfile
└── docker-compose.yml
```

## 🧪 Nivel 8: Dashboard
**Objetivo**: Crear dashboards para admin y user\ 
🏅 **Badges**: `🪪 Gestor de identidades`

🔧 Tareas realizadas:
- Crear interfaces distintas para cada tipo de usuario: admin, user y public:
  - 3 navs con distintos links
  - 3 sidebars, 2 para los dashboards y uno para el de blog
- Modularizar nav.php para poder separar uno por rol
- Implementar funcionalidad dinámica a los sidebars que oculta el texto en pantallas chicas
- Renombrar la carpeta `Layouts/` a `Partials/`
- Implementar el autoloader
- Eliminar clases redundantes de Bootstrap
 
📦 Resultado: Layout de Dashboards listos para agregar funcionalidad

## 🔐 Nivel 9: Seguridad y configuración centralizada
**Objetivo**: Modularizar la configuración del sitio, proteger formularios con CSRF y estructurar middlewares reutilizables\
🏅 **Badges**: `🧰 Arquitecto de la seguridad`, `🧙 Config Wizard`, `🔐 Guardia del Login`

🔧 Tareas realizadas:

- Finalizar la implementación del sistema de configuración centralizado con la clase Config
- Los archivos site.php y seo.php ahora definen dinámicamente el branding del sitio, metadatos y valores reutilizables en todo el proyecto
- Crear un CSRFMiddleware que intercepta y valida tokens en formularios POST, asegurando que ninguna acción crítica se realice sin protección
- La clase CSRFToken genera y asigna el token CSRF en los formularios
- Implementar middlewares reutilizables: AuthMiddleware para rutas protegidas y GuestMiddleware para rutas públicas
- Consolidar la lógica de rutas y middleware en el sistema Router, lo que permite definir rutas junto a sus restricciones de acceso
- Definir acceso único desde index.php que redirige usando Router y Middlewares
- `AuthController` y `SignupController` son los responsables de manejar los envíos de POST y redirigir cuando corresponda
- Implementar manejo de errores de acceso con ErrorHandler y páginas error: 403, 404, 500 y 503
- La clase UserRepository es la única que maneja los accesos a la BBDD

🚫 Problemas enfrentados:
- El validador frontend me impedía usar el botón `submit` por el nuevo `<input type="hidden" value="$CSRFToken">`

✅ Soluciones:
- Tuve que modificar la función que impide activación del botón `submit` con el uso de `form.querySelector('input:not([type="hidden"])')`

📦 Resultado:
- Único punto de entrada al sitio: `public/index.php`
- Uso de rutas con middlewares
- Formularios de login y signup solo accesible para usuarios no logueados
- Formularios protegidos contra ataques CSRF
- Regeneración automática del `session_id` cada 15 mins 
- Proyecto con archivos y carpetas reorganizadas

```
/
├── public/
│   ├── index.php
│   ├── .htaccess
│   ├── uploads/
│   ├── assets/
│   │   └── js/
│   │   │   ├── general.js.php
│   │   │   ├── lang.js.php
│   │   │   ├── inputFormValidators.js
│   │   │   ├── login.js
│   │   │   └── signup.js
├── App/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── PageController.php
│   │   └── SignupController.php
│   ├── Core/
│   │   ├── Middlewares/
│   │   │   ├── AuthMiddleware.php
│   │   │   ├── CSRFMiddleware.php
│   │   │   ├── CSRFToken.php
│   │   │   └── GuestMiddleware.php
│   │   ├── Database.php
│   │   ├── ErrorHandler.php
│   │   ├── Router.php
│   │   └── ViewRenderer.php
│   └── Helpers/
│   │   ├── Config.php
│   │   ├── Lang.php
│   │   ├── LocaleManager.php
│   │   ├── Sanitizer.php
│   │   └── Validator.php
│   ├── Models/
│   │   └── User.php
│   ├── Repositories/
│   │   └── UserRepository.php
│   ├── Security/
│   │   └── SessionManager.php
│   └── Views/
│   │   ├── Admin/
│   │   │   ├── blog.view.php
│   │   │   ├── dashboard.view.php
│   │   │   └── index.view.php
│   │   ├── Errors/
│   │   │   ├── 403.view.php
│   │   │   ├── 404.view.php
│   │   │   ├── 500.view.php
│   │   │   └── 503.view.php
│   │   ├── Partials/
│   │   │   ├── aside.admin.php
│   │   │   ├── aside.blog.php
│   │   │   ├── aside.user.php
│   │   │   ├── content.blog.php
│   │   │   ├── footer.php
│   │   │   ├── head.php
│   │   │   ├── hero.php
│   │   │   ├── nav.admin.php
│   │   │   ├── nav.php
│   │   │   ├── nav.public.php
│   │   │   └── nav.user.php
│   │   ├── Public/
│   │   │   ├── blog.view.php
│   │   │   ├── index.view.php
│   │   │   ├── login.view.php
│   │   │   └── signup.view.php
│   │   ├── User/
│   │   │   ├── blog.view.php
│   │   │   ├── dashboard.view.php
│   │   │   └── index.view.php
├── bootstrap/
│   └── autoload.php
├── config/
│   └── apache/
│   │   └── apache.conf
│   └── php/
│   │   ├── general.php
│   │   ├── paths.php
│   │   ├── seo.php
│   │   └── site.php
├── lang/
│   ├── es/
│   │   └── messages.php
├── sql/
│   └── schema.sql
├── .env
├── .gitignore
├── .dockerignore
├── Dockerfile
├── docker-compose.yml
├── LICENSE
├── history.md
└── README.md
```

***

### 📌 Estado actual del proyecto

- 🧪 Probado en Docker
- ✅ HTML estructurado semánticamente
- ✅ Sitio funcional con rutas básicas `/index.php`, `/login.php`, `/signup.php`
- 🧩 Bootstrap 5 sin clases custom con validación visual (`is-valid`, `is-invalid`, `valid-feedback` e `invalid-feedback`)
- 🔐 Autenticación en preparación con validaciones frontend y backend implementadas
- 🛠️ Sistema modular de configuración (`Config`, `Lang`, `SessionManager`)
- 🌐 Mensajes dinámicos sincronizados en frontend y backend (`messages.php`)
- 💾 Base lista para iniciar sistema de rutas y conexión a base de datos


### 🚧 Próximas etapas

- Nivel 10: CRUD de posts con editor Markdown
- Nivel 11: Sistema de comentarios
- Nivel 12: Buscador por palabra clave y categoría
- Nivel 13: Roles y permisos
  

### 🏅 Badges

- 🎨 UX Sutil
- 🧭 Navegador Semántico
- 🧙‍♂️ Admin total
- 💬 Sistema de comentarios activo
- 📝 Editor con Markdown
- 🧹 Cazador de errores
- 📦 Git Habituado 
- 🔍 Buscador
- ✈️ Deploy final

---
>“Things are only impossible until they are not.”   
>*— Captain Jean-Luc Picard*