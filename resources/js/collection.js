if($('#page-collection').length > 0){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("input#delete-btn").click(function() {
        var collect_id = $('#collection-id').val();
          $.ajax({
            url: '/collection/delete',
            method: 'get',
            data: {
               'id': collect_id
            },
            success: function(result){
              $('#editCollectionModal').modal('hide');
              $('.collection-'+ collect_id).fadeOut();
              setTimeout(function () {
                location.reload();
              }, 300);
            }
          });
    });

    $("input#save-btn").click(function() {
        var collect_id = $('#collection-id').val();
        var title = $('#collection-name').val();
        var description = $('#collection-description').val();
        var is_private = $('#private-chk').val();
        var user_id_edit = $('#user_id_edit').val();
          $.ajax({
            url: "/collection/update",
            method: 'post',
            data: {
               'collection-id': collect_id,
               'collection-name': title,
               'collection-description': description,
               'private-chk': is_private,
               'user_id_edit' : user_id_edit
            },
            success: function(result){
            }
          });
    });

    $('#filter').change(function(){
      var selected = $(this).find('option:selected');
      var username = selected.data('username');
      var id = selected.data('sortingid');
      var user_id = selected.data('userid');

      // console.log(id,user_id,username);
      $.ajax({
        url: "/collection/"+user_id+"/"+username+"/sorting",
        type: "get",
        dataType: 'html',
        data: {
           'id': id,
           'user_id': user_id
        },
        success: function(result){
          // console.log(result);
          $('#collection-list').fadeOut(200, function(){
            $('#collection-list').html(result).fadeIn().delay(500);
          });
        }
      });
    });
    $(".edit_button").click(function () {
        console.log(this);
         var id = $(this).data('collectid');
         var title = $(this).data('title');
         var description = $(this).data('description');
         var isprivate = $(this).data('isprivate');
             console.log(this);
         $('#collection-id').val(id);
         $('#collection-name').val(title);
         $('#collection-description').val(description);
         if(isprivate == 1){
           $('#private-chk').prop("checked",true);
         }
         $('#private-chk').val(isprivate);
    });

    $('#private-chk').click(function(){
        if($(this).prop("checked") == true){
            $('#private-chk').val(1);
        }
        else if($(this).prop("checked") == false){
            $('#private-chk').val(0);
        }
    });
    $('.heart').click(function(){
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
          if(result[0] == 1) {
            is_fav.addClass('heart-active');
          } else {
            is_fav.removeClass('heart-active');
          }
        }
      });
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
           'following_id' : following_id
        },
        success: function(result){
            location.reload();
            // alert(result);
        }
      });
    });
}
