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
              Le pasteur Yves Kalombo est né le 14 juillet 1959 à Dekese, dans l’ex-Kasaï Occidental, au sein d’une famille de douze enfants dont il est le deuxième. Son père, Kalombo Kabwe Simon Pierre, a travaillé dans l’administration publique avant de terminer sa carrière comme cadre à la SNCC, tandis que sa mère s’appelait Victorine Tshibwabwa Tshimanga.
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
