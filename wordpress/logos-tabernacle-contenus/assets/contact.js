/* Formulaire de contact : contrôle des champs obligatoires et envoi par WhatsApp. */
(function () {
  'use strict';

  var form = document.getElementById('formulaire-contact');
  if (!form) {
    return;
  }

  var errorBox = form.querySelector('[data-client-error]');
  var field = function (name) {
    return form.elements[name] ? form.elements[name].value.trim() : '';
  };

  var validate = function () {
    if (!field('logos_name') || !field('logos_message')) {
      errorBox.textContent = 'Merci d’indiquer votre nom et votre message.';
      errorBox.hidden = false;
      (field('logos_name') ? form.elements.logos_message : form.elements.logos_name).focus();
      return false;
    }
    errorBox.hidden = true;
    return true;
  };

  form.addEventListener('submit', function (e) {
    if (!validate()) {
      e.preventDefault();
    }
  });

  var whatsappButton = form.querySelector('[data-whatsapp-send]');
  if (whatsappButton) {
    whatsappButton.addEventListener('click', function () {
      if (!validate()) {
        return;
      }
      var phone = field('logos_phone');
      var text = 'Bonjour, je m’appelle ' + field('logos_name') + '.' + (phone ? ' (Tél. : ' + phone + ')' : '') + '\n' +
        'Objet : ' + field('logos_subject') + '\n\n' + field('logos_message');
      window.open('https://wa.me/' + form.getAttribute('data-whatsapp') + '?text=' + encodeURIComponent(text), '_blank', 'noopener');
    });
  }
})();
