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

***

### 📌 Estado actual del proyecto

- ✅ Sitio funcional con rutas básicas `/index.php`, `/login.php`, `/signup.php`
- ✅ HTML estructurado semánticamente
- 🧩 Bootstrap 5 sin clases custom
- 🧪 Probado en Docker
- 🔐 Preparado para implementar autenticación
- 📄 Base lista para iniciar sistema de rutas


### 🚧 Próximas etapas

- [ ] Nivel 6: Implementar validaciones frontend y backend de login/signup
- [ ] Nivel 7: Crear panel dashboard
- [ ] Nivel 8: CRUD de posts con editor Markdown
- [ ] Nivel 9: Crear router simple en PHP y centralizar rutas
- [ ] Nivel 10: Sistema de comentarios
- [ ] Nivel 11: Buscador por palabra clave y categoría
- [ ] Nivel 12: Roles y permisos
  

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