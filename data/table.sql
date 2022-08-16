BEGIN;

CREATE TABLE "land" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom du terrain
    owner TEXT NOT NULL, -- Propriétaire du terrain
    presentation TEXT NOT NULL, -- Presentation du terrain
    description TEXT NOT NULL, -- Description du terrain   
    "group" TEXT NOT NULL, -- Group du terrain
    prims   TEXT NOT NULL, -- Prims du terrain  
    remainingprims  TEXT NOT NULL, -- prims restante du terrain
    date TEXT NOT NULL, --Date d'achat du terrain
    pictures TEXT --Photos du terrain
);

CREATE TABLE "picture_land" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT, -- Nom de la photo
    land_id INT REFERENCES "land" (id) ON DELETE CASCADE
);

CREATE TABLE "houses" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom de la maison
    owner TEXT, -- Nom du propriétaire de la maison
    presentation TEXT NOT NULL, -- Presentation du la maison
    prims TEXT NOT NULL, -- Prims de la maison
    remaininghouseprims TEXT NOT NULL, -- Prims restante de la maison
    datestartrent TEXT, --Date d'achat de la maison
    dateendrent TEXT, --Date de fin de location de la maison
    pictures TEXT --Photos de la maison
);

CREATE TABLE "picture_house" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom de la phot de la maison
    house_id INT REFERENCES "houses" (id) ON DELETE CASCADE
);

CREATE TABLE "tenant" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom du locataire de la maison
    tenant_house INT REFERENCES "houses" (id) ON DELETE CASCADE
);

CREATE TABLE "club" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom du club
    owner TEXT NOT NULL -- Propriétaire du club
);

CREATE TABLE "dj" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- Nom du dj
    style TEXT NOT NULL, --style musicaux du dj
    date TEXT NOT NULL, --Date d'entrée au club du dj
    picture TEXT NOT NULL -- photo du dj
);

CREATE TABLE "picture_dj" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- nom de photo du dj
    picture_dj INT REFERENCES "dj" (id) ON DELETE CASCADE
);

CREATE TABLE "dancer" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- nom du danceur
    date TEXT NOT NULL, --Date d'entrée du danseur dans le club
    picture TEXT -- picture du danseur dans le club
);

CREATE TABLE "picture_dancer" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    name TEXT NOT NULL, -- nom de la photo du danseur
    picture_dancer INT REFERENCES "dancer" (id) ON DELETE CASCADE   
);

CREATE TABLE "party" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,  -- ID default
    name TEXT NOT NULL, -- nom de la soirée
    owner TEXT NOT NULL, -- Propriétaire de la soirée
    date TEXT NOT NULL, --Date de la soirée
    picture TEXT -- picture de la soirée
);

CREATE TABLE "staff" (
    id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY, -- ID default
    pseudo TEXT NOT NULL, -- pseudo du staff
    email TEXT NOT NULL, -- email du staff
    password TEXT NOT NULL, -- password du staff
    date TEXT NOT NULL, -- date d'entrée du staff
    admin BOOLEAN DEFAULT false -- confirmation ou non du staff en admin 
);

COMMIT;
