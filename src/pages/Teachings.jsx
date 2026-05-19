import React from 'react';
import TeachingsComponent from '../components/Teachings/Teachings';

const TeachingsPage = () => {
  return (
    <div className="page-container light-theme" style={{ paddingTop: '100px', paddingBottom: '0' }}>
      <h1 className="section-title text-center" style={{ marginBottom: '2rem', color: '#111' }}>Replays & Enseignements</h1>
      <TeachingsComponent />
      
      <section className="documents-section" style={{ padding: '4rem 0', backgroundColor: '#f9fafb', marginTop: '3rem' }}>
        <div className="container">
          <h3 className="text-center" style={{ fontFamily: 'var(--font-heading)', fontSize: '2rem', marginBottom: '3rem', color: '#111' }}>
            Ressources à Télécharger
          </h3>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: '2rem' }}>
            
            <div className="doc-card" style={{ backgroundColor: 'white', padding: '2rem', borderRadius: '12px', boxShadow: '0 10px 30px rgba(0,0,0,0.05)', display: 'flex', alignItems: 'center', gap: '1.5rem', transition: 'transform 0.3s ease, box-shadow 0.3s ease', cursor: 'pointer' }}>
              <div style={{ width: '60px', height: '60px', borderRadius: '50%', backgroundColor: '#eef2ff', display: 'flex', alignItems: 'center', justifyContent: 'center', color: 'var(--primary-color)' }}>
                <svg width="28" height="28" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M14 2v14M14 16l-5-5M14 16l5-5M3 20h18"/></svg>
              </div>
              <div>
                <h4 style={{ fontSize: '1.1rem', marginBottom: '0.25rem', color: '#111' }}>Recueil des Chants</h4>
                <p style={{ color: '#666', fontSize: '0.9rem', marginBottom: '0' }}>Format PDF • 2.4 MB</p>
              </div>
              <div style={{ marginLeft: 'auto' }}>
                <span className="doc-badge" style={{ display: 'inline-block', padding: '0.5rem 1rem', borderRadius: '50px', backgroundColor: 'var(--primary-color)', color: 'white', fontSize: '0.85rem', fontWeight: '500', transition: 'background-color 0.3s ease' }}>Télécharger</span>
              </div>
            </div>

            <div className="doc-card" style={{ backgroundColor: 'white', padding: '2rem', borderRadius: '12px', boxShadow: '0 10px 30px rgba(0,0,0,0.05)', display: 'flex', alignItems: 'center', gap: '1.5rem', transition: 'transform 0.3s ease, box-shadow 0.3s ease', cursor: 'pointer' }}>
              <div style={{ width: '60px', height: '60px', borderRadius: '50%', backgroundColor: '#eef2ff', display: 'flex', alignItems: 'center', justifyContent: 'center', color: 'var(--primary-color)' }}>
                <svg width="28" height="28" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M14 2v14M14 16l-5-5M14 16l5-5M3 20h18"/></svg>
              </div>
              <div>
                <h4 style={{ fontSize: '1.1rem', marginBottom: '0.25rem', color: '#111' }}>Résumé des Prédications</h4>
                <p style={{ color: '#666', fontSize: '0.9rem', marginBottom: '0' }}>Format PDF • 5.1 MB</p>
              </div>
              <div style={{ marginLeft: 'auto' }}>
                <span className="doc-badge" style={{ display: 'inline-block', padding: '0.5rem 1rem', borderRadius: '50px', backgroundColor: 'var(--primary-color)', color: 'white', fontSize: '0.85rem', fontWeight: '500', transition: 'background-color 0.3s ease' }}>Télécharger</span>
              </div>
            </div>

            <div className="doc-card" style={{ backgroundColor: 'white', padding: '2rem', borderRadius: '12px', boxShadow: '0 10px 30px rgba(0,0,0,0.05)', display: 'flex', alignItems: 'center', gap: '1.5rem', transition: 'transform 0.3s ease, box-shadow 0.3s ease', cursor: 'pointer' }}>
              <div style={{ width: '60px', height: '60px', borderRadius: '50%', backgroundColor: '#eef2ff', display: 'flex', alignItems: 'center', justifyContent: 'center', color: 'var(--primary-color)' }}>
                <svg width="28" height="28" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M14 2v14M14 16l-5-5M14 16l5-5M3 20h18"/></svg>
              </div>
              <div>
                <h4 style={{ fontSize: '1.1rem', marginBottom: '0.25rem', color: '#111' }}>Brochure de l'Église</h4>
                <p style={{ color: '#666', fontSize: '0.9rem', marginBottom: '0' }}>Format PDF • 3.8 MB</p>
              </div>
              <div style={{ marginLeft: 'auto' }}>
                <span className="doc-badge" style={{ display: 'inline-block', padding: '0.5rem 1rem', borderRadius: '50px', backgroundColor: 'var(--primary-color)', color: 'white', fontSize: '0.85rem', fontWeight: '500', transition: 'background-color 0.3s ease' }}>Télécharger</span>
              </div>
            </div>

          </div>
        </div>
        <style dangerouslySetInnerHTML={{__html: `
          .doc-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
          }
          .doc-card:hover .doc-badge {
            background-color: var(--secondary-color) !important;
          }
        `}} />
      </section>
    </div>
  );
};

export default TeachingsPage;
