create database IF NOT EXISTS DTADB default character set utf8 COLLATE utf8_general_ci;
USE DTADB;

create table survey (

	IdSurvey bigint(20) not null auto_increment,
	Category varchar(150) not null,
	Title varchar(100) not null,
	ImagePath varchar(100) default null,
	IdAuthor bigint(20) not null,
	Description text not null,
	DateDebut date not null,
	DateFin date default null,
	NumberParticipants smallint default 0,
	NumberParticipantsMax smallint default 2000,
	NumberChoiceMax smallint default 15,
	OthersCanPropose tinyint(1) default 0,

	primary key (IdSurvey)

) engine=InnoDB default charset=utf8;


create table choice (

	IdChoice bigint(20) not null auto_increment,
	IdSurvey bigint(20) not null, 
	Title varchar(100) not null,
	ImagePath varchar(100),
	IdAuthor bigint(20),
	AuthorDescription text,
	AltDescription text,
	NumberOfVotes int default 0,
	ClassementPosition smallint default 0,

	primary key (IdChoice)
	
) engine =InnoDB default charset=utf8;

create table websiteUser (

	IdUser bigint(20) not null auto_increment,
	UserName varchar(50) not null, 
	FirstName varchar(100) not null,
	Name varchar(100) not null,
	Age smallint not null,
	Password varchar(300) default "1234",

	primary key(IdUser)

) engine = InnoDB default charset =utf8;

create table message (

	IdMessage bigint(20) not null auto_increment,
	IdAuthor bigint(20) not null,
	IdSurvey bigint(20) not null,
	TextMessage text default "",

	primary key (IdMessage)

) engine = InnoDB default charset = utf8;


insert into survey ( Category, Title, ImagePath, IdAuthor, Description, DateDebut, DateFin) values
	("Films","Quel est le meilleur film de 2019 ?","/website_DTA/images/top-films.jpg",1,
	"L'année 2019 a été riche en chefs d'oeuvres du cinéma... Cependant il est l'heure d'élire ceux qui vous ont le plus plût ! Donnez vôtre avis ici !",
	"2019-12-28","2021-05-15"),
	("Books","Quel est le meilleur livre de 2019 ?","/website_DTA/images/top-livres.png",1,"Guillaume Musso, Stieg Larsson ou David Lagercrantz...Quel auteur vous a le 
	plus séduit cette année ?","2019-12-27","2021-02-03");

insert into choice (IdSurvey, Title, ImagePath, IdAuthor, AuthorDescription, AltDescription) values
	
	(1,"Once Upon a Time in Holywood","/website_DTA/images/once_upon_a_time_affiche.jpg",1,"Le nouveau film de Tarantino, il a fait un tabac auprès du public avec pas moins de 100 000 entrées sur les 6 
	premiers mois après sa sortie... C'est pour moi un bon candidat pour le poste de meilleur film de l'année !",
	"Once Upon a Time… in Hollywood , Il était une fois à Hollywood au Québec ou Il était une fois... à Hollywood en Belgique francophone est un film américano-britannique écrit, coproduit
	et réalisé par Quentin Tarantino, sorti en 2019. Le film est présenté en compétition officielle lors du Festival de Cannes 2019. Salué par la critique, le film remporte 3 Goldens Globes 
	dont le Golden Globe du meilleur film musical ou comédie en 2020. Par la suite, il est nommé 7 fois aux BAFTA 2020 et 10 fois aux Oscars." ),

	(1,"Joker","/website_DTA/images/joker_affiche.jpg",1,"Le Joker a été une vrai révélation cette année. Ce film nous a vraiment pris de court, tant il est 
	différent des films de héros signé Marvel que l'on a l'habitude de voir.",
	"Joker est un thriller psychologique américain, coécrit et réalisé par Todd Phillips, sorti en 2019. 
	Il raconte, dans une histoire originale, la transformation d'Arthur Fleck en Joker, un dangereux tueur psychopathe qui deviendra le plus grand ennemi de Batman. 
	Véritable triomphe au box-office mondial (plus d'un milliard de dollars de recettes), et bénéficiant de critiques élogieuses, il crée toutefois une polémique, notamment aux États-Unis,
	du fait de reproches d’apologie de la violence, laquelle demeure contestée par le réalisateur. Le film est présenté en compétition officielle à la Mostra de Venise 2019 où il reçoit le 
	Lion d'or et est ovationné. Il est ensuite nommé près d'une trentaine de fois pour différentes catégories de récompenses (Oscars, Golden Globes, British Academy Film Awards, César du 
	meilleur film étranger, etc...). Le jeu d'acteur de Joaquin Phoenix est particulièrement salué, cette performance lui valant de nombreuses récompenses dont le Golden Globe du meilleur
	acteur dans un film dramatique et l'Oscar du meilleur acteur. La compositrice Hildur Guðnadóttir reçoit également plusieurs prix dont le Golden Globe et l'Oscar de la meilleure musique de film. "),

	(1,"Parasite","/website_DTA/images/parasite_affiche.jpg",1,"Je n'ai pas vu ce film mais je n'ai pu m'empêcher de le rajouter aux propositions tant il a été salué par la critique et le public... A vous de 
	me convaincre de le voir en lui donnant une bonne place dans le classement !",
	"Parasite (hangeul : 기생충 ; RR : Gisaengchung), est un film sud-coréen coécrit et réalisé par Bong Joon-ho, sorti en 2019. Le film est présenté en compétition officielle au festival 
	de Cannes 2019, où il remporte la Palme d'or à l'unanimité du jury. Il est le premier film sud-coréen à obtenir cette récompense. C'est un immense succès critique et au box-office en 
	Corée du Sud et à l'international. Premier film sud-coréen et, plus largement, premier film en langue étrangère, à gagner l'Oscar du meilleur film en 2020, Parasite est le seul long métrage
	à obtenir lors de la même cérémonie l'Oscar du meilleur film et l'Oscar du meilleur film étranger (rebaptisé Oscar du meilleur film international en 2019). Avec également l'Oscar du meilleur
	scénario original et celui du meilleur réalisateur, Bong Joon-ho devient le premier réalisateur à égaliser le record de Walt Disney, détenu en 1954, en remportant quatre Oscars la même soirée."),

	(1,"Avengers : Endgame","/website_DTA/images/avengers_endgame.jpg",1,"Dernier opus de la saga Avengers, le film était très attendu en raison du suspens laissé à la fin de Avengers : Infinity War. Il a été un
	franc succès au box-office grâce à son scénario inventif mettant en scène les anciens films Marvel revu sous un autre angle",
	"Avengers: Endgame ou Avengers : Phase finale au Québec est un film américain réalisé par Anthony et Joe Russo, sorti en 2019. Il met en scène l'équipe de super-héros des comics Marvel, les Avengers. 
	Il s'agit du 22e film de l'Univers cinématographique Marvel, débuté en 2008 et du 10e et avant-dernier de la phase III. Ce film est la suite directe de Avengers: Infinity War à la fin duquel 
	« la moitié de tous les êtres vivants de l'univers » — et donc des personnages de l'Univers Marvel — disparaît d'un claquement de doigts de Thanos, après qu'il est entré en possession de toutes les
	Pierres d'Infinité. Tout comme ses trois prédécesseurs, le film rassemble les acteurs des différentes franchises super-héroïques habituellement séparées, parmi lesquels Iron Man, Black Widow, Thor, 
	Hulk ou encore Captain America et Ant-Man qui ont survécu à la conclusion du film précédent. Avengers: Endgame marque la fin du cycle des « gemmes de l'infini » démarré avec le film Iron Man en 2008. 
	Le film effectue le meilleur démarrage de l'histoire du cinéma en rapportant plus de 1,2 milliard de dollars de recettes mondiales lors de son premier week-end d'exploitation. Premier film à dépasser
	les 2 milliards onze jours après sa sortie, il devient en douze semaines d'exploitation le plus gros succès du box-office mondial devant Avatar. "),

	

	(2,"Nomadland","/website_DTA/images/nomadland.jpg",1,"Insérer description","Les mensonges et la folle cupidité des banquiers (autrement nommée « crise des subprimes ») les ont jetés à la rue. En 2008, ils ont perdu leur travail,
	leur maison, tout l’argent patiemment mis de côté pour leur retraite. Ils auraient pu rester sur place, à tourner en rond, en attendant des jours meilleurs. Ils ont préféré investir leurs derniers dollars 
	et toute leur énergie dans l’aménagement d’un van, et les voilà partis. Ils sont devenus des migrants en étrange pays, dans leur pays lui-même, l’Amérique dont le rêve a tourné au cauchemar.
	Parfois, ils se reposent dans un paysage sublime ou se rassemblent pour un vide-greniers géant ou une nuit de fête dans le désert. Mais le plus souvent, ils foncent là où l’on embauche les seniors
	compétents et dociles : entrepôts Amazon, parcs d’attractions, campings… Parfois, ils s’y épuisent et s’y brisent."),

	(2,"Sérotonine","/website_DTA/images/serotonine.jpg",1,"Insérer description",'"Mes croyances sont limitées, mais elles sont violentes. Je crois à la possibilité du royaume restreint. Je crois à l’amour" écrivait récemment Michel Houellebecq. 
	Le narrateur de Sérotonine approuverait sans réserve. Son récit traverse une France qui piétine ses traditions, banalise ses villes, détruit ses campagnes au bord de la révolte. Il raconte sa vie d’ingénieur agronome, 
	son amitié pour un aristocrate agriculteur (un inoubliable personnage de roman – son double inversé), l’échec des idéaux de leur jeunesse, l’espoir peut-être insensé de retrouver une femme perdue. 
	Ce roman sur les ravages d’un monde sans bonté, sans solidarité, aux mutations devenues incontrôlables, est aussi un roman sur le remords et le regret.');



insert into websiteUser (UserName, FirstName, Name, Age) values
	("MindeurFou","Tanguy","Pouriel",20);


alter table choice
	add foreign key (IdSurvey) references survey (IdSurvey),
	add foreign key (IdAuthor) references websiteUser (IdUser);

alter table survey 
	add foreign key (IdAuthor) references websiteUser (IdUser);

alter table message
	add foreign key (IdAuthor) references websiteUser (IdUser),
	add foreign key (IdSurvey) references survey (IdSurvey);