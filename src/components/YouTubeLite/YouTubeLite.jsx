import { useState } from 'react';
import Icon from '../Icon';
import './YouTubeLite.css';

// Affiche la miniature et ne charge le lecteur YouTube qu'au clic (bien plus léger).
const YouTubeLite = ({ id, title }) => {
  const [active, setActive] = useState(false);

  return (
    <div className="yt-lite">
      {active ? (
        <iframe
          src={`https://www.youtube-nocookie.com/embed/${id}?autoplay=1&rel=0`}
          title={title}
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowFullScreen
        />
      ) : (
        <button type="button" className="yt-lite__poster" onClick={() => setActive(true)}>
          <img src={`https://i.ytimg.com/vi/${id}/hqdefault.jpg`} alt="" loading="lazy" />
          <span className="yt-lite__play"><Icon name="play" size={28} /></span>
          <span className="visually-hidden">Lire la vidéo : {title}</span>
        </button>
      )}
    </div>
  );
};

export default YouTubeLite;
