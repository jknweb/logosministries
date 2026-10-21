import './VerseBanner.css';

const VerseBanner = ({ text, reference, image = '/images/louange.jpg' }) => (
  <section className="verse-banner" style={{ '--verse-image': `url(${image})` }}>
    <div className="container container--narrow">
      <blockquote>
        <p className="verse-banner__text">« {text} »</p>
        {reference && <cite className="verse-banner__ref">{reference}</cite>}
      </blockquote>
    </div>
  </section>
);

export default VerseBanner;
