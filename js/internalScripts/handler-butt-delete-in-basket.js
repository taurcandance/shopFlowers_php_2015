$(document).ready(function () {
    $('span.but_del').on('click', function () {
        var id_order    = $('span#num_order').text();
        var id_product  = $(this).attr('value');
        var url         = "handler-butt-delete-in-basket.php?id_order=" +
            id_order + "&" + "id_product_del=" + id_product;

        var where = $(this).parents('div').attr('value');
        var where_del = ".box[value=" + where + "]";
        $(where_del).remove();

        $.get(url, function (response) {
            var data_received = JSON.parse(response);
            if (typeof data_received[0].Answer !== "undefined")
            {
                // var out = data_received[0].Answer;
                // alert(out);
                update_numbering();
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

function update_numbering()
{
    $('span[name=poz]').each(function (i) {
        var number = i + 1;
        $(this).text(number);
    });
}