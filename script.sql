CREATE TABLE Equipe (
    idEquipe SERIAL PRIMARY KEY,
    identifiant VARCHAR(200) NOT NULL,
    nomEquipe VARCHAR(200) NOT NULL,
    password VARCHAR(200)
);
INSERT INTO Equipe (nomEquipe,identifiant,password) VALUES ('Equipe 1','equipe1', '123');
INSERT INTO Equipe (nomEquipe,identifiant,password) VALUES ('Equipe 2','equipe2', '123');  
INSERT INTO Equipe (nomEquipe,identifiant,password) VALUES ('Equipe 3','equipe3', '123');  

CREATE TABLE Etape (
    idEtape SERIAL PRIMARY KEY,
    nomEtape VARCHAR(200) NOT NULL,
    longueur NUMERIC(20,2) NOT NULL,
    nbCoureur int NOT NULL,
    rang int NOT NULL,
    rangPoints int[] default '{}'
);
INSERT INTO Etape (nomEtape, longueur, nbCoureur, rang, rangPoints) VALUES ('Etape de Betsizaraina', 30.5, 2, 1, '{10, 6, 4, 2, 1}');
INSERT INTO Etape (nomEtape, longueur, nbCoureur, rang, rangPoints) VALUES ('Etape de Vatomandry', 45, 2, 2, '{12, 10, 8, 6, 4}');
INSERT INTO Etape (nomEtape, longueur, nbCoureur, rang, rangPoints) VALUES ('Etape d''Ampasimbe', 35, 1, 3, '{10, 8, 6, 5, 4}');

CREATE TABLE EtapePoints (
    idEtapePoints SERIAL PRIMARY KEY,
    idEtape int NOT NULL,
    rang int NOT NULL,
    points int NOT NULL,
    FOREIGN KEY (idEtape) REFERENCES Etape(idEtape)
);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (1, 1, 10);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (1, 2, 6);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (1, 3, 4);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (1, 4, 2);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (1, 5, 1);

INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 1, 12);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 2, 10);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 3, 8);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 4, 6);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 5, 4);

INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 1, 10);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 2, 8);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 3, 6);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 4, 5);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 5, 4);

CREATE TABLE Coureur (
    idCoureur SERIAL PRIMARY KEY,
    nomCoureur VARCHAR(200) NOT NULL,
    numero VARCHAR (200) NOT NULL,
    genre VARCHAR(200) NOT NULL,
    dateNaisance DATE NOT NULL,
    idEquipe int NOT NULL,
    FOREIGN KEY (idEquipe) REFERENCES Equipe(idEquipe)
);
INSERT INTO Coureur (nomCoureur, numero, genre, dateNaisance) VALUES ('Lova', '1', 'M', '1990-01-01',1);
INSERT INTO Coureur (nomCoureur, numero, genre, dateNaisance) VALUES ('Sabrina', '2', 'F', '1995-11-01',1);


INSERT INTO Coureur (nomCoureur, numero, genre, dateNaisance) VALUES ('Justin', '11', 'M', '2006-05-01',2);
INSERT INTO Coureur (nomCoureur, numero, genre, dateNaisance) VALUES ('Vero', '12', 'F', '1990-06-01',2);

INSERT INTO Coureur (nomCoureur, numero, genre, dateNaisance) VALUES ('John', '21', 'M', '1990-02-01',3);
INSERT INTO Coureur (nomCoureur, numero, genre, dateNaisance) VALUES ('Jill', '22', 'F', '1995-03-01',3);

CREATE TABLE Categorie (
    idCategorie SERIAL PRIMARY KEY,
    nomCategorie VARCHAR(200) NOT NULL
);
INSERT INTO Categorie (nomCategorie) VALUES ('Homme');
INSERT INTO Categorie (nomCategorie) VALUES ('Femme');
INSERT INTO Categorie (nomCategorie) VALUES ('Junior');
INSERT INTO Categorie (nomCategorie) VALUES ('Senior');

-- CREATE TABLE EquipeCoureur (
--     idEquipeCoureur SERIAL PRIMARY KEY,
--     idEquipe int NOT NULL,
--     idCoureur int NOT NULL,
--     FOREIGN KEY (idEquipe) REFERENCES users(id),
--     FOREIGN KEY (idCoureur) REFERENCES Coureur(idCoureur)
-- );
-- INSERT INTO EquipeCoureur (idEquipe, idCoureur) VALUES (1, 1);
-- INSERT INTO EquipeCoureur (idEquipe, idCoureur) VALUES (1, 2);

-- INSERT INTO EquipeCoureur (idEquipe, idCoureur) VALUES (2, 3);
-- INSERT INTO EquipeCoureur (idEquipe, idCoureur) VALUES (2, 4);

-- INSERT INTO EquipeCoureur (idEquipe, idCoureur) VALUES (3, 5);
-- INSERT INTO EquipeCoureur (idEquipe, idCoureur) VALUES (3, 6);

CREATE TABLE EtapeCoureur (
    idEtapeCoureur SERIAL PRIMARY KEY,
    idEtape int NOT NULL,
    idCoureur int NOT NULL,
    FOREIGN KEY (idEtape) REFERENCES Etape(idEtape),
    FOREIGN KEY (idCoureur) REFERENCES Coureur(idCoureur)
);

CREATE TABLE ResultatCoureur (
    idResultatCoureur SERIAL PRIMARY KEY,
    idCoureur int NOT NULL,
    idEtape int NOT NULL,
    heureDebut time NOT NULL,
    heureFin time NOT NULL,
    lendemain bool NOT NULL,
    duree NUMERIC,
    FOREIGN KEY (idCoureur) REFERENCES Coureur(idCoureur),
    FOREIGN KEY (idEtape) REFERENCES Etape(idEtape)
);


-- CREATE OR REPLACE View ViewResultatEquipeEtape AS
-- select rc.idEtape, sum(rc.duree) as dureeEtape,e.nomEquipe
-- from ResultatCoureur rc
-- join Coureur c on rc.idCoureur = c.idCoureur
-- join Equipe e on c.idEquipe = e.idEquipe
-- group by rc.idEtape,e.nomEquipe order by rc.idEtape asc;

-----------------View qui donne le classement d'une equipe dans une etape par rapport aux durees
CREATE OR REPLACE View ViewClassementEquipeEtape AS
SELECT
    rc.idEtape,
    et.rang AS rangEtape,
    SUM(rc.duree) AS dureeEtape,
    e.nomEquipe,
    ROW_NUMBER() OVER(PARTITION BY rc.idEtape ORDER BY SUM(rc.duree)) AS classement
FROM
    ResultatCoureur rc
JOIN
    Coureur c ON rc.idCoureur = c.idCoureur
JOIN
    Equipe e ON c.idEquipe = e.idEquipe
JOIN Etape et ON rc.idEtape = et.idEtape
GROUP BY
    rc.idEtape,
    e.nomEquipe,
    et.rang
ORDER BY
    rc.idEtape ASC;

    
-----------------View qui donne les points par rapport aux classements d'une equipe dans une etape 
CREATE OR REPLACE VIEW ViewPointsEquipeEtape AS
SELECT
    v.idEtape,
    v.rangEtape,
    v.nomEquipe,
    v.classement,
    SUM(ep.points) AS points
FROM
    ViewClassementEquipeEtape v
JOIN
    EtapePoints ep ON v.idEtape = ep.idEtape AND v.classement = ep.rang
GROUP BY
    v.idEtape,
    v.rangEtape,
    v.nomEquipe,
    v.classement;


CREATE OR REPLACE VIEW ViewClassementGeneralEtape AS
SELECT
    nomEquipe,
    ROW_NUMBER() OVER (ORDER BY SUM(points) DESC) AS classementGeneral,
    SUM(CASE WHEN rangEtape = 1 THEN points ELSE 0 END) AS pointsEtape1,
    SUM(CASE WHEN rangEtape = 2 THEN points ELSE 0 END) AS pointsEtape2,
    SUM(CASE WHEN rangEtape = 3 THEN points ELSE 0 END) AS pointsEtape3,
    SUM(CASE WHEN rangEtape = 4 THEN points ELSE 0 END) AS pointsEtape4,
    SUM(CASE WHEN rangEtape = 5 THEN points ELSE 0 END) AS pointsEtape5
FROM
    ViewPointsEquipeEtape
GROUP BY
    nomEquipe;

CREATE OR REPLACE VIEW ViewClassementGeneral AS
SELECT
    nomEquipe,
    ROW_NUMBER() OVER (ORDER BY SUM(points) DESC) AS classementGeneral,
    SUM(points) AS totalPoints
FROM
    ViewPointsEquipeEtape
GROUP BY
    nomEquipe;


-- ROW_NUMBER() OVER(PARTITION BY rc.idEtape ORDER BY SUM(rc.duree) DESC) AS classement

