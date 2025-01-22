CREATE DATABASE Youdemy;

USE Youdemy;

CREATE TABLE Utilisateur (
    Id int PRIMARY KEY AUTO_INCREMENT UNIQUE,
    Nom VARCHAR(15) NOT NULL,
    Email VARCHAR(20) UNIQUE NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    Role ENUM(
        'Etudiant',
        'Enseignant',
        'Administrateur'
    ) DEFAULT 'Etudiant',
    DateCreation DATETIME DEFAULT now()
);

INSERT INTO
    Utilisateur (Nom, Email, PASSWORD, Role)
VALUES (
        'Alice',
        'alice@example.com',
        'password123',
        'Etudiant'
    ),
    (
        'Bob',
        'bob@example.com',
        'password456',
        'Enseignant'
    );

CREATE View Etudiant AS
SELECT
    Id,
    Nom,
    Email,
    PASSWORD,
    DateCreation
FROM Utilisateur
WHERE
    Role = 'Etudiant';

INSERT INTO
    Utilisateur (Nom, Email, PASSWORD, Role)
VALUES (
        'ana',
        'ana@example.com',
        'password123',
        'Etudiant'
    );

CREATE View Enseignant As
SELECT
    Id,
    Nom,
    Email,
    PASSWORD,
    DateCreation
FROM utilisateur
WHERE
    Role = 'Enseignant';

CREATE View Administrateur As
SELECT
    Id,
    Nom,
    Email,
    PASSWORD,
    DateCreation
FROM utilisateur
WHERE
    Role = 'Administrateur';

CREATE Table Cour (
    IdCour int PRIMARY KEY AUTO_INCREMENT UNIQUE,
    NomCour VARCHAR(20) NOT NULL,
    Description TEXT not NULL,
    Video VARCHAR(255),
    image VARCHAR(255),
    document VARCHAR(255),
    Categorie VARCHAR(255),
    Foreign Key (Categorie) REFERENCES Categorie (NomCategorie),
    DateCreation DATETIME DEFAULT now()
);

CREATE Table Categorie (
    NOmCategorie VARCHAR(255) UNIQUE not NULL
);

ALTER Table Categorie 
ADD PRIMARY KEY (NomCategorie);


ALTER Table Cour
ADD COLUMN Enseignant int,
Foreign Key (Enseignant) REFERENCES Utilisateur (Id);


CREATE Table Tag ( NomTag VARCHAR(10) NOT NULL UNIQUE )

use Youdemy;

ALTER TABLE Cour ADD COLUMN Enseignant INT;

ALTER TABLE Cour
ADD Foreign Key (Enseignant) REFERENCES Utilisateur (Id);
ALTER Table Cour 
DROP CONSTRAINT Ensignant FOREIGN KEY  ;

INSERT INTO
    Cour (
        NomCour,
        Description,
        Video,
        Image,
        Document,
        Categorie,
        DateCreation,
        Enseignant
    )
VALUES (
        'Introduction à PHP',
        'Cours pour apprendre les bases de PHP',
        'video1.mp4',
        'image1.png',
        'document1.pdf',
        'Programmation',
        NOW(),
        '4'
    ),
    (
        'Développement Web',
        'Introduction au développement web',
        'video2.mp4',
        'image2.png',
        'document2.pdf',
        'Web',
        NOW(),
        '4'
    ),
    (
        'JavaScript Avancé',
        'Maîtrisez JavaScript moderne',
        'video3.mp4',
        'image3.png',
        'document3.pdf',
        'Programmation',
        NOW(),
        '4'
    ),
    (
        'Bases de données',
        'Apprenez SQL et la gestion des bases',
        'video4.mp4',
        'image4.png',
        'document4.pdf',
        'Bases de Données',
        NOW(),
        '4'
    ),
    (
        'Introduction à Python',
        'Apprenez Python pour les débutants',
        'video5.mp4',
        'image5.png',
        'document5.pdf',
        'Programmation',
        NOW(),
        '4'
    ),
    (
        'HTML et CSS',
        'Création de pages web avec HTML et CSS',
        'video6.mp4',
        'image6.png',
        'document6.pdf',
        'Web',
        NOW(),
        '4'
    ),
    (
        'Machine Learning',
        'Introduction au Machine Learning',
        'video7.mp4',
        'image7.png',
        'document7.pdf',
        'IA',
        NOW(),
        '4'
    ),
    (
        'Développement Mobile',
        'Développement d\'applications mobiles',
        'video8.mp4',
        'image8.png',
        'document8.pdf',
        'Mobile',
        NOW(),
        '4'
    ),
    (
        'Git et GitHub',
        'Gestion de versions avec Git',
        'video9.mp4',
        'image9.png',
        'document9.pdf',
        'Outils',
        NOW(),
        '4'
    ),
    (
        'Cybersécurité',
        'Les bases de la sécurité informatique',
        'video10.mp4',
        'image10.png',
        'document10.pdf',
        'Sécurité',
        NOW(),
        '4'
    ),
    (
        'Analyse de données',
        'Techniques d\'analyse de données',
        'video11.mp4',
        'image11.png',
        'document11.pdf',
        'Data',
        NOW(),
        '4'
    ),
    (
        'C++ pour débutants',
        'Cours complet de programmation en C++',
        'video12.mp4',
        'image12.png',
        'document12.pdf',
        'Programmation',
        NOW(),
        '4'
    ),
    (
        'Marketing Digital',
        'Apprenez le marketing en ligne',
        'video13.mp4',
        'image13.png',
        'document13.pdf',
        'Marketing',
        NOW(),
        '4'
    ),
    (
        'Framework Laravel',
        'Maîtrisez Laravel pour PHP',
        'video14.mp4',
        'image14.png',
        'document14.pdf',
        'Programmation',
        NOW(),
        '4'
    ),
    (
        'Intelligence Artificielle',
        'Introduction à l\'IA',
        'video15.mp4',
        'image15.png',
        'document15.pdf',
        'IA',
        NOW(),
        '4'
    ),
    (
        'Angular Avancé',
        'Création d\'applications Angular',
        'video16.mp4',
        'image16.png',
        'document16.pdf',
        'Programmation',
        NOW(),
        '4'
    ),
    (
        'DevOps',
        'Concepts de base de DevOps',
        'video17.mp4',
        'image17.png',
        'document17.pdf',
        'Outils',
        NOW(),
        '4'
    ),
    (
        'ReactJS',
        'Développement web avec ReactJS',
        'video18.mp4',
        'image18.png',
        'document18.pdf',
        'Programmation',
        NOW(),
        '4'
    ),
    (
        'Blockchain',
        'Introduction à la blockchain',
        'video19.mp4',
        'image19.png',
        'document19.pdf',
        'Finance',
        NOW(),
        '4'
    ),
    (
        'Ruby on Rails',
        'Développement web avec Ruby on Rails',
        'video20.mp4',
        'image20.png',
        'document20.pdf',
        'Programmation',
        NOW(),
        '4'
    );

ALTER TABLE Utilisateur
ADD COLUMN StatutInscription ENUM('activer', 'non_activer') DEFAULT 'activer';

INSERT INTO
    Utilisateur (
        Nom,
        Email,
        Password,
        Role,
        StatutInscription
    )
VALUES (
        'Adam fadi',
        'johndoe@example.com',
        'hashed_password',
        'Enseignant',
        'activer'
    );
    INSERT INTO Categorie (NomCategorie)
VALUES
    ('Programmation'),
    ('Web'),
    ('Bases de Données'),
    ('IA'),
    ('Mobile'),
    ('Outils'),
    ('Sécurité'),
    ('Data'),
    ('Marketing'),
    ('Finance');

-- Insertion de 10 utilisateurs factices avec le rôle 'Etudiant'
INSERT INTO Utilisateur (Nom, Email, Password, Role, StatutInscription)
VALUES
    ('Etudiant1', 'etudiant1@example.com', 'password1', 'Etudiant', 'activer'),
    ('Etudiant2', 'etudiant2@example.com', 'password2', 'Etudiant', 'activer'),
    ('Etudiant3', 'etudiant3@example.com', 'password3', 'Etudiant', 'activer'),
    ('Etudiant4', 'etudiant4@example.com', 'password4', 'Etudiant', 'activer'),
    ('Etudiant5', 'etudiant5@example.com', 'password5', 'Etudiant', 'activer'),
    ('Etudiant6', 'etudiant6@example.com', 'password6', 'Etudiant', 'activer'),
    ('Etudiant7', 'etudiant7@example.com', 'password7', 'Etudiant', 'activer'),
    ('Etudiant8', 'etudiant8@example.com', 'password8', 'Etudiant', 'activer'),
    ('Etudiant9', 'etudiant9@example.com', 'password9', 'Etudiant', 'activer'),
    ('Etudiant10', 'etudiant10@example.com', 'password10', 'Etudiant', 'activer');
    USE Youdemy;

    CREATE TABLE Etudiants As
SELECT
    Id,
    Nom,
    Email,
    PASSWORD,
    DateCreation
FROM utilisateur
WHERE
    Role = 'Etudiant';

    INSERT INTO Utilisateur (Nom, Email, Password, Role, StatutInscription)
VALUES
    ('Etudiant11', 'etudiant11@example.com', 'password11', 'Etudiant', 'activer')

USE Youdemy;
    ALTER Table Tag 
    ADD COLUMN IdTag int UNIQUE AUTO_INCREMENT PRIMARY KEY ;

    INSERT INTO Tag (NomTag) VALUES
('Programmation'),
('Développement Web'),
('JavaScript'),
('HTML'),
('CSS'),
('PHP'),
('Python'),
('C#'),
('Java'),
('TypeScript'),
('Ruby'),
('Kotlin'),
('Swift'),
('Dart'),
('Angular'),
('React'),
('Node.js'),
('Spring Boot'),
('Flask'),
('Django'),
('Bootstrap'),
('SQL'),
('NoSQL'),
('MongoDB'),
('PostgreSQL'),
('MySQL'),
('Machine Learning'),
('Intelligence Artificielle'),
('Big Data'),
('Cloud Computing');

ALTER TABLE categorie DROP PRIMARY KEY;

ALTER TABLE categorie ADD COLUMN id INT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY;
USE Youdemy;
CREATE Table CourTags (
    IdCour INT  ,
    IdTag INT,
    Foreign Key (IdCour) REFERENCES cour(IdCour),
    Foreign Key (IdTag) REFERENCES tag(IdTag)
    ) ;
USE Youdemy;
    ALTER TABLE Cour
ADD COLUMN Video VARCHAR(255)  ;

CREATE TABLE inscription (
    IdUser INT,          
    IdCour INT,      
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    FOREIGN KEY (IdUser) REFERENCES utilisateur(id) ON DELETE CASCADE,   
    FOREIGN KEY (IdCour) REFERENCES Cour(IdCour) ON DELETE CASCADE  
);