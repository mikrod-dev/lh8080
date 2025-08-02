# 💡 Blog `lh:8080 | De localhost 🖥️ al mundo 🌍`

![Progreso](https://img.shields.io/badge/Nivel-9%2F20-yellow?style=flat-square)
![Estado](https://img.shields.io/badge/Estado-En%20desarrollo-orange?style=flat-square)
![Última actualización](https://img.shields.io/badge/Actualizado-junio%202025-informational?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=flat-square&logo=php)
![Docker](https://img.shields.io/badge/Docker-compose-blue?style=flat-square&logo=docker)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?style=flat-square&logo=bootstrap)
![Frontend Stack](https://img.shields.io/badge/Frontend-HTML%20%7C%20CSS%20%7C%20JS-blue?style=flat-square&logo=html5&logoColor=white)
![License](https://img.shields.io/badge/Licencia-MIT-green?style=flat-square)


---

> "De localhost al mundo" — Un blog personal construido desde cero con PHP, MySQL, Apache2, Docker, Bootstrap y muuucha paciencia.

---

## 🚀 ¿Qué es esto?

Este proyecto es un blog personal, creado sin frameworks ni CMS. Pensado como parte de un proceso de *aprender haciendo*, planificando estructura y desarrollo progresivo. En el que puedo aplicar los conceptos aprendidos en la facultad, cursos, documentación, tutoriales y apoyo incondicional de la ia.

Llevo mucho tiempo buscando aplicar lo que aprendí y sigo aprendiendo en diversos entornos y se me ocurrió movilizar este proyecto para solidificar conceptos e ir probando y aprendiendo cosas nuevas. Además, se me ocurrió gamificarlo para que el proceso sea divertido y motivador.

El "juego" de armar este blog es como un RPG lleno de: misiones, buscar tutoriales y foros, algo de *grind*, y recompensas virtuales.

### 🧩 Características principales

- 🧱 Estructura semántica con HTML y reutilizable con PHP
- 🐳 Docker para facilitar entornos
- 👤 Login y registro de usuarios
- 🧙‍♂️ Panel de usuario y panel admin
- 📝 Publicaciones con soporte Markdown
- 💬 Sistema de comentarios y buscador
- 🔐 Seguridad, validación y control de acceso

---

## 🛠️ Tecnologías

| Herramienta   | Propósito                          |
|---------------|------------------------------------|
| PHP 8.2       | Backend y lógica                   |
| MySQL         | Almacenamiento de usuarios y posts |
| Docker        | Entorno de desarrollo portable     |
| HTML, CSS, JS | Frontend básico                    |
| Bootstrap 5.3 | Diseño responsivo, rápido y limpio |
| Git           | Control de versiones               |



---

## 📁 Estructura de carpetas actual

```markdown
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

## 🧱 Progreso

El archivo [history.md](history.md) contiene los niveles superados y logros desbloqueados

## Badges Adquiridos

- 🛠️ Dockerize It!
- 🔗 Modularizador
- 🧾 Form Master
- 📁 Arquitecto de carpetas
- 🧠 Estratega de rutas
- 🪪 Gestor de identidades
- 🧰 Arquitecto de la seguridad
- 🧙 Config Wizard
- 🔐 Guardia del Login

## 📌 Funcionalidades previstas

- [x] Diseño inicial responsive
- [x] Navegación entre secciones
- [x] Sistema de partials reutilizables
- [x] Panel de usuario y admin con subdominio
- [x] Autenticación (login/signup para admin)
- [x] Base de datos para posts y usuarios
- [x] Routing personalizado con configuración de Apache y la clase Router
- [ ] Crear y editar publicaciones desde el panel admin
- [ ] Markdown + vista previa para posts
- [ ] Buscador interno

## 🏁 Objetivos

- Aprender desarrollo web fullstack sin frameworks
- Aprender y poner en práctica conceptos de ciberseguridad 
- Comprender estructura de un blog funcional paso a paso
- Documentar desarrollo, errores, soluciones y decisiones técnicas en cada etapa

## 📄 Licencia
Este proyecto está licenciado bajo la Licencia MIT — ver el archivo LICENSE para más información.

---
**Por Mik ❤️‍🔥 - 2025**  
*De localhost 🖥️ al mundo 🌍*