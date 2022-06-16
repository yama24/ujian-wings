function buy(id){
    $.ajax({
        url: '/buy/' + id,
        type: 'GET',
        success: function(data){
            data = JSON.parse(data);
            alert(data.message);
            $('#' + id).attr('disabled', true);
        }
    });
}