$(document).ready(function () {
    $('#menu-button').on("click", toggleMenu);
    $('#options').on("click", toggleFabMiniBox);
    $('#option-user-button').on("click", toggleUserOptions);
});

var is_menu_visible = false;
function toggleMenu(event)
{
    if (!is_menu_visible) { $("#side-bar").animate({ left: '0px', opacity: '1' }, 200); }
    else { $("#side-bar").animate({ left: '-250px', opacity: '0' }, 200); }
    is_menu_visible = !is_menu_visible;

    $('#user-option').hide();

    event.stopPropagation();
}
function toggleFabMiniBox()
{
	$('.fab-mini-box').fadeToggle(300);
	event.stopPropagation();
}
function toggleUserOptions(event)
{
	$('#user-option').slideToggle(300);
	event.stopPropagation();
}