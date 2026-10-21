import { useState } from 'react';
import Icon from '../Icon';

// Lecteur habillé aux couleurs du site : l'aperçu, le titre et le bouton sont les nôtres.
// Le lecteur YouTube (sans cookies ni suggestions) ne se charge qu'au clic.
const VideoPlayer = ({ youtubeId, title, poster }) => {
  const [playing, setPlaying] = useState(false);
  const params = 'autoplay=1&rel=0&modestbranding=1&iv_load_policy=3&playsinline=1&color=white';

  return (
    <div className={`player${playing ? ' player--playing' : ''}`}>
      {playing ? (
        <iframe
          src={`https://www.youtube-nocookie.com/embed/${youtubeId}?${params}`}
          title={title}
          allow="autoplay; encrypted-media; picture-in-picture; fullscreen"
          allowFullScreen
        />
      ) : (
        <button type="button" className="player__poster" onClick={() => setPlaying(true)}>
          <img src={poster} alt="" loading="lazy" />
          <span className="player__shade" aria-hidden="true" />
          <span className="player__play" aria-hidden="true">
            <Icon name="play" size={34} />
          </span>
          <span className="player__caption">
            <span className="player__label">Regarder</span>
            <span className="player__title">{title}</span>
          </span>
          <span className="visually-hidden">Lire la vidéo : {title}</span>
        </button>
      )}
    </div>
  );
};

export default VideoPlayer;
