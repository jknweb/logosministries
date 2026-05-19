import React from 'react';

const ContactPage = () => {
  return (
    <div className="page-container light-theme" style={{ paddingTop: '100px', paddingBottom: '4rem' }}>
      <div className="container">
        <h1 className="section-title text-center">Nous Contacter</h1>
        <div className="title-underline mx-auto"></div>

        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '4rem', marginTop: '4rem' }}>
          
          <div className="contact-info">
            <h3 style={{ marginBottom: '1.5rem', fontSize: '1.5rem' }}>Nos Coordonnées</h3>
            <ul style={{ listStyle: 'none', padding: 0, lineHeight: '2' }}>
              <li style={{ marginBottom: '1rem', display: 'flex', alignItems: 'center', gap: '1rem' }}>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-gold)" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                123 Avenue de la Paix, Ville, Pays
              </li>
              <li style={{ marginBottom: '1rem', display: 'flex', alignItems: 'center', gap: '1rem' }}>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-gold)" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                +123 456 789 000
              </li>
              <li style={{ marginBottom: '1rem', display: 'flex', alignItems: 'center', gap: '1rem' }}>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-gold)" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                contact@logostabernacle.com
              </li>
            </ul>
          </div>

          <div className="contact-form glass" style={{ padding: '2rem', borderRadius: 'var(--radius-md)' }}>
            <h3 style={{ marginBottom: '1.5rem' }}>Envoyez-nous un message</h3>
            <form style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
              <input type="text" placeholder="Votre Nom" style={{ padding: '1rem', borderRadius: '4px', border: 'none' }} />
              <input type="email" placeholder="Votre Email" style={{ padding: '1rem', borderRadius: '4px', border: 'none' }} />
              <textarea placeholder="Votre Message" rows="5" style={{ padding: '1rem', borderRadius: '4px', border: 'none', resize: 'vertical' }}></textarea>
              <button type="button" className="btn btn-primary" style={{ marginTop: '1rem' }}>Envoyer</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  );
};

export default ContactPage;
