import VideoPlayer from './VideoPlayer';
import LiveButton from '../LiveButton/LiveButton';
import Icon from '../Icon';
import { featuredVideo } from '../../data/featured';
import { youtubeChannel } from '../../data/site';
import { formatLongDate } from '../../lib/dates';
import './Featured.css';

// Section « À la une » : dernière vidéo mise en ligne.
const Featured = () => (
  <section className="section section--dark featured">
    <div className="container">
      <div className="section__head section__head--center">
        <p className="eyebrow">À la une</p>
        <h2 className="heading">Nourrir votre foi cette semaine</h2>
      </div>

      <div className="featured__grid">
        <VideoPlayer youtubeId={featuredVideo.youtubeId} title={featuredVideo.title} poster={featuredVideo.poster} />

        <aside className="featured__side">
          <div className="featured__info">
            <p className="featured__meta">
              {featuredVideo.speaker}
              {featuredVideo.date && <> · {formatLongDate(featuredVideo.date)}</>}
            </p>
            <p className="featured__summary">{featuredVideo.summary}</p>
            <div className="featured__actions">
              <LiveButton label="Live" />
              <a href={youtubeChannel} className="link-arrow" target="_blank" rel="noopener noreferrer">
                Tous les messages
                <Icon name="arrow" size={18} />
              </a>
            </div>
          </div>

        </aside>
      </div>
    </div>
  </section>
);

export default Featured;
