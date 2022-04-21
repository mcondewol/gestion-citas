CREATE DATABASE zambos_pic;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    correo VARCHAR(255),
    clave VARCHAR(255),
    url_foto VARCHAR(255),
    tipo INT,
    ultimolog DATETIME,
    estado INT
);

CREATE TABLE categorias(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    estado INT
);

CREATE TABLE galeria(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT,
    id_usuario INT,
    url_foto VARCHAR(255),
    fecha_publicacion DATETIME,
    estado INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE log_sesion(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    ip VARCHAR(255),
    fecha DATETIME,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);