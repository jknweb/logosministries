import React from 'react';
import './Pastor.css';

const Pastor = () => {
  return (
    <section className="section pastor-section" id="pasteur">
      <div className="container">
        <div className="pastor-grid">
          <div className="pastor-image-wrapper">
            <img 
              src="/pasta.jpg" 
              alt="Notre Pasteur Visionnaire" 
              className="pastor-image" 
            />
            <div className="pastor-image-accent"></div>
          </div>
          
          <div className="pastor-content">
            <h2 className="section-title">Notre Pasteur Visionnaire</h2>
            <div className="title-underline"></div>
            
            <p className="pastor-text">
              Appelé par Dieu pour réveiller notre génération, notre pasteur porte une vision 
              claire de restauration et d’excellence. Avec un amour profond pour les âmes, 
              il enseigne la Parole avec autorité, foi et compassion.
            </p>
            <p className="pastor-text">
              Son ministère est marqué par la puissance de la prière, le miracle de la 
              transformation intérieure et un engagement indéfectible envers le réveil spirituel 
              des nations. Rejoignez-nous pour expérimenter cette atmosphère de gloire.
            </p>
            
            <div className="pastor-signature">
              <span className="signature-name">Rev. KALOMBO Yves</span>
              <span className="signature-title">Pasteur Principal</span>
            </div>
            
            <a href="#vision" className="btn btn-primary mt-4">Découvrir sa vision</a>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Pastor;
