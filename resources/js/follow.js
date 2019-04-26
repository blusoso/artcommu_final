if($('.page-follower').length > 0){
  $(".following-btn").click(function() {
    var owner_id = $( this ).data('owner');
    var following_id = $( this ).data('following');
    var username = $( this ).data('username');
    var is_follow = $( this ).data('is_follow');
    var id = $( this ).data('id');
    $.ajax({
      url: "/profile/"+username+"/follow",
      method: 'post',
      data: {
         'owner_id' : owner_id,
         'following_id' : following_id,
         'is_follow' : is_follow
      },
      success: function(result){
          if (result[0] == 1) {
            $('.following'+id).removeClass('follow-btn');
            $('.following'+id).addClass('following-btn');
            $('.following'+id).text('Following');
          } else {
            $('.following'+id).removeClass('following-btn');
            $('.following'+id).addClass('follow-btn');
            $('.following'+id).text('Follow');
          }
      }
    });
  });

  $(".follow-btn").click(function() {
    var owner_id = $( this ).data('owner');
    var following_id = $( this ).data('following');
    var username = $( this ).data('username');
    var is_follow = $( this ).data('is_follow');
    var id = $( this ).data('id');
    console.log(username);
    $.ajax({
      url: "/profile/"+username+"/follow",
      method: 'post',
      data: {
         'owner_id' : owner_id,
         'following_id' : following_id,
         'is_follow' : is_follow
      },
      success: function(result){
        console.log(result);
          if (result[0] == 1) {
            $('.following' + id).removeClass('follow-btn');
            $('.following' + id).addClass('following-btn');
            $('.following' + id).text('Following');
          } else {
            $('.following' + id).removeClass('following-btn');
            $('.following' + id).addClass('follow-btn');
            $('.following' + id).text('Follow');
          }
      }
    });
  });
}
