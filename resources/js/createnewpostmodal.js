if ($('#createnewpost'))  {
  var listen = function(element, event, fn) {
      return element.addEventListener(event, fn, false);
  };

  listen(document, 'DOMContentLoaded', function() {

      var fileInput = document.querySelector('#imagesmodal');
      var listView = document.querySelector('#list-viewmodal');

      var queue = [];
      var isProcessing = false;

      var image = new Image();
      var imgLoadHandler;

      listen(fileInput, 'change', function(event) {
          var files = fileInput.files;
          if (files.lenght == 0) {
              return;
          }
          for(var i = 0; i < files.length; i++) {
              queue.push(files[i]);
          }
          //fileInput.value = "";
          processQueue();
      });

      var processQueue = function() {
          if (isProcessing) {
              return;
          }
          if (queue.length == 0) {
              isProcessing = false;
              return;
          }
          isProcessing = true;
          file = queue.pop();
          var li = document.createElement('LI');
          var canvas = document.createElement('CANVAS');
          var ctx = canvas.getContext('2d');
          image.removeEventListener('load', imgLoadHandler, false);
          imgLoadHandler = function() {
              var newWidth = 100;
              var newHeight = image.height * (newWidth / image.width);
              ctx.drawImage(image, 0, 0, newWidth, newHeight);
              URL.revokeObjectURL(image.src);
              li.appendChild(canvas);
              isProcessing = false;
              setTimeout(processQueue, 200);
          };
          listView.appendChild(li);
          listen(image, 'load', imgLoadHandler);
          image.src = URL.createObjectURL(file);
      };
  });
}
