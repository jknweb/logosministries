import React, { useState } from 'react';
import eventsData from '../data/events.json';

const EventsPage = () => {
  const [selectedEvent, setSelectedEvent] = useState(null);

  const openModal = (event) => setSelectedEvent(event);
  const closeModal = () => setSelectedEvent(null);

  return (
    <div className="page-container light-theme" style={{ paddingTop: '100px', paddingBottom: '4rem', position: 'relative' }}>
      <div className="container">
        <h1 className="section-title text-center">Événements à Venir</h1>
        <div className="title-underline mx-auto"></div>

        <div style={{ marginTop: '4rem', display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: '2rem' }}>
          {eventsData.map(event => {
            const dateParts = event.date.split(' ');
            const day = dateParts[0];
            const month = dateParts.slice(1).join(' ');
            
            return (
              <div 
                key={event.id} 
                className="glass event-card" 
                style={{ borderRadius: 'var(--radius-md)', overflow: 'hidden', display: 'flex', flexDirection: 'column', cursor: 'pointer', transition: 'transform 0.3s ease, box-shadow 0.3s ease', backgroundColor: 'white', boxShadow: '0 5px 15px rgba(0,0,0,0.05)' }}
                onClick={() => openModal(event)}
              >
                <div style={{ height: '220px', width: '100%', overflow: 'hidden', position: 'relative' }}>
                  <img src={event.thumbnail} alt={event.title} style={{ width: '100%', height: '100%', objectFit: 'cover', transition: 'transform 0.5s ease' }} className="event-img" />
                  <div style={{ position: 'absolute', top: '1rem', left: '1rem', backgroundColor: 'var(--primary-color)', color: 'white', padding: '0.5rem 1rem', borderRadius: 'var(--radius-sm)', textAlign: 'center', fontWeight: 'bold', boxShadow: '0 5px 15px rgba(0,0,0,0.2)' }}>
                    <span style={{ fontSize: '1.5rem', display: 'block', lineHeight: '1' }}>{day}</span>
                    <span style={{ fontSize: '0.8rem' }}>{month}</span>
                  </div>
                </div>
                <div style={{ padding: '2rem', flex: 1, display: 'flex', flexDirection: 'column' }}>
                  <h3 style={{ fontSize: '1.3rem', marginBottom: '1rem', color: '#111' }}>{event.title}</h3>
                  <button className="btn btn-primary mt-auto" style={{ width: '100%' }}>Voir les détails</button>
                </div>
              </div>
            );
          })}
        </div>
      </div>

      {/* Modal Popup */}
      {selectedEvent && (
        <div 
          className="modal-overlay" 
          style={{ position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, backgroundColor: 'rgba(0,0,0,0.7)', zIndex: 1000, display: 'flex', alignItems: 'center', justifyContent: 'center', padding: '1rem', opacity: 1, animation: 'fadeIn 0.3s ease' }}
          onClick={closeModal}
        >
          <div 
            className="modal-content" 
            style={{ backgroundColor: 'white', borderRadius: '16px', width: '100%', maxWidth: '600px', overflow: 'hidden', position: 'relative', transform: 'translateY(0)', animation: 'slideUp 0.3s ease', boxShadow: '0 25px 50px rgba(0,0,0,0.25)' }}
            onClick={e => e.stopPropagation()}
          >
            <button 
              onClick={closeModal} 
              style={{ position: 'absolute', top: '1rem', right: '1rem', background: 'rgba(255,255,255,0.9)', border: 'none', borderRadius: '50%', width: '40px', height: '40px', display: 'flex', alignItems: 'center', justifyContent: 'center', cursor: 'pointer', zIndex: 10, boxShadow: '0 2px 10px rgba(0,0,0,0.1)', transition: 'background 0.3s' }}
              onMouseOver={e => e.currentTarget.style.background = 'white'}
              onMouseOut={e => e.currentTarget.style.background = 'rgba(255,255,255,0.9)'}
            >
              <svg width="24" height="24" fill="none" stroke="#111" strokeWidth="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
            <div style={{ height: '300px', width: '100%' }}>
              <img src={selectedEvent.thumbnail} alt={selectedEvent.title} style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
            </div>
            <div style={{ padding: '2.5rem' }}>
              <div style={{ color: 'var(--secondary-color)', fontWeight: 'bold', marginBottom: '0.5rem', textTransform: 'uppercase', fontSize: '0.9rem', letterSpacing: '1px' }}>{selectedEvent.date}</div>
              <h2 style={{ fontSize: '1.8rem', marginBottom: '1.5rem', color: '#111', fontFamily: 'var(--font-heading)' }}>{selectedEvent.title}</h2>
              <p style={{ color: '#555', lineHeight: '1.8', fontSize: '1.1rem', margin: 0 }}>{selectedEvent.details}</p>
            </div>
          </div>
        </div>
      )}

      <style dangerouslySetInnerHTML={{__html: `
        .event-card:hover {
          transform: translateY(-10px) !important;
          box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }
        .event-card:hover .event-img {
          transform: scale(1.1) !important;
        }
        @keyframes fadeIn {
          from { opacity: 0; }
          to { opacity: 1; }
        }
        @keyframes slideUp {
          from { transform: translateY(50px); opacity: 0; }
          to { transform: translateY(0); opacity: 1; }
        }
      `}} />
    </div>
  );
};

export default EventsPage;
