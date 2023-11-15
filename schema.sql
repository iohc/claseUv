drop database webClass;
create database webClass;
	use webClass;

	create table user(
			id int not null auto_increment primary key,
			nombre varchar (50),
			apellido varchar (220),
			username varchar(90),
			password varchar(220),
			email varchar(120),
			kind int default 1,
			status int default 1, /*1 visible, 0 no visible.*/


			updated_at datetime,
			created_at datetime
		);



	insert into user (nombre,apellido,username,password,email) values (
			"Crack",
			"",
			"crack",
			sha1(md5("qwerty")),
			"crack@man.org"
		)

