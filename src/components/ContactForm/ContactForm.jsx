import { useState } from 'react';
import Icon from '../Icon';
import { contact, whatsappUrl } from '../../data/site';
import './ContactForm.css';

const subjects = ['Question générale', 'Demande de prière', 'Première visite', 'Rejoindre un département', 'Autre'];

// Sans serveur, le message est transmis par WhatsApp ou par e-mail.
// Sous WordPress : remplacer par Contact Form 7, WPForms ou Fluent Forms.
const ContactForm = () => {
  const [form, setForm] = useState({ name: '', phone: '', subject: subjects[0], message: '' });
  const [error, setError] = useState('');

  const update = (field) => (e) => setForm({ ...form, [field]: e.target.value });

  const compose = () =>
    `Bonjour, je m’appelle ${form.name}.${form.phone ? ` (Tél. : ${form.phone})` : ''}\n` +
    `Objet : ${form.subject}\n\n${form.message}`;

  const validate = () => {
    if (!form.name.trim() || !form.message.trim()) {
      setError('Merci d’indiquer votre nom et votre message.');
      return false;
    }
    setError('');
    return true;
  };

  const sendWhatsApp = (e) => {
    e.preventDefault();
    if (validate()) window.open(whatsappUrl(compose()), '_blank', 'noopener');
  };

  const sendEmail = () => {
    if (!validate()) return;
    const subject = encodeURIComponent(`${form.subject} · ${form.name}`);
    window.location.href = `mailto:${contact.email}?subject=${subject}&body=${encodeURIComponent(compose())}`;
  };

  return (
    <form className="contact-form" onSubmit={sendWhatsApp} noValidate>
      <div className="contact-form__row">
        <label className="field">
          <span>Nom complet *</span>
          <input type="text" name="name" autoComplete="name" value={form.name} onChange={update('name')} required />
        </label>
        <label className="field">
          <span>Téléphone</span>
          <input type="tel" name="phone" autoComplete="tel" value={form.phone} onChange={update('phone')} />
        </label>
      </div>
      <label className="field">
        <span>Objet</span>
        <select name="subject" value={form.subject} onChange={update('subject')}>
          {subjects.map((s) => <option key={s}>{s}</option>)}
        </select>
      </label>
      <label className="field">
        <span>Votre message *</span>
        <textarea name="message" rows="5" value={form.message} onChange={update('message')} required />
      </label>

      {error && <p className="contact-form__error" role="alert">{error}</p>}

      <div className="contact-form__actions">
        <button type="submit" className="btn btn--whatsapp">
          <Icon name="whatsapp" />
          Envoyer par WhatsApp
        </button>
        <button type="button" className="btn btn--outline" onClick={sendEmail}>
          <Icon name="mail" />
          Envoyer par e-mail
        </button>
      </div>
      <p className="contact-form__note">
        Votre message s’ouvre dans WhatsApp ou dans votre messagerie, prêt à être envoyé.
      </p>
    </form>
  );
};

export default ContactForm;
