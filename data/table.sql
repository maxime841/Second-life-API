BEGIN;

CREATE TABLE "land" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom du terrain
    owner TEXT NOT NULL, --Propriétaire du terrain
    presentation TEXT NOT NULL, --Présentation du terrain
    description TEXT NOT NULL, --Déscription du terrain
    "group" TEXT NOT NULL, --Groupe du terrain
    prims INT NOT NULL, --Nombre de prims allouer au terrain
    remainingprims INT NOT NULL, --Nombre de prims restante sur le terrain
    picture TEXT NOT NULL --Photo associée au terrain
);

CREATE TABLE "houses" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom de la maison
    owner TEXT, --Propriétaire de la maison
    description TEXT NOT NULL, --Déscription du terrain
    houseprims INT NOT NULL, --Nombre de prims de la maison
    remaininghouseprims INT NOT NULL, --Nombre de prims restante de la maison
    picture TEXT NOT NULL, --Photo associée à la maison
    landid INT REFERENCES "land"(id), --Reference pour l'id du terrain
    roomnbr INT NOT NULL --Nombre de pièce de la maison
);

CREATE TABLE "tenant" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom du locataire
    rent INT NOT NULL, --Loyer du locataire
    houseid INT REFERENCES "houses"(id) --reference pour l'id de la maison
);

CREATE TABLE "club" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom du club
    owner TEXT NOT NULL, --Propriétaire du club
    picture TEXT NOT NULL --Photo associée au club
);

CREATE TABLE "dj" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom du dj
    style TEXT NOT NULL --Style musicaux du dj
);

CREATE TABLE "dancer" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL -- Nom du danceur
);

CREATE TABLE "party" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom de la soirée
    owner TEXT NOT NULL, --Organisateur de la soirée
    style TEXT NOT NULL, --Style musicaux de la soirée
    description TEXT NOT NULL, --Déscription de la soirée
    djid INT REFERENCES "dj"(id), --reference pour l'id du dj
    firstdancerid INT REFERENCES "dancer"(id), --reference pour l'id du premier danceur
    seconddancerid INT REFERENCES "dancer"(id), --reference pour l'id du second danceur
    "date" TEXT NOT NULL --Date de l'évènement
);

COMMIT;
