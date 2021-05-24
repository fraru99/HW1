create table TRENO
(
	codice integer primary key auto_increment,
    capienza_massima integer,
    velocita_massima integer,
    anno integer,
    tipologia varchar(255),
    nome varchar(255),
    descrizione text(1000),
    immagine varchar(300)
);


create table PACCHETTI
(
	id integer primary key auto_increment,
    nome varchar(255),
    descrizione text(500),
    sotto_descrizione varchar(255),
    immagine varchar(300),
    tipologia varchar(255),
    prezzo float,
    n_acquisti integer default 0
);

create table CARRELLO
(
	id integer primary key auto_increment,
    id_pacchetto integer,
	index idx_pacchetto(id_pacchetto),
    foreign key(id_pacchetto) references PACCHETTI(id),
    
    id_utente integer,
    index idx_utente(id_utente),
    foreign key(id_utente) references CREDENZIALI(id)
);

create table CREDENZIALI
(
	id integer primary key auto_increment,
	username varchar(255) not null unique,
    password text(500) not null,
    mail varchar(255) not null unique,
    nome varchar(255) not null,
    cognome varchar(255) not null,
    oggetti_carrello integer default 0
);


DELIMITER //
CREATE TRIGGER add_carrello
AFTER INSERT ON carrello
FOR EACH ROW
BEGIN
UPDATE credenziali
SET oggetti_carrello = oggetti_carrello + 1
WHERE id = new.id_utente;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER remove_carrello
AFTER DELETE ON carrello
FOR EACH ROW
BEGIN
UPDATE credenziali
SET oggetti_carrello = oggetti_carrello - 1
WHERE id = old.id_utente;
END //
DELIMITER ;



