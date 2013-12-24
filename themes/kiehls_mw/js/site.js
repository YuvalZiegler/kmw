jQuery(document).ready(function($) {

  $(document).on('click', "[data-toggle-target-id]", function(){

    var targetID = $(this).data().toggleTargetId;
    $(targetID).fadeToggle();
  })

});