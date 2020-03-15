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

CREATE TABLE nov_courses (
	id bigserial NOT NULL,
	title varchar NOT NULL,
	description varchar NULL,
	nov_users_id  bigint NOT NULL REFERENCES nov_users (id),
	CONSTRAINT courses_pk PRIMARY KEY (id)
);

INSERT INTO nov_courses (title, description, nov_users_id) VALUES
('Phalcon 3', 'Develop complex and powerful web applications in PHP.', 1),
('Docker', 'Develop high-performance architectures.', 2),
('AWS', 'Work on the cloud.', 3),
('Git', 'Learn to versioning code', 4),
('Photoshop', 'Learn how to touch up your photos.', 5),
('Illustrator', 'Create vector images.', 6);
