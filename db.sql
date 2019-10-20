DROP DATABASE IF EXISTS products_test;
create database products_test;
create table type_product(
    id_type int auto_increment,
    name_type varchar(25) not null,
	PRIMARY KEY (id_type)

)ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;
insert into type_product(name_type) 
    values
    ("zapatos"),
    ("camisas"),
    ("bolsos"),
    ("pantalones"),
    ("busos"),
    ("Carteras");

create table product(
    id int auto_increment,
	name varchar(25) not null,
    url_image varchar(70) not null,
	description varchar(50) not null,
    type_id int not null,
    created_at date not null,
    update_at datetime on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (id),
	FOREIGN KEY (type_id) REFERENCES type_product(id_type)
)ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;
insert into product (name, description , url_image, type_id, created_at)
    values ( "Zapato Lm" ,"Description zapato" ,"assets/images/products/z2.jpg",1,now()),
    ( "Camisa VIP" ,"Description Camisa VIP" ,"assets/images/products/vip.jpg",2,now()),
    ( "Zapato Pastel" ,"Description zapato Pastel" ,"assets/images/products/z.jpg",1,now()),
    ( "Bolso s" ,"Description Bolso s" ,"assets/images/products/bolso.jpg",3,now()),
    ( "Pantalones Cora" ,"Description Pantalones Cora" ,"assets/images/products/cora.jpg",4,now()),
    ( "Pantalones Suaves" ,"Description Pantalones Suaves" ,"assets/images/products/suave.jpg",4,now()),
    ( "Camisa sass" ,"Description Camisa sass" ,"assets/images/products/sass.jpg",2,now());