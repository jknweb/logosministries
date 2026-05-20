import React from 'react';
import './Programs.css';

const Programs = () => {
  return (
    <section className="section programs-section" id="programmes">
      <div className="container">
        <div className="text-center">
          <h2 className="section-title">Nos Programmes</h2>
          <p className="section-subtitle mx-auto">
            Nos rendez-vous hebdomadaires de prière, d’édification et de puissance.
          </p>
        </div>

        <div className="programs-grid">
          {/* Card 1 */}
          <div className="program-card glass">
            <div className="program-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" /></svg>
            </div>
            <h3 className="program-title">Culte du Dimanche</h3>
            <div className="program-time">Chaque dimanche à 8h30</div>
            <p className="program-desc">
              Louange, adoration, prédication de la parole, prière et communion fraternelle.
            </p>
          </div>

          {/* Card 2 */}
          <div className="program-card glass">
            <div className="program-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8" /><path d="M21 3v5h-5" /></svg>
            </div>
            <h3 className="program-title">Culte de la Semaine</h3>
            <div className="program-time">Mardi & Jeudi : 17h30</div>
            <p className="program-desc">
              Enseignement approfondi, intercession, édification et moments de réveil.
            </p>
          </div>

          {/* Card 3 */}
          <div className="program-card glass">
            <div className="program-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <h3 className="program-title">Ecodim</h3>
            <div className="program-time">Chaque dimanche à 7h30</div>
            <p className="program-desc">
              Enseignement biblique pour les enfants, formation ludique et croissance spirituelle.
            </p>
          </div>
        </div>

        <div className="text-center mt-xl">
          <a href="#horaires" className="btn btn-secondary">Voir tous les horaires</a>
        </div>
      </div>
    </section>
  );
};

export default Programs;
