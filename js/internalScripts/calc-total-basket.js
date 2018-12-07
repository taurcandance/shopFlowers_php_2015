$(document).ready(function total_sum_basket() {
    total_sum();
});

function total_sum()
{
    var array = document.querySelectorAll('span[name=cost_poz]');
    var sum = 0;

    for (var i = 0; i < array.length; i++)
    {
        sum += parseFloat(array[i].innerText);
    }
    $('span#sum').text(sum.toFixed(2));
}