const addItem = (id) => {
    updateItem(id, 'addItem')
}

const removeItem = (id) => {
    updateItem(id, 'removeItem')
}

const updateItem = (id, mode) => {
    $.ajax({
        url: './ajax-cart.php',
        method: 'POST',
        data: {
            mode: mode,
            id: id,
        },
        success: function (data) {
            console.log(data);
            window.location.reload();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }
    });
};