if($('#page-favimage')){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $(".edit_button").click(function () {
        var id = $(this).data('collectid');
        var title = $(this).data('title');
        var description = $(this).data('description');
        var isprivate = $(this).data('isprivate');
        $('#collection-id').val(id);
        $('#collection-name').val(title);
        $('#collection-description').val(description);
        if(isprivate == 1){
          $('#private-chk').prop("checked",true);
        }
        $('#private-chk').val(isprivate);
    });

    $("input#save-btn").click(function() {
        var collect_id = $('#collection-id').val();
        var title = $('#collection-name').val();
        var description = $('#collection-description').val();
        var is_private = $('#private-chk').val();
          $.ajax({
            url: "/collection/update",
            method: 'post',
            data: {
               'collection-id': collect_id,
               'collection-name': title,
               'collection-description': description,
               'private-chk': is_private
            },
            success: function(result){
              location.reload();
            }
          });
    });

    $('.heartimg').click(function(){
        var id = $(this).data('postid');
        var user_id = $(this).data('userid');
        var is_fav = $(this);
        $.ajax({
          url: "/post/favpost",
          type: "post",
          dataType: 'html',
          data: {
             'post_id': id,
             'user_id' : user_id

          },
          success: function(result){
            var data = $.parseJSON(result);
            if (data["is_fav"] == 1) {
              is_fav.addClass('heartimg-active');
            } else {
              is_fav.removeClass('heartimg-active');
            }
            $('.fav-counting'+id).text(data["fav_count"]);
          }
        });
    });

    $(".saveToCollection-btn").click(function() {
        var post_id = $(this).data('postid');
        $('#post_id').val(post_id);
    });

    $("#save-btn-tocollection-favimage").click(function() {
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
              $('#saveToCollectionModal2').modal('hide');
              $('.alertsave').addClass('hidden');
            },500);
          }
        }
      });
    });

    $('.delete-favimg').click(function functionName() {
      var id = $(this).data('posthascollectionid');
      $.ajax({
        url: "/favimage/delete",
        method: 'get',
        data: {
           'id': id
        },
        success: function(result){
          location.reload();
        }
      });
    });
}
