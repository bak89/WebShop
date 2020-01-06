$(function () {
    $('.add-to-cart').submit(function(e) {
        e.preventDefault();
        //AJAX
        $.ajax({
            url: "ajax-cart.php",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                $("#cart-holder").fadeOut(500, function () {
                    $(this).empty().append(response).fadeIn(500);
                });
                $('.classname').text('amount');
            }
        });
    });
    $('.updateCart').bind('keyup mouseup', function () {
        $(this).closest('form').submit();
    })
});

let removeItem = (id) => {
    console.log(id);
    let formData = new FormData;
    let data = {
        'mode': 'removeItem',
        'id': id,
        'num': 1
    };
    $.ajax({
        url: "ajax-cart.php",
        type: "POST",
        data:  data,
        success: function (response) {
            $("#cart-holder").fadeOut(500, function () {
                $(this).empty().append(response).fadeIn(500);
            });
            $('.classname').text('amount');
        }
    });
};