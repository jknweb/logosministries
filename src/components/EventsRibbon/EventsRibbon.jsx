import React from 'react';
import './EventsRibbon.css';
import eventsData from '../../data/events.json';
import { useNavigate } from 'react-router-dom';

const EventsRibbon = () => {
  const navigate = useNavigate();

  return (
    <section className="events-ribbon-section">
      <div className="ribbon-title">Derniers Événements</div>
      <div className="marquee-container">
        <div className="marquee-content">
          {/* Duplication pour l'effet de boucle infinie */}
          {[...eventsData, ...eventsData].map((event, index) => (
            <div 
              key={`${event.id}-${index}`} 
              className="ribbon-card"
              onClick={() => navigate('/events')}
            >
              <img src={event.thumbnail} alt={event.title} className="ribbon-img" />
              <div className="ribbon-info">
                <span className="ribbon-date">{event.date}</span>
                <h4 className="ribbon-event-title">{event.title}</h4>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default EventsRibbon;
