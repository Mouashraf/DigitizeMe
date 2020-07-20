/* Smooth Scrolling */
$('a[href*="#"]')
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        event.preventDefault();
        $("html, body").animate(
          {
            scrollTop: target.offset().top
          },
          1000,
          function() {
            var $target = $(target);
            $target.focus();
            if ($target.is(":focus")) {
              return false;
            } else {
              $target.attr("tabindex", "-1");
              $target.focus();
            }
          }
        );
      }
    }
  });

/* Cpunt Up */
jQuery(document).ready(function($) {
  $(".count").counterUp({
    delay: 10,
    time: 1000
  });
});

/*===================================================================================*/
/*  CONTACT AJAX FORM                                                                */
/*===================================================================================*/

$("#contact-form").each(function() {
  var $this = $(this);
  $this.submit(function() {
    var str = $this.serialize();
    $.ajax({
      type: "POST",
      url: $this.attr("action"),
      data: str,
      success: function(msg) {
        if (msg == "OK") {
          location = "thanks.html";
        } else {
          alert(msg);
        }
      },
      error: function(xhr, status, error) {
        alert("An Error has occured! Try again later");
      }
    });
    return false;
  }); // submit
}); // each contactform
