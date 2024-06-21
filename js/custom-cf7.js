jQuery(document).ready(function ($) {
  $("form.wpcf7-form").on("submit", function (event) {
    event.preventDefault();
    var form = $(this);
    var email = form.find('input[name="your-email"]').val();

    $.ajax({
      type: "POST",
      url: cf7_ajax_object.ajax_url,
      data: {
        action: "check_last_submission",
        email: email,
        nonce: cf7_ajax_object.nonce,
      },
      success: function (response) {
        if (response.can_submit) {
          form.unbind("submit").submit();
        } else {
          alert(
            "You have already submitted a form within the last hour. Please try again later."
          );
        }
      },
    });
  });
});
