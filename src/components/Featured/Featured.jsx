import VideoPlayer from './VideoPlayer';
import LiveButton from '../LiveButton/LiveButton';
import Icon from '../Icon';
import { currentBook, featuredVideo } from '../../data/featured';
import { youtubeChannel } from '../../data/site';
import { formatLongDate } from '../../lib/dates';
import './Featured.css';

// Section « À la une » : dernière vidéo et livre en cours.
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

          {currentBook && (
            <article className="book">
              <div className="book__cover" aria-hidden={!currentBook.cover}>
                {currentBook.cover ? (
                  <img src={currentBook.cover} alt={`Couverture : ${currentBook.title}`} loading="lazy" />
                ) : (
                  <span className="book__cover-art">
                    <Icon name="book" size={26} />
                    <span>{currentBook.title}</span>
                  </span>
                )}
              </div>
              <div className="book__body">
                <p className="book__label">Livre en cours</p>
                <h3 className="book__title">{currentBook.title}</h3>
                <p className="book__author">{currentBook.author}</p>
                <p className="book__summary">{currentBook.summary}</p>
                {currentBook.link && (
                  <a href={currentBook.link} className="link-arrow" target="_blank" rel="noopener noreferrer">
                    En savoir plus
                    <Icon name="arrow" size={18} />
                  </a>
                )}
              </div>
            </article>
          )}
        </aside>
      </div>
    </div>
  </section>
);

export default Featured;
