import { Link } from 'react-router-dom';
import Icon from '../Icon';
import { whatsappUrl } from '../../data/site';
import './CtaBand.css';

// Appel à l'action de fin de page.
const CtaBand = ({
  title = 'Nous serions heureux de vous accueillir',
  text = 'Une question, une demande de prière ou envie de nous rendre visite ? Écrivez-nous, nous vous répondons rapidement.',
}) => (
  <section className="cta-band">
    <div className="container cta-band__inner">
      <div>
        <h2 className="cta-band__title">{title}</h2>
        <p className="cta-band__text">{text}</p>
      </div>
      <div className="cta-band__actions">
        <Link to="/contact" className="btn btn--primary">
          Nous écrire
          <Icon name="arrow" />
        </Link>
        <a href={whatsappUrl()} className="btn btn--ghost" target="_blank" rel="noopener noreferrer">
          <Icon name="whatsapp" />
          WhatsApp
        </a>
      </div>
    </div>
  </section>
);

export default CtaBand;
