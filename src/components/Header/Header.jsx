import { useEffect, useState } from 'react';
import { Link, NavLink, useLocation } from 'react-router-dom';
import LiveButton from '../LiveButton/LiveButton';
import { navigation, site } from '../../data/site';
import './Header.css';

const Header = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);
  const { pathname } = useLocation();

  useEffect(() => {
    const onScroll = () => setIsScrolled(window.scrollY > 40);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  // Ferme le menu mobile à chaque changement de page.
  const [lastPath, setLastPath] = useState(pathname);
  if (pathname !== lastPath) {
    setLastPath(pathname);
    setMenuOpen(false);
  }

  useEffect(() => {
    if (!menuOpen) return undefined;
    const onKey = (e) => e.key === 'Escape' && setMenuOpen(false);
    document.addEventListener('keydown', onKey);
    document.body.style.overflow = 'hidden';
    return () => {
      document.removeEventListener('keydown', onKey);
      document.body.style.overflow = '';
    };
  }, [menuOpen]);

  const solid = isScrolled || menuOpen;

  return (
    <header className={`site-header${solid ? ' site-header--solid' : ''}`}>
      <div className="container site-header__inner">
        <Link to="/" className="brand" aria-label={`${site.name}, accueil`}>
          <span className="brand__badge">
            <img src={site.logo} alt="" width="64" height="38" />
          </span>
          <span className="brand__name">
            Logos Tabernacle
            <small>Ministries</small>
          </span>
        </Link>

        <nav id="main-nav" className={`main-nav${menuOpen ? ' main-nav--open' : ''}`} aria-label="Menu principal">
          <ul className="main-nav__list">
            {navigation.map((item) => (
              <li key={item.to}>
                <NavLink to={item.to} end={item.to === '/'} className="main-nav__link">
                  {item.label}
                </NavLink>
              </li>
            ))}
          </ul>
          <Link to="/#visite" className="btn btn--primary main-nav__cta">Nous visiter</Link>
        </nav>

        <div className="site-header__actions">
          <LiveButton size="sm" />
          <Link to="/#visite" className="btn btn--primary btn--sm site-header__cta">Nous visiter</Link>
          <button
            type="button"
            className={`burger${menuOpen ? ' burger--active' : ''}`}
            aria-expanded={menuOpen}
            aria-controls="main-nav"
            onClick={() => setMenuOpen((open) => !open)}
          >
            <span className="visually-hidden">{menuOpen ? 'Fermer le menu' : 'Ouvrir le menu'}</span>
            <span aria-hidden="true" />
            <span aria-hidden="true" />
            <span aria-hidden="true" />
          </button>
        </div>
      </div>
    </header>
  );
};

export default Header;
