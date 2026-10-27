# Logos Tabernacle pour WordPress : guide d'installation et d'utilisation

Ce dossier contient la version WordPress du site Logos Tabernacle Ministries. Le design est celui du site d'origine (couleurs, polices, animations, mise en page mobile), mais tout le contenu se modifie depuis le tableau de bord, sans toucher au code.

La livraison se compose de deux fichiers ZIP :

| Fichier | Rôle |
| --- | --- |
| `logos-tabernacle.zip` | Le **thème** : apparence, page d'accueil, pages intérieures, réglages du site, en-tête, pied de page, couleurs et polices. |
| `logos-tabernacle-contenus.zip` | L'**extension** : événements, enseignements, ressources PDF, horaires, départements, équipe pastorale, formulaire de contact et messages reçus. |

Les contenus sont séparés du thème volontairement : si un jour vous changez de thème, vos événements, enseignements et messages restent dans WordPress.

---

## 1. Installation

### Prérequis

- WordPress 6.2 ou plus récent (testé sur WordPress 6.8.3).
- PHP 7.4 ou plus récent (testé sur PHP 8.3).
- Aucune autre extension n'est obligatoire.

### Étapes

1. **Extension** : *Extensions › Ajouter › Téléverser une extension*, choisissez `logos-tabernacle-contenus.zip`, cliquez sur *Installer maintenant* puis sur *Activer*.
2. **Thème** : *Apparence › Thèmes › Ajouter › Téléverser un thème*, choisissez `logos-tabernacle.zip`, cliquez sur *Installer maintenant* puis sur *Activer*.

L'ordre n'a pas d'importance (les deux ordres ont été testés). Si le thème est activé seul, un message rappelle d'installer l'extension, et le site reste fonctionnel : les sections qui dépendent des contenus se masquent et la page Contact propose WhatsApp et l'e-mail.

### Ce qui est créé automatiquement

À l'activation du **thème** :

- les pages Accueil, À propos, Pasteur, Programmes, Enseignements, Événements, Contact et Actualités, chacune avec son modèle de page ;
- la page d'accueil statique et la page des articles (Actualités) ;
- le menu « Menu principal », placé dans l'en-tête.

Une page déjà existante avec la même adresse n'est jamais écrasée.

À l'activation de l'**extension**, les contenus du site d'origine sont importés une seule fois : 3 horaires, 5 départements, l'événement « Spécial veillée de la traversée 2027 », 3 enseignements, 3 ressources PDF (sans fichier, voir plus bas) et l'équipe pastorale avec les photos.

### Réglages WordPress conseillés

- *Réglages › Permaliens* : choisissez « Titre de la publication ». Les anciennes adresses du site (`/about`, `/pastor`, `/programs`, `/teachings`, `/events`) redirigent automatiquement vers les nouvelles.
- *Réglages › Général* : fuseau horaire « Kinshasa ». Il sert à décider si un événement est « à venir » ou « passé ».
- **Envoi des e-mails** : installez une extension SMTP (par exemple *WP Mail SMTP* ou *FluentSMTP*) et configurez-la avec l'adresse de l'église. Beaucoup d'hébergeurs n'envoient pas les e-mails de WordPress de façon fiable sans cela. Les messages du formulaire sont de toute façon conservés dans le tableau de bord.

---

## 2. Le tableau de bord

Deux menus sont ajoutés à gauche du tableau de bord.

### Menu « Logos Tabernacle » (thème)

| Écran | Ce qu'on y règle |
| --- | --- |
| **Paramètres du site** | Nom, nom court, slogan, description pour les moteurs de recherche, année de fondation, nombre de places, logos, image de partage social. Coordonnées : adresse, téléphone, WhatsApp et message prérempli, e-mail, horaires du secrétariat, adresse et coordonnées GPS de la carte. Liens YouTube, Facebook, Instagram, TikTok et lien du direct. Chiffres clés (valeur et libellé, ajout, suppression et réordonnancement). |
| **En-tête** | Nom et seconde ligne à côté du logo, largeur du logo, en-tête transparent ou toujours opaque, bouton LIVE et son texte, bouton d'action et son lien, largeur à partir de laquelle le menu mobile apparaît. |
| **Page d'accueil** | Les dix sections de l'accueil (bannière, bandeau d'informations, vidéo à la une, présentation, horaires, pasteur, enseignements, événements, verset, visite). Pour chacune : un interrupteur « Affichée », un bouton « Modifier » qui déplie ses champs, et une poignée pour la glisser à une autre position. |
| **Pied de page et textes communs** | Textes et colonnes du pied de page, réseaux sociaux, copyright, bandeau d'appel à l'action de fin de page, textes de la page 404. |
| **Apparence et design** | Ouvre le Personnaliseur WordPress (voir plus bas). |
| **Menus** | Raccourci vers *Apparence › Menus*. |

Dans les textes, quelques jetons sont remplacés automatiquement : `{fondation}` (année de fondation), `{annees}` (nombre d'années depuis la fondation), `{capacite}` (nombre de places), `{rendezvous}` (nombre d'horaires), `{annee}` (année en cours), `{site}` (nom du site).

Un champ d'image laissé vide reprend l'image d'origine du thème. Un champ de texte vidé reste vide et l'élément correspondant disparaît.

#### La bannière principale (hero)

Dans *Page d'accueil › Bannière principale › Modifier* : surtitre, titre H1 (masqué comme sur le site d'origine, mais lu par Google et les lecteurs d'écran ; il peut être affiché), verset et référence, bouton LIVE, second bouton facultatif, image de fond et image pour mobile, couleur et intensité du voile, couleur du texte, taille du verset, alignement, hauteur et animation.

### Menu « Église » (extension)

| Écran | Contenu |
| --- | --- |
| **Événements** | Titre, description, image à la une, date (obligatoire pour apparaître), heure en texte libre, lieu, bouton « Je participe » par WhatsApp. Les événements passés passent automatiquement dans la rubrique des événements passés. |
| **Enseignements** | Titre, lien ou identifiant YouTube, prédicateur, date, case « À la une » pour la vidéo mise en avant sur l'accueil. |
| **Ressources PDF** | Titre, icône, résumé, fichier PDF, taille affichée. Une ressource sans fichier n'est pas affichée. |
| **Horaires** | Titre, jour(s), heure, icône, public concerné. Ordre réglable par glisser-déposer dans la liste. |
| **Départements** | Nom, icône, description, lien « Rejoindre ». Ordre par glisser-déposer. |
| **Équipe pastorale** | Nom, photo, biographie, fonction, case « Pasteur principal » (présenté sur l'accueil et en tête de la page Pasteur ; sa biographie est découpée en chapitres par ses intertitres), repères (intitulé et valeur), coordonnées et réseaux, case « Visible sur le site ». Ordre par glisser-déposer. |
| **Messages reçus** | Les messages envoyés par le formulaire de contact, avec un compteur des non-lus. Un message ouvert est marqué comme lu, avec des boutons « Répondre sur WhatsApp » et « Répondre par e-mail ». |
| **Formulaire de contact** | Adresse qui reçoit les messages, liste des objets proposés, texte du bouton, bouton WhatsApp, messages de succès et d'erreur, note sous le formulaire. |

Le formulaire peut aussi être placé dans n'importe quelle page avec le code court `[logos_formulaire_contact]`.

### Pages intérieures

En modifiant une page (*Pages*), deux boîtes apparaissent sous l'éditeur :

- **En-tête et référencement** : surtitre, titre, introduction et image de l'en-tête de page, description pour les moteurs de recherche.
- **Sections de la page** : les blocs propres au modèle (frise de l'histoire pour À propos, cartes d'identité pour Pasteur, etc.) et le bandeau d'appel à l'action de fin de page.

Le texte libre de la page (éditeur de blocs) s'affiche à l'endroit prévu par le modèle. La page À propos contient déjà le texte d'origine.

### Apparence et design (Personnaliseur)

*Logos Tabernacle › Apparence et design* ouvre le Personnaliseur avec un aperçu en direct :

- **Couleurs** : couleur principale (or), secondaire, accentuation, texte des boutons, liens, titres, textes, fonds (clair, crème, sombre, gris), texte sur fond sombre, en-tête et pied de page.
- **Polices** : police des titres, des surtitres et boutons, du verset d'accueil et du texte courant, parmi 12 polices Google Fonts (par défaut Cormorant Garamond, Cinzel, Marcellus et Source Sans 3, comme le site d'origine).
- **Tailles, arrondis et espacements** : taille des titres et des paragraphes, arrondi des boutons, espacement vertical des sections.

Chaque réglage a un bouton pour revenir à la valeur d'origine. Seules les valeurs modifiées sont ajoutées au site.

### Menus

*Apparence › Menus* : trois emplacements (menu principal, menu du pied de page, liens légaux). Les sous-menus sont gérés : liste déroulante sur ordinateur, bouton d'ouverture dans le menu mobile.

---

## 3. Fonctionnalités implémentées

**Fidélité au design**
- CSS d'origine repris tel quel, polices, icônes SVG identiques, animations (respectant le réglage « réduire les animations » du visiteur).
- En-tête transparent qui devient opaque au défilement, menu mobile plein écran, vidéos YouTube chargées seulement au clic, fenêtre de détail des événements.

**Administration**
- Quatre écrans de réglages, sections de l'accueil activables et réordonnables, champs répétables (ajout, suppression, glisser-déposer), médiathèque pour les images, sélecteur de couleurs.
- Sept types de contenus avec leurs champs, colonnes utiles dans les listes et ordre par glisser-déposer.
- Personnaliseur pour les couleurs, les polices et les tailles.

**Formulaire de contact (traitement côté serveur)**
- Champs nom, téléphone, e-mail (facultatif), objet, message ; validation dans le navigateur et sur le serveur.
- Message enregistré dans *Messages reçus* et envoyé par e-mail, avec « Répondre à » sur l'adresse du visiteur.
- En cas d'erreur, retour au formulaire avec les messages d'erreur et les saisies conservées.
- Bouton « Envoyer par WhatsApp » qui ouvre WhatsApp avec le message déjà rédigé.
- Protection anti-spam sans service externe : jeton de sécurité WordPress, champ piège invisible, délai minimal de 3 secondes, horodatage signé, limite de 5 messages par heure et par connexion.

**Référencement**
- Titre et description par page, balises Open Graph et Twitter pour le partage, données structurées (Église sur l'accueil, Événement sur la page d'un événement, fil d'Ariane).
- Si Yoast SEO, Rank Math, SEOPress ou All in One SEO est actif, le thème lui laisse ces balises pour éviter les doublons.

**Sécurité**
- Toutes les saisies sont nettoyées et tous les affichages échappés avec les fonctions WordPress.
- Jetons de sécurité et contrôle des droits sur chaque enregistrement et sur le réordonnancement.
- Aucune requête SQL écrite à la main, aucune clé d'API, aucun mot de passe dans le code.
- Les messages reçus sont privés : ni pages publiques, ni recherche, ni API REST.

**Performances**
- Pas de jQuery sur le site public, un seul petit script chargé en différé, pas de bibliothèque externe.
- Images en chargement différé et tailles adaptées générées par WordPress.
- Iframes YouTube et Google Maps chargées seulement quand c'est nécessaire.

---

## 4. Tests réalisés

Environnement : WordPress 6.8.3, PHP 8.3, navigateur Chromium (Playwright), base SQLite. Les tests ont été faits sur une installation neuve.

| Domaine | Test | Résultat |
| --- | --- | --- |
| Installation | Téléversement des deux ZIP par l'administration, dans les deux ordres, puis activation | Réussi, aucune erreur PHP |
| Installation | Thème seul, sans l'extension | Toutes les pages répondent, message de rappel affiché, contact en repli WhatsApp et e-mail |
| Fidélité | Comparaison avec le site d'origine à 1440, 1024, 768 et 390 px de large (hauteur des pages et capture pixel par pixel) | Hauteurs identiques sur toutes les pages, à deux exceptions voulues (voir section 5) ; seules différences de pixels : lissage des images redimensionnées |
| Responsive | Débordement horizontal aux quatre largeurs | Aucun |
| JavaScript | Erreurs de console sur toutes les pages | Aucune |
| Réglages | Modification du titre et du verset de la bannière, désactivation d'une section, déplacement d'une section, ajout et suppression d'un élément répétitif, nouvelle image envoyée dans la médiathèque, téléphone, chiffre clé | Tout enregistré et visible sur le site |
| Personnaliseur | Changement de la couleur principale puis publication | Couleur appliquée aux boutons du site |
| Contenus | Création, modification et suppression d'un événement, ouverture et fermeture de sa fenêtre de détail | Réussi |
| Contenus | Réordonnancement des horaires par glisser-déposer | Ordre conservé après rechargement et appliqué sur le site |
| Pages | Modification d'un champ d'une page intérieure (À propos) | Enregistré et affiché |
| Menus | Sous-menu au survol sur ordinateur ; menu mobile : ouverture, sous-menu, touche Échap | Réussi (un défaut du menu mobile a été trouvé et corrigé, voir plus bas) |
| Formulaire | Envoi valide | Message enregistré, e-mail transmis à `wp_mail` avec le bon destinataire, l'objet et « Répondre à » |
| Formulaire | Envoi vide, e-mail invalide | Bloqué dans le navigateur ; refusé par le serveur avec message d'erreur et saisies conservées |
| Formulaire | Champ piège rempli, envoi en moins de 3 secondes | Ignoré sans enregistrement |
| Formulaire | 6 envois en une heure depuis la même connexion | Le 6ᵉ est refusé |
| Formulaire | Échec de l'envoi de l'e-mail | Message quand même conservé, échec indiqué dans le tableau de bord |
| Formulaire | Bouton WhatsApp | Ouvre `wa.me` avec le nom, l'objet et le message |
| Confidentialité | Accès public aux messages (adresse, recherche, API REST) | Aucun accès |
| Redirections | `/about` et autres anciennes adresses | Redirection 301 vers la nouvelle page |

Corrections faites pendant les tests :
- Les photos des pasteurs associés n'avaient pas les proportions d'origine (attributs de taille ajoutés par WordPress) : corrigé.
- Le menu mobile était tronqué quand l'en-tête devenait opaque : le flou de l'en-tête est désormais coupé pendant que le menu est ouvert. Le site React d'origine a probablement le même défaut sur Safari (iPhone), ce qui n'a pas pu être vérifié.
- Une alerte PHP de WordPress dans le Personnaliseur (thème sans zone de widgets) : corrigée.

---

## 5. Écarts voulus et problèmes restants

**Écarts voulus par rapport au site d'origine**
- **Page Contact** : un champ e-mail facultatif a été ajouté au formulaire, pour pouvoir répondre par e-mail (le formulaire d'origine n'envoyait que vers WhatsApp). La page est donc un peu plus haute.
- **Page Enseignements** : la section des ressources PDF n'apparaît que lorsqu'au moins un PDF est téléversé dans *Église › Ressources PDF*. C'était déjà le comportement prévu par le site d'origine, dont les fichiers n'étaient pas fournis.
- **Icônes des réseaux sociaux** : celles dont le lien est vide ou vaut `#` sont masquées. Elles apparaissent dès qu'une adresse est saisie dans *Paramètres du site*.

**Non testé (environnement de test sans accès à Internet)**
- L'envoi réel des e-mails : le traitement a été vérifié jusqu'à `wp_mail`, mais la remise dépend de l'hébergeur. Une extension SMTP est fortement conseillée.
- Le chargement des vidéos YouTube, de la carte Google Maps et des polices Google.
- Le fonctionnement avec une base MySQL ou MariaDB : les tests ont utilisé SQLite. Le code n'utilise que les fonctions standard de WordPress, sans requête SQL directe.
- PHP 7.4 à 8.2 : seul PHP 8.3 a été testé. Le code n'utilise pas de syntaxe propre à PHP 8.
- Safari, Firefox et les vrais téléphones : les tests ont été faits avec Chromium en simulant les tailles d'écran.
- Les extensions de référencement (Yoast, Rank Math, etc.) : le thème détecte leur présence, mais il n'a pas été testé avec elles.
- Le tableau de bord en français : WordPress de test était en anglais. Les textes du thème et de l'extension sont écrits en français ; les textes propres à WordPress (« Publier », « Corbeille »…) seront en français si WordPress est installé en français.

**Points d'attention**
- **Cache de pages** : si une extension de cache garde la page Contact plus de 12 heures, le jeton de sécurité du formulaire peut expirer et le visiteur voit « La session a expiré ». Excluez la page Contact du cache.
- **Proxy ou CDN (Cloudflare…)** : derrière un proxy, tous les visiteurs peuvent sembler venir de la même adresse, et la limite de 5 messages par heure s'appliquerait à tout le monde. Un développeur peut fournir l'adresse réelle avec le filtre `logos_contact_client_ip`, ou modifier la limite avec le filtre `logos_contact_rate_limit` (0 pour la désactiver).
- **Événements** : un événement sans date n'est pas affiché (indiqué dans la liste des événements du tableau de bord).

---

## 6. Pour les développeurs

- Code source : dossier `wordpress/` du dépôt. `wordpress/build.sh` vérifie la syntaxe PHP et produit les deux ZIP dans `wordpress/dist/`.
- La bibliothèque de champs d'administration (`inc/fields/class-logos-fields.php` et `assets/admin/admin-fields.*`) est maintenue dans le thème ; `build.sh` la copie dans l'extension.
- Options du thème : `lt_site`, `lt_header`, `lt_home`, `lt_footer`. Métadonnées des pages : `_lt_page`. Métadonnées des contenus : préfixe `_lt_`.
- Le thème lit les contenus par les fonctions `logos_get_*()` de l'extension ; sans l'extension, il renvoie des listes vides.
