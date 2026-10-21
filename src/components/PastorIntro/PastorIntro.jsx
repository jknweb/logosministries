import { Link } from 'react-router-dom';
import Icon from '../Icon';
import { leadPastor } from '../../data/team';
import './PastorIntro.css';

const PastorIntro = ({ showLink = true }) => (
  <div className="split pastor-intro">
    <figure className="pastor-intro__media">
      <img src={leadPastor.photo} alt={`Portrait du ${leadPastor.name}`} width="555" height="713" loading="lazy" />
    </figure>
    <div>
      <p className="eyebrow">Le pasteur visionnaire</p>
      <h2 className="heading">{leadPastor.name}</h2>
      <p className="lead">{leadPastor.excerpt}</p>
      <dl className="pastor-intro__facts">
        {leadPastor.facts.map((f) => (
          <div key={f.label}>
            <dt>{f.label}</dt>
            <dd>{f.value}</dd>
          </div>
        ))}
      </dl>
      <p className="pastor-intro__signature">
        {leadPastor.name}
        <span>{leadPastor.role}</span>
      </p>
      {showLink && (
        <Link to="/pasteur" className="btn btn--outline">
          Lire sa biographie
          <Icon name="arrow" />
        </Link>
      )}
    </div>
  </div>
);

export default PastorIntro;
