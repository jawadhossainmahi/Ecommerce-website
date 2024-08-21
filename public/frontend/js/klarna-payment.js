import { BASE_URL } from "../../env.js";

let PageModal = document.getElementById("all-preview-modals");
function searchProducts(data, id) {
    for (let i = 0; i < data.length; i++) {
        if (data[i]["id"] == id) {
            return data[i];
        }
    }
    return null;
}

function getCartData() {
    let cart = JSON.parse(localStorage.getItem("cart"));
    $.ajax({
        url: BASE_URL + "api/cart/update",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            cart: JSON.stringify(cart),
            _token:  $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            // console.log(data)
        },
    });
}
getCartData();

function saveCartToSession() {
    let cartproducts = JSON.parse(localStorage.getItem("cart"));

    let cart = JSON.stringify(cartproducts);

    const delivery_address = localStorage.getItem("selected_delivery_address");
    if (!delivery_address) {
        document.getElementsByClassName("bi-pencil-fill")[0].click();
        return;
    }

    // console.log(cartproducts)
    if (!cartproducts.length) {
        window.location.replace("/");
    }
    // console.log(cart)
    // return cart;
    let addToCartRequest = $.ajax({
        url: BASE_URL + "api/cart/insert",
        type: "POST",
        data: {
            cart: cart,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            window.location.replace("/klarna-payment");

            if (localStorage.getItem("cart")) {
                //   localStorage.setItem("cart", "[]");
            }
        },
    });
}

function forBusinessValidation()
{
    const delivery_address = localStorage.getItem("selected_delivery_address");
    const billing_address = localStorage.getItem("selected_billing_address");
    if(!delivery_address){
        $('#selected-address').css('border', '1px solid #FF0000');
        return false;
    }
    if(!billing_address){
        $('#billing_address').css('border', '1px solid #FF0000');
        return false;
    }

    var name_of_recipient = $("input[name=name_of_recipient]");
    if(name_of_recipient.val().length < 1){
        name_of_recipient.css('border', '1px solid #FF0000');
        return false;
    }
    return true;
}

function saveCartToSessionForBusiness() {
    if(!forBusinessValidation()){
        $('html, body').animate({
            scrollTop: $(".delivery-options").offset().top
        }, 500);
        return false;
    }
    let cartproducts = JSON.parse(localStorage.getItem("cart"));

    let cart = JSON.stringify(cartproducts);

    const delivery_address = localStorage.getItem("selected_delivery_address");
    const billing_address = localStorage.getItem("selected_billing_address");
    const delivery_datetime = localStorage.getItem("delivery_datetime");
    const name_of_recipient = document.getElementsByName('name_of_recipient')?.value;

    if (!cartproducts.length) {
        window.location.replace("/");
    }

    let addToCartRequest = $.ajax({
        url: BASE_URL + "api/businessOrderConfirmation",
        type: "POST",
        data: {
            cart: cart,
            delivery_address: delivery_address,
            billing_address: billing_address,
            name_of_recipient: name_of_recipient,
            delivery_datetime: delivery_datetime
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {

            localStorage.setItem("cart", "[]")
            localStorage.removeItem('delivery_datetime')

            // window.location.replace("/");

            $(document).ready(function(){
                $('#purchaseModal').modal('show');
            })
        },
    });
}

let klarnaPayment = document.getElementsByClassName("klarna-payment");

if (klarnaPayment) {
    for (let i = 0; i < klarnaPayment.length; i++) {
        const element = klarnaPayment[i];
        element.addEventListener("click", saveCartToSession);
    }
}

// Business Customer Order
let businessCustomerOrder = document.getElementById("businessCustomerOrderConfirmation");

if (businessCustomerOrder) {
    businessCustomerOrder.addEventListener("click", saveCartToSessionForBusiness);
}

function getDefaultCheckoutDeliveryAddress() {
    const main_id = document.getElementById("main-id").value;
    const businessCust = document.getElementById("businessCust").value;

    $.ajax({
        url: BASE_URL + "api/get_delivery_address/" + main_id,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            if (data != 404) {
                const selected_address =
                    document.getElementById("selected-address");
                localStorage.setItem("selected_delivery_address", data.id);
                let address = "";
                // console.log(data);
                if (selected_address) {

                    if(businessCust){
                        address += `
                        <h1>${data.fname} </h1>
                        <p>${data.user[0].organization ? data.user[0].organization : '' }</p>
                        <p>${data.street_address}</p>
                        <p>${data.postal_code} ${data.city} </p>
                        <p>${data.phone}</p>
                        `;
                    }else{
                        address += `
                        <h1>${data.fname} ${data.lname}</h1>
                        <p>${data.street_address}</p>
                        <p>${data.postal_code} ${data.city} </p>
                        <p>${data.phone}</p>
                        `;
                    }
                    selected_address.innerHTML = address;
                }
            } else {
                // localStorage.removeItem("selected_delivery_address");
            }
        },
    });
}
getDefaultCheckoutDeliveryAddress();

function updateCheckoutDeliveryAddress(id) {
    const main_id = document.getElementById("main-id").value;
    const businessCust = document.getElementById("businessCust").value;

    $.ajax({
        url: BASE_URL + "api/delivery_address/" + main_id + "/" + id,
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            if (data != 404) {
                const selected_address = document.getElementById("selected-address");
                let address = "";
                if (selected_address) {

                    if(businessCust){
                        address += `
                        <h1>${data.fname} </h1>
                        <p>${data.user[0].organization ? data.user[0].organization : '' }</p>
                        <p>${data.street_address}</p>
                        <p>${data.postal_code} ${data.city} </p>
                        <p>${data.phone}</p>
                        `;
                    }else{
                        address += `
                        <h1>${data.fname} ${data.lname}</h1>
                        <p>${data.street_address}</p>
                        <p>${data.postal_code} ${data.city} </p>
                        <p>${data.phone}</p>
                        `;
                    }
                    selected_address.innerHTML = address;
                }
            } else {
                // localStorage.removeItem("selected_delivery_address");
            }
        },
    });
}

function getCheckoutDeliveryAddress(id) {
    const main_id = document.getElementById("main-id").value;
    const businessCust = document.getElementById("businessCust").value;
    $.ajax({
        url: BASE_URL + "api/get_delivery_address/" + main_id + "/" + id,
        type: "GET",

        success: function (data) {
            const selected_address =
                document.getElementById("selected-address");
            let address = "";
            if (selected_address) {

                if(businessCust){
                    address += `
                    <h1>${data.fname} </h1>
                    <p>${data.user[0].organization ? data.user[0].organization : '' }</p>
                    <p>${data.street_address}</p>
                    <p>${data.postal_code} ${data.city} </p>
                    <p>${data.phone}</p>
                    `;
                }else{
                    address += `
                    <h1>${data.fname} ${data.lname}</h1>
                    <p>${data.street_address}</p>
                    <p>${data.postal_code} ${data.city} </p>
                    <p>${data.phone}</p>
                    `;
                }

                selected_address.innerHTML = address;
            }
        },
    });
}

const delivery_address = localStorage.getItem("selected_delivery_address");
if (delivery_address) {
    updateCheckoutDeliveryAddress(delivery_address);
}

function selectDeliveryAddress(id) {
    localStorage.setItem("selected_delivery_address", id);
    updateCheckoutDeliveryAddress(id);
}

let checkoutBody = document.getElementById("body");

if (checkoutBody) {
    checkoutBody.addEventListener("click", function (e) {
        if (
            e.target &&
            e.target.className.trim() == "delivery-address-add-btn"
        ) {
            // console.log(e.target.id)

            selectDeliveryAddress(e.target.id);
            let closeModal = document.getElementById(
                "delivery-address-close-modal"
            );
            if (closeModal) {
                closeModal.click();
            }
        }
    });
}

// window.klarnaAsyncCallback = function () {

//   // This is where you start calling Klarna's JS SDK functions
//   //
//   // Klarna.Payments.init({....})

//   Klarna.Payments.init({
//     client_token: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJmb28iOiJiYXIifQ.dtxWM6MIcgoeMgH87tGvsNDY6cH'
//     })

// };
