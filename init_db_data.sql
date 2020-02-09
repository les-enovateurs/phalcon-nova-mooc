-- creation de la table utilisateurs
CREATE TABLE utilisateurs (
	id bigserial NOT NULL,
	nom varchar NULL,
	prenom varchar NULL,
	email varchar NOT NULL,
	mot_de_passe varchar NOT NULL,
	CONSTRAINT utilisateurs_pk PRIMARY KEY (id),
	CONSTRAINT utilisateurs_un UNIQUE (email)
);

-- insertion des données
INSERT INTO utilisateurs (nom,prenom,email,mot_de_passe) VALUES 
('DOE','John','john.doe@les-enovateurs.com','azerty')
,('DOE','Louise','louise.doe@les-enovateurs.com','uiopq')
,('DOE','Sébastien','sebastien.doe@les-enovateurs.com','qsdf')
,('DOE','Camille','camille.doe@les-enovateurs.com','ghjk')
,('DOE','Damien','damien.doe@les-enovateurs.com','lmwx')
,('DOE','Sandrine','sandrine.doe@les-enovateurs.com','cvbn')
,('DOE','Philippe','philippe.doe@les-enovateurs.com','mlkj');

CREATE TABLE cours (
	id bigserial NOT NULL,
	nom varchar NOT NULL,
	description varchar NULL,
	utilisateurs_id  bigint NOT NULL REFERENCES utilisateurs (id),
	CONSTRAINT cours_pk PRIMARY KEY (id)
);

INSERT INTO cours (nom, description, utilisateurs_id) VALUES
('Phalcon 3', 'Développez des applications web complexes et performantes en PHP.', 1),
('Docker', 'Développez des architectures performantes.', 2),
('AWS', 'Travaillez sur le cloud.', 3),
('Git', 'Versionnez votre code.', 4),
('Photoshop', 'Apprenez à retoucher vos photo.', 5),
('Illustrator', 'Créez des images vectorielles.', 6);
