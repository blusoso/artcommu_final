if($('#profileheader-page').length > 0){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $("#follow-btn").click(function() {
    var owner_id = $( this ).data('owner');
    var following_id = $( this ).data('following');
    var username = $( this ).data('username');
    // alert(owner_id+' ' +following_id)
    $.ajax({
      url: "/profile/"+username+"/follow",
      method: 'post',
      data: {
         'owner_id' : owner_id,
         'following_id' : following_id,
      },
      success: function(result){
<<<<<<< HEAD
=======
          // location.reload();
          // alert(result);
          alert(result);
          // console.log(result[1]);
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
          if (result[0] == 1) {
            $('#follow-btn').text('Unfollow');
            $('#follow-btn').addClass('unfollow-active2');
          } else {
            $('#follow-btn').text('Follow');
            $('#follow-btn').removeClass('unfollow-active2').removeClass('unfollow-active');
          }

          $(".follower_count"+owner_id).text(result[1]);
      }
    });
  });
}
