import { liveUrl } from '../../data/site';
import './LiveButton.css';

// Bouton vers les directs YouTube des cultes.
const LiveButton = ({ label = 'Live', size = '' }) => (
  <a
    href={liveUrl}
    className={`btn btn--live${size ? ` btn--${size}` : ''}`}
    target="_blank"
    rel="noopener noreferrer"
    aria-label={`${label} sur YouTube`}
  >
    <span className="btn--live__dot" aria-hidden="true" />
    {label}
  </a>
);

export default LiveButton;
