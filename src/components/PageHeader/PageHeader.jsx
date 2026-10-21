import { Link } from 'react-router-dom';
import './PageHeader.css';

// Bandeau d'en-tête commun aux pages intérieures (template part « page-header »).
const PageHeader = ({ eyebrow, title, intro, image = '/images/temple-interieur.jpg' }) => (
  <section className="page-header" style={{ '--page-header-image': `url(${image})` }}>
    <div className="container fade-up">
      <nav className="page-header__crumbs" aria-label="Fil d’Ariane">
        <Link to="/">Accueil</Link>
        <span aria-hidden="true">/</span>
        <span aria-current="page">{title}</span>
      </nav>
      {eyebrow && <p className="eyebrow">{eyebrow}</p>}
      <h1 className="page-header__title">{title}</h1>
      {intro && <p className="page-header__intro">{intro}</p>}
    </div>
  </section>
);

export default PageHeader;
