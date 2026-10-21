import LiveButton from '../LiveButton/LiveButton';
import { heroVerse, site } from '../../data/site';
import './Hero.css';

const Hero = () => (
  <section className="hero">
    <div className="hero__bg" aria-hidden="true" />
    <div className="hero__shade" aria-hidden="true" />
    <div className="container hero__inner">
      <div className="hero__content fade-up">
        <p className="eyebrow">Bienvenue à {site.name}</p>
        <h1 className="hero__title">
          Une famille centrée sur la Parole, <em>depuis {site.foundedYear}.</em>
        </h1>
        <blockquote className="hero__verse">
          <p>« {heroVerse.text} »</p>
          <cite>{heroVerse.reference}</cite>
        </blockquote>
        <div className="hero__actions">
          <LiveButton label="Suivre le culte en direct" />
        </div>
      </div>
    </div>
  </section>
);

export default Hero;
