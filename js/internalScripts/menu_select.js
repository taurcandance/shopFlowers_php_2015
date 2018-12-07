$(document).ready(function () {
    $('label#menus_link').on('click', function (e) {

        if (e.target.tagName == "LABEL")
        {
            return;
        }
        var items = document.querySelectorAll('#menu_link');
        var all_param = '';

        for (var i = 0; i < items.length; ++i)
        {
            var item = items[i];
            if (item.checked)
            {
                var indicator_param = item.attributes.name.value;
                var value_param     = item.attributes.value.value;
                var cond_param      = item.attributes.condition.value;
                if (all_param !== '')
                {
                    all_param += "&";
                }
                all_param += indicator_param + "[]" + cond_param + value_param;
            }
        }

        if (items[0].checked == 0)
        {
            var ajax_url = "handler-selectFlowers.php?" + all_param;
            $.get(ajax_url, function (response) {
                $('#content').html(response);
            });
        }
        if (items.length !== 0 && all_param !== '')
        {
            var ajax_url = "handler-selectFlowers.php?" + all_param;
            $.get(ajax_url, function (response) {
                $('#content').html(response);
            });
        }

    });
});