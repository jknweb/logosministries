// Enseignements mis en avant (identifiants de vidéos YouTube).
// Sous WordPress : type de contenu « enseignement » avec un champ « youtube_id ».

export const sermons = [
  { id: 'wZkenFjduRs', title: 'Dernier enseignement' },
  { id: 'zoSMxPDnSYk', title: 'Enseignement précédent' },
  { id: 'lvJ002eSFbw', title: 'Enseignement précédent' },
];

// Ressources PDF. La section ne s'affiche que si la liste contient des fichiers.
// Déposer les PDF dans public/docs/ puis remplacer les '#' (ex. '/docs/recueil-chants.pdf').
export const resources = [
  { id: 'chants', title: 'Recueil des chants', file: '#', size: '2,4 Mo' },
  { id: 'predications', title: 'Résumé des prédications', file: '#', size: '5,1 Mo' },
  { id: 'brochure', title: 'Brochure de l’église', file: '#', size: '3,8 Mo' },
];
