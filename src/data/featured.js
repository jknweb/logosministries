// Section « À la une » de l'accueil : dernière vidéo et livre en cours.
// Sous WordPress : dernier « enseignement » publié + champs d'options pour le livre.

export const featuredVideo = {
  youtubeId: 'wZkenFjduRs',
  title: 'Le dernier message',
  speaker: 'Logos Tabernacle Ministries',
  date: '', // ex. '2026-10-19'
  summary:
    'Revivez le dernier enseignement partagé à Logos Tabernacle : un temps de Parole pour vous équiper, vous fortifier et nourrir votre foi tout au long de la semaine.',
  // Image d'aperçu affichée avant la lecture (aucune miniature YouTube).
  poster: '/images/ambiance-temple.jpg',
};

// Livre étudié en ce moment. Mettre `null` pour masquer le bloc.
export const currentBook = {
  title: 'Titre du livre en cours',
  author: 'Nom de l’auteur',
  cover: '', // ex. '/images/livre-en-cours.jpg' ; sans image, une couverture dessinée s'affiche
  summary: 'Présentation courte du livre étudié en ce moment à l’église et de ce qu’il apporte aux lecteurs.',
  link: '', // ex. lien d'achat ou PDF
};
