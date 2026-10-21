import PageHeader from '../components/PageHeader/PageHeader';
import EventGrid from '../components/Events/EventGrid';
import CtaBand from '../components/CtaBand/CtaBand';
import usePageTitle from '../hooks/usePageTitle';
import { events } from '../data/events';
import { splitEvents } from '../lib/dates';

const Events = () => {
  usePageTitle('Événements', 'Agenda des événements de Logos Tabernacle : cultes spéciaux, retraites, nuits de prière et séminaires.');
  const { upcoming, past } = splitEvents(events);

  return (
    <>
      <PageHeader
        eyebrow="Agenda"
        title="Événements"
        intro="Cultes spéciaux, retraites, nuits de prière et séminaires : ne manquez aucun temps fort de la vie de l’église."
        image="/images/assemblee.jpg"
      />

      <section className="section section--light">
        <div className="container">
          <div className="section__head">
            <p className="eyebrow">À venir</p>
            <h2 className="heading">Prochains événements</h2>
          </div>
          {upcoming.length > 0 ? (
            <EventGrid events={upcoming} />
          ) : (
            <p className="lead">Aucun événement n’est programmé pour le moment. Revenez bientôt ou suivez-nous sur YouTube.</p>
          )}
        </div>
      </section>

      {past.length > 0 && (
        <section className="section section--cream">
          <div className="container">
            <div className="section__head">
              <p className="eyebrow">Archives</p>
              <h2 className="heading">Événements passés</h2>
            </div>
            <EventGrid events={past} past />
          </div>
        </section>
      )}

      <CtaBand title="Vous organisez votre venue ?" text="Écrivez-nous pour toute question sur un événement, nous vous répondons rapidement." />
    </>
  );
};

export default Events;
