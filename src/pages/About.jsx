import PageHeader from '../components/PageHeader/PageHeader';
import Timeline from '../components/Timeline/Timeline';
import Stats from '../components/Stats/Stats';
import CtaBand from '../components/CtaBand/CtaBand';
import usePageTitle from '../hooks/usePageTitle';
import { intro, pillars, timeline } from '../data/history';

const About = () => {
  usePageTitle('À propos', 'L’histoire de Logos Tabernacle, de la campagne d’Ozone en 1986 au temple de 2 500 places dédié en 2007.');

  return (
    <>
      <PageHeader
        eyebrow="Notre histoire"
        title="À propos de nous"
        intro="D’un petit commencement dans un salon d’Ozone à une œuvre durable au service des croyants."
        image="/images/assemblee.jpg"
      />

      <section className="section section--light">
        <div className="container split">
          <div>
            <p className="eyebrow">Les origines</p>
            <h2 className="heading">Une église née de l’évangélisation</h2>
            <div className="prose">
              {intro.map((p) => <p key={p.slice(0, 24)}>{p}</p>)}
            </div>
          </div>
          <Stats />
        </div>
      </section>

      <section className="section section--cream">
        <div className="container">
          <div className="section__head section__head--center">
            <p className="eyebrow">Les grandes étapes</p>
            <h2 className="heading">De 1986 à aujourd’hui</h2>
          </div>
          <Timeline items={timeline} />
        </div>
      </section>

      <section className="section section--dark">
        <div className="container">
          <div className="section__head section__head--center">
            <p className="eyebrow">Notre identité</p>
            <h2 className="heading">Ce qui nous anime</h2>
            <p className="lead">
              Logos Tabernacle est une communion fraternelle centrée sur la Parole révélée, reconnue pour son attachement
              à la foi apostolique.
            </p>
          </div>
          <div className="grid grid--3">
            {pillars.map((p) => (
              <article className="card" key={p.id}>
                <h3 className="card__title">{p.title}</h3>
                <p className="card__text">{p.text}</p>
              </article>
            ))}
          </div>
        </div>
      </section>

      <CtaBand />
    </>
  );
};

export default About;
