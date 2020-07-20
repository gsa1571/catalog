$(function () {
  $(".category").dcAccordion();

  $("#perpage").change(function () {
    var perPage = this.value;
    //$.cookie('per_page', perPage,  {expires : 7, path : '/category/'});
    $.cookie("per_page", perPage, { expires: 7 });
    window.location = location.href;
  });
});
