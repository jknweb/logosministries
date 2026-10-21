import './Timeline.css';

const Timeline = ({ items }) => (
  <ol className="timeline">
    {items.map((item) => (
      <li className="timeline__item" key={item.year}>
        <span className="timeline__year">{item.year}</span>
        <div className="timeline__body">
          <h3 className="timeline__title">{item.title}</h3>
          <p>{item.text}</p>
        </div>
      </li>
    ))}
  </ol>
);

export default Timeline;
