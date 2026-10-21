import PageHeader from '../components/PageHeader/PageHeader';
import ContactForm from '../components/ContactForm/ContactForm';
import VisitBlock from '../components/VisitBlock/VisitBlock';
import Icon from '../components/Icon';
import usePageTitle from '../hooks/usePageTitle';
import { contact, whatsappUrl } from '../data/site';
import './Contact.css';

const Contact = () => {
  usePageTitle('Contact', `Contactez Logos Tabernacle : ${contact.phone}, WhatsApp ou ${contact.email}. ${contact.address}, ${contact.city}.`);

  const channels = [
    { icon: 'phone', label: 'Téléphone', value: contact.phone, href: contact.phoneHref },
    { icon: 'whatsapp', label: 'WhatsApp', value: contact.whatsappDisplay, href: whatsappUrl(), external: true },
    { icon: 'mail', label: 'E-mail', value: contact.email, href: `mailto:${contact.email}` },
    { icon: 'pin', label: 'Adresse', value: `${contact.address}, ${contact.city}`, href: '#visite' },
  ];

  return (
    <>
      <PageHeader
        eyebrow="Écrivez-nous"
        title="Nous contacter"
        intro="Une question, une demande de prière ou une première visite ? Nous serons heureux de vous répondre."
      />

      <section className="section section--light">
        <div className="container contact">
          <div>
            <p className="eyebrow">Coordonnées</p>
            <h2 className="heading">Restons en contact</h2>
            <p className="lead">Le plus rapide est de nous écrire sur WhatsApp. Vous pouvez aussi nous appeler ou nous envoyer un e-mail.</p>
            <ul className="contact__channels">
              {channels.map((c) => (
                <li key={c.label}>
                  <a href={c.href} {...(c.external ? { target: '_blank', rel: 'noopener noreferrer' } : {})}>
                    <span className="card__icon"><Icon name={c.icon} /></span>
                    <span>
                      <small>{c.label}</small>
                      {c.value}
                    </span>
                  </a>
                </li>
              ))}
            </ul>
          </div>
          <div>
            <h2 className="contact__form-title">Envoyez-nous un message</h2>
            <ContactForm />
          </div>
        </div>
      </section>

      <VisitBlock />
    </>
  );
};

export default Contact;
