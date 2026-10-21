import { Link } from 'react-router-dom';
import usePageTitle from '../hooks/usePageTitle';

const NotFound = () => {
  usePageTitle('Page introuvable');

  return (
    <section className="section section--dark not-found">
      <div className="container container--narrow text-center">
        <p className="eyebrow">Erreur 404</p>
        <h1 className="heading">Cette page est introuvable</h1>
        <p className="lead">Le lien est peut-être ancien ou mal saisi.</p>
        <div className="section__foot">
          <Link to="/" className="btn btn--primary">Retour à l’accueil</Link>
          <Link to="/contact" className="btn btn--ghost">Nous contacter</Link>
        </div>
      </div>
    </section>
  );
};

export default NotFound;
