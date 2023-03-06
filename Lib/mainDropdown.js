$(document).ready(function () {
    $('#depensetoggle').click(function() {
        $('#depensemenu').show();
    })

    $('#depensetoggle').mouseout(function() {
        t = setTimeout(function() {
            $('#depensemenu').hide();
        }, 100);

        $('#depensemenu').on('mouseenter', function() {
            $('#depensemenu').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('#depensemenu').hide();
        })
    })


$('#abonnetoggle').click(function() {
        $('#abonnemenu').show();
    })

    $('#abonnetoggle').mouseout(function() {
        t = setTimeout(function() {
            $('#abonnemenu').hide();
        }, 100);

        $('#abonnemenu').on('mouseenter', function() {
            $('#abonnemenu').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('#abonnemenu').hide();
        })
    })

$('#ventetoggle').click(function() {
        $('#ventemenu').show();
    })

    $('#ventetoggle').mouseout(function() {
        t = setTimeout(function() {
            $('#ventemenu').hide();
        }, 100);

        $('#ventemenu').on('mouseenter', function() {
            $('#ventemenu').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('#ventemenu').hide();
        })
    })

   $('#travatoggle').click(function() {
        $('#travamenu').show();
    })

    $('#travatoggle').mouseout(function() {
        t = setTimeout(function() {
            $('#travamenu').hide();
        }, 100);

        $('#travamenu').on('mouseenter', function() {
            $('#travamenu').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('#travamenu').hide();
        })
    }) 


     $('#rapporttoggle').click(function() {
        $('#rapportmenu').show();
    })

    $('#rapporttoggle').mouseout(function() {
        t = setTimeout(function() {
            $('#rapportmenu').hide();
        }, 100);

        $('#rapportmenu').on('mouseenter', function() {
            $('#rapportmenu').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('#rapportmenu').hide();
        })
    }) 

 $('#notificationtoggle').click(function() {
        $('#notificationmenu').show();
    })

    $('#notificationtoggle').mouseout(function() {
        t = setTimeout(function() {
            $('#notificationmenu').hide();
        }, 100);

        $('#notificationmenu').on('mouseenter', function() {
            $('#notificationmenu').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('#notificationmenu').hide();
        })
    }) 




})