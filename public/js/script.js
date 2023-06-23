var opened_hidden_header = false;

function open_hidden_header() {
    var hidden_header = document.getElementById("hidden_header");
    if (opened_hidden_header) {
        hidden_header.style.maxHeight = "0";
        opened_hidden_header = false;
    } else {
        hidden_header.style.maxHeight = "271px";
        opened_hidden_header = true;
    }
}

var opened_section = {
    category: false,
    flower_type: false,
    price: false,
    material: false,
    size: false,
    color: false
}
function opensection(section_name, elements_amount) {
    var section = document.getElementById(section_name);
    if (opened_section[section_name]) {
        section.style.maxHeight = "0";
        section.style.paddingBottom = "0";
        opened_section[section_name] = false;
        setPlus(section_name+"_img")
    } else {
        section.style.maxHeight = (39*elements_amount).toString() + 'px';
        section.style.paddingBottom = "20px";
        opened_section[section_name] = true;
        setMinus(section_name+"_img")
    }
}

function setPlus(img_name) {
    var img = document.getElementById(img_name);
    img.src = "/images/plus.svg";
}

function setMinus(img_name) {
    var img = document.getElementById(img_name);
    img.src = "/images/minus.svg";
}

function setCheckbox(checkboxName) {
    let maxHeight;
    var payment_grid = document.getElementById("payment_grid")
    if (window.screen.availWidth > 1080) {
        maxHeight = 115;
    } else {
        maxHeight = 420;
    }
    if (checkboxName === 'card') {
        payment_grid.style.maxHeight = maxHeight + "px";
    } else {
        payment_grid.style.maxHeight = "0";
    }
}

function redirect(url) {
    window.location.href=url;
}

var contactVisibility = false;
var currentContact = "";
function showContact(contact) {
    if (contactVisibility === false) {
        var hidden_contact = document.getElementById("hidden_contact");
        hidden_contact.innerHTML = contact;
        hidden_contact.style.maxWidth = '100%';
        contactVisibility = true;
        currentContact = contact;
    }
    else{
        if (currentContact !== contact) {
            var hidden_contact = document.getElementById("hidden_contact");
            hidden_contact.innerHTML = contact;
            currentContact = contact;
            hidden_contact.animate(
                [
                    {maxWidth: '0'},
                    {maxWidth: '100%'},
                ], {
                    duration: 1000
                }
            )
        }
    }
}

let hiddenSortOpened = false;
function showHiddenSort(parameters_amount) {
    let section = document.getElementById("hidden_sort");
    let arrow = document.getElementById("sort_arrow");
    if (hiddenSortOpened) {
        section.style.maxHeight = '0';
        arrow.style['-ms-transform'] = 'rotate(0deg)';
        arrow.style['-webkit-transform'] = 'rotate(0deg)';
        hiddenSortOpened = false;
    } else {
        section.style.maxHeight = (100+30*parameters_amount).toString()+'px';
        arrow.style['-ms-transform'] = 'rotate(-180deg)';
        arrow.style['-webkit-transform'] = 'rotate(-180deg)';
        hiddenSortOpened = true;
    }
}

function update_cart(csrf_token, id) {
    jQuery.ajax({
        url: '/add_to_cart',
        method: "patch",
        data: {
        _token: csrf_token,
            id: id
        },
        success: function (response) {
            window.location.reload();
            show_hidden_card_button();
        }
    })
}

function show_hidden_card_button() {
    let button = document.getElementById('hidden_cart_button');
    button.style.border = '1px #29432F solid';
    button.style.maxWidth = '260px';
    let text = document.getElementById('success_text');
    text.style.maxHeight = '20px';
    setTimeout(()=> {
            text.style.maxHeight = '0';
        }
        ,3000);
}

let hiddenSelectOpened = false;
function show_hidden_section(select_id) {
    let selection = document.getElementById("hidden_select" + select_id);
    let arrow = document.getElementById("select_arrow" + select_id);
    if (hiddenSelectOpened) {
        selection.style.maxHeight = '0';
        arrow.style['-ms-transform'] = 'rotate(0deg)';
        arrow.style['-webkit-transform'] = 'rotate(0deg)';
        hiddenSelectOpened = false;
    } else {
        selection.style.maxHeight = '236px';
        arrow.style['-ms-transform'] = 'rotate(-180deg)';
        arrow.style['-webkit-transform'] = 'rotate(-180deg)';
        hiddenSelectOpened = true;
    }
}

function change_selected_number(number, select_id) {
    let select_number = document.getElementById('select_number' + select_id);
    select_number.innerText = 'Кількість: ' + number;
    show_hidden_section(select_id);
    result_price_update(number, select_id);
}
