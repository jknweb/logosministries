import { Link } from 'react-router-dom';
import Icon from '../Icon';
import Stats from '../Stats/Stats';
import { site } from '../../data/site';
import './Welcome.css';

const values = [
  {
    icon: 'book',
    title: 'La Parole au centre',
    text: 'Une prédication fidèle et bibliquement fondée, pour grandir chaque semaine dans la connaissance de Christ.',
  },
  {
    icon: 'heart',
    title: 'Une famille qui accueille',
    text: 'Que vous découvriez la foi ou cherchiez une église, vous trouverez ici une communauté fraternelle.',
  },
  {
    icon: 'worship',
    title: 'Une foi apostolique',
    text: 'Attachés à la foi des apôtres et au Message de la restauration, depuis la fondation de l’église.',
  },
];

// Section « Qui sommes-nous » de l'accueil.
const Welcome = () => {
  return (
    <section className="section section--light welcome">
      <div className="container">
        <div className="welcome__grid">
          <figure className="welcome__media">
            <img src="/images/assemblee.jpg" alt="L’assemblée réunie pour le culte à Logos Tabernacle" loading="lazy" width="1080" height="720" />
          </figure>

          <div>
            <p className="eyebrow">Qui sommes-nous</p>
            <h2 className="heading">Plus qu’une église, une famille</h2>
            <p className="lead">
              Depuis {site.foundedYear}, Logos Tabernacle rassemble à Ngaliema celles et ceux qui veulent connaître Dieu
              et grandir dans Sa Parole.
            </p>

            <ul className="welcome__values">
              {values.map((v) => (
                <li key={v.title}>
                  <span className="card__icon"><Icon name={v.icon} /></span>
                  <div>
                    <h3>{v.title}</h3>
                    <p>{v.text}</p>
                  </div>
                </li>
              ))}
            </ul>

            <Link to="/a-propos" className="btn btn--outline">
              Découvrir notre histoire
              <Icon name="arrow" />
            </Link>
          </div>
        </div>

        <Stats variant="row" />
      </div>
    </section>
  );
};

export default Welcome;
