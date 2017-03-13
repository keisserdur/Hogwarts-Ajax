create database actividades default character set utf8 collate utf8_unicode_ci;

create user actividades@localhost identified by 'actividades';

grant all on actividades.* to actividades@localhost;

flush privileges;

use actividades;

create table profesor (
    idProfesor int auto_increment primary key,
    nick varchar(100) unique,
    password varchar(256) not null,
    departamento varchar(150) default 'Sin departamento',
    administrador tinyint not null
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;

insert into profesor(nick, password, departamento, administrador) values ('carmelo','carmelo','Informatica',1); 
INSERT INTO profesor(nick, password, departamento, administrador) values ('mode','mode','Informatica',1); 
INSERT INTO profesor(nick, password, departamento, administrador) values ('aurora','aurora','Informatica',0);
INSERT INTO profesor(nick, password, administrador) values ('maria','maria',0);
INSERT INTO profesor(nick, password, administrador) values ('pilar','pilar',0);



create table grupo (
    idGrupo int auto_increment primary key,
    nombre varchar(150) not null,
    nivel varchar(100)
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;

insert into grupo(nombre, nivel) values ('Desarollo de aplicaciones multiplataforma','1');
insert into grupo(nombre, nivel) values ('Desarollo de aplicaciones multiplataforma','2');
insert into grupo(nombre, nivel) values ('Desarollo de aplicaciones web','1');
insert into grupo(nombre, nivel) values ('Desarollo de aplicaciones web','2');
insert into grupo(nombre, nivel) values ('E.S.O','1A');
insert into grupo(nombre, nivel) values ('E.S.O','1B');
insert into grupo(nombre, nivel) values ('E.S.O','2A');
insert into grupo(nombre, nivel) values ('E.S.O','2B');
insert into grupo(nombre, nivel) values ('E.S.O','3A');
insert into grupo(nombre, nivel) values ('E.S.O','3B');
insert into grupo(nombre, nivel) values ('E.S.O','4A');
insert into grupo(nombre, nivel) values ('E.S.O','4B');

create table actividad (
    idActividad int auto_increment primary key,
    idProfesor int not null,
    idGrupo int not null,
    tituloCorto varchar(100) not null,
    description varchar(500) default 'No existe una descripcion',
    fecha date not null,
    lugar varchar(150) not null,
    horaInicio time not null,
    horaFinal time not null,
    foto varchar(150)
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;

insert into actividad(idProfesor, idGrupo,tituloCorto,descritcion,fecha,lugar,horaInicio,horaFinal) values (1,4, 'Visita Central Electrica', 'La visita a la central de ...', '2017-02-25', 'Guadix', '09:30:00', '14:30:00');
insert into actividad(idProfesor, idGrupo,tituloCorto,description,fecha,lugar,horaInicio,horaFinal) values (3,2, 'Visita Puerto', 'La visita al puerto matirimo de ...', '2017-03-15', 'Motril', '08:00:00', '15:00:00');
insert into actividad(idProfesor, idGrupo,tituloCorto,description,fecha,lugar,horaInicio,horaFinal) values (4,7, 'Visita Alhambra', 'La visita al monumeto marroqui de la alhambra ...', '2017-02-11', 'Granada', '09:15:00', '14:30:00');