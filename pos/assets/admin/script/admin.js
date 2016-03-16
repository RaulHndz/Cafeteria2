var is_menu_visible = false;
var base_url = 'http://' + location.hostname + '/Liquidaciones';

$(document).ready(function () {
    $('#menu-button').on("click", toggleMenu);
    //$('#options').on("click", function () { $('.fab-mini-box').fadeToggle(300); event.stopPropagation(); });
    $('#option-user-button').on("click", toggleUserOptions);

    $('.body-content').on("click", function (event) {
        if (is_menu_visible) { toggleMenu(event); }
        //$('.fab-mini-box').fadeOut(0);
    });

/*
    document.onkeydown = function (e) {
        e = e || event;
        if (e.keyCode == 27) {
            if (is_menu_visible) { toggleMenu(e); }
            //$('.fab-mini-box').fadeOut(0);
        }
        e.stopPropagation();
    }

    $(document).bind("contextmenu", function (event) {
        if (!is_menu_visible) { toggleMenu(event); }
        return false;
    });
*/

});

function toggleMenu(event)
{
    if (!is_menu_visible) { $("#side-bar").animate({ left: '0px', opacity: '1' }, 200); }
    else { $("#side-bar").animate({ left: '-250px', opacity: '0' }, 200); $('#user-option').hide(); }
    is_menu_visible = !is_menu_visible;
}
function toggleUserOptions(event) {
    $('#user-option').slideToggle(300);
    event.stopPropagation();
}

function recSearch()
{
    document.location = '/Liquidaciones/Site/Recibos/?q=' + $('#search-box').val() + '&page=1';
}