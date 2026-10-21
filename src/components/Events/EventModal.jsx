import { useEffect, useRef } from 'react';
import Icon from '../Icon';
import { formatLongDate, isUpcoming } from '../../lib/dates';
import { whatsappUrl } from '../../data/site';

const EventModal = ({ event, onClose }) => {
  const closeRef = useRef(null);

  useEffect(() => {
    const onKey = (e) => e.key === 'Escape' && onClose();
    document.addEventListener('keydown', onKey);
    document.body.style.overflow = 'hidden';
    closeRef.current?.focus();
    return () => {
      document.removeEventListener('keydown', onKey);
      document.body.style.overflow = '';
    };
  }, [onClose]);

  const upcoming = isUpcoming(event.date);

  return (
    <div className="event-modal" onClick={onClose}>
      <div
        className="event-modal__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="event-modal-title"
        onClick={(e) => e.stopPropagation()}
      >
        <button ref={closeRef} type="button" className="event-modal__close" onClick={onClose}>
          <Icon name="close" />
          <span className="visually-hidden">Fermer</span>
        </button>
        <img className="event-modal__image" src={event.image} alt="" />
        <div className="event-modal__body">
          <p className="eyebrow">{upcoming ? 'À venir' : 'Événement passé'}</p>
          <h2 id="event-modal-title" className="event-modal__title">{event.title}</h2>
          <ul className="event-modal__facts">
            <li><Icon name="calendar" size={18} />{formatLongDate(event.date)}</li>
            {event.time && <li><Icon name="clock" size={18} />{event.time}</li>}
            {event.location && <li><Icon name="pin" size={18} />{event.location}</li>}
          </ul>
          <p className="event-modal__text">{event.summary}</p>
          {upcoming && (
            <a
              className="btn btn--whatsapp"
              href={whatsappUrl(`Bonjour, je souhaite participer à l’événement « ${event.title} » du ${formatLongDate(event.date)}.`)}
              target="_blank"
              rel="noopener noreferrer"
            >
              <Icon name="whatsapp" />
              Je participe
            </a>
          )}
        </div>
      </div>
    </div>
  );
};

export default EventModal;
