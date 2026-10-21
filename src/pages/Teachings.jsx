import PageHeader from '../components/PageHeader/PageHeader';
import SermonShowcase from '../components/SermonShowcase/SermonShowcase';
import VerseBanner from '../components/VerseBanner/VerseBanner';
import CtaBand from '../components/CtaBand/CtaBand';
import Icon from '../components/Icon';
import usePageTitle from '../hooks/usePageTitle';
import { resources } from '../data/sermons';

const Teachings = () => {
  usePageTitle('Enseignements', 'Prédications et cultes en direct de Logos Tabernacle sur YouTube.');

  return (
    <>
      <PageHeader
        eyebrow="Replays"
        title="Enseignements"
        intro="Des messages bibliquement fondés pour vous équiper, vous fortifier et vous préparer au retour de Christ."
        image="/images/ambiance-temple.jpg"
      />

      <section className="section section--dark-2">
        <div className="container">
          <SermonShowcase />
        </div>
      </section>

      {resources.length > 0 && (
        <section className="section section--cream">
          <div className="container">
            <div className="section__head section__head--center">
              <p className="eyebrow">Ressources</p>
              <h2 className="heading">À télécharger</h2>
            </div>
            <div className="grid grid--3">
              {resources.map((r) => (
                <a className="card" key={r.id} href={r.file} download={r.file !== '#' || undefined}>
                  <span className="card__icon"><Icon name="download" /></span>
                  <h3 className="card__title">{r.title}</h3>
                  <p className="card__text">PDF · {r.size}</p>
                </a>
              ))}
            </div>
          </div>
        </section>
      )}

      <VerseBanner text="Ta parole est une lampe à mes pieds, et une lumière sur mon sentier." reference="Psaume 119:105" />

      <CtaBand />
    </>
  );
};

export default Teachings;
