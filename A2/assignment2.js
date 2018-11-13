$(window).load(function () {//functions clickable when the page loads.

    $("img[id^='small']").on('click', function () { //whenever any small pics are clicked
        //change the image
        $newSrc = $(this).attr('src').replace("small", "medium");//take the source of the item that's clicked and replace the word small in it to medium and save in variable $newSrc
        $("img[id*=big]").attr('src', $newSrc);//change the src of the big image with the src replaced and called as $newSrc

        //change the title and figcaption of big image when small pic is clicked
        $imageTitle = $(this).attr('title');//take the title of the attribute thats clicked into the variable $imageTitle
        $("img[id*=big]").attr('title', $imageTitle);//change the title of the big image with the $imageTitle
        $("img[id*=big]").next('figcaption').text($imageTitle);//change the figcaption of the big image with the title $imageTitle
    });

    //Display/overlap the image/div with mouseover and mouseout
    $("img[id*=big],.overlayDiv").mouseover(function () {//whenver mouse is hovered on to the big image or the div of the small image
        $('h2').text($("img[id*=big]").attr('title'));//change the h2 tag text of the overlayDiv with the title of the image 
        $('.overlayDiv').css('visibility', 'visible');//make the OverlayDiv visible when mouse is hovered on
    }).mouseout(function () {//whenver mouse is hovered out to the big image or the div of the small image
        $('.overlayDiv').css('visibility', 'hidden');//make the OverlayDiv hidden when mouse is hovered out of the image
    });
});
