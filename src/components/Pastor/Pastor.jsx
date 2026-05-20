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
              En raison des mutations professionnelles de son père, son parcours scolaire l’a conduit dans plusieurs villes du pays. Il a fait ses études primaires au Collège Saint-Louis de Kananga, puis a poursuivi sa scolarité à Kinshasa, notamment à l’Athénée de la Gombe. Ses études secondaires se sont déroulées à Lubumbashi, au Collège Imara et à l’Institut Kiwele.
            </p>
            <p className="pastor-text">
              Plus tard, à Kinshasa, il a obtenu le diplôme d’ingénieur technicien en électronique radionavigation à l’Institut Supérieur des Techniciens Appliqués (ISTA). Par la suite, il s’est également formé en journalisme et en informatique au centre CEFOJI. Son profil reflète donc une double orientation, à la fois technique et communicative, qu’il mettra plus tard au service de l’évangélisation et de l’enseignement biblique.
            </p>
            <p className="pastor-text">
              En 1984, il s’est marié à Mademoiselle Gorettie Twebana Kalombo, et le couple est parent de huit enfants. En 2003, il a également créé un magazine d’informations religieuses basé à Kinshasa. Cette dimension médiatique montre son intérêt pour la diffusion du message chrétien au-delà de la chaire et de l’assemblée.</p>
            <p className="pastor-text">Son parcours spirituel est marqué par une recherche profonde du sens de la vie dès sa jeunesse. Pendant ses années d’études, il a connu une expérience de conversion qui a transformé sa vision de l’existence et orienté toute sa vie vers la prédication de l’Évangile. Selon son témoignage, cette rencontre avec Dieu a fait naître en lui une conviction durable : servir Jésus-Christ et annoncer Sa Parole avec fidélité. </p>
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
