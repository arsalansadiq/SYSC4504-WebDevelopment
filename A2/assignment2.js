<script type="text/javascript">
function showImage(image){
  var mainImage = document.getElementById('mainImage');
  var mainImage = document.querySelector('[id^="big"]').id;
  mainImage.src = image;
}
function toggleThumbnails(){
  var thumbnails = document.getElementById('thumbnails');
  if(thumbnails.style.display == 'block'){
    thumbnails.style.display = 'none';
  } else {
    thumbnails.style.display = 'block';
  }
}
</script>


// $('#select-form img').click(function() {
//     // Set the form value
//     $('#image-value').val($(this).attr('data-value'));
//
//     // Unhighlight all the images
//     $('#select-form img').removeClass('highlighted');
//
//     // Highlight the newly selected image
//     $(this).addClass('highlighted');
// });
