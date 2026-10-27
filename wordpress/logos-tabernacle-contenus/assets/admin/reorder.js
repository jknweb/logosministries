/* Réordonne les éléments d'une liste par glisser-déposer et enregistre l'ordre. */
(function ($) {
  'use strict';

  $(function () {
    var $list = $('#the-list');
    if (!$list.length || !$list.find('.logos-sort-handle').length) {
      return;
    }

    var $notice = $('<div class="notice inline" hidden><p></p></div>').insertBefore('.wp-list-table');

    $list.sortable({
      handle: '.logos-sort-handle',
      axis: 'y',
      items: '> tr',
      helper: function (e, tr) {
        var $cells = tr.children();
        return tr.clone().children().each(function (i) {
          $(this).width($cells.eq(i).width());
        }).end();
      },
      update: function () {
        var ids = $list.children('tr').map(function () {
          return this.id.replace('post-', '');
        }).get();
        $.post(window.ajaxurl, { action: 'logos_reorder', nonce: window.logosReorder.nonce, ids: ids })
          .done(function () {
            $notice.removeClass('notice-error').addClass('notice-success').prop('hidden', false).find('p').text(window.logosReorder.saved);
          })
          .fail(function () {
            $notice.removeClass('notice-success').addClass('notice-error').prop('hidden', false).find('p').text(window.logosReorder.error);
          });
      }
    });
  });
})(jQuery);
