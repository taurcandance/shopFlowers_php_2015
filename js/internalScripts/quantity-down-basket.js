$(document).ready(function () {
    $('span.but_down').on('click', function () {
        var id_order    = $('span#num_order').text();
        var id_product  = $(this).attr('value');
        var num         = "span#quant" + id_product;
        var num_next    = $(num).text();

        if (parseFloat(num_next) <= 1)
        {
            alert('меньше 1 кол-во товара быть не может/' +
                'воспользуйтесь крестиком для удаления');
            end();
        }
        var url = "handler-quantity-in-basket.php?id_order=" +
            id_order + "&" + "id_product_down=" + id_product;

        $.get(url, function (response) {
            var data_received = JSON.parse(response);
            if (typeof data_received[0].Answer !== "undefined")
            {
                var out = data_received[0].Answer;
                var num = "span#quant" + id_product;
                $(num).text(out);
                cost_quantity_prod();
                total_sum();
            }
            else
            {
                alert('Сэр, что-то пошло не так');
            }
        })
    })
});