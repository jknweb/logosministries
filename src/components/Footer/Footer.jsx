import React from 'react';
import './Footer.css';

const Footer = () => {
  return (
    <footer className="footer" id="contact">
      <div className="container">
        <div className="footer-grid">
          {/* Column 1 */}
          <div className="footer-col">
            <div className="footer-logo">
              Logos Tabernacle<span>.</span>
            </div>
            <div className="footer-programs">
              <h4 className="footer-subtitle">Programme des cultes</h4>
              <ul className="footer-list">
                <li><strong>Culte du Dimanche :</strong> 9h00</li>
                <li><strong>Culte de la Semaine :</strong> Mardi et Jeudi à 18h30</li>
                <li><strong>Ecodim :</strong> Dimanche à 7h30</li>
              </ul>
            </div>
          </div>

          {/* Column 2 */}
          <div className="footer-col">
            <h4 className="footer-title">Adresse et Contact</h4>
            <ul className="footer-list footer-contact">
              <li>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span>123 Avenue de la Paix, Ville, Pays</span>
              </li>
              <li>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                <span>+123 456 789 000</span>
              </li>
              <li>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <span>contact@logostabernacle.com</span>
              </li>
              <li>
                {/* WhatsApp Icon */}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                <span>+123 456 789 001 (WhatsApp)</span>
              </li>
            </ul>
            <a href="#map" className="btn btn-outline-gold mt-4">Nous localiser</a>
          </div>
        </div>

        <div className="footer-bottom">
          <div className="footer-line"></div>
          <p className="copyright">
            &copy; 2026 Logos Tabernacle Ministries. Tous droits réservés.
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
