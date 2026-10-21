import { Link } from 'react-router-dom';
import Icon from '../Icon';
import { heroVerse, site } from '../../data/site';
import './Hero.css';

const Hero = () => (
  <section className="hero">
    <div className="hero__bg" aria-hidden="true" />
    <div className="container hero__inner">
      <div className="hero__content fade-up">
        <p className="eyebrow">Bienvenue à {site.name}</p>
        <h1 className="hero__title">
          Une famille centrée sur la Parole, <em>depuis {site.foundedYear}.</em>
        </h1>
        <p className="hero__text">
          Une église de Kinshasa-Ngaliema où chacun est accueilli, enseigné et accompagné dans sa marche avec Christ.
          Rejoignez-nous ce dimanche à 8h30.
        </p>
        <div className="hero__actions">
          <Link to="/#visite" className="btn btn--primary">
            Planifier ma visite
            <Icon name="arrow" />
          </Link>
          <Link to="/enseignements" className="btn btn--ghost">
            <Icon name="play" />
            Voir un enseignement
          </Link>
        </div>
        <blockquote className="hero__verse">
          <p>« {heroVerse.text} »</p>
          <cite>{heroVerse.reference}</cite>
        </blockquote>
      </div>
    </div>
  </section>
);

export default Hero;
