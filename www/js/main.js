$(function () {

    $.nette.init();


   // Sending form with ajax technology
    $('#MyForm').on('click', function(){
        var form = $(this).closest('form');
        $.nette.ajax({
            type: 'POST',
            url:  form.attr('action'),
            data: form.serialize()
        });
    return false;
    })


    // Spinner setup for the waiting for echo from server.
    $.nette.ext('MyForm', {

        before: function (xhr, settings) {

            console.log('nette.BEFORE');

            $spinner = $('<div id="ajax-spinner"></div>');
            $spinner.appendTo("#displayCalculateIn");
            $("#ajax-spinner").css({
                visibility: "visible",
                display:"block",
                background:"url('./images/spinner400x300.gif') no-repeat",
                position: "absolute",
                "z-index": "123456",
                width: 400+"px",
                height: 300+"px",
                left: 50+"%",
                top: 50+"%",
                //"margin-left": "-220px",
                //"margin-top": "-150px"
                left: event.pageX -214,
                top: event.pageY - 163
            });
        },
        complete: function () {
 
            console.log('nette.COMPLETE');

             $("#ajax-spinner").css({
                 visibility: "hidden",
                 display:"none",
                 });
        }


    });


    // Render display
    var str = $("#display").html();
    str = htmlDecode(str);
    var $displayCalculate   = $( '#displayCalculate' );
    var $displayCalculateIn = $( '<span id="displayLabel">Output: </span><div id="displayCalculateIn" class="text"></div>' );
    $displayCalculate.html( $displayCalculateIn );
    $("#displayCalculateIn").html(str);
    $("#display").html('');


    // Setting default radio button
    $(".radio")[0].checked = true;


});
