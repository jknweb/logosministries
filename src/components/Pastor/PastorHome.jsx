import React from 'react';
import './Pastor.css';

const PastorHome = () => {
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
            <h2 className="section-title">Le Pasteur Visionnaire</h2>
            <div className="title-underline"></div>

            <p className="pastor-text">
              Le pasteur Yves Kalombo est né le 14 juillet 1959 à Dekese, dans l’ex-Kasaï Occidental, au sein d’une famille de douze enfants dont il est le deuxième. Son père, Kalombo Kabwe Simon Pierre, a travaillé dans l’administration publique avant de terminer sa carrière comme cadre à la SNCC, tandis que sa mère s’appelait Victorine Tshibwabwa Tshimanga.
            </p>
            <p className="pastor-text">
              En raison des mutations professionnelles de son père, son parcours scolaire l’a conduit dans plusieurs villes du pays. Il a fait ses études primaires au Collège Saint-Louis de Kananga, puis a poursuivi sa scolarité à Kinshasa, notamment à l’Athénée de la Gombe. Ses études secondaires se sont déroulées à Lubumbashi, au Collège Imara et à l’Institut Kiwele.
            </p>

            <div className="pastor-signature">
              <span className="signature-name">Rév.Yves KALOMBO </span>
              <span className="signature-title">Pasteur Principal</span>
            </div>

            <a href="#vision" className="btn btn-primary mt-4">En savoir plus</a>
          </div>
        </div>
      </div>
    </section>
  );
};

export default PastorHome;
