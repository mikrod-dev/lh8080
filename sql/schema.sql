-- Crear base de datos
-- codificación utf8mb4 (soporta hasta 4 bytes por caracter,
-- representa toda la gama unicode, emojis y símbolos especiales)
CREATE
    DATABASE IF NOT EXISTS blog_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE
    blog_db;

-- Tabla de usuarios
CREATE TABLE users
(
    user_id       INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100) NOT NULL,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role          ENUM ('admin', 'user') DEFAULT 'user',
    avatar_url    VARCHAR(255)           DEFAULT NULL,
    is_active     BOOLEAN                DEFAULT TRUE,
    last_login    TIMESTAMP    NULL,
    preferred_language VARCHAR(2) DEFAULT 'es',
    created_at    TIMESTAMP              DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP              DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE = InnoDB;


-- Tabla de categorías
CREATE TABLE categories
(
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    slug        VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- Tabla de posts
CREATE TABLE posts
(
    post_id          INT AUTO_INCREMENT PRIMARY KEY,
    author_id        INT          NOT NULL,
    category_id      INT,
    title            VARCHAR(255) NOT NULL,
    slug             VARCHAR(255) NOT NULL UNIQUE,
    content          LONGTEXT     NOT NULL,
    excerpt          TEXT,
    is_published     BOOLEAN               DEFAULT FALSE,
    published_at     TIMESTAMP    NULL,
    meta_description VARCHAR(255),
    views            INT UNSIGNED NOT NULL DEFAULT 0,
    is_deleted       BOOLEAN               DEFAULT FALSE,
    created_at       TIMESTAMP             DEFAULT CURRENT_TIMESTAMP,
    updated_at       TIMESTAMP             DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users (user_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories (category_id) ON DELETE SET NULL,
    INDEX idx_slug (slug),
    INDEX idx_author_id (author_id),
    INDEX idx_category_id (category_id),
    INDEX idx_published_at (is_published),
    INDEX idx_created_at (created_at)
) ENGINE = InnoDB;

-- Tabla de imágenes
CREATE TABLE post_images
(
    image_id       INT PRIMARY KEY AUTO_INCREMENT,
    post_id        INT          NOT NULL,
    image_path     VARCHAR(255) NOT NULL,
    image_alt      VARCHAR(150),
    caption        VARCHAR(255),
    is_featured    BOOLEAN   DEFAULT FALSE,
    is_thumbnail   BOOLEAN   DEFAULT FALSE,
    is_deleted     BOOLEAN   DEFAULT FALSE,
    uploaded_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts (post_id) ON DELETE CASCADE,
    featured_flag  INT GENERATED ALWAYS AS (IF(is_featured, post_id, NULL)) VIRTUAL,
    thumbnail_flag INT GENERATED ALWAYS AS (IF(is_thumbnail, post_id, NULL)) VIRTUAL,
    UNIQUE INDEX idx_post_featured (post_id, is_featured),
    UNIQUE INDEX idx_post_thumbnail (post_id, is_thumbnail)
) ENGINE = InnoDB;

-- Tabla pivote para post-likes. 1 like por usuario
CREATE TABLE post_likes
(
    like_id  INT AUTO_INCREMENT PRIMARY KEY,
    post_id  INT NOT NULL,
    user_id  INT NOT NULL,
    liked    BOOLEAN   DEFAULT TRUE,
    liked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (post_id, user_id),
    FOREIGN KEY (post_id) REFERENCES posts (post_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
    INDEX idx_post_id (post_id)
) ENGINE = InnoDB;

-- Tabla para reading lists
CREATE TABLE reading_lists
(
    reading_list_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT          NOT NULL,
    title           VARCHAR(100) NOT NULL,
    description     TEXT,
    is_public       BOOLEAN   DEFAULT TRUE,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Tabla con posts de la reading list
CREATE TABLE reading_list_items
(
    reading_list_id      INT NOT NULL,
    post_id              INT NOT NULL,
    added_at             TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (reading_list_id, post_id),
    FOREIGN KEY (reading_list_id) REFERENCES reading_lists (reading_list_id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts (post_id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Tabla de backlinks para red de conocimientos tipo "segundo cerebro"
CREATE TABLE post_links(
    from_post_id    INT NOT NULL,
    to_post_id      INT NOT NULL,
    PRIMARY KEY (from_post_id, to_post_id),
    FOREIGN KEY (from_post_id) REFERENCES posts (post_id) ON DELETE CASCADE,
    FOREIGN KEY (to_post_id) REFERENCES posts (post_id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Tabla para comentarios
CREATE TABLE comments
(
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id    INT  NOT NULL,
    user_id    INT  NULL,
    content    TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_deleted BOOLEAN   DEFAULT FALSE,
    FOREIGN KEY (post_id) REFERENCES posts (post_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE SET NULL,
    INDEX idx_post_id (post_id)
) ENGINE = InnoDB;

-- Tabla para etiquetas (tags)
CREATE TABLE tags
(
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name   VARCHAR(50) NOT NULL UNIQUE,
    slug   VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB;

-- Tabla pivote post-tag
CREATE TABLE post_tag
(
    post_id INT,
    tag_id  INT,
    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES posts (post_id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags (tag_id) ON DELETE CASCADE,
    INDEX idx_post_id (post_id),
    INDEX idx_tag_id (tag_id)
) ENGINE = InnoDB;


-- Tabla de sesiones
CREATE TABLE sessions
(
    session_id VARCHAR(128) PRIMARY KEY,
    user_id    INT       NOT NULL,
    data       TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
    INDEX idx_expires_at (expires_at)
) ENGINE = InnoDB;
