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
);
INSERT INTO Etape (nomEtape, longueur, nbCoureur, rang, rangPoints) VALUES ('Etape de Betsizaraina', 30.5, 2, 1);
INSERT INTO Etape (nomEtape, longueur, nbCoureur, rang, rangPoints) VALUES ('Etape de Vatomandry', 45, 2, 2);
INSERT INTO Etape (nomEtape, longueur, nbCoureur, rang, rangPoints) VALUES ('Etape d''Ampasimbe', 35, 1, 3);

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

INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 1, 10);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 2, 6);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 3, 4);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 4, 2);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (2, 5, 1);

INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 1, 10);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 2, 6);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 3, 4);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 4, 2);
INSERT INTO EtapePoints (idEtape, rang, points) VALUES (3, 5, 1);

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

CREATE TABLE CategorieCoureur (
    idCategorieCoureur SERIAL PRIMARY KEY,
    idCoureur int NOT NULL,
    idCategorie int NOT NULL,
    FOREIGN KEY (idCoureur) REFERENCES Coureur(idCoureur),
    FOREIGN KEY (idCategorie) REFERENCES Categorie(idCategorie)
);
INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (1, 1);
INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (2,2);

INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (3, 1);
INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (4,2);

INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (5, 1);
INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (6,2);
------------------------
INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (1, 4);
INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (2,4);

INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (3, 3);
INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (4,4);

INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (5, 4);
INSERT INTO CategorieCoureur (idCoureur, idCategorie) VALUES (6,4);


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

-----------------View qui donne le classement d'un coureur dans une etape par rapport aux durees
-- CREATE OR REPLACE View ViewClassementCoureurEtape AS
-- SELECT
--     rc.idEtape,
--     et.rang AS rangEtape,
--     SUM(rc.duree) AS dureeEtape,
--     rc.idcoureur,
-- 	c.nomcoureur,
--     ROW_NUMBER() OVER(PARTITION BY rc.idEtape ORDER BY SUM(rc.duree)) AS classement
-- FROM
--     ResultatCoureur rc
-- JOIN
--     Coureur c ON rc.idCoureur = c.idCoureur
-- JOIN Etape et ON rc.idEtape = et.idEtape 
-- GROUP BY
--     rc.idEtape,
--     rc.idcoureur,
-- 	c.nomcoureur,
--     et.rang
-- ORDER BY
--     rc.idEtape ASC;

CREATE OR REPLACE VIEW ViewClassementCoureurEtape AS
SELECT
    rc.idEtape,
    et.rang AS rangEtape,
    SUM(rc.duree) AS dureeEtape,
    rc.idcoureur,
    c.nomcoureur,
    DENSE_RANK() OVER(PARTITION BY rc.idEtape ORDER BY SUM(rc.duree)) AS classement
FROM
    ResultatCoureur rc
JOIN
    Coureur c ON rc.idCoureur = c.idCoureur
JOIN
    Etape et ON rc.idEtape = et.idEtape 
GROUP BY
    rc.idEtape,
    rc.idcoureur,
    c.nomcoureur,
    et.rang
ORDER BY
    rc.idEtape ASC;
    
-----------------View qui donne les points par rapport aux classements d'un coureur dans une etape 
CREATE OR REPLACE VIEW ViewPointsCoureurEtape AS
SELECT
    et.nomEtape,
    v.idEtape,
    v.rangEtape,
    v.nomcoureur,
    v.dureeEtape,
    v.classement,
    v.idcoureur,
    e.nomEquipe,
    COALESCE(SUM(ep.points), 0) AS points
FROM
    ViewClassementCoureurEtape v
LEFT JOIN
    EtapePoints ep ON v.idEtape = ep.idEtape AND v.classement = ep.rang
JOIN coureur c on c.idcoureur= v.idcoureur
JOIN equipe e on e.idequipe=c.idequipe
JOIN etape et ON et.idetape = v.idetape
GROUP BY
	et.nomEtape,
    v.idEtape,
    v.rangEtape,
    v.nomcoureur,
    v.dureeEtape,
    v.classement,
    v.idcoureur,
    e.nomEquipe
ORDER BY v.idEtape, v.classement ASC; 

--------------ou 
SELECT
    et.nomEtape,
    v.idEtape,
    v.rangEtape,
    v.nomcoureur,
    v.dureeEtape,
    v.classement,
    v.idcoureur,
    e.nomEquipe,
    CASE 
        WHEN v.classement = 1 THEN 10
        WHEN v.classement = 2 THEN 6
        WHEN v.classement = 3 THEN 4
        WHEN v.classement = 4 THEN 2
        WHEN v.classement = 5 THEN 1
        ELSE 0
    END AS points
FROM
    ViewClassementCoureurEtape v
JOIN
    Coureur c ON c.idcoureur = v.idcoureur
JOIN
    Equipe e ON e.idequipe = c.idequipe
JOIN etape et ON et.idetape = v.idetape
ORDER BY
    v.idEtape, v.classement ASC;
-----------------------------

CREATE OR REPLACE VIEW ViewClassementGeneral AS
SELECT
    v.nomEquipe,
    DENSE_RANK() OVER (ORDER BY SUM(points) DESC) AS classementGeneral,
    SUM(points) AS totalPoints
FROM
    ViewPointsCoureurEtape v
GROUP BY
    v.nomEquipe;

--------------------------- Classement generale coureur
CREATE OR REPLACE VIEW ViewClassementGeneralCoureur AS

SELECT
    c.nomcoureur,
    DENSE_RANK() OVER (ORDER BY SUM(points) DESC) AS classementGeneral,
    SUM(points) AS totalPoints
FROM
    ViewPointsCoureurEtape v
JOIN coureur c on c.idcoureur= v.idcoureur
GROUP BY
    c.nomcoureur;

--------------------------- Details etape coureur

CREATE OR REPLACE View ViewEtapeCoureur as
SELECT e.rang,e.idetape,e.nomEtape,eq.idEquipe,eq.nomEquipe,c.idcoureur,c.nomCoureur
FROM etape e
JOIN etapecoureur ec ON ec.idetape = e.idetape
JOIN coureur c ON ec.idcoureur = c.idcoureur
JOIN equipe eq ON eq.idequipe = c.idequipe;

-- ROW_NUMBER() OVER(PARTITION BY rc.idEtape ORDER BY SUM(rc.duree) DESC) AS classement

select etape.*,coureur.nomCoureur 
from etape
join etapecoureur on etape.idEtape = etapecoureur.idEtape
join coureur on etapecoureur.idCoureur = coureur.idCoureur



INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 13, 1, 1, '10:25:34', '12:25:35', 7201);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 14, 2, 1, '10:25:34', '12:30:34', 7500);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 15, 3, 1, '10:25:34', '12:30:00', 7466);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 16, 5, 1, '10:25:34', '12:45:00', 8366);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 18, 4, 1, '10:25:34', '12:40:00', 8066);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 19, 6, 1, '10:25:34', '12:50:34', 8700);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 20, 1, 2, '12:25:36', '15:00:00', 9264);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 21, 2, 2, '12:30:35', '15:15:00', 9865);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 22, 3, 2, '12:30:01', '15:30:00', 10799);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 23, 5, 2, '12:45:01', '15:40:00', 10499);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 24, 4, 2, '12:40:01', '15:20:00', 9599);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 25, 6, 2, '12:50:35', '15:25:35', 9300);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 26, 1, 3, '15:00:01', '01:00:00', 35999);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 28, 3, 3, '15:15:01', '01:15:00', 35999);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree ) VALUES ( 29, 4, 3, '15:20:01', '01:30:00', 36599);

INSERT INTO "public".resultatcoureur(idresultatcoureur, idcoureur, idetape, heuredebut, heurefin, duree)
VALUES
(13, 1, 1, '10:25:34', '12:25:35', '7201 seconds'::interval),
(14, 2, 1, '10:25:34', '12:30:34', '7500 seconds'::interval),
(15, 3, 1, '10:25:34', '12:30:00', '7466 seconds'::interval),
(16, 5, 1, '10:25:34', '12:45:00', '8366 seconds'::interval),
(18, 4, 1, '10:25:34', '12:40:00', '8066 seconds'::interval),
(19, 6, 1, '10:25:34', '12:50:34', '8700 seconds'::interval),
(20, 1, 2, '12:25:36', '15:00:00', '9264 seconds'::interval),
(21, 2, 2, '12:30:35', '15:15:00', '9865 seconds'::interval),
(22, 3, 2, '12:30:01', '15:30:00', '10799 seconds'::interval),
(23, 5, 2, '12:45:01', '15:40:00', '10499 seconds'::interval),
(24, 4, 2, '12:40:01', '15:20:00', '9599 seconds'::interval),
(25, 6, 2, '12:50:35', '15:25:35', '9300 seconds'::interval),
(26, 1, 3, '15:00:01', '01:00:00', '35999 seconds'::interval),
(28, 3, 3, '15:15:01', '01:15:00', '35999 seconds'::interval),
(29, 4, 3, '15:20:01', '01:30:00', '36599 seconds'::interval);


--------------------------------fonction import

INSERT INTO "public".resultatcoureur(idresultatcoureur, idcoureur, idetape, heuredebut, heurefin)
VALUES 
(13, 1, 1, '10:25:34', '12:25:35'),
(14, 2, 1, '10:25:34', '12:30:34'),
(15, 3, 1, '10:25:34', '12:30:00'),
(16, 5, 1, '10:25:34', '12:45:00'),
(18, 4, 1, '10:25:34', '12:40:00'),
(19, 6, 1, '10:25:34', '12:50:34'),
(20, 1, 2, '12:25:36', '15:00:00'),
(21, 2, 2, '12:30:35', '15:15:00'),
(22, 3, 2, '12:30:01', '15:30:00'),
(23, 5, 2, '12:45:01', '15:40:00'),
(24, 4, 2, '12:40:01', '15:20:00'),
(25, 6, 2, '12:50:35', '15:25:35'),
(26, 1, 3, '15:00:01', '01:00:00'),
(28, 3, 3, '15:15:01', '01:15:00'),
(29, 4, 3, '15:20:01', '01:30:00');

UPDATE "public".resultatcoureur
SET duree = CASE
    WHEN heurefin < heuredebut THEN
        -- Calculer la durée depuis heuredebut jusqu'à minuit
        (INTERVAL '24 hours' - heuredebut::time + heurefin::time)::time
    ELSE
        -- Calculer la durée normale
        (heurefin::time - heuredebut::time)::time
END;
