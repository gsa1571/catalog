$(function () {
  $(".category").dcAccordion();

  $("#perpage").change(function () {
    var perPage = this.value;
    //$.cookie('per_page', perPage,  {expires : 7, path : '/category/'});
    $.cookie("per_page", perPage, { expires: 7 });
    window.location = location.href;
  });

  $("#forgot-link").click(function () {
    $("#auth").fadeOut(300, function () {
      $("#forgot").fadeIn();
      return false;
    });
  });

  $("#auth-link").click(function () {
    $("#forgot").fadeOut(300, function () {
      $("#auth").fadeIn();
      return false;
    });
  });


});
