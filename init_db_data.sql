-- create table nov_users
CREATE TABLE nov_users (
	id bigserial NOT NULL,
	lastname varchar NULL,
	firstname varchar NULL,
	email varchar NOT NULL,
	password varchar NOT NULL,
	CONSTRAINT nov_users_pk PRIMARY KEY (id),
	CONSTRAINT nov_users_un UNIQUE (email)
);

-- insert data
INSERT INTO nov_users (lastname,firstname,email,password) VALUES 
('DOE','John','john.doe@les-enovateurs.com','azerty')
,('DOE','Louise','louise.doe@les-enovateurs.com','uiopq')
,('DOE','Sébastien','sebastien.doe@les-enovateurs.com','qsdf')
,('DOE','Camille','camille.doe@les-enovateurs.com','ghjk')
,('DOE','Damien','damien.doe@les-enovateurs.com','lmwx')
,('DOE','Sandrine','sandrine.doe@les-enovateurs.com','cvbn')
,('DOE','Philippe','philippe.doe@les-enovateurs.com','mlkj');

CREATE TABLE cours (
	id bigserial NOT NULL,
	lastname varchar NOT NULL,
	description varchar NULL,
	nov_users_id  bigint NOT NULL REFERENCES nov_users (id),
	CONSTRAINT cours_pk PRIMARY KEY (id)
);

INSERT INTO cours (lastname, description, nov_users_id) VALUES
('Phalcon 3', 'Développez des applications web complexes et performantes en PHP.', 1),
('Docker', 'Développez des architectures performantes.', 2),
('AWS', 'Travaillez sur le cloud.', 3),
('Git', 'Versionnez votre code.', 4),
('Photoshop', 'Apprenez à retoucher vos photo.', 5),
('Illustrator', 'Créez des images vectorielles.', 6);
