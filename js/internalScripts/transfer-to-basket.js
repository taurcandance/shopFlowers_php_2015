$(document).ready(function () {
    $("div#button_transfer_to_basket").on('click', function () {
        var id_product      = $(this).attr('value');
        var id_order        = $('#id_user').attr('value');
        var cost_av         = "span#cost" + id_product;
        var product_cost    = $(cost_av).text();
        var url             = "handler-transfer-to-basket.php?id_product=" +
            id_product + "&" + "id_user=" + id_order + "&" +
            "product_cost=" + product_cost;

        $.get(url, function (response) {
            var data_received = JSON.parse(response);
            if (typeof data_received[0].Answer !== "undefined")
            {
                var out = data_received[0].Answer;
                alert(out);
            }
            else
            {
                alert('Сэр, что-то пошло не так');
            }
        })
    })
});