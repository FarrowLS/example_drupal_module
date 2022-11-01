(function ($, Drupal) {
  Drupal.behaviors.example_multi_user_message_submit = {
    attach: function(context, settings) {
      var pm_form_new_thread = '.section-multi-user-private-message #private-message-add-form',
          pm_send_button = '.section-multi-user-private-message #edit-submit';

      // On load
      $(pm_form_new_thread).attr('onSubmit', "document.getElementById(\'edit-submit\').disabled = true; return true;");
      $(pm_send_button)
        .after('<span id="post-message" class="alert-light" style="margin-left: 1em; color: #dc3545;"></span>')

      // On click
      $(pm_form_new_thread).submit(function(e){
        $(pm_send_button).css('background-color', '#0DA378');
        $(pm_send_button).css('border-color', '#0DA378');
        $('#post-message')
          .text('Please wait. This may take a few seconds to send.');
      });
    }
  }
})(jQuery, Drupal);
