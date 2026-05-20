import React from 'react';
import PastorComponent from '../components/Pastor/Pastor';

const PastorPage = () => {
  return (
    <div className="page-container light-theme" style={{ paddingTop: '100px', paddingBottom: '4rem' }}>
      {/* Réutilisation du composant existant pour le pasteur principal */}
      <PastorComponent />

      {/* Ajout des pasteurs secondaires */}
      <section className="secondary-pastors" style={{ padding: '4rem 0' }}>
        <div className="container">
          <h3 className="text-center" style={{ fontFamily: 'var(--font-heading)', fontSize: '2rem', marginBottom: '3rem' }}>
            Nos Pasteurs Associés
          </h3>

          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))', gap: '2rem' }}>
            {/* Pasteur 1 */}
            <div className="glass pastor-card" style={{ padding: '2rem', borderRadius: 'var(--radius-md)', textAlign: 'center', transition: 'transform 0.3s ease, box-shadow 0.3s ease' }}>
              <div className="pastor-avatar" style={{ width: '150px', height: '150px', borderRadius: '50%', backgroundColor: '#eee', margin: '0 auto 1.5rem', overflow: 'hidden', border: '4px solid white', boxShadow: '0 10px 20px rgba(0,0,0,0.1)' }}>
                <img src="/gershom.jpg" alt="Pasteur Gershom" className="pastor-img" style={{ width: '100%', height: '100%', objectFit: 'cover', transition: 'transform 0.5s ease' }} />
              </div>
              <h4 style={{ fontSize: '1.2rem', marginBottom: '0.5rem' }}>Pasteur Gershom</h4>
              {/*<p style={{ color: '#666', fontSize: '0.9rem' }}>Enseignement & Formation</p>*/}
            </div>

            {/* Pasteur 2 */}
            <div className="glass pastor-card" style={{ padding: '2rem', borderRadius: 'var(--radius-md)', textAlign: 'center', transition: 'transform 0.3s ease, box-shadow 0.3s ease' }}>
              <div className="pastor-avatar" style={{ width: '150px', height: '150px', borderRadius: '50%', backgroundColor: '#eee', margin: '0 auto 1.5rem', overflow: 'hidden', border: '4px solid white', boxShadow: '0 10px 20px rgba(0,0,0,0.1)' }}>
                <img src="/joel.jpg" alt="Pasteur Joël" className="pastor-img" style={{ width: '100%', height: '100%', objectFit: 'cover', transition: 'transform 0.5s ease' }} />
              </div>
              <h4 style={{ fontSize: '1.2rem', marginBottom: '0.5rem' }}>Pasteur Joël</h4>
              {/* <p style={{ color: '#666', fontSize: '0.9rem' }}>Évangélisation</p> */}
            </div>

            {/* Pasteur 3 */}
            <div className="glass pastor-card" style={{ padding: '2rem', borderRadius: 'var(--radius-md)', textAlign: 'center', transition: 'transform 0.3s ease, box-shadow 0.3s ease' }}>
              <div className="pastor-avatar" style={{ width: '150px', height: '150px', borderRadius: '50%', backgroundColor: '#eee', margin: '0 auto 1.5rem', overflow: 'hidden', border: '4px solid white', boxShadow: '0 10px 20px rgba(0,0,0,0.1)' }}>
                <img src="/salem.jpg" alt="Pasteur Salem" className="pastor-img" style={{ width: '100%', height: '100%', objectFit: 'cover', transition: 'transform 0.5s ease' }} />
              </div>
              <h4 style={{ fontSize: '1.2rem', marginBottom: '0.5rem' }}>Pasteur Salem</h4>
              {/* <p style={{ color: '#666', fontSize: '0.9rem' }}>Jeunesse & Ecodim</p> */}
            </div>
          </div>

          <style dangerouslySetInnerHTML={{
            __html: `
            .pastor-card:hover {
              transform: translateY(-10px);
              box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
            }
            .pastor-card:hover .pastor-img {
              transform: scale(1.1);
            }
            .pastor-avatar {
              position: relative;
              z-index: 1;
            }
            .pastor-avatar::after {
              content: '';
              position: absolute;
              top: 0; left: 0; right: 0; bottom: 0;
              border-radius: 50%;
              box-shadow: inset 0 0 20px rgba(0,0,0,0.1);
              pointer-events: none;
            }
          `}} />
        </div>
      </section>
    </div>
  );
};

export default PastorPage;
