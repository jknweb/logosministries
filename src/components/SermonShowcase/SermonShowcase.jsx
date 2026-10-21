import Icon from '../Icon';
import YouTubeLite from '../YouTubeLite/YouTubeLite';
import { sermons } from '../../data/sermons';
import { youtubeChannel } from '../../data/site';
import './SermonShowcase.css';

const SermonShowcase = () => {
  const [featured, ...others] = sermons;

  return (
    <div className="sermons">
      <div className="sermons__intro">
        <p className="eyebrow">Enseignements</p>
        <h2 className="heading">La Parole, chaque semaine</h2>
        <p className="lead">
          Nous croyons que la Parole de Dieu est la boussole de notre vie. Retrouvez les prédications et les cultes
          en direct sur notre chaîne YouTube, où que vous soyez.
        </p>
        <div className="sermons__actions">
          <a href={`${youtubeChannel}/streams`} className="btn btn--primary" target="_blank" rel="noopener noreferrer">
            <Icon name="youtube" />
            Tous les enseignements
          </a>
          <a href={`${youtubeChannel}?sub_confirmation=1`} className="btn btn--ghost" target="_blank" rel="noopener noreferrer">
            S’abonner à la chaîne
          </a>
        </div>
      </div>
      <div className="sermons__videos">
        {featured && <YouTubeLite id={featured.id} title={featured.title} />}
        {others.length > 0 && (
          <div className="sermons__more">
            {others.map((s) => <YouTubeLite key={s.id} id={s.id} title={s.title} />)}
          </div>
        )}
      </div>
    </div>
  );
};

export default SermonShowcase;
