import { BrowserRouter, Navigate, Route, Routes } from 'react-router-dom';
import Header from './components/Header/Header';
import Footer from './components/Footer/Footer';
import ScrollManager from './components/ScrollManager/ScrollManager';
import Home from './pages/Home';
import About from './pages/About';
import Pastor from './pages/Pastor';
import Programs from './pages/Programs';
import Teachings from './pages/Teachings';
import Events from './pages/Events';
import Contact from './pages/Contact';
import NotFound from './pages/NotFound';

// Anciennes adresses en anglais, redirigées vers les nouvelles.
const legacyRoutes = {
  '/about': '/a-propos',
  '/pastor': '/pasteur',
  '/programs': '/programmes',
  '/teachings': '/enseignements',
  '/events': '/evenements',
};

function App() {
  return (
    <BrowserRouter>
      <ScrollManager />
      <a href="#contenu" className="skip-link">Aller au contenu</a>
      <Header />
      <main id="contenu">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/a-propos" element={<About />} />
          <Route path="/pasteur" element={<Pastor />} />
          <Route path="/programmes" element={<Programs />} />
          <Route path="/enseignements" element={<Teachings />} />
          <Route path="/evenements" element={<Events />} />
          <Route path="/contact" element={<Contact />} />
          {Object.entries(legacyRoutes).map(([from, to]) => (
            <Route key={from} path={from} element={<Navigate to={to} replace />} />
          ))}
          <Route path="*" element={<NotFound />} />
        </Routes>
      </main>
      <Footer />
    </BrowserRouter>
  );
}

export default App;
