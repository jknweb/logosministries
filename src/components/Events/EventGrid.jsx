import { useCallback, useState } from 'react';
import EventCard from './EventCard';
import EventModal from './EventModal';
import './Events.css';

const EventGrid = ({ events, past = false }) => {
  const [selected, setSelected] = useState(null);
  const close = useCallback(() => setSelected(null), []);

  return (
    <>
      <div className="grid grid--3">
        {events.map((event) => (
          <EventCard key={event.id} event={event} past={past} onOpen={setSelected} />
        ))}
      </div>
      {selected && <EventModal event={selected} onClose={close} />}
    </>
  );
};

export default EventGrid;
