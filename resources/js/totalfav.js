if ($('#totalfav-page').length > 0) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.heartimgfav').click(function(){
      var post_id = $(this).data('post_id');
      var favid = $(this).data('favid');
      $.ajax({
        url: "/favorite/fav",
        type: "post",
        dataType: 'html',
        data: {
           'favid': favid,
        },
        success: function(result){
          console.log(result);
          if (result == 0) {
            $('.heartimgfav'+favid).removeClass('heartimg-active');
          } else {
            $('.heartimgfav'+favid).addClass('heartimg-active');
          }
        }
      });
  });

  $('.heartimgfav-otheruser').click(function(){
      var post_id = $(this).data('post_id');
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
          var data = $.parseJSON(result)
          console.log(data["is_fav"],data["fav_count"]);
          if (data["is_fav"] == 1) {
            is_fav.addClass('heartimg-active');
          } else {
            is_fav.removeClass('heartimg-active');
          }
          $('.fav-counting'+post_id).text(data["fav_count"]);
        }
      });
  });

  $(".saveToCollection-btn").click(function() {
      var post_id = $(this).data('postid');
      $('#post_id').val(post_id);
  });

  $("#save-btn-tocollection").click(function() {
    var collectid = $( "option:selected" ).data('collectid');
    var post_id = $('#post_id').val();
    $.ajax({
      url: "/post/addtocollection",
      method: 'post',
      data: {
         'collection_id' : collectid,
         'post_id' : post_id
      },
      success: function(result){
        if (result) {
          $('.alertsave').removeClass('hidden').removeClass('alert-success');
          $('.alertsave').addClass('alert-warning');
          $('.alertsave').text(result);
          setTimeout(function () {
            $('.alertsave').addClass('hidden');
          },3000);
        } else {
          $('.alertsave').removeClass('hidden').removeClass('alert-warning');
          $('.alertsave').addClass('alert-success');
          $('.alertsave').text('Save Success');
          setTimeout(function () {
            $('#saveToCollectionModal').modal('hide');
            $('.alertsave').addClass('hidden');
          },500);
        }
      }
    });
  });
}
