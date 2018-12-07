$(document).ready(function total_sum_basket() {
    cost_quantity_prod();
});

function cost_quantity_prod()
{
    for (var i = 0; i < 100; i++)
    {
        var out1    = "span#quant" + i;
        var elem1   = parseFloat($(out1).text());
        var out2    = "span#cost_prod" + i;
        var elem2   = parseFloat($(out2).text());
        var sum     = elem1 * elem2;
        var out     = "span#sum_prod" + i + ".cost";
        $(out).text(sum.toFixed(2));
    }
}