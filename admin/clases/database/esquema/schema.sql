create database ajax default character set utf8 collate utf8_unicode_ci; /*#cotejar*/

create user uajax@localhost identified by 'pajax';

grant all on ajax.* to uajax@localhost;

flush privileges;

use ajax;

create table user (
    email varchar(150) not null primary key,
    password varchar(256) not null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;