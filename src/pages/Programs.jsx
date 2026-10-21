import PageHeader from '../components/PageHeader/PageHeader';
import ScheduleCards from '../components/ScheduleCards/ScheduleCards';
import MinistryCards from '../components/MinistryCards/MinistryCards';
import VisitBlock from '../components/VisitBlock/VisitBlock';
import usePageTitle from '../hooks/usePageTitle';

const Programs = () => {
  usePageTitle('Programmes', 'Horaires des cultes de Logos Tabernacle (dimanche 8h30, mardi et jeudi 17h30, Ecodim 7h30) et départements de l’église.');

  return (
    <>
      <PageHeader
        eyebrow="Vie de l’église"
        title="Programmes et départements"
        intro="Nos rendez-vous hebdomadaires de prière, d’édification et de louange, et les départements où chacun peut servir."
        image="/images/louange.jpg"
      />

      <section className="section section--light">
        <div className="container">
          <div className="section__head section__head--center">
            <p className="eyebrow">Horaires</p>
            <h2 className="heading">Nos rendez-vous de la semaine</h2>
          </div>
          <ScheduleCards detailed />
        </div>
      </section>

      <section className="section section--dark">
        <div className="container">
          <div className="section__head section__head--center">
            <p className="eyebrow">Servir ensemble</p>
            <h2 className="heading">Nos départements</h2>
            <p className="lead">Chaque membre a sa place. Trouvez le département où mettre vos dons au service de Dieu.</p>
          </div>
          <MinistryCards />
        </div>
      </section>

      <VisitBlock />
    </>
  );
};

export default Programs;
