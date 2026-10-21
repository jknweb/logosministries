import { site } from '../../data/site';
import { schedule } from '../../data/schedule';
import './Stats.css';

const Stats = ({ variant = 'grid' }) => {
  const years = new Date().getFullYear() - site.foundedYear;
  const items = [
    { value: site.foundedYear, label: 'Année de fondation' },
    { value: `${years} ans`, label: 'Au service de Kinshasa' },
    { value: `${site.capacity.toLocaleString('fr-FR')}`, label: 'Places dans le temple' },
    { value: schedule.length, label: 'Rendez-vous chaque semaine' },
  ];

  return (
    <dl className={`stats stats--${variant}`}>
      {items.map((item) => (
        <div className="stats__item" key={item.label}>
          <dt>{item.label}</dt>
          <dd>{item.value}</dd>
        </div>
      ))}
    </dl>
  );
};

export default Stats;
