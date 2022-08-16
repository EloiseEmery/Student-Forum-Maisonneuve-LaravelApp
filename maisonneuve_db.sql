CREATE TABLE langues (
    id smallint(6) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    lang varchar(40) NOT NULL
);

CREATE TABLE caterogies (
    id smallint(6) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	nom varchar(40) NOT NULL
);