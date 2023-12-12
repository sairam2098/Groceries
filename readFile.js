function displayScreen() {
    var user = localStorage.getItem('username');
    if(user == 'admin') {
        var main = document.getElementById("admin");
        main.style.display = "block";
        var general = document.getElementById("general");
        general.style.display = "none";
    }else {
        var main = document.getElementById("admin");
        main.style.display = "none";
        var general = document.getElementById("general");
        general.style.display = "block";
    }
}

function readFile() {
    var fileType = document.getElementById('dropdown').value;
    var fileInput = document.getElementById('fileInput');
    var file = fileInput.files[0];
    var reader = new FileReader();

    reader.onload = function (event) {
        var xmlString = event.target.result;
        if(fileType == 'XML'){
            displayXMLFields(xmlString);
        }else if(fileType = 'JSON') {
            displayJSONFields(xmlString);
        }
    };

    reader.readAsText(file);
}

function displayJSONFields(jsonString) {
    try {
        var products = JSON.parse(jsonString);

        for (var i = 0; i < products.length; i++) {
            var image = products[i].image;
            var name = products[i].name;
            var price = products[i].price;
            var quantity = products[i].quantity;
            var category = products[i].category;
            var subcategory = products[i].subcategory;

            $.ajax({
                url: 'display.php',
                method: 'post',
                data: { image: image, name: name, price: price, quantity: quantity, category: category, subcategory: subcategory },
                success: function (response) {
                }
            })
        }
        alert('Succesfully added to the cart')
    } catch (error) {
        alert('Error occurred while reading the XML file')
    }
}

function displayXMLFields(xmlString) {
    try {
        var xmlDoc = new DOMParser().parseFromString(xmlString, 'text/xml');

        var products = xmlDoc.getElementsByTagName('PROD');

        for (var i = 0; i < products.length; i++) {
            var image = products[i].children[0].innerHTML;
            var name = products[i].children[1].innerHTML;
            var price = products[i].children[2].innerHTML;
            var quantity = products[i].children[3].innerHTML;
            var category = products[i].children[4].innerHTML;
            var subcategory = products[i].children[5].innerHTML;

            $.ajax({
                url: 'display.php',
                method: 'post',
                data: { image: image, name: name, price: price, quantity: quantity, category: category, subcategory: subcategory },
                success: function (response) {
                }
            })
        }
        
        alert('Succesfully added to the cart')
    } catch (error) {
        alert('Error occurred while reading the XML file')
    }
}

