/* Champs d'administration Logos Tabernacle : médiathèque, couleurs, répéteurs, ordre des sections. */
(function ($) {
  'use strict';

  var l10n = window.logosFields || {};

  function initColors(scope) {
    $(scope).find('.logos-color').each(function () {
      if (!$(this).closest('.wp-picker-container').length) {
        $(this).wpColorPicker();
      }
    });
  }

  function rowTitle($row) {
    var text = '';
    $row.find('.logos-repeater__fields input[type=text], .logos-repeater__fields textarea').each(function () {
      if (!text && this.value) {
        text = this.value;
      }
    });
    $row.find('.logos-repeater__title').text(text.length > 70 ? text.slice(0, 70) + '…' : text);
  }

  // Renumérote les noms pour que l'ordre affiché soit l'ordre enregistré.
  function renumber($repeater) {
    var base = $repeater.data('name');
    $repeater.children('.logos-repeater__rows').children('.logos-repeater__row').each(function (index) {
      $(this).find('[name]').each(function () {
        var name = this.getAttribute('name');
        if (name.indexOf(base + '[') === 0) {
          var rest = name.slice(base.length).replace(/^\[[^\]]*\]/, '[' + index + ']');
          this.setAttribute('name', base + rest);
        }
      });
    });
  }

  function initRepeaters(scope) {
    $(scope).find('.logos-repeater__rows').each(function () {
      if ($(this).data('sortable-ready')) {
        return;
      }
      $(this).data('sortable-ready', true).sortable({
        handle: '.logos-repeater__handle',
        axis: 'y',
        update: function () {
          renumber($(this).closest('.logos-repeater'));
        }
      });
      $(this).children('.logos-repeater__row').each(function () {
        rowTitle($(this));
      });
    });
  }

  $(document).on('click', '.logos-repeater__add', function () {
    var $repeater = $(this).closest('.logos-repeater');
    var $rows = $repeater.children('.logos-repeater__rows');
    var html = $repeater.children('.logos-repeater__template').html().split('__i__').join(String($rows.children().length));
    var $row = $(html);
    $rows.append($row);
    initColors($row);
    renumber($repeater);
    $row.find('input, textarea').first().trigger('focus');
  });

  $(document).on('click', '.logos-repeater__remove', function () {
    if (window.confirm(l10n.confirmDel || 'Supprimer ?')) {
      var $repeater = $(this).closest('.logos-repeater');
      $(this).closest('.logos-repeater__row').remove();
      renumber($repeater);
    }
  });

  $(document).on('input', '.logos-repeater__fields input[type=text], .logos-repeater__fields textarea', function () {
    rowTitle($(this).closest('.logos-repeater__row'));
  });

  // Médiathèque WordPress.
  $(document).on('click', '.logos-media__choose', function (e) {
    e.preventDefault();
    var $box = $(this).closest('.logos-media');
    var isImage = $box.data('type') === 'image';
    var frame = wp.media({
      title: isImage ? l10n.chooseImage : l10n.chooseFile,
      button: { text: l10n.use },
      library: isImage ? { type: 'image' } : {},
      multiple: false
    });
    frame.on('select', function () {
      var att = frame.state().get('selection').first().toJSON();
      $box.find('input[type=hidden]').val(att.id).trigger('change');
      var $preview = $box.find('.logos-media__preview').empty();
      if (isImage) {
        var src = att.sizes && att.sizes.medium ? att.sizes.medium.url : att.url;
        $('<img alt="">').attr('src', src).appendTo($preview);
      } else {
        $('<span class="logos-media__name"></span>').text(att.filename).appendTo($preview);
      }
      $box.find('.logos-media__remove').prop('hidden', false);
    });
    frame.open();
  });

  $(document).on('click', '.logos-media__remove', function (e) {
    e.preventDefault();
    var $box = $(this).closest('.logos-media');
    $box.find('input[type=hidden]').val('').trigger('change');
    $box.find('.logos-media__preview').empty();
    $(this).prop('hidden', true);
  });

  // Ordre des sections de la page d'accueil (glisser-déposer).
  function initSections() {
    var $list = $('.logos-sections');
    if (!$list.length) {
      return;
    }
    var save = function () {
      var order = $list.children('.logos-section').map(function () {
        return $(this).data('section');
      }).get();
      $('#logos-sections-order').val(order.join(','));
    };
    $list.sortable({ handle: '.logos-section__handle', axis: 'y', update: save });
    save();
  }

  $(document).on('click', '.logos-section__toggle', function () {
    var $section = $(this).closest('.logos-section');
    var open = $section.toggleClass('is-open').hasClass('is-open');
    $(this).attr('aria-expanded', open ? 'true' : 'false');
  });

  $(function () {
    initColors(document);
    initRepeaters(document);
    initSections();
    $(document).on('click', '.logos-repeater__add', function () {
      initRepeaters($(this).closest('.logos-repeater'));
    });
  });
})(jQuery);
