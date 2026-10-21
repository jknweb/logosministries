import PageHeader from '../components/PageHeader/PageHeader';
import PastorIntro from '../components/PastorIntro/PastorIntro';
import CtaBand from '../components/CtaBand/CtaBand';
import usePageTitle from '../hooks/usePageTitle';
import { associatePastors, leadPastor } from '../data/team';
import './Pastor.css';

const Pastor = () => {
  usePageTitle('Pasteur', `Biographie du ${leadPastor.name}, fondateur de Logos Tabernacle, et présentation de l’équipe pastorale.`);

  return (
    <>
      <PageHeader
        eyebrow="Équipe pastorale"
        title="Le pasteur visionnaire"
        intro="Découvrez le parcours du Rév. Yves Kalombo et les pasteurs qui l’entourent."
      />

      <section className="section section--light">
        <div className="container">
          <PastorIntro showLink={false} />
        </div>
      </section>

      <section className="section section--cream">
        <div className="container container--narrow">
          <div className="section__head">
            <p className="eyebrow">Biographie</p>
            <h2 className="heading">Son parcours</h2>
          </div>
          <div className="bio">
            {leadPastor.bio.map((chapter) => (
              <article className="bio__chapter" key={chapter.title}>
                <h3 className="bio__title">{chapter.title}</h3>
                <div className="prose">
                  {chapter.paragraphs.map((p) => <p key={p.slice(0, 24)}>{p}</p>)}
                </div>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section className="section section--light">
        <div className="container">
          <div className="section__head section__head--center">
            <p className="eyebrow">À ses côtés</p>
            <h2 className="heading">Nos pasteurs associés</h2>
          </div>
          <div className="team">
            {associatePastors.map((p) => (
              <article className="team__member" key={p.id}>
                <img className="team__photo" src={p.photo} alt={`Portrait du ${p.name}`} loading="lazy" />
                <h3 className="team__name">{p.name}</h3>
                {p.role && <p className="team__role">{p.role}</p>}
              </article>
            ))}
          </div>
        </div>
      </section>

      <CtaBand />
    </>
  );
};

export default Pastor;
