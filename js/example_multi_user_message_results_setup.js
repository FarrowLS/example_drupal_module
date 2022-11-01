(function ($, Drupal) {

  Drupal.behaviors.example_multi_user_message_results_setup = {
    attach: function(context, settings) {

      var checkboxes_selector = '.view-member-solr-v2 input.form-check-input';
      var checkboxes_checked_selector = '.view-member-solr-v2 input.form-check-input:checked';

      function setHref() {
        var user_ids = '';
        var href_value = '';

        $.each($(checkboxes_checked_selector), function (index, value) {
          if (!user_ids == '') {
            user_ids = user_ids + ',';
          }
          user_ids = user_ids + $(value).attr('id');
        });

        if (!user_ids == '') {
          href_value = '/multi-user-private-message/create?recipients=' + user_ids;
        } else {
          href_value = '';
        }

        return href_value;
      }

      // On load
      if ($('.user-logged-in').length == 0) {
        $('#member-search-message-button').attr('data-toggle', 'modal');
        $('#member-search-message-button').attr('data-target', '#authenticateModal');
      }
      $('#member-search-message-button').attr('href', setHref());

      // On click
      $(checkboxes_selector)
        .click(function () {
          $('#member-search-message-button').attr('href', setHref());
      });
    }
  }
})(jQuery, Drupal);
