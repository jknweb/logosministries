import Icon from '../Icon';
import { formatDay, formatLongDate, formatMonth } from '../../lib/dates';

const EventCard = ({ event, past = false, onOpen }) => (
  <article className={`event-card${past ? ' event-card--past' : ''}`}>
    <div className="event-card__media">
      <img src={event.image} alt="" loading="lazy" />
      <span className="event-card__date">
        <strong>{formatDay(event.date)}</strong>
        {formatMonth(event.date)}
      </span>
    </div>
    <div className="event-card__body">
      <p className="event-card__meta">
        <Icon name="calendar" size={16} />
        {formatLongDate(event.date)}{event.time && ` · ${event.time}`}
      </p>
      <h3 className="event-card__title">{event.title}</h3>
      <p className="event-card__text">{event.summary}</p>
      <button type="button" className="link-arrow event-card__more" onClick={() => onOpen(event)}>
        Voir les détails
        <Icon name="arrow" size={18} />
      </button>
    </div>
  </article>
);

export default EventCard;
