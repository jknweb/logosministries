// Équipe pastorale.
// Sous WordPress : type de contenu « equipe » (photo = image mise en avant).

export const leadPastor = {
  name: 'Rév. Yves Kalombo',
  role: 'Pasteur principal et fondateur',
  photo: '/images/pasteur-yves-kalombo.jpg',
  excerpt:
    'Ingénieur de formation, converti pendant ses études, le pasteur Yves Kalombo prêche l’Évangile depuis les années 1980. Il a fondé Logos Tabernacle en 1987 à Ngaliema-Ozone, avec la conviction de servir Jésus-Christ et d’annoncer Sa Parole avec fidélité.',
  facts: [
    { label: 'Naissance', value: '14 juillet 1959, Dekese' },
    { label: 'Formation', value: 'Ingénieur technicien (ISTA), journalisme et informatique (CEFOJI)' },
    { label: 'Famille', value: 'Marié depuis 1984 à Gorettie Twebana Kalombo, huit enfants' },
    { label: 'Ministère', value: 'Fondateur de Logos Tabernacle (1987)' },
  ],
  bio: [
    {
      title: 'Origines',
      paragraphs: [
        'Le pasteur Yves Kalombo est né le 14 juillet 1959 à Dekese, dans l’ex-Kasaï Occidental, au sein d’une famille de douze enfants dont il est le deuxième. Son père, Kalombo Kabwe Simon Pierre, a travaillé dans l’administration publique avant de terminer sa carrière comme cadre à la SNCC. Sa mère s’appelait Victorine Tshibwabwa Tshimanga.',
      ],
    },
    {
      title: 'Formation',
      paragraphs: [
        'Au gré des mutations professionnelles de son père, il étudie dans plusieurs villes du pays : le primaire au Collège Saint-Louis de Kananga, puis l’Athénée de la Gombe à Kinshasa, et le secondaire à Lubumbashi, au Collège Imara et à l’Institut Kiwele.',
        'À Kinshasa, il obtient le diplôme d’ingénieur technicien en électronique radionavigation à l’Institut Supérieur des Techniciens Appliqués (ISTA). Il se forme ensuite au journalisme et à l’informatique au centre CEFOJI. Ce double profil, technique et communicant, sera mis au service de l’évangélisation et de l’enseignement biblique.',
      ],
    },
    {
      title: 'Famille et médias',
      paragraphs: [
        'En 1984, il épouse Mademoiselle Gorettie Twebana Kalombo. Le couple est parent de huit enfants. En 2003, il crée à Kinshasa un magazine d’informations religieuses, signe de son souci de porter le message chrétien au-delà de la chaire.',
      ],
    },
    {
      title: 'Conversion et appel',
      paragraphs: [
        'Son parcours spirituel est marqué dès sa jeunesse par une recherche profonde du sens de la vie. Pendant ses études, il vit une conversion qui transforme sa vision de l’existence et oriente toute sa vie vers la prédication de l’Évangile. De cette rencontre avec Dieu naît une conviction durable : servir Jésus-Christ et annoncer Sa Parole avec fidélité.',
      ],
    },
  ],
};

// Renseigner `role` pour afficher la fonction sous le nom.
export const associatePastors = [
  { id: 'gershom', name: 'Pasteur Gershom', role: '', photo: '/images/equipe/pasteur-gershom.jpg' },
  { id: 'joel', name: 'Pasteur Joël', role: '', photo: '/images/equipe/pasteur-joel.jpg' },
  { id: 'salem', name: 'Pasteur Salem', role: '', photo: '/images/equipe/pasteur-salem.jpg' },
];
