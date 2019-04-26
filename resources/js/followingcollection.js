if ($('#followingcollection-page').length > 0) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('.heart').click(function(){
    var collection_id = $(this).data('collectionid');
    var user_id = $(this).data('userid');
    $.ajax({
      url: "/collection/fav",
      type: "post",
      data: {
         'collection_id': collection_id,
         'user_id' : user_id
      },
      success: function(result){
        $('#favcollection' + collection_id).fadeOut();
        setTimeout(function () {
            $('#followingcollection-page').fadeIn().delay(500);
        },300);
      }
    });
  });

  $('.heart-otheruser').click(function(){
    var collection_id = $(this).data('collectionid');
    var user_id = $(this).data('userid');
    var is_fav = $(this);
    $.ajax({
      url: "/collection/fav",
      type: "post",
      data: {
         'collection_id': collection_id,
         'user_id' : user_id
      },
      success: function(result){
        if (result[0] == 1) {
          is_fav.addClass('heart-active');
        } else {
          is_fav.removeClass('heart-active');
        }
        $('.fav-counting'+collection_id).text(result[1]);
      }
    });
  });
}
