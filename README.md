# Logos Tabernacle Ministries - Documentation du Projet

Ce document sert de guide de référence complet pour le site web "Logos Tabernacle Ministries". Il détaille l'architecture, les technologies, le fonctionnement et les recommandations pour le passage à l'échelle (scaling).

---

## 1. Vue d'Ensemble du Projet

Le site web a été conçu pour refléter l'identité d'une église moderne, premium et spirituelle. Il offre une expérience utilisateur fluide avec des animations douces, une typographie élégante, un design dit "glassmorphism" et une structure responsive.

## 2. Technologies Utilisées

- **Framework Core** : **React.js** (via **Vite**)
  - *Pourquoi ?* React permet de créer une application monopage (SPA) extrêmement réactive, modulaire et maintenable. Vite remplace Webpack/CRA pour offrir des temps de compilation instantanés.
- **Stylisation** : **CSS Vanilla** (pur)
  - *Pourquoi ?* Pour garantir un contrôle au pixel près de la charte graphique de luxe, sans la surcharge de classes inutiles, avec l'utilisation de variables CSS (`:root`) pour un design system propre.
- **Polices (Typographie)** :
  - **Playfair Display** : Typographie à empattement (serif) élégante pour les titres.
  - **Outfit** : Typographie sans empattement (sans-serif) lisible et moderne pour le corps de texte.
- **Icônes** : Fichiers SVG purs pour assurer de hautes performances et éviter le téléchargement de bibliothèques lourdes.

---

## 3. Structure du Répertoire (Architecture)

L'architecture est construite pour être modulaire et facilement évolutive.

```text
logos/
├── public/                     # Fichiers publics (accessibles directement à la racine)
│   ├── hero_church_bg_...png   # Image générée par IA pour l'arrière-plan de l'accueil
│   ├── pastor_portrait_...png  # Portrait généré par IA
│   └── vision_worship_bg_..png # Image de louange/prière générée par IA
├── src/                        # Code source de l'application
│   ├── components/             # Composants d'interface (UI) encapsulés
│   │   ├── Navbar/             # Barre de navigation fixe (Menu & Hamburger)
│   │   ├── Hero/               # Section Accueil (Titre, CTA, fond animé)
│   │   ├── Pastor/             # Section de présentation du pasteur visionnaire
│   │   ├── Programs/           # Cartes descriptives des cultes et réunions
│   │   ├── Teachings/          # Section intégrant un lecteur vidéo YouTube
│   │   ├── Vision/             # Section citation avec effet parallaxe
│   │   └── Footer/             # Pied de page (Contacts, Horaires, etc.)
│   ├── App.jsx                 # Point d'entrée des composants (Assemble la page)
│   ├── App.css                 # Styles structurels de la page globale
│   ├── index.css               # Design System GLOBAL (Variables, Animations, Utilitaires)
│   └── main.jsx                # Point d'ancrage de React dans le DOM HTML
├── index.html                  # Fichier HTML principal
├── package.json                # Dépendances du projet et scripts (npm)
└── vite.config.js              # Configuration du bundler Vite
```

---

## 4. Modules et Fonctionnalités Clés

- **Système de Variables CSS (`index.css`)** : Définit les couleurs (Noir, Anthracite, Or, Beige), les espacements et les polices. Modifier une couleur ici la changera sur tout le site.
- **Glassmorphism** : Utilisé dans `Programs.css` et `Navbar.css` (`backdrop-filter: blur()`), créant un effet de verre dépoli moderne.
- **Effets de Parallaxe & Animations** : 
  - Effet de zoom lent infini sur le Hero (`@keyframes zoomBg`).
  - L'image de la section Vision possède `background-attachment: fixed` pour simuler le parallaxe au défilement.
- **Navigation Mobile** : Un menu "Hamburger" a été codé en pur React/CSS dans `Navbar.jsx`, sans plugin tiers.

---

## 5. Exécution et Déploiement

### Développement en Local
1. Ouvrez un terminal dans le dossier du projet (`/Users/user/Desktop/logos`).
2. Installez les dépendances : `npm install`
3. Lancez le serveur local : `npm run dev`
4. Ouvrez `http://localhost:5173/` dans le navigateur.

### Build pour la Production
1. Générez les fichiers optimisés : `npm run build`
2. Un dossier `dist/` sera créé. Ces fichiers HTML/CSS/JS minifiés peuvent être envoyés sur n'importe quel hébergement statique.

### Options de Déploiement
- **Vercel** ou **Netlify** : Idéal pour les applications Vite/React. Il suffit de lier le dépôt GitHub et ils construiront/déploieront le site automatiquement.
- **Serveur mutualisé (cPanel, Hostinger, OVH)** : Transférez simplement le contenu du dossier `dist/` à la racine de votre serveur via FTP.

---

## 6. Procédure de Scaling (Passage à l'Échelle)

Si l'église grandit et que le site nécessite des fonctionnalités avancées (gestion d'événements, dons en ligne, authentification), voici les recommandations architecturales :

### A. Intégration de Multiples Pages (Routage)
Le site actuel est une "One-Page". Pour rajouter des pages distinctes (ex: `/dons`, `/evenements`) :
- **Action** : Installer `react-router-dom` (`npm install react-router-dom`).
- **Implémentation** : Encapsuler `App` avec `<BrowserRouter>` et définir des `<Routes>`.

### B. Gestion des États Avancée (State Management)
Si des données complexes doivent circuler (ex: panier pour des ressources, système d'authentification pour les membres) :
- **Action** : Introduire le **Context API** (déjà inclus dans React) ou **Zustand** pour une gestion d'état légère. Éviter Redux sauf si l'application devient un SaaS complexe.

### C. Backend et Base de Données
Pour dynamiser le contenu (ex: le pasteur veut ajouter les horaires de culte depuis une interface d'administration) :
- **Solution Headless CMS** : Lier le site React à un CMS comme **Sanity.io** ou **Strapi**. Les articles et vidéos seront fetchés dynamiquement via une API REST ou GraphQL.
- **Solution Base de Données (BaaS)** : Utiliser **Firebase** ou **Supabase** si l'église souhaite récolter des données de contact en direct ou créer un portail membre.

### D. Optimisation des Médias (Scaling des performances)
- **Lazy Loading** : Si le site s'enrichit de nombreuses images de cultes, implémenter l'attribut `loading="lazy"` sur les images et utiliser `React.lazy()` pour fractionner le code (Code Splitting).
- **Hébergement des vidéos** : Toujours utiliser des iFrames (comme fait avec YouTube dans le composant `Teachings`) plutôt que d'héberger les vidéos en local, afin de préserver la bande passante du serveur.

### E. Ajout d'une plateforme de Dons
- **Intégration** : Utiliser l'API de **Stripe** ou de **PayPal** avec des composants React sécurisés. Une simple redirection de bouton vers une page Stripe Checkout est la solution la plus robuste et la plus simple à implémenter.
