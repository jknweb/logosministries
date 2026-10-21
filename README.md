# Logos Tabernacle Ministries · Site web

Site vitrine de l'église Logos Tabernacle (Kinshasa-Ngaliema), construit avec **React + Vite** et du **CSS pur**. La structure est pensée pour être convertie facilement en **thème WordPress**.

## Démarrer

```bash
npm install
npm run dev      # serveur local sur http://localhost:5173
npm run build    # version de production dans dist/
npm run lint     # vérification du code
```

## Modifier le contenu

Tout le contenu éditable est dans `src/data/`, séparé du code :

| Fichier | Contenu |
| --- | --- |
| `site.js` | Nom, coordonnées, WhatsApp, réseaux sociaux, menu, verset d'accueil |
| `schedule.js` | Horaires des cultes et de l'Ecodim |
| `events.js` | Événements (date au format `AAAA-MM-JJ`). Les événements passés sont classés automatiquement. |
| `sermons.js` | Vidéos YouTube mises en avant et PDF à télécharger (la section PDF s'affiche dès qu'un fichier est ajouté) |
| `team.js` | Biographie du pasteur principal et pasteurs associés |
| `ministries.js` | Départements |
| `history.js` | Histoire, frise chronologique, mission et vision |

Pour afficher un réseau social, renseignez son `url` dans `site.js`. Pour afficher la fonction d'un pasteur associé, renseignez `role` dans `team.js`.

Les images sont dans `public/images/` (JPEG compressés, 1600 px de large au maximum).

## Structure

```text
src/
├── data/          Contenu (voir ci-dessus)
├── styles/        tokens.css (couleurs, typo, espacements), base.css, layout.css (sections, boutons, cartes)
├── components/    Un dossier par composant (JSX + CSS)
│   ├── Header, Footer, PageHeader, CtaBand
│   ├── Hero, QuickInfo, Stats, VerseBanner, VisitBlock
│   ├── ScheduleCards, MinistryCards, PastorIntro, Timeline
│   ├── SermonShowcase, YouTubeLite, Events (carte, grille, fenêtre)
│   ├── ContactForm, ScrollManager, Icon
├── pages/         Accueil, À propos, Pasteur, Programmes, Enseignements, Événements, Contact, 404
├── hooks/         usePageTitle (titre et description par page)
└── lib/           dates.js (formatage des dates en français)
```

Conventions : classes CSS nommées façon BEM (`bloc__element--variante`), aucune couleur en dur hors de `tokens.css`, pas de styles en ligne.

## Correspondance WordPress

| Site actuel | Thème WordPress |
| --- | --- |
| `styles/tokens.css` | `theme.json` (palette, typographie, espacements) |
| `Header`, `Footer`, `PageHeader` | `header.php`, `footer.php`, `template-parts/page-header.php` |
| `pages/*.jsx` | Modèles de page (`front-page.php`, `page-a-propos.php`…) |
| `data/events.js` | Type de contenu « evenement » (date, heure, lieu en champs ACF) |
| `data/sermons.js` | Type de contenu « enseignement » (champ `youtube_id`) |
| `data/team.js` | Type de contenu « equipe » |
| `data/ministries.js` | Type de contenu « departement » |
| `data/site.js`, `data/schedule.js` | Options du thème (Customizer ou page d'options ACF) |
| `navigation` dans `site.js` | Menu `primary` (`wp_nav_menu`) |
| `ContactForm` | Contact Form 7, WPForms ou Fluent Forms |

## Formulaire de contact

Sans serveur, le formulaire prépare le message et l'ouvre dans **WhatsApp** ou dans la **messagerie e-mail** du visiteur. Sous WordPress, il sera remplacé par une extension de formulaire.

## Déploiement

Le site est une application monopage : toutes les adresses doivent renvoyer vers `index.html`. Les fichiers nécessaires sont déjà fournis :

- **Netlify** : `public/_redirects`
- **Vercel** : `vercel.json`
- **Hébergement Apache (cPanel, Hostinger…)** : `public/.htaccess`, copié dans `dist/` au build

Les anciennes adresses en anglais (`/about`, `/pastor`…) redirigent vers les nouvelles adresses en français.

## Contenu à confirmer

- Nom officiel à mettre en avant (Logos Tabernacle Ministries ou Logos Fontaine)
- Adresse e-mail `contact@logostabernacle.com`
- Liens Facebook, Instagram, TikTok
- Événements réels à venir (dates, heures, descriptions)
- Fonctions des pasteurs associés
- PDF à proposer en téléchargement
