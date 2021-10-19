DROP TABLE IF EXISTS depart CASCADE;

CREATE TABLE depart
(
    id        bigserial    PRIMARY KEY,
    nombre    varchar(255) NOT NULL,
    localidad varchar(255)
);

INSERT INTO depart (nombre, localidad)
    VALUES ('Contabilidad', 'Sanlúcar'),
           ('Informática', 'Jerez de la Frontera'),
           ('Inglés', 'Londres'),
           ('Matemáticas', 'Trebujena'),
           ('Cibernética', 'Chipiona');
