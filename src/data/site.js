// Réglages généraux du site.
// Sous WordPress : options du thème (Customizer ou page d'options ACF).

export const site = {
  name: 'Logos Tabernacle Ministries',
  shortName: 'Logos Tabernacle',
  tagline: 'Une famille centrée sur la Parole depuis 1987',
  foundedYear: 1987,
  capacity: 2500,
  logo: '/images/logo-logos.png',
};

export const contact = {
  address: '09, avenue Kimpu, Barré/Ozone',
  city: 'Kinshasa-Ngaliema',
  country: 'République démocratique du Congo',
  phone: '+243 818 139 464',
  phoneHref: 'tel:+243818139464',
  whatsapp: '243999949822',
  whatsappDisplay: '+243 999 949 822',
  email: 'contact@logostabernacle.com',
  mapsQuery: '09 avenue Kimpu, Ozone, Ngaliema, Kinshasa',
};

export const mapsEmbedUrl = `https://www.google.com/maps?q=${encodeURIComponent(contact.mapsQuery)}&output=embed`;
export const mapsDirectionsUrl = `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(contact.mapsQuery)}`;

export const whatsappUrl = (text = '') =>
  `https://wa.me/${contact.whatsapp}${text ? `?text=${encodeURIComponent(text)}` : ''}`;

// Remplacer les '#' par les vrais liens. Laisser `url` vide masque le lien.
export const socials = [
  { id: 'youtube', label: 'YouTube', url: 'https://www.youtube.com/@Logosfontaine' },
  { id: 'facebook', label: 'Facebook', url: '#' },
  { id: 'instagram', label: 'Instagram', url: '#' },
  { id: 'tiktok', label: 'TikTok', url: '#' },
].filter((s) => s.url);

export const youtubeChannel = 'https://www.youtube.com/@Logosfontaine';

// Sous WordPress : menu « primary » (wp_nav_menu).
export const navigation = [
  { to: '/', label: 'Accueil' },
  { to: '/a-propos', label: 'À propos' },
  { to: '/pasteur', label: 'Pasteur' },
  { to: '/programmes', label: 'Programmes' },
  { to: '/enseignements', label: 'Enseignements' },
  { to: '/evenements', label: 'Événements' },
  { to: '/contact', label: 'Contact' },
];

export const heroVerse = {
  text: 'Dieu ne fait point acception de personnes, mais en toute nation celui qui le craint et qui pratique la justice lui est agréable.',
  reference: 'Actes 10:34-35',
};
