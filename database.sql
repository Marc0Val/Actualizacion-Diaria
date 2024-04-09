-- modelo de base de datos usada xdxd
create database IF NOT EXISTS `dshit`
create table usuario (
    nombreUser varchar(10) not null primary key,
    password varchar(10) not null
);
alter table usuario add column rol varchar(10) not null;
CREATE TABLE imagen (
    idImagen INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ruta VARCHAR(100) NOT NULL
);
CREATE TABLE publicacion (
    idPublicacion INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(10) NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    idImagen INT,
    FOREIGN KEY (usuario) REFERENCES usuario(nombreUser),
    FOREIGN KEY (idImagen) REFERENCES imagen(idImagen)
);
create table usuarioPendiente (
    idpendiente INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombrependiente VARCHAR(20) NOT NULL,
    nombreUser varchar(10) not null,
    password varchar(10) not null,
);