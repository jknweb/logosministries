// Rendez-vous hebdomadaires.
// Sous WordPress : type de contenu « programme » ou champ répétable ACF.

export const schedule = [
  {
    id: 'ecodim',
    title: 'Ecodim',
    day: 'Dimanche',
    time: '7h30',
    icon: 'children',
    audience: 'Enfants',
    summary: 'Enseignement biblique pour les enfants, formation ludique et croissance spirituelle.',
    details: [
      'Classes adaptées à chaque tranche d’âge',
      'Histoires bibliques, chants et activités',
      'Les enfants rejoignent ensuite leurs parents',
    ],
  },
  {
    id: 'culte-dimanche',
    title: 'Culte du dimanche',
    day: 'Dimanche',
    time: '8h30',
    icon: 'worship',
    audience: 'Tout public',
    summary: 'Louange, adoration, prédication de la Parole, prière et communion fraternelle.',
    details: [
      'Louange et adoration avec la chorale',
      'Prédication de la Parole',
      'Prière et communion fraternelle',
    ],
  },
  {
    id: 'culte-semaine',
    title: 'Culte de la semaine',
    day: 'Mardi et jeudi',
    time: '17h30',
    icon: 'book',
    audience: 'Tout public',
    summary: 'Enseignement approfondi, intercession, édification et moments de réveil.',
    details: [
      'Étude approfondie des Écritures',
      'Temps d’intercession',
      'Édification et réveil',
    ],
  },
];
