import React from 'react';
import { Link } from 'react-router-dom';
import './Hero.css';

const Hero = () => {
  return (
    <section className="hero">
      <div className="hero-overlay"></div>
      <div className="container hero-container">
        <div className="hero-content animate-fade-in" style={{ textAlign: 'left', display: 'flex', flexDirection: 'column', alignItems: 'flex-start' }}>
          <span className="hero-subtitle-top">Bienvenue au Logos Tabernacle Ministries</span>
          <h1 className="hero-title">
            Dieu ne fait point acception de personnes, mais qu`en toute nation celui qui le craint et qui pratique la justice lui est agréable.
          </h1>
          <div className="hero-actions">
            <Link to="/programs" className="btn btn-primary">Nos Programmes</Link>
            <Link to="/contact" className="btn btn-outline-gold">Nous Contacter</Link>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;
