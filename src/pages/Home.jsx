import { Link } from 'react-router-dom';
import Hero from '../components/Hero/Hero';
import QuickInfo from '../components/QuickInfo/QuickInfo';
import Stats from '../components/Stats/Stats';
import ScheduleCards from '../components/ScheduleCards/ScheduleCards';
import PastorIntro from '../components/PastorIntro/PastorIntro';
import SermonShowcase from '../components/SermonShowcase/SermonShowcase';
import EventGrid from '../components/Events/EventGrid';
import VerseBanner from '../components/VerseBanner/VerseBanner';
import VisitBlock from '../components/VisitBlock/VisitBlock';
import Icon from '../components/Icon';
import usePageTitle from '../hooks/usePageTitle';
import { events } from '../data/events';
import { splitEvents } from '../lib/dates';

const Home = () => {
  usePageTitle();
  const { upcoming } = splitEvents(events);

  return (
    <>
      <Hero />
      <QuickInfo />

      <section className="section section--light">
        <div className="container split">
          <div>
            <p className="eyebrow">Qui sommes-nous</p>
            <h2 className="heading">D’un salon à Ozone à un temple de 2 500 places</h2>
            <div className="prose">
              <p>
                Logos Tabernacle est née en 1987 d’une campagne d’évangélisation à Ngaliema-Ozone. Les premières
                réunions se tenaient dans un salon, puis sous un hangar de bambous et de nattes.
              </p>
              <p>
                Aujourd’hui, l’église est une communauté solidement établie, attachée à la foi apostolique et centrée
                sur la Parole révélée, qui continue d’accueillir chaque semaine celles et ceux qui cherchent Dieu.
              </p>
            </div>
            <Link to="/a-propos" className="link-arrow mt-md">
              Découvrir notre histoire
              <Icon name="arrow" size={18} />
            </Link>
          </div>
          <Stats />
        </div>
      </section>

      <section className="section section--dark">
        <div className="container">
          <div className="section__head section__head--center">
            <p className="eyebrow">Nos rendez-vous</p>
            <h2 className="heading">Chaque semaine, une place pour vous</h2>
            <p className="lead">Louange, prière et enseignement de la Parole, pour toute la famille.</p>
          </div>
          <ScheduleCards />
          <div className="section__foot">
            <Link to="/programmes" className="btn btn--ghost">
              Programmes et départements
              <Icon name="arrow" />
            </Link>
          </div>
        </div>
      </section>

      <section className="section section--cream">
        <div className="container">
          <PastorIntro />
        </div>
      </section>

      <section className="section section--dark-2">
        <div className="container">
          <SermonShowcase />
        </div>
      </section>

      {upcoming.length > 0 && (
        <section className="section section--light">
          <div className="container">
            <div className="section__head section__head--center">
              <p className="eyebrow">Agenda</p>
              <h2 className="heading">Prochains événements</h2>
            </div>
            <EventGrid events={upcoming.slice(0, 3)} />
            <div className="section__foot">
              <Link to="/evenements" className="btn btn--outline">
                Tout l’agenda
                <Icon name="arrow" />
              </Link>
            </div>
          </div>
        </section>
      )}

      <VerseBanner
        text="Nous croyons que chaque vie peut être restaurée par la puissance de Christ."
        reference="Notre conviction"
      />

      <VisitBlock />
    </>
  );
};

export default Home;
