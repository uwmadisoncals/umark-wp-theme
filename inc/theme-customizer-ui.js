jQuery(document).ready(function ($) {

  var use_verlag = $('[data-customize-setting-link="uwmadison_use_official_uw_type"]');
  var type_production_control = $("#customize-control-uwmadison_type_production");

  function show_type_production_control(el) {
    if (el.prop('checked')) {
      type_production_control.show();
    } else {
      type_production_control.hide();
    }
  }

  show_type_production_control(use_verlag);

  use_verlag.on("change", function(){
    show_type_production_control($(this));
  });

  
});