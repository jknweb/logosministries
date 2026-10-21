import Icon from '../Icon';
import { ministries } from '../../data/ministries';
import { whatsappUrl } from '../../data/site';

const MinistryCards = () => (
  <div className="grid grid--3">
    {ministries.map((m) => (
      <article className="card" key={m.id}>
        <span className="card__icon"><Icon name={m.icon} /></span>
        <h3 className="card__title">{m.title}</h3>
        <p className="card__text">{m.text}</p>
        <a
          className="link-arrow card__link"
          href={whatsappUrl(`Bonjour, je souhaite rejoindre le département « ${m.title} ».`)}
          target="_blank"
          rel="noopener noreferrer"
        >
          Rejoindre ce département
          <Icon name="arrow" size={18} />
        </a>
      </article>
    ))}
  </div>
);

export default MinistryCards;
