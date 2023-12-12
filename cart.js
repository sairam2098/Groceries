function addToCart(itemNo, qua) {
    var quantity = document.getElementById(qua).value
    var date = new Date().toISOString().slice(0, 10).replace('T', ' ');
    var customerid = localStorage.getItem('customerid');

    $.ajax({
        url: 'display.php',
        method: 'post',
        data: { itemNo: itemNo, quantity:quantity, date: date, customerid: customerid },
        success: function (response) {
            console.log(response)
            alert(response);
        }
    })
}

function addOnceToCart(itemNo) {
    var date = new Date().toISOString().slice(0, 10).replace('T', ' ');
    var customerid = localStorage.getItem('customerid');

    $.ajax({
        url: 'display.php',
        method: 'post',
        data: { itemNo: itemNo, date: date, customerid: customerid },
        success: function (response) {
            console.log(response)
            alert(response);
        }
    })
}

function removeAll() {
    var operation = 'removeAll';
    $.ajax({
        url: 'display.php',
        method: 'get',
        data: {operation:operation},
        success: function (response) {
            setTimeout(function() {
                window.location.reload(true);
            }, 100);
        }
    })
}

function removeOne(itemNo) {
    $.ajax({
        url: 'display.php',
        method: 'get',
        data: {removeItem:itemNo},
        success: function (response) {
            setTimeout(function() {
                window.location.reload(true);
            }, 300);
        }
    })
}

function checkOut() {
    var operation = 'checkout';
    $.ajax({
        url: 'display.php',
        method: 'get',
        data: {operation:operation},
        success: function (response) {
        }
    })
    location.reload();
}
