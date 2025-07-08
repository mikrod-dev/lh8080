# 📘 Historial de desarrollo: Blog `lh:8080`

Documentación por niveles del desarrollo del blog personal educativo `lh:8080`, creado con HTML, PHP y MySQL, servido con Apache2 dentro de Docker y estilizado con Bootstrap 5.  
Este archivo sirve como bitácora de progreso y motivación personal 🧠💪

---

## 🧱 Nivel 1: Primeros cimientos
**Objetivo**: Tener un sitio corriendo en Docker con un único archivo visible desde el navegador\
🎯 *Logro desbloqueado*: Primer archivo `index.php` visible desde `localhost:8080`\
🏅 **Badge**: `🛠️ Dockerize It!`

- 🔧 Se creó `Dockerfile` y `docker-compose.yml` básico. No alcanzó con solo el Dockerfile, tuve que agregar `docker-compose.yml` para ver los cambios al refrescar el navegador
- 🔁 Montaje simple: `.:/var/www/html`
- 🧪 Probado con `phpinfo()` en `index.php`

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

- 🗃️ Archivos separados, donde cada componente de layout cumple con una tarea y se pueda reutilizar
- 🔁 `require_once()` usado para ensamblar vistas
- 🧼 Uso de `Bootstrap` para maquetado
- 🚫 Problemas detectados:
  - `index.php` y `footer.php`(importado) no estaban bien distribuidos 
  - `blog.php` se solapaba con `footer.php`(importado) cuando solucionaba el punto anterior
  - Tamaños inconsistentes en login/signup
- ✅ Solucionado con las clases de Bootstrap `min-vh-100` + `flex-grow-1` en `main` + `d-flex` en `body` y `flex-grow-1` en el contenedor del index.php

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

- 📝 Creación de:
    - `login.php`
    - `signup.php`
- 🎨 Refinamiento de diseño:
    - Espaciado entre inputs
    - Botones centrados
    - Placeholders amables y divertidos
- 🔁 Links dinámicos entre login/signup (¿No tenés cuenta? <-> ¡Registrarme!)
- 📱 Testeado en pantallas pequeñas → ajustes de tamaño y márgenes
- 🚫 Problemas detectados:
  - Los cambios en CSS no se actualizaban por caché
- ✅ Solución rápida: actualizar con `Ctrl + Shift + R` tanto en Chrome como Firefox
- ✅ Solución tipo hack con php: añadir `...<?php echo '?v=' . time() ?>...` en el header.php(lo mantengo por las dudas)
- ✅ 🙏 Solución a largo plazo: **usar solo Bootstrap**

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

- 🧠 Reflexión sobre `/layouts`, `/assets`, `/views`, `/admin`, `/config`
- 🔁 Rediseño con nuevo árbol de archivos
- 🧪 Testeado desde dentro del contenedor Docker (`docker exec -it ... bash`)
- 🚫 Problemas detectados:
  - Algunas imágenes no eran cargadas correctamente  
  - Con la reorganización de carpetas todos los `require_once()` fallaban debido a rutas relativas rotas y ocasionaba que el navegador mostrara solo **Fatal Error** en las líneas donde estaban los require 
- ✅ Solución problema de imágenes: `docker exec -it lh8080 bash` dar permiso recursivo de lectura a la carpeta assets/ y reiniciar el contenedor con `docker restart lh8080`
- ✅ Solución de error fatal: creé la constante `LAYOUTS` con rutas desde la raíz del proyecto en config.php y como efecto secundario los `require_once` quedaron más legibles

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

- 🤔 ¿Router o no router? Decidí implementar uno artesanal
- 🧠 Complementé mis conocimientos y manejo de la configuración de Apache con el router de único acceso con PHP

---

## 🧪 Nivel 6: Implementar validaciones frontend y backend de login/signup  
**Objetivo**: Validar datos del usuario tanto en el cliente como en el servidor con mensajes consistentes y visuales\
🏅 **Badge**: `🛡️ Guardián del input`

- 🧠 Reflexión sobre validación: los formularios deben ser amigables, claros y seguros  
- 🔁 Refactor de `login.php` y `signup.php` con limpieza de código y uso de clases
- 🔁 Sanitización y validación usando `JavaScript` en frontend y `PHP` en backend, y retroalimentación con clases de `Bootstrap`   
- 🔁 Se agregó `messages.php` como única fuente de mensajes para ambos entornos PHP y JS  
- 🔁 Se creó una clase `Lang` para acceder a los mensajes en backend y exportarlos al frontend en `lang.js.php`
- 🔁 Implementación de la clase `SessionManager` para centralizar `session_start()`, regenerar ID y evitar errores de headers ya enviados  
- 🔁 Reestructuración y reutilización de validadores en `inputFormValidators.js`  
- 🔁 Se creó un archivo de configuración general `general.js.php` accesible desde JS  
- 🔁 Preparación para soporte multilingüe con detección automática desde `locale.php`  
- 🔁 Mejoras en la validación cruzada `password` y `confirm_password` (actualiza feedback si se cambia cualquiera de los dos campos)

🚫 Problemas detectados:
- ❗ Error Fatal al llamar `SessionManager::init()` después de imprimir HTML `require_once('header.php')`
- ❗ `lang.js.php` y `general.js.php` no exportaban correctamente (causaban errores de módulo)
- ❗ Las clases `is-valid` e `is-invalid` no se sincronizaban bien al modificar `password` después de `confirm_password`
- ❗ Mensajes de feedback ausentes o mostraban `undefined` por fallas de carga o errores de key

✅ Soluciones:
- ✅ Se movió `SessionManager::init()` antes de cualquier salida para evitar `headers already sent`
- ✅ Se usó `export const` en lugar de `export default` en JS para permitir múltiples imports
- ✅ Se agregó lógica condicional para revalidar automáticamente `confirm_password` si se cambia el campo `password`
- ✅ Se corrigieron claves faltantes o mal nombradas en `messages.php`

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
│   │   ├── general.js.php
│   │   ├── lang.js.php
│   │   ├── inputFormValidators.js
│   │   ├── login.js
│   │   └── signup.js
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


***

### 📌 Estado actual del proyecto

- 🧪 Probado en Docker
- ✅ HTML estructurado semánticamente
- ✅ Sitio funcional con rutas básicas `/index.php`, `/login.php`, `/signup.php`
- 🧩 Bootstrap 5 sin clases custom con validación visual (`is-valid`, `is-invalid`, `valid-feedback` e `invalid-feedback`)
- 🔐 Autenticación en preparación con validaciones frontend y backend implementadas
- 🛠️ Sistema modular de configuración (`Config`, `Lang`, `SessionManager`)
- 🌐 Mensajes dinámicos sincronizados en frontend y backend (`messages.php`)
- 📄 Base lista para iniciar sistema de rutas y conexión a base de datos


### 🚧 Próximas etapas

- Nivel 7: Crear panel dashboard
- Nivel 8: CRUD de posts con editor Markdown
- Nivel 9: Crear router simple en PHP y centralizar rutas
- Nivel 10: Sistema de comentarios
- Nivel 11: Buscador por palabra clave y categoría
- Nivel 12: Roles y permisos
  

### 🏅 Badges

- 💾 SQL Ready
- 🧙 Config Wizard
- 🎨 UX Sutil
- 🔐 Guardia del Login
- 🧭 Navegador Semántico
  🧙‍♂️ Admin total
- 💬 Sistema de comentarios activo
- 📝 Editor con Markdown
- 🧹 Cazador de errores
- 📦 Git Habituado 
- 🔍 Buscador
- ✈️ Deploy final

---
>“Things are only impossible until they are not.”   
>*— Captain Jean-Luc Picard*