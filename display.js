function displayFresh() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-fresh");

  fresh.style.display = "block";
  main.style.display = "none";
}

function displayFruit() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-fruit");

  fresh.style.display = "block";
  main.style.display = "none";
}

function displayPreCut() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-precut");

  fresh.style.display = "block";
  main.style.display = "none";
}

function displayFlowers() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-flowers");

  fresh.style.display = "block";
  main.style.display = "none";
}

//Frozen
function displayBF() {
  var main = $('#bodypagechild-main')
  var fresh = $('#bodypagechild-bf')

  main.hide();
  fresh.show();
}

function displayDessert() {
  var main = $('#bodypagechild-main')
  var fresh = $('#bodypagechild-dessert')

  main.hide();
  fresh.show();
}

function displayPizza() {
  var main = $('#bodypagechild-main')
  var fresh = $('#bodypagechild-pizza')

  main.hide();
  fresh.show();
}

function displaySnacks() {
  var main = $('#bodypagechild-main')
  var fresh = $('#bodypagechild-snacks')

  main.hide();
  fresh.show();
}

//Pantry
function displayGoods() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-goods");

  fresh.style.display = "block";
  main.style.display = "none";
}

function displayVeg() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-veg");

  fresh.style.display = "block";
  main.style.display = "none";
}

function displaySpread() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-spread");

  fresh.style.display = "block";
  main.style.display = "none";
}

//Breakfast
function displayCereals() {
  var main = $('#bodypagechild-main')
  var fresh = $('#bodypagechild-cereal')

  main.hide();
  fresh.show();
}
function displayPan() {
  var main = $('#bodypagechild-main')
  var fresh = $('#bodypagechild-pan')

  main.hide();
  fresh.show();
}
function displayBread() {
  var main = $('#bodypagechild-main')
  var fresh = $('#bodypagechild-bread')

  main.hide();
  fresh.show();
}

//Baking
function displayBaking() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-goods");

  fresh.style.display = "block";
  main.style.display = "none";
}

//Candy
function displayCandy() {
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById("bodypagechild-fresh");

  fresh.style.display = "block";
  main.style.display = "none";
}

//Snacks
function displaySnack() {
  var main = $('#bodypagechild-main')
  var fresh = $('#bodypagechild-fresh')

  main.hide();
  fresh.show();
}

function search_candy() {
  let input = document.getElementById('searchbar').value

  if (input.trim() != "" & !isNaN(input.slice(-1))) {
    alert('Do not enter numbers')
    return
  }

  input = input.toLowerCase();
  let x = {
    'Snickers Bar': 'snack0',
    'M&Ms milk candy': 'snack1',
    'Reeses peanut butter cup': 'snack2'
  }

  var keys = Object.keys(x);

  for (i = 0; i < keys.length; i++) {
    var key = keys[i];
    var element = document.getElementsByClassName(x[key]);
    if (!key.toLowerCase().includes(input)) {
      element[0].style.display = "none";
    }
    else {
      element[0].style.display = "flex";
    }
  }
}


function search_snacks() {
  let input = document.getElementById('searchbar').value

  if (input.trim() != "" & !isNaN(input.slice(-1))) {
    alert('Do not enter numbers')
    return
  }

  input = input.toLowerCase();
  let x = {
    'Lays Classic': 'snack0',
    'Doritos Nacho Cheese': 'snack2',
    'Pop-tarts strawberry': 'snack1'
  }

  var keys = Object.keys(x);

  for (i = 0; i < keys.length; i++) {
    var key = keys[i];
    var element = document.getElementsByClassName(x[key]);
    if (!key.toLowerCase().includes(input)) {
      element[0].style.display = "none";
    }
    else {
      element[0].style.display = "flex";
    }
  }
}

function displayTime() {
  var date = new Date();
  var current_time = date.getHours() + ":" + date.getMinutes();
  var current_date = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
  document.getElementById("time").innerHTML = current_date + " / " + current_time;
}


function displayAllItems(parentClass, childDiv1, childDiv2, childDiv3, childDiv4) {
  const parent = document.querySelector(parentClass);
  const child1 = document.querySelector(childDiv1);
  const child2 = document.querySelector(childDiv2);
  const child3 = document.querySelector(childDiv3);
  const child4 = document.querySelector(childDiv4);

  for(var i=0; i<child1.children.length;) {
    parent.appendChild(child1.children[i])
  }

  for(let i of child2.children) {
    parent.appendChild(i)
  }

  if(child3 != null) {
    for(let i of child3.children) {
      parent.appendChild(i)
    }
  }

  if(child4 != null) {
    for(let i of child4.children) {
      parent.appendChild(i)
    }
  }
  
  var main = document.getElementById("bodypagechild-main");
  var fresh = document.getElementById(parentClass.slice(1));

  fresh.style.display = "block";
  main.style.display = "none";
}