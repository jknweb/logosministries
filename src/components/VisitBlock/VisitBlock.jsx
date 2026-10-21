import Icon from '../Icon';
import { contact, mapsDirectionsUrl, mapsEmbedUrl, whatsappUrl } from '../../data/site';
import { schedule } from '../../data/schedule';
import './VisitBlock.css';

// Bloc « Planifiez votre visite » : horaires, adresse, carte et contacts directs.
const VisitBlock = () => (
  <section className="section section--cream" id="visite">
    <div className="container visit">
      <div className="visit__info">
        <p className="eyebrow">Première visite</p>
        <h2 className="heading">Planifiez votre visite</h2>
        <p className="lead">
          Que vous découvriez la foi ou que vous cherchiez une église, vous êtes le bienvenu.
          Une équipe d’accueil vous reçoit à l’entrée et vous guide.
        </p>

        <ul className="visit__schedule">
          {schedule.map((s) => (
            <li key={s.id}>
              <span>{s.title}</span>
              <strong>{s.day} · {s.time}</strong>
            </li>
          ))}
        </ul>

        <address className="visit__address">
          <Icon name="pin" />
          <span>
            {contact.address}, {contact.city}
            <small>{contact.country}</small>
          </span>
        </address>

        <div className="visit__actions">
          <a href={mapsDirectionsUrl} className="btn btn--primary" target="_blank" rel="noopener noreferrer">
            <Icon name="directions" />
            Itinéraire
          </a>
          <a
            href={whatsappUrl('Bonjour, je souhaite venir à Logos Tabernacle. Pouvez-vous me renseigner ?')}
            className="btn btn--whatsapp"
            target="_blank"
            rel="noopener noreferrer"
          >
            <Icon name="whatsapp" />
            WhatsApp
          </a>
          <a href={contact.phoneHref} className="btn btn--outline">
            <Icon name="phone" />
            Appeler
          </a>
        </div>
      </div>

      <div className="visit__map">
        <iframe
          src={mapsEmbedUrl}
          title="Carte : Logos Tabernacle, avenue Kimpu, Ngaliema"
          loading="lazy"
          referrerPolicy="no-referrer-when-downgrade"
        />
      </div>
    </div>
  </section>
);

export default VisitBlock;
