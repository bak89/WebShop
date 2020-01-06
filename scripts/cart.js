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

let addItem = (id) => {
    let formData = new FormData();
    formData.append('mode', 'addItem');
    formData.append('id', id);

    fetch('./ajax-cart.php', {method: 'POST', body: formData})
        .then((resp) => resp.json())
        .then(function(data) {
            console.log(data);
        });
};

let removeItem = (id) => {
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
          console.log(response);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
    });
    window.location.reload();
};

let updateAmount = (op, name, id) => {
    let element = document.querySelector('.'+ name);
    if(op === '+') {
        element.value++;
        addItem(id);
    } else {
        if(element.value > 0) {
            element.value--;
            removeItem(id);
        }
    }
};