import { Link } from 'react-router-dom';
import Icon from '../Icon';
import { contact, navigation, site, socials, whatsappUrl } from '../../data/site';
import { schedule } from '../../data/schedule';
import './Footer.css';

const Footer = () => (
  <footer className="site-footer">
    <div className="container">
      <div className="site-footer__grid">
        <div className="site-footer__about">
          <Link to="/" className="site-footer__brand">
            Logos Tabernacle<span>.</span>
          </Link>
          <p>
            Une église fondée en {site.foundedYear} à Ngaliema-Ozone, attachée à la Parole et ouverte à tous.
            Venez tel que vous êtes.
          </p>
          {socials.length > 0 && (
            <ul className="site-footer__socials" aria-label="Réseaux sociaux">
              {socials.map((s) => (
                <li key={s.id}>
                  <a href={s.url} target="_blank" rel="noopener noreferrer" aria-label={s.label}>
                    <Icon name={s.id} size={20} />
                  </a>
                </li>
              ))}
            </ul>
          )}
        </div>

        <div>
          <h2 className="site-footer__title">Navigation</h2>
          <ul className="site-footer__list">
            {navigation.map((item) => (
              <li key={item.to}>
                <Link to={item.to}>{item.label}</Link>
              </li>
            ))}
          </ul>
        </div>

        <div>
          <h2 className="site-footer__title">Horaires</h2>
          <ul className="site-footer__list site-footer__list--schedule">
            {schedule.map((s) => (
              <li key={s.id}>
                <strong>{s.title}</strong>
                <span>{s.day} · {s.time}</span>
              </li>
            ))}
          </ul>
        </div>

        <div>
          <h2 className="site-footer__title">Contact</h2>
          <ul className="site-footer__list site-footer__list--contact">
            <li>
              <Icon name="pin" size={18} />
              <span>{contact.address}<br />{contact.city}</span>
            </li>
            <li>
              <Icon name="phone" size={18} />
              <a href={contact.phoneHref}>{contact.phone}</a>
            </li>
            <li>
              <Icon name="whatsapp" size={18} />
              <a href={whatsappUrl()} target="_blank" rel="noopener noreferrer">WhatsApp</a>
            </li>
            <li>
              <Icon name="mail" size={18} />
              <a href={`mailto:${contact.email}`}>{contact.email}</a>
            </li>
          </ul>
        </div>
      </div>

      <div className="site-footer__bottom">
        <p>&copy; {new Date().getFullYear()} {site.name}. Tous droits réservés.</p>
      </div>
    </div>
  </footer>
);

export default Footer;
