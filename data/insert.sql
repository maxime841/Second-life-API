BEGIN;

INSERT INTO "land" ("name","owner","presentation","description","group","prims","remainingprims","picture") 
VALUES ('Le domaine de Valombreuse','Khaleessie07','Bienvenue sur notre land éxotique le domaine de valombreuse. Vous y trouverez un descriptif de la land dans la carte suivante.','Différentes maisons aux choix seront proposées en locations dont 5 grandes maisons meublés avec piscine selons les gouts de chacun. Pour ceux qui le désire nous avons 2 maisons vide pour ceux qui souhaitent faire leur propre décoration. De plus, nous avons un complexe restaurant, manicure, et bien être; pour profiter de bon moments de détentes, convivialitées et amusements en famille en couple ou seul. Des animations y seront implantées pour donner une distraction supplémentaire et ainsi vous satisfaire pleinement. Un petit coin de Guadeloupe "Gwada" pour les intimes. En cours de préparation le domaine de valombreuse va débuter avec une parcelle de presque une demi sim Full. Il y a des parties communes de style Tropical avec Falaises, Plages, jeux aquatiques, bateau, vivre une experience de cinema, et aussi un coin romantique pour se retrouver en couple. Vous êtes donc invité à venir découvrir ce lieu.','Le domaine de valombreuse', '9000', '1520', ''),
       ('Douceur de Paris','Khaleessie07','','','Douceur de Paris', '4500', '800', '');
      
INSERT INTO "houses" ("name","owner","description","houseprims","remaininghouseprims","picture","roomnbr") 
VALUES ('Maison 1','','description maison 1','0','0', '', '7'),
       ('Maison 2','','description maison 2','0','0', '', '7'),
       ('Maison 3','','description maison 3','0','0', '', '7'),
       ('Maison 4','','description maison 4','0','0', '', '7'),
       ('Maison 5','','description maison 5','0','0', '', '7'),
       ('Maison 6','','description maison 6','0','0', '', '7'),
       ('Maison 7','','description maison 7','0','0', '', '7');

INSERT INTO "tenant" ("name","rent") 
VALUES ('','1500'),
       ('','1500'),
       ('','1500'),
       ('','1500'),
       ('','1500'),
       ('','1500'),
       ('','1100'),
       ('','1100');
      
INSERT INTO "club" ("name","owner", "picture") 
VALUES ('Douceur Kreyol Club','Khaleessie07', '');

INSERT INTO "dj" ("name","style") 
VALUES ('Mad','Afro-house'),
       ('Selecta', 'Dancehall, Soca, Bouyon'),
       ('Kaydenn', 'Dancehall, Soca, Bouyon');

INSERT INTO "dancer" ("name") 
VALUES ('danceur 1'),
       ('danceur 2'),
       ('danceur 3'),
       ('danceur 4');

INSERT INTO "party" ("name", "owner", "style", "description", "date") 
VALUES ('pool party', 'Khaleessie07', 'Bouyon et soca', 'ouverture du club Douceur Kreyol Club', '02/06/2022');