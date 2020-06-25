-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 mai 2020 à 16:01
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dtadb`
--

-- --------------------------------------------------------

--
-- Structure de la table `choice`
--

CREATE TABLE `choice` (
  `IdChoice` bigint(20) NOT NULL,
  `IdSurvey` bigint(20) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `ImagePath` varchar(100) DEFAULT NULL,
  `IdAuthor` bigint(20) DEFAULT NULL,
  `AuthorDescription` text DEFAULT NULL,
  `AltDescription` text DEFAULT NULL,
  `NumberOfVotes` int(11) DEFAULT 0,
  `ClassementPosition` smallint(6) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `choice`
--

INSERT INTO `choice` (`IdChoice`, `IdSurvey`, `Title`, `ImagePath`, `IdAuthor`, `AuthorDescription`, `AltDescription`, `NumberOfVotes`, `ClassementPosition`) VALUES
(1, 1, 'Once Upon a Time in Holywood', '/website_DTA/images/once_upon_a_time_affiche.jpg', 1, 'Le nouveau film de Tarantino, il a fait un tabac auprès du public avec pas moins de 100 000 entrées sur les 6 \r\n	premiers mois après sa sortie... C\'est pour moi un bon candidat pour le poste de meilleur film de l\'année !', 'Once Upon a Time… in Hollywood , Il était une fois à Hollywood au Québec ou Il était une fois... à Hollywood en Belgique francophone est un film américano-britannique écrit, coproduit\r\n	et réalisé par Quentin Tarantino, sorti en 2019. Le film est présenté en compétition officielle lors du Festival de Cannes 2019. Salué par la critique, le film remporte 3 Goldens Globes \r\n	dont le Golden Globe du meilleur film musical ou comédie en 2020. Par la suite, il est nommé 7 fois aux BAFTA 2020 et 10 fois aux Oscars.', 48, 1),
(2, 1, 'Joker', '/website_DTA/images/joker_affiche.jpg', 1, 'Le Joker a été une vrai révélation cette année. Ce film nous a vraiment pris de court, tant il est \r\n	différent des films de héros signé Marvel que l\'on a l\'habitude de voir.', 'Joker est un thriller psychologique américain, coécrit et réalisé par Todd Phillips, sorti en 2019. \r\n	Il raconte, dans une histoire originale, la transformation d\'Arthur Fleck en Joker, un dangereux tueur psychopathe qui deviendra le plus grand ennemi de Batman. \r\n	Véritable triomphe au box-office mondial (plus d\'un milliard de dollars de recettes), et bénéficiant de critiques élogieuses, il crée toutefois une polémique, notamment aux États-Unis,\r\n	du fait de reproches d’apologie de la violence, laquelle demeure contestée par le réalisateur. Le film est présenté en compétition officielle à la Mostra de Venise 2019 où il reçoit le \r\n	Lion d\'or et est ovationné. Il est ensuite nommé près d\'une trentaine de fois pour différentes catégories de récompenses (Oscars, Golden Globes, British Academy Film Awards, César du \r\n	meilleur film étranger, etc...). Le jeu d\'acteur de Joaquin Phoenix est particulièrement salué, cette performance lui valant de nombreuses récompenses dont le Golden Globe du meilleur\r\n	acteur dans un film dramatique et l\'Oscar du meilleur acteur. La compositrice Hildur Guðnadóttir reçoit également plusieurs prix dont le Golden Globe et l\'Oscar de la meilleure musique de film. ', 20, 3),
(3, 1, 'Parasite', '/website_DTA/images/parasite_affiche.jpg', 1, 'Je n\'ai pas vu ce film mais je n\'ai pu m\'empêcher de le rajouter aux propositions tant il a été salué par la critique et le public... A vous de \r\n	me convaincre de le voir en lui donnant une bonne place dans le classement !', 'Parasite (hangeul : 기생충 ; RR : Gisaengchung), est un film sud-coréen coécrit et réalisé par Bong Joon-ho, sorti en 2019. Le film est présenté en compétition officielle au festival \r\n	de Cannes 2019, où il remporte la Palme d\'or à l\'unanimité du jury. Il est le premier film sud-coréen à obtenir cette récompense. C\'est un immense succès critique et au box-office en \r\n	Corée du Sud et à l\'international. Premier film sud-coréen et, plus largement, premier film en langue étrangère, à gagner l\'Oscar du meilleur film en 2020, Parasite est le seul long métrage\r\n	à obtenir lors de la même cérémonie l\'Oscar du meilleur film et l\'Oscar du meilleur film étranger (rebaptisé Oscar du meilleur film international en 2019). Avec également l\'Oscar du meilleur\r\n	scénario original et celui du meilleur réalisateur, Bong Joon-ho devient le premier réalisateur à égaliser le record de Walt Disney, détenu en 1954, en remportant quatre Oscars la même soirée.', 13, 4),
(4, 1, 'Avengers : Endgame', '/website_DTA/images/avengers_endgame.jpg', 1, 'Dernier opus de la saga Avengers, le film était très attendu en raison du suspens laissé à la fin de Avengers : Infinity War. Il a été un\r\n	franc succès au box-office grâce à son scénario inventif mettant en scène les anciens films Marvel revu sous un autre angle', 'Avengers: Endgame ou Avengers : Phase finale au Québec est un film américain réalisé par Anthony et Joe Russo, sorti en 2019. Il met en scène l\'équipe de super-héros des comics Marvel, les Avengers. \r\n	Il s\'agit du 22e film de l\'Univers cinématographique Marvel, débuté en 2008 et du 10e et avant-dernier de la phase III. Ce film est la suite directe de Avengers: Infinity War à la fin duquel \r\n	« la moitié de tous les êtres vivants de l\'univers » — et donc des personnages de l\'Univers Marvel — disparaît d\'un claquement de doigts de Thanos, après qu\'il est entré en possession de toutes les\r\n	Pierres d\'Infinité. Tout comme ses trois prédécesseurs, le film rassemble les acteurs des différentes franchises super-héroïques habituellement séparées, parmi lesquels Iron Man, Black Widow, Thor, \r\n	Hulk ou encore Captain America et Ant-Man qui ont survécu à la conclusion du film précédent. Avengers: Endgame marque la fin du cycle des « gemmes de l\'infini » démarré avec le film Iron Man en 2008. \r\n	Le film effectue le meilleur démarrage de l\'histoire du cinéma en rapportant plus de 1,2 milliard de dollars de recettes mondiales lors de son premier week-end d\'exploitation. Premier film à dépasser\r\n	les 2 milliards onze jours après sa sortie, il devient en douze semaines d\'exploitation le plus gros succès du box-office mondial devant Avatar. ', 34, 2),
(5, 2, 'Nomadland', '/website_DTA/images/nomadland.jpg', 1, 'Insérer description', 'Les mensonges et la folle cupidité des banquiers (autrement nommée « crise des subprimes ») les ont jetés à la rue. En 2008, ils ont perdu leur travail,\r\n	leur maison, tout l’argent patiemment mis de côté pour leur retraite. Ils auraient pu rester sur place, à tourner en rond, en attendant des jours meilleurs. Ils ont préféré investir leurs derniers dollars \r\n	et toute leur énergie dans l’aménagement d’un van, et les voilà partis. Ils sont devenus des migrants en étrange pays, dans leur pays lui-même, l’Amérique dont le rêve a tourné au cauchemar.\r\n	Parfois, ils se reposent dans un paysage sublime ou se rassemblent pour un vide-greniers géant ou une nuit de fête dans le désert. Mais le plus souvent, ils foncent là où l’on embauche les seniors\r\n	compétents et dociles : entrepôts Amazon, parcs d’attractions, campings… Parfois, ils s’y épuisent et s’y brisent.', 42, 2),
(6, 2, 'Sérotonine', '/website_DTA/images/serotonine.jpg', 1, 'Insérer description', '\"Mes croyances sont limitées, mais elles sont violentes. Je crois à la possibilité du royaume restreint. Je crois à l’amour\" écrivait récemment Michel Houellebecq. \r\n	Le narrateur de Sérotonine approuverait sans réserve. Son récit traverse une France qui piétine ses traditions, banalise ses villes, détruit ses campagnes au bord de la révolte. Il raconte sa vie d’ingénieur agronome, \r\n	son amitié pour un aristocrate agriculteur (un inoubliable personnage de roman – son double inversé), l’échec des idéaux de leur jeunesse, l’espoir peut-être insensé de retrouver une femme perdue. \r\n	Ce roman sur les ravages d’un monde sans bonté, sans solidarité, aux mutations devenues incontrôlables, est aussi un roman sur le remords et le regret.', 75, 1),
(8, 6, 'Ross', '/website_DTA/images/ross_friends.jpg', 1, 'Ross est le personnage pour lequel l\'histoire est la plus développée. Il est attachant de part son humour et son histoire avec Rachel', 'Dr. Ross Eustace Geller, dit Ross Geller, est un personnage de fiction interprété par David Schwimmer dans la série américaine Friends. \r\nDocteur en paléontologie, Ross est le frère aîné de Monica et son meilleur ami est Chandler Bing, son colocataire à l\'université. \r\nRoss dit à Gunther dans un épisode qu\'il est né en décembre mais plus tard il dira à Joey qu\'il est né le 18 octobre. ', 579, 5),
(9, 6, 'Rachel', '/website_DTA/images/rachel_friends.jpg', 1, 'Rachel ne part pas favorite selon moi...\r\nElle est drôle mais pas autant que les autres. ', 'Rachel Karen Green est un personnage de fiction interprété par Jennifer Aniston (Voix françaises : Dorothée Jemma et Monika Lawinska) dans la série américaine Friends. ', 292, 6),
(10, 6, 'Chandler', '/website_DTA/images/chandler_friends.png', 1, 'Chandler est l\'humour décalé par excellence ! Il n\'y a pas une seule question qui lui est posé à laquelle il a pu répondre sans faire de blagues.\r\nToujours à se moquer des autres et de lui-même.', 'Chandler Muriel Bing est un des six personnages principaux de la série télévisée Friends. Il est interprété par Matthew Perry (Voix françaises : Emmanuel Curtil et Antoine Nouel). À l\'université, il rencontre Ross Geller. Ce dernier lui présente, lors du repas de Thanksgiving sa sœur Monica Geller et la meilleure amie de celle-ci, Rachel Green. Il partage un appartement avec Joey Tribbiani, son meilleur ami, pendant les 5 premières saisons de la série. Lors de cette colocation, ils adoptent un coq et un canard.', 3240, 1),
(11, 6, 'Joey', '/website_DTA/images/joey_friends.jpg', 1, 'Joey est le dragueur de la bande. Avec son célèbre \"How you doin\' ?\" et son air toujours perdu, il m\'a fait beaucoup rire.\r\nIl enchaîne les dates avec les filles et les questions stupides à longueur de temps et ce pour notre plus grand plaisir !', 'Joseph Francis Tribbiani, dit Joey Tribbiani est un personnage interprété par Matt LeBlanc (Voix françaises : Mark Lesser et Olivier Jankovic) dans la série américaine Friends ainsi que dans son spin-off Joey. Dans les traductions espagnoles et italiennes, son patronyme est Triviani. \r\nActeur de seconde zone et colocataire de Chandler Bing, son meilleur ami, durant les six premières saisons de Friends, Joey est le dragueur de la bande. C\'est aussi le moins intelligent et le moins cultivé des six compères, ce qui ne l\'empêche pas d\'avoir à son actif de nombreuses conquêtes féminines, plus attirées par son physique que par son esprit. Il est fier de ses origines italiennes et on lui doit l\'expression Va fa Napoli. Il a sept sœurs : Gina, Cookie, Mary-Therese, Mary-Angela, Tina, Véronica et Dina. Gina habite à Los Angeles et il la rejoindra dans la série Joey. ', 2947, 2),
(12, 6, 'Monica', '/website_DTA/images/monica_friends.jpg', 1, 'Monica est la soeur de Ross. C\'est à elle qu\'appartient l\'appartement dans lequel les compères passent 90% de leurs temps.\r\nElle est d\'une grande gentillesse et est toujours là pour acceuillir ou aider ses amis.', 'Monica E. Geller-Bing est un personnage de fiction interprété par Courteney Cox (Voix française : Marie-Christine Darah) dans la sitcom américaine Friends. \r\nMonica est la sœur cadette de Ross Geller et la fille de Jack & Judy Geller. Elle habite un appartement new-yorkais loué en réalité à sa grand-mère : elle le sous-loue tandis que son aïeule est partie vivre en Floride (le loyer étant limité, elle le paye largement en dessous de sa valeur réelle). \r\nMonica a partagé son appartement avec Phoebe Buffay, dont le déménagement est antérieur au début de la série. Phoebe avait peur que leur relation ne se dégrade à cause de l\'obsession du ménage de son amie, qui commençait à être pesante. Dans le pilote, Monica trouve une nouvelle colocataire : son ancienne meilleure amie de lycée, Rachel Green qui a planté son fiancé Barry Farber à l\'autel le jour de leur mariage puis s\'est enfuie. ', 1255, 3),
(13, 6, 'Phoebe', '/website_DTA/images/phoebe_friends.jpg', 1, 'Phoebe est l\'excentrique de la bande. Un peu comme Joey, elle est toujours à côté de la plaque. Mais elle est toujours là pour ses amis et elle nous fait rire avec ses interprétations bien à elles des choses.', 'Phoebe Buffay Hannigan est un personnage fictif interprété par Lisa Kudrow dans la série américaine Friends.', 863, 4);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `IdMessage` bigint(20) NOT NULL,
  `IdAuthor` bigint(20) NOT NULL,
  `IdSurvey` bigint(20) NOT NULL,
  `TextMessage` text DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `survey`
--

CREATE TABLE `survey` (
  `IdSurvey` bigint(20) NOT NULL,
  `Category` varchar(150) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `ImagePath` varchar(100) DEFAULT NULL,
  `IdAuthor` bigint(20) NOT NULL,
  `Description` text NOT NULL,
  `DateDebut` date NOT NULL,
  `DateFin` date DEFAULT NULL,
  `NumberParticipants` smallint(6) DEFAULT 0,
  `NumberParticipantsMax` smallint(6) DEFAULT 2000,
  `NumberChoiceMax` smallint(6) DEFAULT 15,
  `OthersCanPropose` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `survey`
--

INSERT INTO `survey` (`IdSurvey`, `Category`, `Title`, `ImagePath`, `IdAuthor`, `Description`, `DateDebut`, `DateFin`, `NumberParticipants`, `NumberParticipantsMax`, `NumberChoiceMax`, `OthersCanPropose`) VALUES
(1, 'Films', 'Quel est le meilleur film de 2019 ?', '/website_DTA/images/top-films.jpg', 1, 'L\'année 2019 a été riche en chefs d\'oeuvres du cinéma... Cependant il est l\'heure d\'élire ceux qui vous ont le plus plût ! Donnez vôtre avis ici !', '2019-12-28', '2021-05-15', 115, 2000, 15, 0),
(2, 'Books', 'Quel est le meilleur livre de 2019 ?', '/website_DTA/images/top-livres.png', 1, 'Guillaume Musso, Stieg Larsson ou David Lagercrantz...Quel auteur vous a le \r\n	plus séduit cette année ?', '2019-12-27', '2021-02-03', 117, 2000, 15, 0),
(6, 'Series', 'Quel est le meilleur personnage de Friends ?', '/website_DTA/images/friends.jpg', 1, 'Friends est une de mes séries préférées ! Pas un seul épisode n\'a manqué de me faire rire !\r\nSorte d\'utopie de la vie en coloc, cette série regroupe 5 acteurs qui passent leur temps à se divertir et à rigoler entre eux. J\'aimerais connaître votre personnage préféré. Celui que vous avez trouvé le plus drôle ou bien celui avec qui joue le mieux, ou autre... A vous de décider !', '2020-05-13', '2020-08-20', 9176, 32767, 15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `websiteuser`
--

CREATE TABLE `websiteuser` (
  `IdUser` bigint(20) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Age` smallint(6) NOT NULL,
  `Password` varchar(300) DEFAULT '1234'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `websiteuser`
--

INSERT INTO `websiteuser` (`IdUser`, `UserName`, `FirstName`, `Name`, `Age`, `Password`) VALUES
(1, 'MindeurFou', 'Tanguy', 'Pouriel', 20, '1234'),
(2, 'monMDPest12345678', 'Jay', 'Adams', 21, '$2y$10$hC0.1uOqnMMNAmQN4B9zNeSDHmabJZUfi.dHtcWLRrjowthgxyCOy'),
(4, 'monMDPestabcdefgh', 'Dimitri', 'Cracker', 11, '$2y$10$7Eju9JZdg/EbWI6DMiMByOhcgOE4cfdTF.jU5MwlNyvT4t7QTiU46');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `choice`
--
ALTER TABLE `choice`
  ADD PRIMARY KEY (`IdChoice`),
  ADD KEY `IdSurvey` (`IdSurvey`),
  ADD KEY `IdAuthor` (`IdAuthor`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`IdMessage`),
  ADD KEY `IdAuthor` (`IdAuthor`),
  ADD KEY `IdSurvey` (`IdSurvey`);

--
-- Index pour la table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`IdSurvey`),
  ADD KEY `IdAuthor` (`IdAuthor`);

--
-- Index pour la table `websiteuser`
--
ALTER TABLE `websiteuser`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `choice`
--
ALTER TABLE `choice`
  MODIFY `IdChoice` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `IdMessage` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `survey`
--
ALTER TABLE `survey`
  MODIFY `IdSurvey` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `websiteuser`
--
ALTER TABLE `websiteuser`
  MODIFY `IdUser` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `choice`
--
ALTER TABLE `choice`
  ADD CONSTRAINT `choice_ibfk_1` FOREIGN KEY (`IdSurvey`) REFERENCES `survey` (`IdSurvey`),
  ADD CONSTRAINT `choice_ibfk_2` FOREIGN KEY (`IdAuthor`) REFERENCES `websiteuser` (`IdUser`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`IdAuthor`) REFERENCES `websiteuser` (`IdUser`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`IdSurvey`) REFERENCES `survey` (`IdSurvey`);

--
-- Contraintes pour la table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`IdAuthor`) REFERENCES `websiteuser` (`IdUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
