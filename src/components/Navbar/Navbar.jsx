import React, { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';
import './Navbar.css';

const Navbar = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 50);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Fermer le menu mobile lors d'un changement de route
  useEffect(() => {
    setMobileMenuOpen(false);
  }, [location.pathname]);

  return (
    <header className={`navbar ${isScrolled || location.pathname !== '/' ? 'scrolled' : ''}`}>
      <div className="container navbar-container">
        <div className="navbar-logo">
          <Link to="/" style={{ color: 'var(--color-gold)', fontSize: '1.2rem', fontWeight: 'bold', textDecoration: 'none', fontFamily: 'var(--font-heading)' }}>
            Logos Tabernacle
          </Link>
        </div>
        
        <nav className={`navbar-menu ${mobileMenuOpen ? 'open' : ''}`}>
          <Link to="/">Accueil</Link>
          <Link to="/about">À propos</Link>
          <Link to="/pastor">Pasteur</Link>
          <Link to="/programs">Programmes</Link>
          <Link to="/teachings">Enseignements</Link>
          <Link to="/events">Événements</Link>
          <Link to="/contact">Contact</Link>
        </nav>

        <div className="navbar-actions">
          <Link to="/contact" className="btn btn-primary btn-visiter">Nous Visiter</Link>
          <button 
            className={`hamburger ${mobileMenuOpen ? 'active' : ''}`}
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            aria-label="Menu"
          >
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
      </div>
    </header>
  );
};

export default Navbar;
