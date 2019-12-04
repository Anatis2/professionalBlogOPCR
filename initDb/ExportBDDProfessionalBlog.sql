-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 04 Décembre 2019 à 10:31
-- Version du serveur :  10.1.41-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `opcr_projet5_professionalBlog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `titleArticle` varchar(255) DEFAULT NULL,
  `subtitleArticle` varchar(255) DEFAULT NULL,
  `contentArticle` text,
  `dateCreationArticle` datetime DEFAULT CURRENT_TIMESTAMP,
  `person_idPerson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`idArticle`, `titleArticle`, `subtitleArticle`, `contentArticle`, `dateCreationArticle`, `person_idPerson`) VALUES
(1, 'PHP 8 va proposer un compilateur Just In Time', 'Un sous-titre', 'Les détails techniques de ce changement au sein de la proposition par Dmitry Stogov et Zeev Suraski :\r\nNous proposons d\'inclure un compilateur JIT à PHP 8 et de fournir des efforts supplémentaires pour augmenter ses performances et sa convivialité. En outre, nous proposons d\'envisager l\'inclusion d\'un compilateur JIT dans PHP 7.4 en tant que fonctionnalité expérimentale (désactivée par défaut)', '2019-12-04 10:18:21', 1),
(2, 'Les développeurs logiciels actifs sont actuellement estimés à un peu moins de 19 millions dans le monde', 'Un sous-titre', 'Combien y a-t-il de développeurs de logiciels dans le monde ? C’est la question à laquelle SlashData a tenté de répondre dans un rapport. SlashData estime qu\'il y a un peu moins de 19 millions de développeurs de logiciels actifs dans le monde au début de 2019, dont 13 millions sont des professionnels du logiciel. La société avance être arrivé à cette estimation en utilisant une méthodologie ascendante de cinq sources différentes (notamment GitHub, Stack Overflow, npm ainsi que des statistiques de l\'emploi des États-Unis et de l\'Union européenne).\r\nPour être plus précis la méthodologie de SlashData s’appuie sur deux piliers :\r\n\r\n    Le nombre de développeurs ou indicateurs directs de leur activité, mesurés de manière fiable: comptes Github et référentiels, comptes Stack Overflow, comptes npm et statistiques de l\'emploi aux États-Unis et dans l\'Union européenne.\r\n    Les données de son enquête auprès des développeurs, c’est-à-dire la mesure le comportement des développeurs. SlashData a terminé 16 éditions de cette enquête à grande échelle et affirme toucher plus de 20 000 développeurs par édition.\r\n\r\n« Nous sommes bien sûr conscients que d’autres estimations de la population de développeurs qui circulent sont plus élevées que la nôtre: plus de 20 millions et parfois 35, voire 60 millions de développeurs. Nous pensons que notre estimation, bien que conservatrice, est fortement étayée par des preuves de l’activité réelle des développeurs.\r\n\r\n« La plupart des estimations des communautés de développeurs qui circulent sur Internet sont basées sur des pages (uniques) vues, des téléchargements, des adresses IP, etc. Tous ces éléments sont susceptibles d\'avoir un effet multiplicateur, notamment en raison des tests de logiciels multi-machines et multi-navigateurs, du nettoyage fréquent des caches et des cookies pour les tests, des téléchargements répétés d\'outils de développement et de l\'automatisation du développement (par exemple, des serveurs de développement). Parfois, il n’est pas clair si les estimations reposent sur une base quelconque. Les chiffres que nous rapportons sont exclusivement basés sur ce que nous considérons comme des indicateurs directs de l\'activité du développeur humain ».\r\n\r\nQui est considéré dans l\'enquête sur les développeurs ?\r\n\r\nLa première chose que SlashData recherche est de savoir si un développeur est actif, c’est-à-dire s’il existe des preuves récentes de codage. Les gens ont peut-être écrit du code à un moment donné, mais sont ensuite passés à d\'autres priorités dans leur vie. SlashData ne veut pas compter les anciens développeurs ou les développeurs inactifs.\r\n\r\nEnsuite, pour obtenir un nombre significatif de développeurs, SlashData suppose que ceux-ci doivent être impliqués dans des projets de codage de grande envergure. Ceci est bien sûr un terme ambigu. « Cela exclut probablement les personnes occupant d\'autres emplois techniques qui écrivent parfois un petit script d\'automatisation, par exemple, mais inclut probablement les projets annexes ou ceux effectués comme des passe-temps dans lesquels les personnes investissent beaucoup d\'heures de leur temps ».\r\n\r\nÀ ce propos, SlashData précise que « nous comptons les développeurs qui codent uniquement comme passe-temps ou qui sont encore en train d’étudier le domaine, sans être professionnellement impliqué dans aucun domaine du software ».\r\n\r\nLes données de son enquête au fil des ans sont assez cohérentes à ce sujet, les amateurs / étudiants purs représentant un peu moins du tiers des développeurs. SlashData estime qu\'il y a 6 millions de développeurs amateurs / étudiants à la fin du quatrième trimestre de 2018, en plus des 12,9 millions de développeurs de logiciels professionnels.', '2019-12-04 10:18:21', 1),
(3, 'Les développeurs exercent une influence considérable à l\'ère de Kubernetes et du cloud', 'Un sous-titre', 'En outre, les développeurs exercent une influence sur les décisions d’achat des entreprises et doivent être considérés comme des parties prenantes clés lors de ces décisions d’achats au sein de toute entreprise soumise à un passage au cloud accompagné d’une transformation numérique interne.\r\n\r\n« L’autonomie et l’influence dont jouissent les développeurs aujourd’hui illustrent bien l’évolution du rôle de ces derniers dans l’informatique d’entreprise à l’ère de la transformation numérique qui s’intensifie rapidement », a déclaré Arnal Dayaratna , directeur de la recherche, Développement de logiciels chez IDC. « Les développeurs sont de plus en plus considérés comme des visionnaires et des architectes de la transformation numérique, par opposition aux exécutants d\'un plan prédéfini mis en place par une direction informatique centralisée ».\r\n\r\nL’étude, qui repose sur une enquête mondiale menée auprès de 2 500 développeurs, a également révélé que le paysage actuel des langages et des cadres de développement logiciel reste très fragmenté, ce qui crée toute une série de défis pour les équipes de développeurs, ainsi que des implications potentiellement importantes pour le support à long terme des logiciels.\r\n\r\nDans cet environnement, les langages susceptibles de continuer à gagner du terrain parmi les développeurs sont ceux qui prennent en charge divers cas d\'utilisation et environnements de déploiement, tels que Python et Java, ou présentent des spécificités les différenciant des autres langages.\r\n\r\nKubernetes est un système open source permettant d\'automatiser le déploiement, la mise à l\'échelle et la gestion des applications conteneurisées. Il regroupe les conteneurs qui composent une application dans des unités logiques pour faciliter la gestion et la découverte. Kubernetes s’appuie sur 15 années d’expérience dans la gestion de charges de travail de production chez Google, combinées aux meilleures idées et pratiques de la communauté, il s\'est imposé comme le standard de facto pour l\'orchestration de conteneurs et constitue le projet phare de la CNCF (Cloud Native Computing Foundation), soutenu par des acteurs clés tels que Google, AWS, Microsoft, IBM, Intel, Cisco et Red Hat.\r\n\r\nParmi les autres résultats clés de l\'enquête PaaSView d\'IDC, nous avons :\r\n\r\n    67 % des organisations ont adopté les pratiques de DevOps d\'une manière ou d\'une autre ;\r\n    environ 20 % des développeurs déclarent connaître « extrêmement bien » les conteneurs et les microservices ;\r\n    44 % des développeurs ont utilisé des outils de développement à code réduit de manière professionnelle à un moment ou à un autre ;\r\n    plus de 50 % des applications de développement et de test déployées sur le cloud public sont finalement déployées ailleurs dans la production ;\r\n\r\n\r\n« L\'intérêt des développeurs pour DevOps reflète un intérêt plus général pour la transparence et la collaboration, illustrant la tendance du développement logiciel à non seulement utiliser les technologies open source, mais également à intégrer les pratiques open sources au développement logiciel », a déclaré Al Gillen, vice-président du groupe Développement logiciel et Open Source chez IDC. « Les développeurs accordent la priorité à la collaboration décentralisée et aux contributions au code, ainsi qu\'à la documentation transparente du raisonnement des décisions liées au code ».', '2019-12-04 10:18:21', 1),
(4, 'Intel, Google, Microsoft et d\'autres se joignent au « Confidential Computing Consortium »', 'Un sous-titre', 'Certains des plus grands fournisseurs de matériel informatique, fournisseurs de cloud computing, développeurs, experts en open source et universitaires ont accepté de se joindre à une initiative axée sur la promotion des pratiques informatiques plus sûres : le Confidential Computing Consortium (CCC). Le CCC est une communauté de projet de la Linux Foundation qui se consacre à la définition et à l\'accélération de l\'adoption de l\'informatique confidentielle. Pour la réussite du projet, Google Cloud, IBM, Intel, Alibaba, Arm, Baidu, Microsoft, Red Hat, Swisscom et Tencent collaboreront sur des technologies et standards open source, selon un communique fait mercredi par The Linux Foundation.', '2019-12-04 10:18:21', 1),
(5, 'Google, Apple et Mozilla bloquent l\'espionnage par navigateur du gouvernement du Kazakhstan', 'Un sous-titre', 'Dans un communiqué commun, Mozilla et Google ont rendu publiques les mesures prises contre le gouvernement du Kazakhstan. « Pour protéger la vie privée des personnes, ensemble, nous avons déployé des solutions techniques dans Firefox et Chrome pour empêcher le gouvernement du Kazakhstan d\'intercepter le trafic Internet dans le pays ». Indique ce communiqué.\r\n\r\nCette réponse intervient après des informations crédibles selon lesquelles les fournisseurs de services Internet au Kazakhstan ont demandé à leurs habitants de télécharger et d\'installer un certificat délivré par le gouvernement sur tous les appareils et dans tous les navigateurs afin d\'accéder à Internet. Ce certificat n’est approuvé par aucune des sociétés et, une fois installé, il permet de déchiffrer et de lire tout ce que l\'utilisateur écrit ou publie, y compris les informations de son compte et ses mots de passe. Cette mesure visait les personnes visitant des sites populaires comme Facebook, Twitter et Google, entre autres.\r\n\r\nCe gouvernement aurait récemment commencé à intercepter les connexions HTTPS à l’aide d’une fausse autorité de certification. Ce qui affaiblit considérablement Internet pour les internautes kazakhs.\r\n\r\nQu\'est-ce qui dérange les concepteurs de navigateurs ?\r\n\r\nHTTPS sécurise la communication entre les navigateurs et les sites Web en chiffrant les échanges, empêchant les fournisseurs de services Internet et les gouvernements de la lire ou de la modifier. Les serveurs prouvent leur identité en présentant des certificats signés numériquement par des autorités de certification (CA), des entités sur lesquelles les navigateurs Web ont confiance pour garantir l\'identité des sites.\r\n\r\nPar exemple, facebook.com fournit aux navigateurs un certificat signé par DigiCert, une autorité de certification approuvée et intégrée à pratiquement tous les navigateurs. Les navigateurs peuvent savoir qu\'ils parlent au vrai correspondant en validant le certificat présenté et en confirmant qu\'il est signé par une autorité de certification en laquelle ils ont confiance (DigiCert). Le certificat fourni par facebook.com contient également une clé cryptographique publique utilisée pour sécuriser les communications ultérieures entre le navigateur et Facebook.', '2019-12-04 10:18:21', 1),
(6, 'Scala Native disponible en version 0.3.9, le développement du générateur de code natif', 'Un sous-titre', 'Le langage Scala n’est pas dénué d’avantages, comme beaucoup d’autres : il est typé (comme C ou Pascal), mais ne force pas à indiquer les types explicitement dans le code (contrairement aux précités, mais comme Python) ; il n’impose pas une verbosité monstre (contrairement à Java), avec une syntaxe orientée productivité (comme Python) ; il est raisonnablement rapide (comme Java, mais nettement moins que C), mais permet d’exploiter le parallélisme très facilement (contrairement à Python).\r\n\r\nPar contre, un des inconvénients de Scala est sa vitesse d’exécution, pas toujours suffisante : il faut compter le temps de démarrage de la JVM, puis les optimisations que le moteur JIT peut effectuer sur le code qui lui est soumis, sans oublier que le ramasse-miettes peut venir jouer. La sécurité que le langage offre peut aussi aller à l’encontre de la performance à l’exécution : il est impossible de s’échapper du bac à sable défini, à l’exception de quelques utilisateurs très expérimentés. Finalement, au niveau de l’accès aux bibliothèques natives préexistantes, leur réutilisation est presque impossible — après tout, ces bibliothèques natives pourraient causer des problèmes de sécurité !\r\n\r\nPour résoudre ces problèmes, une équipe de l’EPFL, déjà à l’origine de Scala, a lancé en 2016 le développement de Scala Native. Ce compilateur Scala exploite LLVM, l’infrastructure de compilateurs derrière Clang, notamment. La syntaxe de cette variante de Scala ne diffère de l’originale que par quelques ajouts, dont l’objectif est de faciliter l’interopérabilité avec des bibliothèques natives, comme des structures C (avec l’annotation @struct sur une classe) ou encore l’allocation de mémoire sur le tas avec des pointeurs.', '2019-12-04 10:18:21', 1),
(7, 'Richard Stallman adopte une alternative aux codes de conduite pour le projet GNU', 'Les GNU Kind Communications Guidelines', 'La saison des codes de conduite se confirme. Outre la communauté du noyau Linux et celle de SQLite, le projet GNU a également adopté des règles ou principes qui doivent régir les interactions de la communauté (mainteneurs et contributeurs) au quotidien. Mais Richard Stallman, initiateur du projet et président de la Free Software Foundation (FSF), a opté pour une approche qui vise à prévenir les écarts de conduite plutôt qu\'à punir ceux qui en seront responsables.\r\n\r\nPour le projet GNU, les discussions ont commencé en août dernier quand des mainteneurs de paquets GNU ont estimé que le style de communication au sein du projet éloignait souvent les femmes. Certains mainteneurs ont donc préconisé l\'adoption d\'un code de conduite avec des règles strictes, tandis que d\'autres ont averti que s\'ils en arrivaient là, ils quitteraient immédiatement le projet. Richard Stallman, pour sa part, dit ne pas être d\'accord pour faire de la diversité un objectif.\r\n\r\nSi les développeurs d\'un projet de logiciel libre spécifique n\'incluent pas un certain groupe démographique, le président de la FSF pense que leur absence ne constitue pas en soit un problème qui nécessite une action. Il n\'y a pas donc besoin, selon lui, de se démener désespérément pour recruter les personnes de ce groupe démographique. Il y aurait seulement un problème si nous faisons en sorte qu\'un certain groupe ne se sente pas bien accueilli, car - estime Stallman - nous perdons des contributeurs potentiels et très probablement aussi d\'autres qui ne sont pas de ce groupe. Il pense toutefois qu\'il « existe une sorte de diversité qui profiterait à de nombreux projets de logiciels libres : la diversité des utilisateurs en ce qui concerne les niveaux de compétences et les types d’utilisation. Cependant, ce n\'est pas ce que les gens entendent généralement par diversité », dit-il.\r\n\r\nEn ce qui concerne le fait d\'instaurer un code de conduite avec des règles strictes, le père du mouvement du logiciel libre dit également ne pas apprécier l\'esprit punitif. Il a donc décidé d\'essayer une approche différente, qui consiste à inciter les participants à s\'encourager et s\'entraider pour éviter les modes de communication rudes. « J\'ai identifié divers patterns de notre conversation susceptibles de chasser les femmes - et certains hommes aussi. Ensuite, j\'ai écrit des suggestions sur la manière de les éviter et d\'aider les autres à les éviter », dit-il. C\'est cette liste de suggestions que Richard Stallman a appelé les GNU Kind Communications Guidelines, qu\'on pourrait traduire en français par « directives de communication aimable du projet GNU ».', '2019-12-04 10:18:21', 1),
(8, 'Après Linux, c\'est au tour du projet Qt de se lancer dans l\'élaboration d\'un code de conduite', 'Pour harmoniser les échanges entre la communauté', 'La communauté open source Qt s’est elle aussi lancé dans l’élaboration d’un code de conduite. En préambule du draft qui est disponible depuis hier, nous pouvons lire :\r\n\r\n« Nous voulons adopter un code de conduite pour le projet Qt afin d’établir une ligne officielle de ce qui constitue un comportement inacceptable. Nous voulons que les nouveaux membres de la communauté Qt se sentent à l\'aise et acceptés, et nous voulons créer un environnement de travail sain pour les membres actuels et les nouveaux membres. Nous voudrions maintenir un moyen de faire en toute sécurité des critiques constructives et de dissiper les idées avec lesquelles nous ne sommes pas d’accord, sans manquer de respect à nos pairs. Et quand il y a des cas où quelqu\'un s’en égare, nous voudrions un moyen de résoudre le problème de manière pacifique ».\r\n\r\nLes exemples de comportement inacceptables des participants incluent:\r\n\r\n    L\'usage d’un langage ou imagerie sexualisée et l’attention ou avances sexuelles importuns\r\n    Les commentaires trollesques, insultants / dérogatoires et les attaques personnelles ou politiques\r\n    Le harcèlement public ou privé\r\n    La publication d’informations personnelles d’autres personnes, telles qu’une adresse physique ou électronique, sans autorisation expresse\r\n    D’autres comportements pouvant raisonnablement être considérés comme inappropriés dans un cadre professionnel', '2019-12-04 10:18:21', 1),
(9, 'WebStorm 2019.2 disponible : tour d\'horizon des nouveautés de l\'EDI de JetBrains', 'Pour les développeurs JavaScript', 'Fin mars, JetBrains a annoncé la sortie de WebStorm 2019.1, la première mise à jour majeure annuelle de son EDI pour les développeurs JavaScript. Celle-ci apportait un bon nombre de nouvelles fonctionnalités qu’on pouvait remarquer au niveau des langages JavaScript et TypeScript, des frameworks, de HTML et CSS, des tests, des outils JavaScript et au niveau de l’EDI lui-même. WebStorm 2019.2, la deuxième mise à jour majeure de l\'année, est maintenant disponible et apporte aussi des améliorations majeures pour la complétion de code et l\'édition de manière générale, pour JavaScript et TypeScript, la prise en charge améliorée de Vue.js, la mise en surbrillance de la syntaxe pour plus de 20 langages, de nouvelles intentions pour la déstructuration, etc.\r\n\r\nJavaScript et TypeScript\r\n\r\nWebStorm 2019.2 vient avec une nouvelle interface utilisateur pour la fenêtre de complétion, rendant la présentation des suggestions de complétion de code dans JavaScript et TypeScript plus claire et plus cohérente. Il est par exemple maintenant plus facile de repérer l\'endroit où le symbole est défini et s\'il fait partie d\'une API de langage standard. Il existe également une nouvelle icône pour les symboles avec plusieurs définitions.', '2019-12-04 10:18:21', 1),
(10, 'PhpStorm 2019.2 disponible :', 'Pour harmoniser les échanges entre la communauté', 'Début avril, JetBrains a annoncé la sortie de PhpStorm 2019.1, la première mise à jour majeure annuelle de son EDI pour le développement Web avec PHP. Celle-ci apportait un bon lot de fonctionnalités et améliorations, à savoir : la prise en charge du débogage des modèles Twig et Blade non compilés, la localisation de code mort, de nouveaux refactorings, intentions et correctifs rapides. Elle offrait également de meilleures performances et plus de stabilité, entre autres améliorations.\r\n\r\nJetBrains vient de publier PhpStorm 2019.2, la deuxième mise à jour majeure de l\'année de son EDI PHP, qui apporte aussi bon nombre de nouveautés et améliorations. Outre des améliorations en termes de performances et de stabilité, cette version majeure apporte de nouvelles fonctionnalités telles que la prise en charge des propriétés typées de PHP 7.4, la localisation instantanée de code dupliqué, la coloration et la vérification des expressions régulières (RegExps) en PHP, l\'amélioration de la prise en charge de EditorConfig, le support des scripts Shell, la coloration syntaxique pour plus 20 langages de programmation, entre autres. Nous vous proposons ici les fonctionnalités les plus notables par domaine.\r\n\r\nPropriétés typées de PHP 7.4\r\n\r\nLa sortie de PHP 7.4 est prévue pour fin novembre. JetBrains veut implémenter sa prise en charge le plus tôt possible dans PhpStorm, afin que les développeurs aient le temps de tester et de commencer à planifier leur migration. La fonctionnalité la plus attendue de cette nouvelle version du langage de programmation web côté serveur est probablement les propriétés typées, que PhpStorm 2019.2 supporte déjà pleinement. De nouvelles inspections mettent en évidence les violations de type et vous pourrez mettre à jour votre base de code à l\'aide du correctif rapide Add declared type for the field (Ajouter un type déclaré pour le champ). PhpStorm détectera le type automatiquement en fonction de la déclaration PHPDoc, la valeur par défaut ou du type d\'argument dans un constructeur.', '2019-12-04 10:18:21', 1),
(11, 'PHP 7.4 devrait être rendu disponible vers la fin de cette année', 'Voici un aperçu des nouveautés qui pourraient y figurer', 'PHP est utilisé par 78,9 % des sites de la toile, ce qui en fait l’un des langages de programmation côté serveur les plus utilisés. En décembre 2018, PHP 7.3 a été rendu disponible en version stable, apportant de nouvelles fonctionnalités et améliorations. Un mois plus tard, et des rapports ont déjà commencé à relayer les nouveautés de PHP 7.4, la prochaine itération du langage.\r\n\r\nPHP 7.4 devrait probablement être rendu disponible en décembre 2019. Alors voici quelques nouveautés qui pourraient faire leur apparition dans la nouvelle version.\r\n\r\nPHP a fait de grands progrès en ajoutant de puissantes fonctionnalités au cours des dernières années. Le moteur de PHP (Zend engine 3) a par été largement réécrit pour être beaucoup plus rapide que les versions précédentes. PHP 7.0 a apporté des gains de performance avec un moteur Zend Engine jusqu\'à deux fois plus rapide que dans la version 5.6. La version 7.1.0 du langage de développement Web côté serveur a également suivi avec de nouvelles fonctionnalités et encore des gains de performances : jusqu’à 35 % plus rapide pour les charges de travail avec une utilisation intensive du CPU.\r\n\r\nUne nouvelle fonctionnalité devrait améliorer davantage la performance de PHP. Si vous utilisez un framework, ses fichiers doivent être chargés et recompilés pour chaque requête. Le Preloading permet au serveur de charger les fichiers PHP sur la mémoire au démarrage, et les rendre disponibles en permanence pour toutes les requêtes ultérieures. Seul bémol, si la source des fichiers préchargés change, il faudra redémarrer le serveur.', '2019-12-04 10:18:21', 1),
(12, '« Pourquoi on est repassé de Go à PHP ? », Danny van Kooten, l\'éditeur de MailChimp nous livre les raisons', 'De ce rebasculement', 'En avril 2017, Danny van Kooten, un développeur indépendant, prenait la décision de réécrire en Go l\'application Laravel qui alimente Boxzilla, un plugin pour WordPress qui permet de créer des formulaires MailChimp ayant plus d\'un million d\'utilisateurs. Le développeur précisait qu\'il avait pris du plaisir à coder son application en Go. Rappelons au passage que Go est un langage de programmation compilé et concurrent inspiré de C et Pascal. Ce langage a été développé par Google et veut faciliter et accélérer la programmation à grande échelle. C\'est un langage qui vise aussi la rapidité d\'exécution, indispensable à la programmation système. Il considère le multithreading comme le moyen le plus robuste d\'assurer sur les processeurs actuels cette rapidité tout en rendant la maintenance facile par séparation de tâches simples exécutées indépendamment.\r\n\r\nPourquoi avoir laissé PHP pour Go ?\r\n\r\nAprès avoir développé son application en Go, Kooten trouvait que le résultat final était une énorme amélioration par rapport à l\'ancienne application (développé en PHP) avec une meilleure performance, un déploiement plus facile et une couverture de test plus étendue. Le développeur explique que son application était relativement simple. C\'était une API et un gestionnaire de compte relativement simple, pilotée par une base de données, où les utilisateurs peuvent se connecter pour télécharger le produit, consulter leurs factures ou mettre à jour leur méthode de paiement, dit-il. Laravel l\'avait bien aidé à développer, mais Kooten trouvait que certaines choses « ont toujours semblé trop compliquées » à faire.', '2019-12-04 10:18:21', 1),
(13, 'Quiz CSS', 'Alors, vous êtes expert ou non ?', 'Bonjour à tous,\r\n\r\nSouvenez-vous, vos bonnes résolutions 2018 disaient quelque chose du style : cette année, je deviens expert en CSS, à moi les belles pages, à moi la fluidité, à moi les visiteurs heureux !\r\n\r\nComme chaque bonne résolution, on la commence, rarement on la termine. Qu\'à cela ne tienne, il vous reste un mois pour rectifier le tir et la rubrique CSS a de quoi évaluer votre niveau !\r\n\r\nEffectivement, l\'équipe avait en son temps constitué quelques Quiz CSS. Ils sont classés par thèmes, à savoir Les bases et La programmation avancée\r\n. Le nombre d\'étoiles représentant le niveau du Quiz.', '2019-12-04 10:18:21', 1),
(14, 'La version 5.0 du framework Bootstrap va supprimer jQuery, sa plus grande dépendance côté client', 'Pour du pur JavaScript', 'Bootstrap n\'est plus à présenter aux développeurs Web, car c\'est sans doute le framework HTML, CSS et JavaScript le plus populaire pour développer des projets mobiles first et responsives sur le Web. Il offre des outils utiles à la création du design de sites et d\'applications Web. C\'est un ensemble qui contient des codes HTML et CSS, des formulaires, boutons, outils de navigation et autres éléments interactifs, ainsi que des extensions JavaScript en option. La dernière version majeure, Bootstrap 4.0 a été publiée en janvier 2018, après plus de trois 3 ans de développement et une réécriture majeure de l\'ensemble du projet. Elle a donc introduit des changements incompatibles que les développeurs devraient prendre en compte dans leurs projets.\r\n\r\nPlus d\'un an après la version 4.0, des versions mineures ont été livrées. La dernière, Bootstrap 4.3, date du 11 février. Bootstrap v4.3 vient avec des améliorations aux utilitaires du framework, des corrections de bogues, mais surtout des tailles de polices responsives. Un nouveau projet Bootstrap permet en effet d’automatiser le calcul d’une taille de police appropriée en fonction des dimensions du périphérique du visiteur ou de la fenêtre du navigateur.\r\n\r\nMais juste après la livraison de la v4.3, l\'équipe Bootstrap a décidé d\'aborder quelques changements clés à venir dans la version v5. À la Une, elle annonce l\'abandon de jQuery pour du pur JavaScript. « Le chat est sorti du sac - nous abandonnons notre plus grande dépendance côté client pour du JavaScript pur. Nous y travaillons depuis longtemps et un pull request est en cours et presque terminé », a affirmé l\'équipe Bootstrap.\r\n\r\nIl s\'agit d\'un énorme pull request avec des centaines de commentaires étalés sur un an et demi. Selon les commentaires, jQuery a été remplacé par du pur JavaScript (également désigné par le nom Vanilla JS) qui appelle directement les API du navigateur. S\'il est souvent désigné comme étant un framework, Vanilla JS ne l\'est pas vraiment, c\'est du JavaScript sans bibliothèque.\r\n\r\nLe concept Vanilla JS a été popularisé fin 2012, avec pour objectif de contrecarrer l’omniprésence des bibliothèques JS comme jQuery. Si vous avez déjà effectué une recherche sur un moteur de recherche suite à une question ou à un problème en codant en JavaScript, vous vous êtes peut-être rendu compte que jQuery et d’autres étaient omniprésents et toujours présentés comme la solution, même sur des questions génériques. C\'est pour lutter contre cela que le concept Vanilla JS a été mis en avant. Il vante les mérites de JavaScript. Plutôt que d’utiliser une bibliothèque en surcouche, on peut en effet trouver une solution équivalente qui utilise les fonctions du core JavaScript.', '2019-12-04 10:18:21', 1),
(17, 'Webosaures – L’évolution des connexions internet', '', 'Dernier sujet abordé chez les Webosaures avec l’ami Remouk : L’évolution des connexions internet. Un sujet parfait pour les dinosaures que nous sommes, car on va remonter au moins jusque fin des années 60/début 70 … quand les Diplodocus existaient encore ! (si si)\r\n\r\nDans cet épisode nous vous partageons un peu « notre » Internet, comment Rémi et moi avons vu évoluer les choses au fil des années. Vous découvrirez peut-être que le web tel que nous le connaissons est partiellement d’origine française (no joke !), l’impact du minitel sur le déploiement d’Internet dans l’hexagone, etc. Avec aussi Giscard d’Estaing (un autre dinosaure), FranceNet, le 56k, AOL, mon militantisme anti France Télécom, Adriana Karembeu, Emule ou encore la révolution Free.\r\n\r\nOui j’avoue, je suis un peu à la bourre pour cet épisode puisqu’il est paru il y a quasi une semaine sur YouTube (j’espère que ça vous forcera à nous y suivre pour être au taquet de notre actu ;)). J’en profite pour vous dire que vous pouvez aussi nous retrouver sur Instagram, Facebook et Twitter.\r\n\r\nPour aller plus loin :\r\n    - Louis Pouzin – l’un des Pères de l’Internet (préfacé par Bibi)\r\n   -  L’émission « Optimiser son site web »\r\n    - Carte de la fibre en France ', '2019-12-04 10:26:42', 2);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `idComment` int(11) NOT NULL,
  `authorComment` varchar(45) DEFAULT NULL,
  `contentComment` text,
  `dateComment` datetime DEFAULT CURRENT_TIMESTAMP,
  `article_idArticle` int(11) NOT NULL,
  `validate` varchar(45) DEFAULT 'En attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`idComment`, `authorComment`, `contentComment`, `dateComment`, `article_idArticle`, `validate`) VALUES
(1, 'Claire', 'Un commentaire pour tester', '2019-12-04 10:18:22', 1, 'En attente'),
(2, 'Claire', 'Un commentaire pour l\'article n°2', '2019-12-04 10:18:22', 2, 'En attente'),
(3, 'Claire', 'Article 1', '2019-12-04 10:18:22', 1, 'En attente'),
(4, 'Claire', 'Nous sommes ici dans l\'article n°2', '2019-12-04 10:18:22', 2, 'En attente'),
(5, 'Claire', 'Nous sommes ici dans l\'article n°2', '2019-12-04 10:18:22', 2, 'En attente'),
(6, 'Claire', 'Nous sommes ici dans l\'article n°1', '2019-12-04 10:18:22', 1, 'En attente'),
(7, 'Claire', 'Article n°2', '2019-12-04 10:18:22', 2, 'En attente'),
(10, 'Admin', 'Un article repris du site de Korben : https://korben.info/webosaures-levolution-des-connexions-internet.html', '2019-12-04 10:27:25', 17, 'En attente'),
(11, 'Member', 'merci pour cet article !', '2019-12-04 10:27:52', 17, 'En attente'),
(12, 'Member', 'Test pour article à valider', '2019-12-04 10:28:12', 6, 'En attente'),
(13, 'utilisateurinscrit', '+1 !', '2019-12-04 10:29:06', 2, 'En attente'),
(14, 'utilisateurinscrit', 'test de spam', '2019-12-04 10:29:15', 2, 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `idPerson` int(11) NOT NULL,
  `surnamePerson` varchar(45) DEFAULT NULL,
  `firstnamePerson` varchar(45) DEFAULT NULL,
  `pseudoPerson` varchar(45) DEFAULT NULL,
  `emailPerson` varchar(45) DEFAULT NULL,
  `passwordPerson` varchar(255) DEFAULT NULL,
  `dateRegistrationPerson` datetime DEFAULT CURRENT_TIMESTAMP,
  `typePerson` varchar(45) DEFAULT 'Member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `person`
--

INSERT INTO `person` (`idPerson`, `surnamePerson`, `firstnamePerson`, `pseudoPerson`, `emailPerson`, `passwordPerson`, `dateRegistrationPerson`, `typePerson`) VALUES
(1, 'NomTest', 'PrénomTest', 'NomTest.PrénomTest', 'test@test.fr', 'MDPTEST', '2019-12-04 10:18:21', 'Member'),
(2, 'Admin', 'Admin', 'Admin', 'admin@admin.fr', '$2y$10$cQFFmNI6NGUxiZxvATL7U.jjfjZ9TfGHmiA9Y9/7ENcr7cMmo8efK', '2019-12-04 10:20:09', 'Admin'),
(3, 'Member', 'Member', 'Member', 'member@member.fr', '$2y$10$xtsZlA1V/S4s8XQKiJwQLej0rGK391dfIiIP5650Vo/VNWgUjIejO', '2019-12-04 10:20:55', 'Member'),
(4, 'Utilisateur', 'Inscrit', 'utilisateurinscrit', 'utilisateur.inscrit@gmail.com', '$2y$10$4k1Y3nCmHWQA84aZYolCk.AmHtVh3j7EFKz/M/ky/tZNoTPRdewSm', '2019-12-04 10:25:04', 'Member');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`,`person_idPerson`),
  ADD KEY `fk_article_personne1_idx` (`person_idPerson`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idComment`,`article_idArticle`),
  ADD KEY `fk_commentaire_article_idx` (`article_idArticle`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`idPerson`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `idPerson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_personne1` FOREIGN KEY (`person_idPerson`) REFERENCES `person` (`idPerson`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_commentaire_article` FOREIGN KEY (`article_idArticle`) REFERENCES `article` (`idArticle`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
