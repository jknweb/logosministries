import React from 'react';
import ProgramsComponent from '../components/Programs/Programs';

const ProgramsPage = () => {
  return (
    <div className="page-container light-theme" style={{ paddingTop: '100px', paddingBottom: '4rem' }}>
      <ProgramsComponent />
      
      <section className="other-ministries" style={{ padding: '4rem 0' }}>
        <div className="container">
          <h2 className="section-title text-center" style={{ color: '#111' }}>Nos Départements</h2>
          <div className="title-underline mx-auto"></div>

          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: '3rem', marginTop: '3rem' }}>
            
            <div className="glass" style={{ padding: '2rem', borderRadius: 'var(--radius-md)' }}>
              <h3 style={{ marginBottom: '1rem', fontFamily: 'var(--font-heading)' }}>Musique & Louange</h3>
              <p style={{ lineHeight: '1.6' }}>Notre chorale et groupe de louange transportent l'assemblée dans des temps d'adoration profonds et prophétiques chaque dimanche.</p>
            </div>

            <div className="glass" style={{ padding: '2rem', borderRadius: 'var(--radius-md)' }}>
              <h3 style={{ marginBottom: '1rem', fontFamily: 'var(--font-heading)' }}>Département des Mamans</h3>
              <p style={{ lineHeight: '1.6' }}>Un rassemblement de femmes fortes, priantes et dévouées qui intercèdent pour l'église, la famille et la nation, tout en œuvrant dans le social.</p>
            </div>

            <div className="glass" style={{ padding: '2rem', borderRadius: 'var(--radius-md)' }}>
              <h3 style={{ marginBottom: '1rem', fontFamily: 'var(--font-heading)' }}>Intercession</h3>
              <p style={{ lineHeight: '1.6' }}>Le moteur de notre église. Une équipe dédiée qui se tient à la brèche nuit et jour pour soutenir le ministère et les requêtes des fidèles.</p>
            </div>

            <div className="glass" style={{ padding: '2rem', borderRadius: 'var(--radius-md)' }}>
              <h3 style={{ marginBottom: '1rem', fontFamily: 'var(--font-heading)' }}>Action Sociale</h3>
              <p style={{ lineHeight: '1.6' }}>L'Évangile en action. Nous visitons les malades, soutenons les orphelins et aidons les démunis pour manifester l'amour de Christ concrètement.</p>
            </div>

          </div>
        </div>
      </section>
    </div>
  );
};

export default ProgramsPage;
