if($('.imagePost')) {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('.imagePost').click(function(){
      var image = $(this).data('img');
      var id = $(this).attr('id');
      var modal = document.getElementById('Modal_show');
      var modalImg = document.getElementById("image_show");
      var x = window.matchMedia("(max-width: 787px)");
      
      if(!x.matches){
        modal.style.display = "flex";
      }
      modalImg.src = image;
  });

  $('.close').click(function(){
    $('#Modal_show').hide();
  });
}
