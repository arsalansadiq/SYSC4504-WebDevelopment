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
