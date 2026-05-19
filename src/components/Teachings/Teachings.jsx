import React from 'react';
import './Teachings.css';

const Teachings = () => {
  return (
    <section className="section teachings-section" id="enseignements">
      <div className="container">
        <div className="teachings-grid">
          <div className="teachings-content">
            <h2 className="section-title">Nos Enseignements</h2>
            <div className="title-underline"></div>
            <p className="teachings-text">
              Nous croyons que la Parole de Dieu est la boussole de notre vie. 
              Chaque semaine, nous partageons des messages puissants, prophétiques et 
              bibliquement fondés pour vous équiper, vous fortifier et vous préparer 
              au retour de Christ.
            </p>
            <p className="teachings-text">
              Plongez dans les profondeurs des Écritures et laissez la vérité vous affranchir.
            </p>
            <a href="#youtube" className="btn btn-primary mt-4">Voir les enseignements</a>
          </div>
          
          <div className="teachings-video-wrapper animate-fade-in" style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
            <div className="video-container" style={{ borderRadius: 'var(--radius-md)', overflow: 'hidden', boxShadow: '0 10px 30px rgba(0,0,0,0.3)' }}>
              <iframe 
                width="100%" 
                style={{ aspectRatio: '16/9' }}
                src="https://www.youtube.com/embed/wZkenFjduRs" 
                title="Dernier Sermon" 
                frameBorder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowFullScreen
              ></iframe>
            </div>
            
            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
              <div className="video-container" style={{ borderRadius: 'var(--radius-sm)', overflow: 'hidden', boxShadow: '0 5px 15px rgba(0,0,0,0.2)' }}>
                <iframe 
                  width="100%" 
                  style={{ aspectRatio: '16/9' }}
                  src="https://www.youtube.com/embed/zoSMxPDnSYk" 
                  title="Sermon Précédent 1" 
                  frameBorder="0" 
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                  allowFullScreen
                ></iframe>
              </div>
              <div className="video-container" style={{ borderRadius: 'var(--radius-sm)', overflow: 'hidden', boxShadow: '0 5px 15px rgba(0,0,0,0.2)' }}>
                <iframe 
                  width="100%" 
                  style={{ aspectRatio: '16/9' }}
                  src="https://www.youtube.com/embed/lvJ002eSFbw" 
                  title="Sermon Précédent 2" 
                  frameBorder="0" 
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                  allowFullScreen
                ></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Teachings;
