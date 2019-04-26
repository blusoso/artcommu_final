if($('#rand_follow_page').length > 0){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".follow-btn").click(function() {
    var owner_id = $( this ).data('owner');
    var following_id = $( this ).data('following');
    var username = $( this ).data('username');
    $.ajax({
      url: "/profile/"+username+"/follow",
      method: 'post',
      data: {
         'owner_id' : owner_id,
         'following_id' : following_id
      },
      success: function(result){
        console.log(result[0]);
          if (result[0] == 1) {
            $('#follow-btn'+following_id).text('');
            $('#follow-btn'+following_id).addClass('unfollow-active');
          } else {
            $('#follow-btn'+following_id).text('Follow');
            $('#follow-btn'+following_id).removeClass('unfollow-active');
          }
      }
    });
  });
}
