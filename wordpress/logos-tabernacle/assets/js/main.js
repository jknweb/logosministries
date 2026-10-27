/* Logos Tabernacle : en-tête au défilement, menu mobile, vidéos à la demande, fenêtre des événements. */
(function () {
  'use strict';

  var body = document.body;

  // En-tête opaque après 40 px de défilement (sauf réglage « toujours opaque »).
  var header = document.querySelector('[data-header]');
  var nav = document.getElementById('main-nav');
  var burger = document.querySelector('[data-burger]');
  var menuOpen = false;

  var updateHeader = function () {
    if (!header || header.classList.contains('site-header--always-solid')) {
      return;
    }
    header.classList.toggle('site-header--solid', window.scrollY > 40 || menuOpen);
  };
  updateHeader();
  window.addEventListener('scroll', updateHeader, { passive: true });

  // Menu mobile : bouton, touche Échap, blocage du défilement de la page.
  var setMenu = function (open) {
    menuOpen = open;
    if (!nav || !burger) {
      return;
    }
    nav.classList.toggle('main-nav--open', open);
    if (header) {
      header.classList.toggle('site-header--menu-open', open);
    }
    burger.classList.toggle('burger--active', open);
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    var label = burger.querySelector('[data-burger-label]');
    if (label) {
      label.textContent = label.getAttribute(open ? 'data-close' : 'data-open');
    }
    body.style.overflow = open ? 'hidden' : '';
    updateHeader();
  };

  if (burger) {
    burger.addEventListener('click', function () {
      setMenu(!menuOpen);
    });
  }

  if (nav) {
    // Un lien d'ancre (ex. /#visite) ferme le menu.
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a') && menuOpen) {
        setMenu(false);
      }
    });

    // Sous-menus : bouton d'ouverture (mobile et clavier).
    nav.querySelectorAll('.sub-menu__toggle').forEach(function (toggle) {
      toggle.addEventListener('click', function () {
        var item = toggle.closest('.menu-item');
        var open = !item.classList.contains('is-open');
        item.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
    });
  }

  // Vidéos : l'iframe YouTube n'est chargée qu'au clic.
  document.addEventListener('click', function (e) {
    var play = e.target.closest('[data-video-play]');
    if (!play) {
      return;
    }
    var box = play.closest('[data-video]');
    var iframe = document.createElement('iframe');
    iframe.src = box.getAttribute('data-video');
    iframe.title = box.getAttribute('data-video-title') || '';
    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen';
    iframe.allowFullscreen = true;
    box.innerHTML = '';
    box.appendChild(iframe);
    if (box.getAttribute('data-video-class')) {
      box.classList.add(box.getAttribute('data-video-class'));
    }
    iframe.focus();
  });

  // Fenêtre de détail des événements.
  var modal = document.querySelector('[data-modal]');
  var lastTrigger = null;

  var closeModal = function () {
    if (!modal || modal.hidden) {
      return;
    }
    modal.hidden = true;
    modal.querySelector('[data-modal-content]').innerHTML = '';
    if (!menuOpen) {
      body.style.overflow = '';
    }
    if (lastTrigger) {
      lastTrigger.focus();
    }
  };

  document.addEventListener('click', function (e) {
    var trigger = e.target.closest('[data-modal-open]');
    if (!trigger || !modal) {
      return;
    }
    var template = trigger.closest('article').querySelector('[data-modal-template]');
    if (!template) {
      return;
    }
    e.preventDefault();
    lastTrigger = trigger;
    var content = modal.querySelector('[data-modal-content]');
    content.innerHTML = '';
    content.appendChild(template.content.cloneNode(true));
    modal.hidden = false;
    body.style.overflow = 'hidden';
    modal.querySelector('[data-modal-close]').focus();
  });

  if (modal) {
    modal.addEventListener('click', function (e) {
      if (e.target === modal || e.target.closest('[data-modal-close]')) {
        closeModal();
      }
    });
  }

  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') {
      return;
    }
    if (modal && !modal.hidden) {
      closeModal();
    } else if (menuOpen) {
      setMenu(false);
      burger.focus();
    }
  });
})();
