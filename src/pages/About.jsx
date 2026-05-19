import React from 'react';

const About = () => {
  return (
    <div className="page-container light-theme" style={{ paddingTop: '100px', paddingBottom: '4rem' }}>
      <div className="container">
        <h1 className="section-title text-center">À Propos de Nous</h1>
        <div className="title-underline mx-auto"></div>
        <div style={{ maxWidth: '800px', margin: '3rem auto', fontSize: '1.1rem', lineHeight: '1.8' }}>
          <p style={{ marginBottom: '1.5rem' }}>
            <strong>Logos Tabernacle Ministries</strong> est une église de réveil fondée sur la puissance de l'Évangile de Jésus-Christ. Nous sommes une communauté dynamique, chaleureuse et résolument tournée vers l'excellence spirituelle.
          </p>
          <p style={{ marginBottom: '1.5rem' }}>
            Notre mission est de restaurer les vies par la prière, d'enseigner la Parole de Dieu avec profondeur et de préparer une génération à expérimenter la gloire de Dieu au quotidien.
          </p>
          <p>
            Que vous soyez à la recherche de réponses, en quête de croissance spirituelle ou désireux de servir le Seigneur, vous trouverez ici une famille prête à vous accueillir avec amour.
          </p>
        </div>
      </div>
    </div>
  );
};

export default About;
