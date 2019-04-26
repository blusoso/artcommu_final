if ($('#postcontent')) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.delete-post').click(function functionName() {
    var post_id = $(this).data('postid');
    if (confirm("Are you sure you want to Delete this Post?")) {
      $.ajax({
        url: "/post/delete",
        method: 'get',
        data: {
           'post_id' : post_id
        },
        success: function(result){
          $('.postcontent'+post_id).hide();
        }
      });
    }
  });

  $('.delete-comment').click(function functionName() {
    var comment_id = $(this).data('commentid');
    var post_id = $(this).data('postid');
    $.ajax({
      url: "/comment/delete",
      method: 'get',
      data: {
         'comment_id': comment_id,
         'post_id' : post_id
      },
      success: function(result){
        // location.reload();
        $('.each-comment'+comment_id).hide();
      }
    });
  });

  $('.comment-btn').click(function(){
    var post_id = $(this).data('postid');
    var user_id = $(this).data('userid');
    var comment = $('.commentcontent'+post_id).val();
    $.ajax({
      url: "/comment/insert",
      type: "post",
      data: {
         'post_id': post_id,
         'user_id' : user_id,
         'comment' : comment
      },
      success: function(result){
        // console.log(result);
        location.reload();
      }
    });
  });

  $('.heart-post').click(function(){
      var post_id = $(this).data('postid');
      var user_id = $(this).data('userid');
      var is_fav = $(this);
      $.ajax({
        url: "/post/favpost",
        type: "post",
        dataType: 'html',
        data: {
           'post_id': post_id,
           'user_id' : user_id
        },
        success: function(result){
          console.log(result);
          var data = $.parseJSON(result);
          if (data["is_fav"] == 1) {
            is_fav.addClass('heart-post-active');
          } else {
            is_fav.removeClass('heart-post-active');
          }
          $('.fav-counting'+post_id).text(data["fav_count"]);
        }
      });



  });

  $('.heart-comment').click(function(){
      var comment_id = $(this).data('commentid');
      var user_id = $(this).data('userid');
      var is_fav = $(this);
      // alert(comment_id + ' ' + user_id);
      $.ajax({
        url: "/comment/fav",
        type: "post",
        data: {
           'comment_id': comment_id,
           'user_id' : user_id
        },
        success: function(result){
          if (result['is_fav'] == 1) {
            is_fav.addClass('heart-comment-active');
          } else {
            is_fav.removeClass('heart-comment-active');
          }
          $('.fav-comment-counting'+comment_id).text(result['fav_count']);
        }
      });
  });

  $('.comment').click(function() {
      var post_id = $(this).data('postid');
      $('#toggle-comment-'+post_id).toggle('normal');
  });
}
