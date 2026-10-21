import { Link } from 'react-router-dom';
import Icon from '../Icon';
import { contact } from '../../data/site';
import { schedule } from '../../data/schedule';
import './QuickInfo.css';

// Barre d'informations pratiques sous le hero.
const QuickInfo = () => (
  <section className="quick-info" aria-label="Informations pratiques">
    <div className="container quick-info__grid">
      {schedule.map((s) => (
        <div className="quick-info__item" key={s.id}>
          <Icon name="clock" className="quick-info__icon" />
          <div>
            <strong>{s.title}</strong>
            <span>{s.day} à {s.time}</span>
          </div>
        </div>
      ))}
      <Link to="/#visite" className="quick-info__item quick-info__item--link">
        <Icon name="pin" className="quick-info__icon" />
        <div>
          <strong>{contact.address}</strong>
          <span>{contact.city}</span>
        </div>
      </Link>
    </div>
  </section>
);

export default QuickInfo;
