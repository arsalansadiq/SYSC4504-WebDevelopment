String.prototype.filename=function(extension){
    var s= this.replace(/\\/g, '/');
    s= s.substring(s.lastIndexOf('/')+ 1);
    return extension? s.replace(/[?#].+$/, ''): s.split('.')[0];
}

$(window).load(function() {

    $("img[id^='small']").on('click',function(){
        var imgsrc=$(this).attr('src').filename();
        imgsrc = imgsrc+'.jpg';

        // alert(imgsrc);
       var imagefolder = "images/medium/"+imgsrc ; 
        $("img[id*=big]").attr('src', imagefolder);
        imageTitle = $(this).attr('title');

        $("img[id*=big]").attr('title', imageTitle);
        $("img[id*=big]").next('figcaption').text(imageTitle);
        // alert(imageTitle);
});
    // alert("window load occurred!");

    //mouseover and mouseout stuff
    $("img[id*=big]").mouseover(function () {
        $('.textblock').show();
    }).mouseout(function () {
        $('.textblock').hide();
    });
});
