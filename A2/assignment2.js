$(window).load(function () {

    $("img[id^='small']").on('click', function () {
        $newSrc = $(this).attr('src').replace("small","medium");
        $("img[id*=big]").attr('src', $newSrc);

        $imageTitle = $(this).attr('title');
        $("img[id*=big]").attr('title', $imageTitle);
        $("img[id*=big]").next('figcaption').text($imageTitle);
    });

    //mouseover and mouseout stuff
    $("img[id*=big],.text-block").mouseover(function () {
        $('h2').text($("img[id*=big]").attr('title'));
         $('.text-block').css('visibility','visible');
    }).mouseout(function () {
        $('.text-block').css('visibility','hidden');
    });
});
