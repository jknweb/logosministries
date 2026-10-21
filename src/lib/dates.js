const dayFormat = new Intl.DateTimeFormat('fr-FR', { day: '2-digit' });
const monthFormat = new Intl.DateTimeFormat('fr-FR', { month: 'short' });
const longFormat = new Intl.DateTimeFormat('fr-FR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });

// Les dates sont stockées au format ISO (AAAA-MM-JJ), à midi pour éviter les décalages de fuseau.
const toDate = (iso) => new Date(`${iso}T12:00:00`);

export const formatDay = (iso) => dayFormat.format(toDate(iso));
export const formatMonth = (iso) => monthFormat.format(toDate(iso)).replace('.', '');
export const formatLongDate = (iso) => {
  const text = longFormat.format(toDate(iso));
  return text.charAt(0).toUpperCase() + text.slice(1);
};

export const isUpcoming = (iso, now = new Date()) => {
  const today = new Date(now);
  today.setHours(0, 0, 0, 0);
  return toDate(iso) >= today;
};

export const splitEvents = (events, now = new Date()) => {
  const sorted = [...events].sort((a, b) => a.date.localeCompare(b.date));
  return {
    upcoming: sorted.filter((e) => isUpcoming(e.date, now)),
    past: sorted.filter((e) => !isUpcoming(e.date, now)).reverse(),
  };
};
