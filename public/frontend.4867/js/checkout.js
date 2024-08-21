import { BASE_URL } from "../../env.js";

var mainId = document.getElementById("main-id")?.value;
var businessCust = document.getElementById("businessCust")?.value;
if (mainId) {
    mainId = mainId.value;
} else {
    mainId = 0;
}

// Get billing address
function getDefaultBillingAddress() {
    const main_id = document.getElementById("main-id")?.value;
    const businessCust = document.getElementById("businessCust")?.value;

    if(localStorage.getItem('selected_delivery_address') === localStorage.getItem('selected_billing_address'))
    {
        document.getElementById("sameAsDeliveryAddress").checked = true;
    }
    
    if(businessCust){

        $.ajax({
            url: BASE_URL + "api/get_billing_address/" + main_id,
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                if (data != 404) {
                    const billing_address = document.getElementById("billing_address");
                    localStorage.setItem("selected_billing_address", data.id);
                    let address = "";
                    if (billing_address) {
    
                        if(businessCust){
                            address += `
                            <h1>${data.fname} </h1>
                            <p>${data.organization ? data.organization : data.billing_user[0]?.organization  }</p>
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
                        billing_address.innerHTML = address;
                    }
                } else {
                    // localStorage.removeItem("selected_delivery_address");
                }
            },
        });
    }
}
getDefaultBillingAddress();


//Same as delivery address
const sameAsDeliveryAddress = document.getElementById("sameAsDeliveryAddress");


if (sameAsDeliveryAddress) {
    sameAsDeliveryAddress.addEventListener("change", function () {


        var deliveryId = localStorage.getItem('selected_delivery_address');
        var billingId = localStorage.getItem('selected_billing_address');
        const main_id = document.getElementById("main-id")?.value;
        const isSave = sameAsDeliveryAddress.checked;
        // console.log(isSave);
        
        $.ajax({
            url: BASE_URL + "api/same_billing_address",
            type: "POST",
            data: {
                userId: main_id,
                deliveryId: deliveryId ? deliveryId : '',
                billingId: billingId ? billingId : '',
                isSave: isSave ? 1 : 0,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                if (data != 404) {
                    const billing_address = document.getElementById("billing_address");
                    if(isSave) {
                        
                        localStorage.setItem("selected_billing_address", data.id);
                        let address = "";
                        if (billing_address) {
        
                            address += `
                            <h1>${data.fname} </h1>
                            <p>${data.billing_user[0]?.organization ? data.billing_user[0]?.organization : '' }</p>
                            <p>${data.street_address}</p>
                            <p>${data.postal_code} ${data.city} </p>
                            <p>${data.phone}</p>
                            `;
                            billing_address.innerHTML = address;
                        }

                    }else{
                        localStorage.removeItem("selected_billing_address");
                        billing_address.innerHTML = '';
                    }

                } else {
                    // localStorage.removeItem("selected_delivery_address");
                }
            },
        });

    });
}

//Update Billing address
function updateCheckoutBillingAddress(id) {
    const main_id = document.getElementById("main-id").value;
    const businessCust = document.getElementById("businessCust")?.value;

    $.ajax({
        url: BASE_URL + "api/billing_address/" + main_id + "/" + id,
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            if (data != 404) {
                let address = "";
                const billing_address = document.getElementById("billing_address")
                if (billing_address) {
                        address += `
                        <h1>${data.fname} </h1>
                        <p>${data.organization }</p>
                        <p>${data.street_address}</p>
                        <p>${data.postal_code} ${data.city} </p>
                        <p>${data.phone}</p>
                        `;

                    billing_address.innerHTML = address;
                }
            }
        },
    });
}
//Select Billing Address
$(".billing-address-add-btn").on('click', function(){
    const billingId = $(this).attr('data-id');
    if(billingId){
        localStorage.setItem("selected_billing_address", billingId);
        updateCheckoutBillingAddress(billingId, 1);
        let closeModal = document.getElementById(
            "billing-address-close-modal2"
        );
        if (closeModal) {
            closeModal.click();
        }
    }
})