import React from 'react';
import Hero from '../components/Hero/Hero';
import EventsRibbon from '../components/EventsRibbon/EventsRibbon';
import Pastor from '../components/Pastor/Pastor';
import Programs from '../components/Programs/Programs';
import Teachings from '../components/Teachings/Teachings';
import Vision from '../components/Vision/Vision';

const Home = () => {
  return (
    <>
      <Hero />
      <EventsRibbon />
      <PastorHome />
      <Programs />
      <Teachings />
      <Vision />
    </>
  );
};

export default Home;
