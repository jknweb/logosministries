import Icon from '../Icon';
import { schedule } from '../../data/schedule';

const ScheduleCards = ({ detailed = false }) => (
  <div className="grid grid--3">
    {schedule.map((s) => (
      <article className="card" key={s.id}>
        <span className="card__icon"><Icon name={s.icon} /></span>
        <h3 className="card__title">{s.title}</h3>
        <p className="card__meta">{s.day} · {s.time}</p>
        <p className="card__text">{s.summary}</p>
        {detailed && (
          <ul className="check-list">
            {s.details.map((d) => <li key={d}>{d}</li>)}
          </ul>
        )}
      </article>
    ))}
  </div>
);

export default ScheduleCards;
