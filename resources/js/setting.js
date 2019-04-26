if($('#page-setting')){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.imageAvatar2').css('background-image', 'url('+e.target.result +')');
            $('.imageAvatar2').hide();
            $('.imageAvatar2').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
  }
  $("#imageUpload-edit").change(function() {
      readURL(this);
  });
  $("#imageUpload").change(function() {
      readURL(this);
      $('.save-image-btn').removeClass('hidden');
  });
}
