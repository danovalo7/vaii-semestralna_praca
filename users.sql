create or replace table vaii_semestralna_praca.users
(
	user_id int auto_increment
		primary key,
	user_name varchar(63) not null,
	user_pass varchar(127) not null,
	user_email varchar(127) not null,
	constraint user_name_UNIQUE
		unique (user_name)
)
collate=utf8mb4_unicode_ci;

