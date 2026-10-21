import { Link } from 'react-router-dom';
import Hero from '../components/Hero/Hero';
import QuickInfo from '../components/QuickInfo/QuickInfo';
import Featured from '../components/Featured/Featured';
import Welcome from '../components/Welcome/Welcome';
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

      <Featured />

      <Welcome />

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
