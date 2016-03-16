function retrieveClients(event)
{
    var _q = $('#producto').val();
    if (_q != '') {
        var _url = base_url + '/ajax/get_products/';
        $.ajax({url:_url, data:{q:_q}, type:'post'}).done(function (data) {
            $('#sugestions').show();
            $('#sugestions').html("");
            $('#sugestions').html('<ul class="sugestion-list">');
            $(data).each(function () {
                var value = this.codigo;
                var display = this.codigo + ' - ' + this.nombre;
                $('#sugestions').append('<li class="sugestion" data-value="' + value + '" data-display="' + display + '" onclick="selectClient(this)">' + display + '</li>');
            });
            $('#sugestions').append('<ul class="sugestion-list">');
        }).fail(function () { clearClient(); });
    }
    else
    {
        clearClient();
    }
}

function clearClient()
{
    clientCode = '';
    //$('#product_code').val('');
    $('#sugestions').hide();
    $('#sugestions').html("");
}

function selectClient(client)
{
    clientCode = $(client).attr('data-value');
    //$('#product_code').val(clientCode);
    $('#producto').val($(client).attr('data-display'));
    $('#sugestions').hide();
}