import { BASE_URL } from "../../env.js";

const match_string = /[^0-9.,]+/gi;
const match_colon = /[:,]/gi;
const match_dot = /[.]/gi;

var main_category_id = null;
var main_sub_category_id = null;
var main_sub_sub_category_id = null;

var home_sortby = 'popularity';

document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})

async function showModalAndWait(cartItems = null) {
    var deferred = $.Deferred();

    // Show the modal
    $('#change_alert').modal('show');

    // Handle closing the modal
    await $('#change_alert').find("#save-btnss").on('click', async function () {
        await deferred.resolve();
        // cart_change_alert2 = false;
        cart_change_alert = false;
    });
    if (cartItems) {
        localStorage.setItem("cart", JSON.stringify(cartItems));
    }

    return deferred.promise();
}
function price_format(price) {
    if (price == null) {
        return null;
    }
    return price.toString().replace(match_string, "").replace(match_colon, ".");
}
// Remove html tags
function strip_tags(data = "") {
    // return data;
    return data.replace(/(<([^>]+)>)/gi, "");
}

function price_display_format(price) {
    return (
        "SEK " + parseFloat(price).toFixed(2).toString().replace(match_dot, ",")
    );
}

function discount_price_format(sale_price, original_price, qty) {
    return parseFloat(
        (price_format(sale_price) / 2) * (qty - (qty % 2)) +
        price_format(original_price).toString() * (qty % 2)
    ).toFixed(2);
}

function normal_price_format(price, qty) {
    return parseFloat(price_format(price.toString()) * qty).toFixed(2);
}

let mainId = document.getElementById("main-id"); // auth id
var businessCust = document.getElementById("businessCust")?.value;
var transportFee = parseInt(businessCust) === 1 ? 0 : 95;

if (mainId) {
    mainId = mainId.value;
} else {
    mainId = 0;
}

function cardCounter() {
    const body = document.getElementById("body");
    const cardCounter = body.getElementsByClassName("card-counter");
    for (let i = 0; i < cardCounter.length; i++) {
        const element = cardCounter[i];

        const minusParent = element.querySelectorAll("a")[0];
        const plusParent = element.querySelectorAll("a")[1];
        const minus = element.getElementsByClassName("minus")[0];
        const plus = element.getElementsByClassName("plus")[0];
        const st = element.getElementsByClassName("st")[0];
        const firstbtn = element.getElementsByClassName("first-btn")[0];

        element.style.backgroundColor = "white";
    }
}

const dropdownbox = document.getElementById("SearchInput");

if (dropdownbox) {
    dropdownbox.oninput = darkbg;
    // dropdownbox.onchange = lightbg;
}
function darkbg() {
    const box = document.getElementById("box");
    const body = document.getElementById("body");
    if (box) {
        box.style.display = "block";

        $("#body").addClass("overflow-hidden");
    }
}
function lightbg() {
    const box = document.getElementById("box");
    const body = document.getElementById("body");
    if (box) {
        box.style.display = "none";

        // body.style.overflowY ="scroll"
        $("#body").removeClass("overflow-hidden");
    }
}

const acceptCookie = document.getElementById("Accept-cookie-btn");
const rejectCookie = document.getElementById("Reject-cookie-btn");
if (acceptCookie) {
    acceptCookie.addEventListener("click", function () {
        localStorage.setItem("accept-cookie", true);
    });
}
if (rejectCookie) {
    rejectCookie.addEventListener("click", function () {
        localStorage.setItem("reject-cookie", true);
    });
}

const staticBackdropBtn = document.getElementById("staticBackdropBtn");

if (staticBackdropBtn) {
    // staticBackdropBtn
    if (
        localStorage.getItem("accept-cookie") ||
        localStorage.getItem("reject-cookie")
    ) {
    } else {
        document.getElementById("staticBackdropBtn").click();
    }
}

// const editablecontent = document.getAttribute()

// ---------------cart-card-Counter----------------

const cartcardCounter = document.getElementsByClassName("cart-card-counter");
for (let i = 0; i < cartcardCounter.length; i++) {
    const element = cartcardCounter[i];
    const minus = element.getElementsByClassName("minus")[0];
    const plus = element.getElementsByClassName("plus")[0];
    const st = element.getElementsByClassName("st")[0];
    minus.style.display = "block";
    st.style.display = "block";
    plus.style.display = "block";
    // element.style.backgroundColor = 'white'

    if (plus) {
        plus.addEventListener("click", () => {
            st.value = parseInt(st.value) + 0;
            if (minus.style.display == "none") {
                minus.style.display = "block";
                element.style.backgroundColor = "rgb(232, 232, 232)";
                plus.style.display = "block";
            }
            if (st.style.display == "none") {
                st.style.display = "block";
            }
        });
    }

    if (minus) {
        minus.addEventListener("click", () => {
            if (st.value < 2) {
                st.value = 0;
                minus.style.display = "block";
                st.style.display = "block";
                // element.style.backgroundColor = 'white'
                plus.style.display = "block";
            } else {
                st.value = st.value - 1;
            }
        });
    }
    if (plus) {
        plus.addEventListener("click", () => {
            st.value = parseInt(st.value) + 1;
            if (minus.style.display == "none") {
                minus.style.display = "block";
                // element.style.backgroundColor = 'rgb(232, 232, 232)'
            }
            if (st.style.display == "none") {
                st.style.display = "block";
            }
        });
    }
}

// ------------preview-----------

let previewContainer = document.querySelector(".products-preview");
if (previewContainer) {
    let previewBox = previewContainer.querySelectorAll(".preview");
    const body = document.getElementById("body");

    document.querySelectorAll(".home-cards .card-image").forEach((product) => {
        product.onclick = () => {
            previewContainer.style.display = "flex";
            let name = product.getAttribute("data-name");
            previewBox.forEach((preview) => {
                let target = preview.getAttribute("data-target");
                if (name == target) {
                    preview.classList.add("active");
                    body.style.overflow = "hidden";
                }
            });
        };
    });
    previewBox.forEach((close) => {
        close.querySelector(".bi-x").onclick = () => {
            close.classList.remove("active");
            previewContainer.style.display = "none";
            // body.style.overflow = ('scroll');
        };
    });
}

// ---------------filter--------------

var open = document.getElementById("open");

// function showMenu(){
//     open.style.left = "0";
// }
function showMenu() {
    open.style.left = "-700px";
}

// ---------------navbar--------------

const chc = document.querySelector("#shopping-cart-checkbox");
var element = document.getElementById("SideNav");
function FuncClick() {
    if (chc.checked) {
        element.classList.remove("-left-[17rem]");
        element.classList.add("left-0");
    } else {
        element.classList.remove("left-0");
        element.classList.add("-left-[17rem]");
    }
}
const chka = document.querySelector("#Shopping-cartbtn");
var element2 = document.getElementById("Shopping-cart-menu");
function FuncClick2() {
    if (element2) {
        if (chka.checked) {
            element2.classList.add("shop-visible");
            element2.classList.remove("hide-visible");
        } else {
            element2.classList.add("hide-visible");
            element2.classList.remove("shop-visible");
        }
    }
}

var count = 1;
function Decrement(element) {
    var x = element.nextElementSibling;
    count = x.innerHTML;
    if (count > 1) {
        count--;
        x.innerHTML = count;
        let cart_count_input =
            element.parentElement.querySelector("#cart_count_input");
        cart_count_input.setAttribute("value", count);

        cartfun();
    }
}
function Increment(element) {
    var x = element.previousElementSibling;
    count = x.innerHTML;
    if (count < 10) {
        count++;
        x.innerHTML = count;
        let cart_count_input =
            element.parentElement.querySelector("#cart_count_input");
        cart_count_input.setAttribute("value", count);
        cartfun();
    }
}

// ---------------add to cart--------------

const cart = document.getElementsByClassName("cart")[0];
const continueShopping = document.getElementById("continue-shopping");

if (continueShopping) {
    continueShopping.addEventListener("click", () => {
        cart.style.right = "-900px";
        body.style.overflow = "scroll";
    });
}

const cartOpen = document.getElementsByClassName("cart-open")[0];

if (cartOpen) {
    cartOpen.addEventListener("click", () => {
        cart.style.right = "0px";
        body.style.overflow = "hidden";
    });
}

// ---------down-nav-add to cart----------------
const cartOpen1 = document.getElementsByClassName("cart-open-1")[0];
const cartOpen2 = document.getElementById("cart-open-1");

if (cartOpen1) {
    cartOpen1.addEventListener("click", () => {
        if (cart) {
            cart.style.right = "0px";
        }
    });
}

if (cartOpen2) {
    continueShopping.addEventListener("click", () => {
        if (cart) {
            cart.style.right = "-900px";
        }
    });
}

// ------------------------filter-----------------------

const filterbox = document.getElementsByClassName("filter-box")[0];
const cancel = document.getElementById("cancel");

if (cancel) {
    cancel.addEventListener("click", () => {
        filterbox.style.left = "-900px";
    });
}

const filterOpen = document.getElementsByClassName("filter")[0];

if (filterOpen) {
    filterOpen.addEventListener("click", () => {
        filterbox.style.left = "0px";
    });
}

const slideform = document.getElementsByClassName("slide-form")[0];
const formcancel = document.getElementById("form-cancel");

if (formcancel) {
    formcancel.addEventListener("click", () => {
        slideform.style.right = "-900px";
    });
}

const formopen = document.getElementsByClassName("form-open")[0];

if (formopen) {
    formopen.addEventListener("click", () => {
        if (slideform) {
            slideform.style.right = "0px";
        }
    });
}

const chatbox = document.getElementById("ChatBox");
const backdrop = document.getElementById("box");
const body = document.getElementById("body");
function openChat() {
    chatbox.classList.remove("hidden");
    if (backdrop) {
        backdrop.style.display = "block";
        body.style.overflow = "hidden";
        const chattinput_fname = document.getElementById("chattinput_fname");
        if (chattinput_fname) {
            chattinput_fname.focus();
        }
    }
}

function closeChat() {
    chatbox.classList.add("hidden");
    backdrop.style.display = "none";
    body.style.overflowY = "scroll";
}

const chatBtn = document.getElementById("ChatBtn");
if (chatBtn) {
    chatBtn.addEventListener("click", openChat);
}

const closeChatBtn = document.getElementById("CloseChatBtn");
if (closeChatBtn) {
    closeChatBtn.addEventListener("click", closeChat);
}

function GetProducts() {
    let products = document.getElementById("products");

    if (products) {
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        let trademark_id = "trademark_id=" + params.trademark_id;
        let origin_id = "&origin_id=" + params.origin_id;
        let marking_id = "&marking_id=" + params.marking_id;
        $.ajax({
            url:
                BASE_URL +
                "api/products?" +
                trademark_id +
                origin_id +
                marking_id,
            type: "GET",
            data: {},
            success: function (data) {
                // data = JSON.parse(data);
                for (var i = 0; i < data.length && i < 12; i++) {
                    let div = document.createElement("div");
                    div.className =
                        "cards col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-6";
                    div.style = "display:block";
                    let div1 = document.createElement("div");
                    div1.className = "card h-100";
                    div1.id = data[i].id;
                    let div5 = document.createElement("div");
                    div5.className = "card-image";
                    div5.setAttribute("data-name", "p-1");
                    let img = document.createElement("img");
                    img.className = "card-img-top";
                    img.setAttribute("src", data[i].image);
                    let div6 = document.createElement("div");
                    div6.className = "card-body";
                    let h5 = document.createElement("h5");
                    h5.className = "card-title text-center";
                    let h4 = document.createElement("h4");
                    h4.className = "tag mx-auto mb-2";
                    h4.innerHTML = data[i].price;
                    h5.innerHTML = data[i].name;
                    let div8 = document.createElement("div");
                    div8.className = "card-counter d-flex";
                    div8.style = "background-color: white;";
                    let a1 = document.createElement("a");
                    a1.classList.add("custom-d-none");
                    a1.addEventListener("click", function () {
                        RemoveQuantity(this);
                    });
                    let i2 = document.createElement("i");
                    i2.className = "bi bi-dash-circle-fill minus";
                    let input = document.createElement("input");
                    input.type = "number";
                    input.className = "st text-center custom-d-none";
                    input.value = 0;
                    let a2 = document.createElement("a");
                    a2.addEventListener("click", function () {
                        AddQuantity(this);
                    });
                    let i3 = document.createElement("i");
                    i3.className = "bi bi-plus-circle-fill plus d-none";
                    let btn = document.createElement("button");
                    btn.className = "first-btn";
                    btn.addEventListener("click", function () {
                        this.classList.add("d-none");
                        btn = this.previousElementSibling;
                        btn.children[0].classList.remove("d-none");
                        AddQuantity(btn);
                    });
                    let p = document.createElement("p");
                    p.innerHTML = "Add";
                    btn.appendChild(p);
                    a2.appendChild(i3);
                    a1.appendChild(i2);
                    div8.appendChild(a1);
                    div8.appendChild(input);
                    div8.appendChild(a2);
                    div8.appendChild(btn);
                    div6.appendChild(h5);
                    div6.appendChild(h4);
                    div6.appendChild(div8);
                    div5.appendChild(img);
                    div1.appendChild(div5);
                    div1.appendChild(div6);
                    div.appendChild(div1);
                    products.appendChild(div);
                }
            },
        });
    }
}

// -----------------cart-------------------- //

const debounce = (func, delay = 400) => {
    let debounceTimer;
    return function () {
        const context = this;
        const args = arguments;
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => func.apply(context, args), delay);
    };
};

const getQuantityRequest = null;
function GetQuantity(qty, id) {
    $.ajax({
        url: BASE_URL + "api/cart/" + id,
        type: "GET",
        beforeSend: function () {
            if (getQuantityRequest != null) {
                getQuantityRequest.abort();
            }
        },
        success: function (data) {
            // qty.value = data[0];
            // AddtoCart(id, qty);
        },
    });

    // $.ajax({
    //     url: BASE_URL+"api/cart/"+id,
    //     type: "GET",
    //     // data: {
    //     // },
    //     success: function (data) {
    //         // data = JSON.parse(data);
    //         qty.value = data[0];
    //         AddtoCart(id, qty.value);
    //     }
    // });
}

function Checkout() {
    $.ajax({
        url: "functions.php",
        type: "POST",
        data: {
            function: "Checkout",
        },
        success: function (data) {
            // data = JSON.parse(data);
            if (data.status == "success") {
                Swal.fire({
                    icon: "success",
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500,
                }).then(function () {
                    location.reload();
                });
            }
        },
    });
}

function searchProducts(data, id) {
    for (let i = 0; i < data.length; i++) {
        if (data[i]["id"] == id) {
            return data[i];
        }
    }
    return null;
}

const removeProductById = (data, itemId, cart_index) => {
    const index = data.products.findIndex(product => product.item_id === itemId);
    if (index !== -1) {
        data.products.splice(index, 1);

        // Check if products array is empty and remove the category if so
        if (data.products.length === 0) {
            console.log("inside removeProductID", data)
            data.splice(cart_index, 1);
            // delete data.category;
            // delete data.products
        }
        return true;
    }
    return false;
};

// Function to check and remove specific value from localStorage
function checkAndRemoveCart() {
    // Retrieve the value from local storage
    const cartValue = localStorage.getItem('cart');

    // Check if the value is not null or undefined
    if (cartValue) {
        try {
            // Parse the value to an array
            const cartArray = JSON.parse(cartValue);

            // Check if the array matches the structure [{ }]
            if (Array.isArray(cartArray) && cartArray.length === 1 && typeof cartArray[0] === 'object' && !Array.isArray(cartArray[0]) && Object.keys(cartArray[0]).length === 0) {
                // Remove the item from local storage
                localStorage.removeItem('cart');
                console.log('Cart item removed from local storage.');
            } else {
                console.log('Cart item does not match the structure.');
            }
        } catch (error) {
            console.error('Error parsing cart value:', error);
        }
    } else {
        console.log('Cart item not found in local storage.');
    }
}

// REMOVING A PRODUCT FROM THE CART
function removeItemFromCart2(productId, category) {

    let cart = JSON.parse(localStorage.getItem("cart"));
    // category = category.replace("& ", "&amp; ")
    let findExistingCategory = cart.find(
        (categories) => categories.category == category
    );
    let findRemaning = {};
    if (findExistingCategory && findExistingCategory.products) {
        findRemaning = findExistingCategory.products.filter(
            (product) => product.item_id != productId
        );
    }

    let updatedCart = cart.filter(
        (categories) => categories.category != category
    );
    let updateCart = [];

    if (findRemaning.length > 0) {
        findExistingCategory["products"] = findRemaning;
        updateCart = updatedCart.concat(findExistingCategory);
    } else {
        updateCart = updatedCart;
    }

    localStorage.setItem("cart", JSON.stringify(updateCart));
    // 	GetCartProductFromCache()
}



let try_once = true;
let cart_change_alert = false;
function GetCartProductFromCache() {
    // localStorage.removeItem('cart');return false;
    let cartItems = JSON.parse(localStorage.getItem("cart"));
    let cart = document.getElementById("cart-product");

    $("#shopping").hide();
    document.getElementById("total").innerHTML = "";
    cart.innerHTML = "";
    let totalquantity = 0;
    let total = 0;
    let memory = [];
    let totaldiscount = 0;
    let total_discounted_price = 0;
    let totalPant = 0;
    let tax_12 = 0;
    let tax_25 = 0
    let total_tax = 0;
    if (cartItems.length > 0) {

        for (let i = 0; i < cartItems.length; i++) {
            let category = document.createElement("h2");
            if (!memory.includes(cartItems[i].category)) {
                category.classList.add("text-xl");
                category.innerHTML = cartItems[i].category;
                memory.push(cartItems[i].category);
                cart.appendChild(category);
            }
            for (let j = 0; j < cartItems[i].products.length; j++) {

                let div0 = document.createElement("div");
                div0.setAttribute("data-tax", cartItems[i].products[j].tax)
                div0.id = cartItems[i].products[j].item_id;
                let div = document.createElement("div");
                div.className = "selected-product";
                let span = document.createElement("span");
                let img = document.createElement("img");
                img.classList.add("product-image");
                if (cartItems[i].products[j].image) {
                    if (cartItems[i].products[j].image.includes(BASE_URL)) {
                        img.src = cartItems[i].products[j].image;
                    } else {
                        img.src = BASE_URL + cartItems[i].products[j].image;
                    }

                    img.style = "width: 50px;";
                }
                $("#shopping").show();

                let div1 = document.createElement("div");
                div1.className = "s-product-detail";
                let categoryp = document.createElement("p");
                let p = document.createElement("p");
                p.classList.add("cursor-pointer");
                p.setAttribute("data-bs-toggle", "modal");
                p.setAttribute(
                    "data-bs-target",
                    "#data-" + cartItems[i].products[j].item_id
                );

                p.innerHTML = cartItems[i].products[j].item_name;
                p.classList.add("product-name");
                categoryp.innerHTML = cartItems[i].category;
                categoryp.classList.add("hidden", "product-category");
                let h5 = document.createElement("h5");
                let h6 = document.createElement("h6");
                let h4 = document.createElement("h4");

                //let buy_two_for = data[1][data[0][i]][j]["buy_two_for"]
                let buy_two_for = cartItems[i].products[j].buy_two;
                if (
                    cartItems[i].products[j].item_sale_price &&
                    cartItems[i].products[j].item_sale_price !== "undefined" && cartItems[i].products[j].item_sale_price != ""
                ) {
                    if (Number(cartItems[i].products[j].tax) == 12) {
                        let _tax_percent = Number((cartItems[i].products[j].tax) / 100);
                        let _product_price = Number(normal_price_format(cartItems[i].products[j].item_price, cartItems[i].products[j].quantity));
                        tax_12 += _product_price - (_product_price / 1 + _tax_percent);
                    }
                    else if (Number(cartItems[i].products[j].tax) == 25) {
                        let _tax_percent = Number((cartItems[i].products[j].tax) / 100);
                        let _product_price = Number(normal_price_format(cartItems[i].products[j].item_price, cartItems[i].products[j].quantity));
                        tax_25 += _product_price - (_product_price / 1 + _tax_percent);
                    }
                    if (buy_two_for && buy_two_for !== undefined) {

                        if (cartItems[i].products[j].quantity > 1) {
                            let discount = document.createElement("span");

                            let discount_price = discount_price_format(
                                cartItems[i].products[j].item_sale_price,
                                cartItems[i].products[j].item_price,
                                cartItems[i].products[j].quantity
                            );
                            let original_price = normal_price_format(
                                cartItems[i].products[j].item_price,
                                cartItems[i].products[j].quantity
                            );
                            discount.classList.add(
                                "!no-underline",
                                "discounted-price",
                                "product-discount-price"
                            );
                            discount.innerHTML =
                                price_display_format(discount_price);
                            let original = document.createElement("span");
                            original.classList.add(
                                "line-through",
                                "!text-slate-900",
                                "original-price",
                                "product-real-price"
                            );
                            original.innerHTML =
                                price_display_format(original_price);
                            h5.appendChild(discount);
                            h5.appendChild(original);

                            let single_item_price =
                                document.createElement("span");
                            let default_single_item_price =
                                cartItems[i].products[j].item_price;
                            single_item_price.style = "display:none";
                            single_item_price.innerHTML = price_display_format(
                                default_single_item_price
                            );

                            let single_item_sale_price =
                                document.createElement("span");
                            let default_single_item_sale_price =
                                cartItems[i].products[j].item_sale_price;
                            single_item_sale_price.style = "display:none";
                            single_item_sale_price.innerHTML =
                                price_display_format(
                                    default_single_item_sale_price
                                );

                            h6.appendChild(single_item_price);
                            h6.appendChild(single_item_sale_price);
                        } else {
                            let original = document.createElement("span");
                            let original_price = normal_price_format(
                                cartItems[i].products[j].item_price,
                                cartItems[i].products[j].quantity
                            );
                            original.classList.add(
                                "!text-slate-900",
                                "!no-underline",
                                "original-price",
                                "product-real-price"
                            );
                            original.innerHTML =
                                price_display_format(original_price);
                            h5.appendChild(original);

                            let single_item_price =
                                document.createElement("span");
                            let default_single_item_price =
                                cartItems[i].products[j].item_price;
                            single_item_price.style = "display:none";
                            single_item_price.innerHTML = price_display_format(
                                default_single_item_price
                            );

                            let single_item_sale_price =
                                document.createElement("span");
                            let default_single_item_sale_price =
                                cartItems[i].products[j].item_sale_price;
                            single_item_sale_price.style = "display:none";
                            single_item_sale_price.innerHTML =
                                price_display_format(
                                    default_single_item_sale_price
                                );

                            h6.appendChild(single_item_price);
                            h6.appendChild(single_item_sale_price);
                        }
                    } else {
                        let discount = document.createElement("span");
                        let discount_price =
                            cartItems[i].products[j].item_sale_price *
                            cartItems[i].products[j].quantity;
                        let original_price = normal_price_format(
                            cartItems[i].products[j].item_price,
                            cartItems[i].products[j].quantity
                        );
                        discount.classList.add(
                            "!no-underline",
                            "discounted-price",
                            "product-discount-price"
                        );
                        discount.innerHTML =
                            price_display_format(discount_price);
                        let original = document.createElement("span");
                        original.classList.add(
                            "line-through",
                            "!text-slate-900",
                            "original-price",
                            "product-real-price"
                        );
                        original.innerHTML =
                            price_display_format(original_price);
                        h5.appendChild(discount);
                        h5.appendChild(original);

                        let single_item_price = document.createElement("span");
                        let default_single_item_price =
                            cartItems[i].products[j].item_price;
                        single_item_price.style = "display:none";
                        single_item_price.innerHTML = price_display_format(
                            default_single_item_price
                        );

                        let single_item_sale_price =
                            document.createElement("span");
                        let default_single_item_sale_price =
                            cartItems[i].products[j].item_sale_price;
                        single_item_sale_price.style = "display:none";
                        single_item_sale_price.innerHTML = price_display_format(
                            default_single_item_sale_price
                        );

                        h6.appendChild(single_item_price);
                        h6.appendChild(single_item_sale_price);
                    }
                } else {
                    if (Number(cartItems[i].products[j].tax) == 12) {
                        tax_12 += ((Number(cartItems[i].products[j].tax) / 100) * Number(normal_price_format(
                            cartItems[i].products[j].item_price,
                            cartItems[i].products[j].quantity
                        )));

                    }
                    else if (Number(cartItems[i].products[j].tax) == 25) {
                        tax_25 += (Number((cartItems[i].products[j].tax) / 100) * Number(normal_price_format(
                            cartItems[i].products[j].item_price,
                            cartItems[i].products[j].quantity
                        )));

                    }
                    let original = document.createElement("span");
                    let original_price = normal_price_format(
                        cartItems[i].products[j].item_price,
                        cartItems[i].products[j].quantity
                    );
                    original.classList.add(
                        "!text-slate-900",
                        "!no-underline",
                        "original-price",
                        "product-real-price"
                    );
                    original.innerHTML = price_display_format(original_price);
                    h5.appendChild(original);

                    let single_item_price = document.createElement("span");
                    let default_single_item_price =
                        cartItems[i].products[j].item_price;
                    single_item_price.style = "display:none";
                    single_item_price.innerHTML = price_display_format(
                        default_single_item_price
                    );

                    let single_item_sale_price = document.createElement("span");
                    let default_single_item_sale_price =
                        cartItems[i].products[j].item_sale_price;
                    single_item_sale_price.style = "display:none";
                    single_item_sale_price.innerHTML = price_display_format(
                        default_single_item_sale_price
                    );

                    h6.appendChild(single_item_price);
                    h6.appendChild(single_item_sale_price);
                }
                let itemPant = 0;
                if (cartItems[i].products[j].pant) {
                    let pantspan = document.createElement("span");
                    itemPant =
                        cartItems[i].products[j].pant *
                        cartItems[i].products[j].quantity;
                    totalPant += itemPant;
                    pantspan.innerHTML = "+" + itemPant + " kr pant";
                    pantspan.classList.add("!text-slate-900", "!no-underline");
                    pantspan.style.fontWeight = 500;
                    // pant += `<span class="pant">+${} kr pant</span>`
                    h5.appendChild(pantspan);
                }
                h4.style = "display:none";
                h4.innerHTML = cartItems[i].category;
                let div3 = document.createElement("div");
                let div2 = document.createElement("div");
                div2.className = "cart-card-counter d-flex";
                let a1 = document.createElement("a");
                let i1 = document.createElement("i");
                let a2 = document.createElement("a");
                let i2 = document.createElement("i");
                let input1 = document.createElement("input");
                input1.type = "number";
                a1.className = "card-minus-div";
                a2.className = "card-plus-div";
                input1.className = "st card-quantity-div";
                input1.value = cartItems[i].products[j].quantity;
                input1.readOnly = true;
                i1.className = "bi bi-plus-circle-fill plus";
                i2.className = "bi bi-dash-circle-fill minus";
                // a1.onclick = function () {
                //     AddQuantity(this)
                // };
                // a2.onclick = function () {
                //     RemoveQuantity(this)
                // };
                a1.appendChild(i1);
                a2.appendChild(i2);
                div2.appendChild(a2);
                div2.appendChild(input1);
                div2.appendChild(a1);

                div1.appendChild(p);
                div1.appendChild(categoryp);
                div1.appendChild(h5);
                div1.appendChild(h6);
                div1.appendChild(h4);
                span.appendChild(img);
                span.appendChild(div1);
                div.appendChild(span);

                div.appendChild(div2);

                div0.appendChild(div);
                div3.appendChild(div0);
                //cart.appendChild(category);
                cart.appendChild(div3);
                let price = cartItems[i].products[j].item_price.toString();
                let discount_price = "0";

                if (cartItems[i].products[j].item_sale_price) {
                    if (buy_two_for) {
                        if (cartItems[i].products[j].quantity > 1) {
                            discount_price = price_format(
                                cartItems[i].products[j].item_sale_price
                            ).toString();
                        }
                    } else {
                        discount_price =
                            cartItems[i].products[j].item_sale_price.toString();
                    }
                }

                price = price.split(" ");
                price = price_format(price[0]);
                discount_price = discount_price.split(" ");
                discount_price = price_format(discount_price[0]);
                let quantity = parseInt(cartItems[i].products[j].quantity);

                updateAllElements(cartItems[i].products[j].item_id, quantity);


                if (discount_price > 0) {
                    if (buy_two_for) {
                        if (cartItems[i].products[j].quantity > 1) {
                            // totaldiscount += ((parseFloat(price)-parseFloat(discount_price)) * quantity);
                            total_discounted_price +=
                                parseFloat(
                                    discount_price_format(
                                        discount_price,
                                        price,
                                        quantity
                                    )
                                ) + itemPant;
                        } else {
                            // totaldiscount += 0
                            total_discounted_price +=
                                discount_price * quantity + itemPant;
                        }
                    } else {
                        // totaldiscount += ((parseFloat(price)-parseFloat(discount_price)) * quantity);
                        total_discounted_price +=
                            discount_price * quantity + itemPant;
                    }
                } else {
                    total_discounted_price += parseFloat(price) * quantity + itemPant;
                }

                //
                total += parseFloat(price) * quantity + itemPant;
                totalquantity = totalquantity + quantity;

                totaldiscount = total - total_discounted_price;

                // let preview = previewModel(cartItems[i].products[j], 'cart')
                // let cartPreview = document.getElementById('cart-preview-cards')
                // if(cartPreview){
                //     cartPreview.innerHTML += preview
                // }
            }
        }

        let cartItemBtn = document.getElementById("cart-item-amount");
        TotalCartCount(totalquantity);
        document.getElementById("transport-fee").innerHTML =
            price_display_format(transportFee);
        // total1 = total.toFixed(1).toString().replace(".", ":");

        let valid_coupon = localStorage.getItem("valid_coupon");

        let coupon_discount = 0;
        let coupon_discount_div = document.getElementById("coupon-discount");
        if (valid_coupon) {

            valid_coupon = JSON.parse(valid_coupon);
            if (valid_coupon.type === "Percentage") {
                coupon_discount =
                    (valid_coupon.amount * total_discounted_price) / 100;
                if (
                    valid_coupon.max_discount != null &&
                    coupon_discount > valid_coupon.max_discount
                ) {
                    coupon_discount = valid_coupon.max_discount;
                }
            } else if (valid_coupon.type === "Flat") {
                if (total_discounted_price - valid_coupon.amount > 0) {
                    coupon_discount = valid_coupon.amount;
                }
            } else if (valid_coupon.type === "FreeShipping") {
                if (
                    total_discounted_price > 0 &&
                    total_discounted_price < 650
                ) {
                    coupon_discount = 95;
                }
            }
            coupon_discount_div.innerHTML = price_display_format(
                parseFloat(coupon_discount).toFixed(2)
            );
            coupon_discount_div.parentNode.classList.remove("hidden");
        } else {
            coupon_discount_div.parentNode.classList.add("hidden");
        }
        total_tax = tax_12 + tax_25;
        let subtotal = total_discounted_price;

        document.getElementById("grand_total").innerHTML = price_display_format(subtotal);
        let p_message = 650 - total_discounted_price;
        if (p_message > 0) {
            p_message = p_message.toFixed(2).toString().replace(".", ",");
            if (document.getElementById("p_message")) {
                document.getElementById("p_message").style.backgroundColor =
                    "green";
                document.getElementById("p_message").style.padding = "15px";
                document.getElementById("p_message").innerHTML =
                    `${businessCust == 1 ? 'Din leverans är gratis' : "Handla för " + p_message + " till"}`;
            }
            document.getElementById("p_message2").innerHTML =
                `${businessCust == 1 ? '' : 'då slipper du transport avgiften SEK 95,00'}`; //på
            document.getElementById("transport-fee").innerHTML =
                price_display_format(transportFee);

            let percent = (total_discounted_price / 650) * 100;

            document.getElementById("p-bar").style.width = `${businessCust == 1 ? '100%' : percent + "%"}`;

            if (total_discounted_price > 0) {
                total_discounted_price += transportFee;
            }
        } else if (p_message <= 0) {
            if (document.getElementById("p_message")) {
                document.getElementById("p_message").innerHTML = "Din leverans är gratis";
                document.getElementById("p_message").style.padding = "15px";
                document.getElementById("p_message").style.backgroundColor = "green";
            }
            if (document.getElementById("p_message2")) {
                document.getElementById("p_message2").innerHTML = "";
            }
            if (document.getElementById("transport-fee")) {
                document.getElementById("transport-fee").innerHTML = "Gratis";
            }
            if (document.getElementById("p-bar")) {
                document.getElementById("p-bar").style.width = "100%";
            }
        }
        TotalCartPrice(subtotal);
        discountPrice(totaldiscount);

        let grand_total = (
            total_discounted_price - parseFloat(coupon_discount)
        ).toFixed(2);

        document.getElementById("total").innerHTML = price_display_format(grand_total);

        var checkoutButton = document.getElementById("checkout");
        var counterForBusiness = document.getElementById("counter");


        // cdp-progress-bar
        var maxAmount = 1500;
        var remainingAmount;
        var progressPercentage;

        if (grand_total <= maxAmount) {
            remainingAmount = maxAmount - grand_total;
            if (document.getElementById("counter")) {
                document.getElementById("counter").innerHTML = 'Handla för ' + price_display_format(remainingAmount) + ' till';
            }

            progressPercentage = (grand_total / maxAmount) * 100;
        } else {
            remainingAmount = 0;
            if (document.getElementById("counter")) {
                document.getElementById("counter").innerHTML = 'Klar för kassan';
            }
            progressPercentage = 0;
        }
        if (document.getElementById("cdp-bar")) {
            document.getElementById("cdp-bar").style.width = progressPercentage + "%";
        }
        // cdp-progress-bar

        if (counterForBusiness?.className && counterForBusiness.className == 'business') {
            if (document.getElementById("p-bar")) {
                document.getElementById("p-bar").style.width = 0 + "%";
            }
            if (grand_total < 1500) {
                checkoutButton.classList.add("disabledCheckout");
            } else {
                if (document.getElementById("cdp-bar")) {
                    document.getElementById("cdp-bar").style.width = 100 + "%";
                }
                checkoutButton.classList.remove("disabledCheckout");
            }
        }

        if (document.getElementById("total")) {
            document.getElementById("total").innerHTML = price_display_format(grand_total);
        }
        if (document.getElementById("checkout")) {
            document.getElementById("checkout").disabled = false;
        }
        if (document.getElementsByClassName('checkout-taxs') && Array.from(document.getElementsByClassName("checkout-taxs")).length > 0) {
            if (document.getElementById("tax_12_percent")) {
                document.getElementById("tax_12_percent").innerHTML = price_display_format(tax_12);
            }
            if (document.getElementById("tax_25_percent")) {
                document.getElementById("tax_25_percent").innerHTML = price_display_format(tax_25);
            }
            if (document.getElementById("tax_total")) {
                document.getElementById("tax_total").innerHTML = price_display_format(total_tax);
            }
        }

    } else {

        TotalCartCount(totalquantity);
        TotalCartPrice(total - totaldiscount);
        let coupon_discount_div = document.getElementById("coupon-discount");
        coupon_discount_div.parentNode.classList.add("hidden");
        if (document.getElementById("total")) {
            document.getElementById("total").innerHTML = "";
        }
        if (document.getElementById("checkout")) {
            document.getElementById("checkout").disabled = true;
        }
        if (document.getElementById("grand_total")) {
            document.getElementById("grand_total").innerHTML = "";
        }
        if (document.getElementsByClassName('checkout-taxs') && Array.from(document.getElementsByClassName("checkout-taxs")).length > 0) {

            if (document.getElementById("tax_12_percent")) {
                document.getElementById("tax_12_percent").innerHTML = ''
            }
            if (document.getElementById("tax_25_percent")) {
                document.getElementById("tax_25_percent").innerHTML = ''
            }
            if (document.getElementById("tax_total")) {
                document.getElementById("tax_total").innerHTML = ''
            }

        }
        if (document.getElementById("p_message")) {
            document.getElementById("p_message").innerHTML = "Handla för 650,00 till";
        }
        if (document.getElementById("p-bar")) {
            document.getElementById("p-bar").style.width = "0%";
        }

        discountPrice(totaldiscount);
    }


}
window.GetCartProductFromCache = GetCartProductFromCache;

let coupon_input = document.getElementById("coupon");
if (coupon_input) {
    let valid_coupon = localStorage.getItem("valid_coupon");
    if (valid_coupon) {
        valid_coupon = JSON.parse(valid_coupon);
        coupon_input.value = valid_coupon.code;
    }
}

if (document.getElementById("transport-fee")) {
    document.getElementById("transport-fee").innerHTML =
        price_display_format(transportFee);
}
if (document.getElementById("p_message")) {
    document.getElementById("p_message").style.backgroundColor = "white";
    document.getElementById("p_message").style.padding = "0px";
}
if (document.getElementById("p-bar")) {
    document.getElementById("p-bar").style.width = "0";
}

async function checkPostNumberDetails() {
    let postcode = JSON.parse(JSON.stringify(localStorage.getItem("postcode")));
    // localStorage.removeItem('cart');return false;

    if (!postcode) {
        document.getElementById("post-number-btn").click();
    }

    return true;
}
function checkReserveTimeDetails() {
    let delivery_datetime = JSON.parse(
        localStorage.getItem("delivery_datetime")
    );
    if (!delivery_datetime) {
        document.getElementById("reserve-time-btn").click();
    }
    return true;
}

function updateAllElementsCopy(id, qty) {
    let all_elements = document.getElementsByClassName(id);

    // console
    // if (all_elements[0] && all_elements[0].classList.contains(id)) {
    for (let i = 0; i < all_elements.length; i++) {
        let id_element = all_elements[i];
        let buy_two_for = id_element.getElementsByClassName(
            "buy_two_for_compare"
        )[0];

        if (buy_two_for) {
            let real_price = id_element.getElementsByClassName("real-price")[0];
            if (!real_price) {
                real_price =
                    id_element.getElementsByClassName("original-price")[0];
            }

            let discounted_price =
                id_element.getElementsByClassName("discount-price")[0];
            let price_per_item =
                id_element.getElementsByClassName("price_per_item")[0];
            if (
                id_element.getElementsByClassName("card-quantity-div")[0]
                    .value < 2
            ) {
                discounted_price.classList.add("hidden");
                if (real_price) {
                    if (price_per_item) {
                        price_per_item.classList.remove("hidden");
                        buy_two_for.classList.add("hidden");
                    }
                    real_price.classList.remove("real-price");
                    real_price.classList.add("original-price");
                    real_price.style.textDecoration = "none";
                }
            } else {
                discounted_price.classList.remove("hidden");
                if (real_price) {
                    if (price_per_item) {
                        price_per_item.classList.add("hidden");
                        buy_two_for.classList.remove("hidden");
                    }
                    real_price.classList.remove("original-price");
                    real_price.classList.add("real-price");
                    real_price.style.textDecoration = "line-through";
                }
            }
        }
        if (all_elements[i].children[2]) {
            const counter = all_elements[i].children[2].children[3];

            counter.getElementsByClassName("card-quantity-div")[0].value = qty;
            counter.children[0].nextElementSibling.classList.remove(
                "custom-d-none",
                "hidden"
            );
            counter.children[0].nextElementSibling.nextElementSibling.classList.remove(
                "custom-d-none",
                "hidden"
            );
            counter.children[0].classList.remove("custom-d-none", "hidden");
            counter.children[3].classList.add("hidden");
            counter.style =
                "background-color:rgb(232, 232, 232);justify-content:space-between";
        }
        if (all_elements[i].classList.contains("buy-now")) {
            const counter =
                all_elements[i].getElementsByClassName("card-counter-div")[0];

            let firstBtn = counter.getElementsByClassName("first-btn")[0];
            if (firstBtn) {
                firstBtn.classList.add("hidden");
                let plusDiv =
                    counter.getElementsByClassName("card-plus-div")[0];
                let minusDiv =
                    counter.getElementsByClassName("card-minus-div")[0];
                let input =
                    counter.getElementsByClassName("card-quantity-div")[0];
                plusDiv.classList.remove("hidden", "custom-d-none");
                minusDiv.classList.remove("hidden", "custom-d-none");
                input.classList.remove("hidden", "custom-d-none");
                input.value = qty;
                counter.style =
                    "background-color:rgb(232, 232, 232);justify-content:space-between";
            }
        }
    }
    // }
}

function updateAllElements(id, qty, buy_two = false) {
    let all_elements = document.getElementsByClassName(id);

    for (let i = 0; i < all_elements.length; i++) {
        let id_element = all_elements[i];

        let buy_two_for = id_element.getElementsByClassName(
            "buy_two_for_compare"
        )[0];

        if (buy_two_for) {
            let real_price = id_element.getElementsByClassName("real-price")[0];
            if (!real_price) {
                real_price =
                    id_element.getElementsByClassName("original-price")[0];
            }

            let discounted_price =
                id_element.getElementsByClassName("discount-price")[0];
            let price_per_item =
                id_element.getElementsByClassName("price_per_item")[0];
            if (qty < 2) {
                discounted_price.classList.add("hidden");
                if (real_price) {
                    if (price_per_item) {
                        price_per_item.classList.remove("hidden");
                        buy_two_for.classList.add("hidden");
                    }
                    real_price.classList.remove("real-price");
                    real_price.classList.add("original-price");
                    real_price.style.textDecoration = "none";
                }
            } else {
                discounted_price.classList.remove("hidden");
                if (real_price) {
                    if (price_per_item) {
                        price_per_item.classList.add("hidden");
                        buy_two_for.classList.remove("hidden");
                    }
                    real_price.classList.remove("original-price");
                    real_price.classList.add("real-price");
                    real_price.style.textDecoration = "line-through";
                }
            }
        }
        else {
            let real_price = id_element.getElementsByClassName("real-price")[0];
            let discount_price = id_element.getElementsByClassName("discount-price")[0];
            if (!discount_price.classList.contains("hidden")) {
                real_price.style.textDecoration = "line-through";
            } else {
                if (real_price) {
                    real_price.style.textDecoration = "inherit";
                }

            }

        }

        const counter =
            id_element.getElementsByClassName("card-counter-div")[0];

        let firstBtn = counter.getElementsByClassName("first-btn")[0];
        let plusDiv = counter.getElementsByClassName("card-plus-div")[0];
        let minusDiv = counter.getElementsByClassName("card-minus-div")[0];
        let input = counter.getElementsByClassName("card-quantity-div")[0];
        plusDiv.classList.remove("hidden", "custom-d-none");
        minusDiv.classList.remove("hidden", "custom-d-none");
        input.classList.remove("hidden", "custom-d-none");

        counter.classList.remove("bg-white");
        input.value = qty;
        counter.style =
            "background-color:rgb(232, 232, 232);justify-content:space-between";
        if (firstBtn) {
            firstBtn.classList.add("hidden");
        }
        if (qty <= 0) {
            minusDiv.classList.add("hidden", "custom-d-none");
            if (firstBtn) {
                firstBtn.classList.remove("hidden");
                plusDiv.classList.add("hidden");
            }
            input.classList.add("hidden", "custom-d-none");
            input.value = qty;

            counter.style = "background-color:white;justify-content:flex-end";
        }
    }
}

function AddQuantity(btn) {
    let cart = JSON.parse(localStorage.getItem("cart"));

    if (!checkPostNumberDetails()) {
        return;
    }

    btn.classList.remove("plus");
    let id_element = btn.parentNode.parentNode.parentNode;

    let id = id_element.id;
    let qty = btn.previousElementSibling;

    let buy_two = false;
    let price = "0:00:-";
    let sale_price = "0:00:-";
    // let category = document.getElementsByClassName('main-heading');
    let searched_product =
        document.getElementsByClassName("header-search-item");
    let category = qty.parentNode.parentNode.parentNode.parentNode
        .getElementsByClassName("product-category")[0]
        .innerText.replace(" /", "");

    let findExistingCategory = cart.find(
        (categories) => categories.category == category
    );

    let findExisting = {};
    if (findExistingCategory && findExistingCategory.products) {
        findExisting = findExistingCategory.products.find(
            (product) => product.item_id == id
        );
    }

    let buy_two_for = id_element.getElementsByClassName(
        "buy_two_for_compare"
    )[0];

    let tax = btn.closest('[data-tax]').getAttribute('data-tax');


    if (buy_two_for) {
        buy_two = true;
    }

    price = price_format(
        qty.parentNode.parentNode.parentNode.parentNode.getElementsByClassName(
            "product-real-price"
        )[0].innerText
    );

    if (
        qty.parentNode.parentNode.parentNode.parentNode.getElementsByClassName(
            "product-discount-price"
        )[0]
    ) {
        sale_price = price_format(
            qty.parentNode.parentNode.parentNode.parentNode.getElementsByClassName(
                "product-discount-price"
            )[0].innerText
        );
    }

    let image =
        qty.parentNode.parentNode.parentNode.parentNode.getElementsByClassName(
            "product-image"
        )[0].currentSrc;

    let product_name =
        qty.parentNode.parentNode.parentNode.parentNode.getElementsByClassName(
            "product-name"
        )[0].innerText;

    let pant = 0;
    let pantElement =
        qty.parentNode.parentNode.parentNode.parentNode.getElementsByClassName(
            "pant"
        );

    if (pantElement.length) {
        // Regular expression to match a floating-point number
        let regex = /[+-]?([0-9]*[.])?[0-9]+/;
        // Extract the floating-point number from the string
        let matches = pantElement[0].innerHTML.match(regex);
        // Check if there is a match and extract the number
        if (matches && matches.length > 0) {
            pant = parseFloat(matches[0]);
        }
    }

    let product = {
        item_id: id,
        quantity: qty.value,
        item_name: product_name,
        image: image,
        item_price: price,
        item_sale_price: price !== sale_price ? sale_price : "",
        buy_two: buy_two,
        category: category,
        pant: pant,
        tax: tax,
    };
    let category_products = { category: category };
    category_products["products"] = [product];

    if (cart.length == 0) {
        cart.push(category_products);

        localStorage.setItem("cart", JSON.stringify(cart));
    } else {
        if (findExistingCategory === undefined) {
            cart.push(category_products);
            localStorage.setItem("cart", JSON.stringify(cart));
        } else {
            updateQuantity(product, findExisting);
        }
    }
    // add point to cart
    addPopularityPoint(product.item_id, 'cart');
    GetCartProductFromCache();
}

// REMOVING A PRODUCT FROM THE CART
function removeItemFromCart(productId, category) {
    console.log("remove cart running", productId, category)
    let cart = JSON.parse(localStorage.getItem("cart"));
    // category = category.replace("& ", "&amp; ")
    let findExistingCategory = cart.find(
        (categories) => categories.category == category
    );
    let findRemaning = {};
    if (findExistingCategory && findExistingCategory.products) {
        findRemaning = findExistingCategory.products.filter(
            (product) => product.item_id != productId
        );
    }

    let updatedCart = cart.filter(
        (categories) => categories.category != category
    );
    let updateCart = [];

    if (findRemaning.length > 0) {
        findExistingCategory["products"] = findRemaning;
        updateCart = updatedCart.concat(findExistingCategory);
    } else {
        updateCart = updatedCart;
    }

    localStorage.setItem("cart", JSON.stringify(updateCart));
    // 	GetCartProductFromCache()
}

// UPDATING THE PRODUCTS QUANTITY.
function updateQuantity(product, exists) {
    let cart = JSON.parse(localStorage.getItem("cart"));
    for (let category of cart) {
        if (exists === undefined && category.category === product.category) {
            category.products.push(product);
        } else {
            for (let item of category.products) {
                if (item.item_id == product.item_id) {
                    item.quantity = product.quantity;
                }
            }
        }
    }

    localStorage.setItem("cart", JSON.stringify(cart));
}

function RemoveQuantity(btn) {
    let id = btn.parentNode.parentNode.parentNode.id;
    let qty = btn.nextElementSibling;
    qty.value = parseInt(qty.value) - 1;

    let category = qty.parentNode.parentNode.parentNode.parentNode
        .getElementsByClassName("product-category")[0]
        .innerText.replace(" /", "");

    let product = { item_id: id, quantity: qty.value };
    if (qty.value <= 0) {
        updateAllElements(id, qty.value);
        qty.classList.add("custom-d-none");
        btn.classList.add("custom-d-none");
        removeItemFromCart(id, category);
    } else {
        updateQuantity(product, {});
    }

    GetCartProductFromCache();
}

let addToCartRequest = null;
function AddtoCart(id, qty) {
    addToCartRequest = $.ajax({
        url: BASE_URL + "api/cart/" + id + "/" + qty,
        type: "POST",
        beforeSend: function () {
            if (addToCartRequest != null) {
                addToCartRequest.abort();
            }
        },
        success: function (data) {
            // GetCartProducts()
        },
    });
}

let timer;

function handleClick(callback, data) {
    // Clear any existing timer.
    clearTimeout(timer);

    // Start a new timer to execute the callback with the provided data after 1 second.
    timer = setTimeout(() => callback(data), 0);
}

let getCartProductsRequest = null;
function GetCartProducts() {
    let cart = document.getElementById("cart-product");

    document.getElementById("total").innerHTML = "";
    getCartProductsRequest = $.ajax({
        url: BASE_URL + "api/cart",
        type: "GET",
        beforeSend: function () {
            if (getCartProductsRequest != null) {
                getCartProductsRequest.abort();
            }
        },
        success: function (data) {
            console.log(data);
            return false;
            if (data.status != "error") {
                cart.innerHTML = "";
                let totalquantity = 0;
                let total = 0;
                let memory = [];
                let totaldiscount = 0;
                for (let i = 0; i < data[0].length; i++) {
                    if (!data[1][data[0][i]]) {
                        data[1][data[0][i]] = [];
                    }
                    for (let j = 0; j < data[1][data[0][i]].length; j++) {
                        var category = document.createElement("h2");
                        if (
                            !memory.includes(data[1][data[0][i]][j]["category"])
                        ) {
                            category.classList.add("text-xl");
                            category.innerHTML = data[0][i];
                            memory.push(data[1][data[0][i]][j]["category"]);
                        }
                        var div0 = document.createElement("div");
                        div0.id = data[1][data[0][i]][j]["id"];
                        var div = document.createElement("div");
                        div.className = "selected-product";
                        var span = document.createElement("span");
                        var img = document.createElement("img");
                        img.src = data[1][data[0][i]][j]["image"];
                        img.style = "width: 50px;";
                        var div1 = document.createElement("div");
                        div1.className = "s-product-detail";
                        var p = document.createElement("p");
                        p.classList.add("cursor-pointer");
                        p.setAttribute("data-bs-toggle", "modal");
                        p.setAttribute(
                            "data-bs-target",
                            "#cart-" + data[1][data[0][i]][j]["id"]
                        );
                        p.innerHTML = data[1][data[0][i]][j]["name"];

                        var h5 = document.createElement("h5");
                        var buy_two_for = data[1][data[0][i]][j]["buy_two_for"];
                        if (data[1][data[0][i]][j]["discount_price"]) {
                            if (buy_two_for) {
                                if (data[1][data[0][i]][j]["qty"] > 1) {
                                    var discount =
                                        document.createElement("span");
                                    var discount_price =
                                        parseFloat(
                                            data[1][data[0][i]][j][
                                                "discount_price"
                                            ]
                                                .toString()
                                                .replace("kr", "")
                                                .replace(":", ".")
                                                .replace(",", ".") *
                                            data[1][data[0][i]][j]["qty"]
                                        ).toFixed(2) + ":-";
                                    let original_price =
                                        parseFloat(
                                            data[1][data[0][i]][j]["price"]
                                                .toString()
                                                .replace("kr", "")
                                                .replace(":", ".")
                                                .replace(",", ".") *
                                            data[1][data[0][i]][j]["qty"]
                                        ).toFixed(2) + ":-";
                                    discount.classList.add(
                                        "!no-underline",
                                        "discounted-price"
                                    );
                                    discount.innerHTML = discount_price;
                                    let original =
                                        document.createElement("span");
                                    original.classList.add(
                                        "line-through",
                                        "!text-slate-900",
                                        "original-price"
                                    );
                                    original.innerHTML = original_price;
                                    h5.appendChild(discount);
                                    h5.appendChild(original);
                                } else {
                                    var original =
                                        document.createElement("span");
                                    var original_price =
                                        parseFloat(
                                            data[1][data[0][i]][j]["price"]
                                                .toString()
                                                .replace("kr", "")
                                                .replace(":", ".")
                                                .replace(",", ".") *
                                            data[1][data[0][i]][j]["qty"]
                                        ).toFixed(2) + ":-";
                                    original.classList.add(
                                        "!text-slate-900",
                                        "!no-underline",
                                        "original-price"
                                    );
                                    original.innerHTML = original_price;
                                    h5.appendChild(original);
                                }
                            } else {
                                var discount = document.createElement("span");
                                var discount_price =
                                    parseFloat(
                                        data[1][data[0][i]][j]["discount_price"]
                                            .toString()
                                            .replace("kr", "")
                                            .replace(":", ".")
                                            .replace(",", ".") *
                                        data[1][data[0][i]][j]["qty"]
                                    ).toFixed(2) + ":-";
                                var original_price =
                                    parseFloat(
                                        data[1][data[0][i]][j]["price"]
                                            .toString()
                                            .replace("kr", "")
                                            .replace(":", ".")
                                            .replace(",", ".") *
                                        data[1][data[0][i]][j]["qty"]
                                    ).toFixed(2) + ":-";
                                discount.classList.add(
                                    "!no-underline",
                                    "discounted-price"
                                );
                                discount.innerHTML = discount_price;
                                let original = document.createElement("span");
                                original.classList.add(
                                    "line-through",
                                    "!text-slate-900",
                                    "original-price"
                                );
                                original.innerHTML = original_price;
                                h5.appendChild(discount);
                                h5.appendChild(original);
                            }
                        } else {
                            var original = document.createElement("span");
                            var original_price =
                                parseFloat(
                                    data[1][data[0][i]][j]["price"]
                                        .toString()
                                        .replace("kr", "")
                                        .replace(":", ".")
                                        .replace(",", ".") *
                                    data[1][data[0][i]][j]["qty"]
                                ).toFixed(2) + ":-";
                            original.classList.add(
                                "!text-slate-900",
                                "!no-underline",
                                "original-price"
                            );
                            original.innerHTML = original_price;
                            h5.appendChild(original);
                        }
                        var div2 = document.createElement("div");
                        div2.className = "cart-card-counter d-flex";
                        var a1 = document.createElement("a");
                        var i1 = document.createElement("i");
                        var a2 = document.createElement("a");
                        var i2 = document.createElement("i");
                        var input1 = document.createElement("input");
                        input1.type = "number";
                        a1.className = "card-minus-div";
                        a2.className = "card-plus-div";
                        input1.className = "st card-quantity-div";
                        input1.value = data[1][data[0][i]][j]["qty"];
                        input1.readOnly = true;
                        i1.className = "bi bi-plus-circle-fill plus";
                        i2.className = "bi bi-dash-circle-fill minus";
                        // a1.onclick = function () {
                        //     AddQuantity(this)
                        // };
                        // a2.onclick = function () {
                        //     RemoveQuantity(this)
                        // };
                        a1.appendChild(i1);
                        a2.appendChild(i2);
                        div2.appendChild(a2);
                        div2.appendChild(input1);
                        div2.appendChild(a1);
                        div1.appendChild(p);
                        div1.appendChild(h5);
                        span.appendChild(img);
                        span.appendChild(div1);
                        div.appendChild(span);
                        div.appendChild(div2);
                        div0.appendChild(div);
                        cart.appendChild(category);
                        cart.appendChild(div0);
                        var price = data[1][data[0][i]][j]["price"]
                            .toString()
                            .slice(0, 4);
                        var discount_price = "0";

                        if (data[1][data[0][i]][j]["discount_price"]) {
                            if (buy_two_for) {
                                if (data[1][data[0][i]][j]["qty"] > 1) {
                                    discount_price = data[1][data[0][i]][j][
                                        "discount_price"
                                    ]
                                        .toString()
                                        .slice(0, 4);
                                }
                            } else {
                                discount_price = data[1][data[0][i]][j][
                                    "discount_price"
                                ]
                                    .toString()
                                    .slice(0, 4);
                            }
                        }
                        price = price.split(" ");
                        price = price[0]
                            .replace("kr", "")
                            .replace(":", ".")
                            .replace(",", ".");
                        discount_price = discount_price.split(" ");
                        discount_price = discount_price[0]
                            .replace("kr", "")
                            .replace(":", ".")
                            .replace(",", ".");
                        let quantity = parseInt(data[1][data[0][i]][j]["qty"]);
                        if (discount_price > 0) {
                            if (buy_two_for) {
                                if (data[1][data[0][i]][j]["qty"] > 1) {
                                    totaldiscount +=
                                        (parseFloat(price) -
                                            parseFloat(discount_price)) *
                                        quantity;
                                } else {
                                    totaldiscount += 0;
                                }
                            } else {
                                totaldiscount +=
                                    (parseFloat(price) -
                                        parseFloat(discount_price)) *
                                    quantity;
                            }
                        } else {
                            totaldiscount += 0;
                        }
                        total += parseFloat(price) * quantity;
                        totalquantity = totalquantity + quantity;

                        let preview = previewModel(
                            data[1][data[0][i]][j],
                            "cart"
                        );
                        // let cartPreview = document.getElementById('cart-preview-cards')
                        // if(cartPreview){
                        // cartPreview.innerHTML += preview
                        // }
                    }
                }

                let cartItemBtn = document.getElementById("cart-item-amount");

                TotalCartCount(totalquantity);

                let total1 = total.toFixed(1).toString().replace(".", ":");
                TotalCartPrice(total - totaldiscount);
                let p_message = 650 - total;
                if (p_message > 0) {
                    p_message = p_message
                        .toFixed(1)
                        .toString()
                        .replace(".", ":");
                    if (document.getElementById("p_message")) {
                        document.getElementById("p_message").innerHTML =
                            "Handla för " + p_message + " till";
                    }
                    let percent = (total / 1000) * 100;
                    if (document.getElementById("p-bar")) {
                        document.getElementById("p-bar").style.width = percent + "%";
                    }
                    if (total > 0) {
                        total += 95;
                    }
                } else if (p_message <= 0) {
                    if (document.getElementById("p_message")) {
                        document.getElementById("p_message").innerHTML = "Din leverans är gratis";
                    }
                    if (document.getElementById("p_message2")) {
                        document.getElementById("p_message2").innerHTML = "";
                    }
                    if (document.getElementById("p-bar")) {
                        document.getElementById("p-bar").style.width = "100%";
                    }
                    if (document.getElementById("delivery")) {
                        document.getElementById("delivery").innerHTML = "Gratis";
                    }
                }
                if (document.getElementById("grand_total")) {
                    document.getElementById("grand_total").innerHTML = "SEK " + (total - totaldiscount);
                }

                discountPrice(totaldiscount);
                let grand_total = (total - totaldiscount)
                    .toFixed(2)
                    .toString()
                    .replace(".", ":");
                document.getElementById("total").innerHTML =
                    "SEK " + grand_total;
                document.getElementById("checkout").disabled = false;
            }
        },
    });
}

function card(
    data,
    modal_class = "data",
    classes = "card-box col-xxl-2 col-xl-3 col-md-4 col-sm-6 col-xs-6 px-1 py-3 col-6",
    incarousel = false,
    quantity = null
) {
    let cart = JSON.parse(localStorage.getItem("cart"));
    let all_products = [];
    if (cart) {
        for (let item of cart) {
            for (let product of item.products) {
                all_products.push(product);
            }
        }
    }

    let cart_item = all_products.find((product) => product.item_id == data.id);

    let buy_two_for_compare = "";
    let buy_two_for = "";
    if (data.buy_two_for) {
        buy_two_for += `<div class="deals">
                            <h2>2 for</h2>
                            <p>${data.discount_price}:-</p>
                        </div>`;
        buy_two_for_compare = "buy_two_for_compare";
    } else {
        buy_two_for += `<div class="discount absolute right-[4.5rem] ${price_format(data.discount_price) <= 0 ? "hidden" : ""
            }" >
                            <i class="fa fa-certificate"></i>
                            <h5>${data.discount_price}:-</h5>
                        </div>`;
    }
    let pant = "";
    if (data.pant) {
        pant += `<div class="text-[11px] hidden">+<span class="hidden pant">${data.pant}</span>pant</div>`;
    }

    let discount_price_hidden = "";
    let text_decoration = "inherit";
    if (data.buy_two_for) {
        if (cart_item && cart_item.quantity > 1) {
            discount_price_hidden = "";
            text_decoration = "line-through"
        } else {
            text_decoration = "inherit";
            discount_price_hidden = "hidden";
        }
    } else {
        if (price_format(data.discount_price) > 0) {
            text_decoration = "line-through";
        } else {
            text_decoration = "inherit";
            discount_price_hidden = "hidden";
        }
    }

    let price = `<span class="text-right">
                    <h5 class="product-discount-price discount-price ${discount_price_hidden}">${price_format(data.discount_price) > 0 ? data.discount_price : ""
        }:-</h5>
                    <h5 ${price_format(data.discount_price) <= 0
            ? ""
            : `style="text-decoration: ${text_decoration}"`
        } class="product-real-price ${price_format(data.discount_price) <= 0 ? "original-price" : "real-price"
        }">${data.price}:-</h5>
                    ${pant}
                 </span>`;

    let card = "";
    if (incarousel) {
        card += '<div class="item">';
    }

    let favourite = "";
    if (data.is_favourite) {
        favourite = `<i id="likebtn" class="bi bi-heart-fill likebtn-${data.id} " style="color: red;"></i>`;
    } else {
        favourite = `<i id="likebtn" class="bi bi-heart-fill likebtn-${data.id}"></i>`;
    }
    let category = "";
    if (data.category_id) {
        category = `<h4><b><a class="product-category" href="${BASE_URL}product/category?category=${data.category_id}">${data.category}</a></b></h4>`;
    }
    let price_per_item = "";
    if (data.compare_price) {
        price_per_item = `<h4 class="text-[10px]">Jfr pris <span class="${buy_two_for_compare} hidden">${data.price_per_item}</span>
                                                            <span class="price_per_item ">${data.compare_price}</span></h4>`;
    } else if (data.price_per_item) {
        price_per_item = `<h4 class="text-[10px]">Jfr pris <span class="">${data.price_per_item}</span></h4>`;
    }
    card += `
    <div data-tax="${data.tax}" class="${classes}">
        <div class="card ${data.id}" id="${data.id}">

            <div class="t-icon relative">
                ${buy_two_for}
                <div class="favourite">
                      ${favourite}

                </div>
            </div>
            <div class="card-image" data-bs-toggle="modal" data-bs-target="#${modal_class}-${data.id
        }">
                <img class="product-image" src="${data.image}" alt="${data.name
        }" class="card-img-top">
            </div>
            <div class="card-body">
                <h5 class="card-title text-center product-name" data-bs-toggle="modal" data-bs-target="#${modal_class}-${data.id
        }">${data.name}</h5>
                <div class=" d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#${modal_class}-${data.id1
        }">
                <h4 class="tag" data-bs-toggle="modal" data-bs-target="#${modal_class}-${data.id
        }">${data.weight} </h4>
                 </div>
                <div class="price" data-bs-toggle="modal" data-bs-target="#${modal_class}-${data.id
        }">
          <span>

                        ${category}
                        ${price_per_item}
                    </span>
                    ${price}
                </div>
                <div class="card-counter-div card-counter d-flex " style="${(cart_item !== undefined && cart_item.quantity > 0) ||
            quantity > 0
            ? "justify-content:space-between;background-color:rgb(232, 232, 232)"
            : "justify-content:flex-end;background-color:white"
        } ">
                    <a class="card-minus-div ${(cart_item !== undefined && cart_item.quantity > 0) ||
            quantity > 0
            ? ""
            : "hidden"
        }"><i class="bi bi-dash-circle-fill minus"></i></a>
                    <input type="number" class="st ${(cart_item !== undefined && cart_item.quantity > 0) ||
            quantity > 0
            ? ""
            : "hidden"
        } card-quantity-div" value="${(cart_item !== undefined && cart_item.quantity > 0) || quantity > 0
            ? quantity > 0
                ? quantity
                : cart_item.quantity
            : 0
        }" size="2">
                    <a class="card-plus-div ${(cart_item !== undefined && cart_item.quantity > 0) ||
            quantity > 0
            ? ""
            : "hidden"
        } "><i class="bi bi-plus-circle-fill plus"></i></a>
                    <button class="first-btn  ${(cart_item !== undefined && cart_item.quantity > 0) ||
            quantity > 0
            ? "hidden"
            : ""
        }" >
                        Köp
                    </button>
                </div>
            </div>
        </div>
    </div>
    `;
    if (incarousel) {
        card += "</div>";
    }

    return card;
}

function previewModel(data, modal_name = "data", quantity = null) {
    //console.log(data)
    let cart = JSON.parse(localStorage.getItem("cart"));
    let all_products = [];
    if (cart) {
        for (let item of cart) {
            for (let product of item.products) {
                all_products.push(product);
            }
        }
    }

    let cart_item = all_products.find((product) => product.item_id == data.id);
    let preview_discount_price =
        price_format(data.discount_price) > 0
            ? data.discount_price
            : data.price;
    let preview_price_hidden =
        price_format(data.discount_price) <= 0 ? "hidden" : "";
    // let preview_price = (data.discount_price <= 0) ? data.price : data.price
    let origin = "";
    let buy_two_for_compare = "";
    let buy_two_for = "";
    if (data.buy_two_for) {
        buy_two_for += `<div class="deals">
                            <h2>2 for</h2>
                            <p>${data.discount_price}:-</p>
                        </div>`;
        buy_two_for_compare = "buy_two_for_compare";
    } else {
        buy_two_for += `<div class="discount absolute left-10 ${price_format(data.discount_price) <= 0 ? "hidden" : ""
            }" >
                            <i class="fa fa-certificate"></i>
                            <h5>${data.discount_price}:-</h5>
                        </div>`;
    }
    let favourite = "";
    if (data.is_favourite) {
        favourite = `<i id="likebtn" class="bi bi-heart-fill likebtn-${data.id} " style="color: red;"></i>`;
    } else {
        favourite = `<i id="likebtn" class="bi bi-heart-fill likebtn-${data.id}"></i>`;
    }

    let category = "";
    let sub_category = "";
    let subsub_category = "";
    let product_information = "";
    let nutritional_content = "";
    let pant = "";
    if (data.pant) {
        pant = `<h4><span class="pant">${data.pant}</span> kr pant tillkommer</h4>`;
    }
    if (data.category_id) {
        category = `<h4><a class="product-category" href="${BASE_URL}product/category?category=${data.category_id}">${data.category}</a> / </h4>`;
    }
    if (data.sub_category_id) {
        sub_category = `<h4><a href="${BASE_URL}product/sub_cat/${data.sub_category_id}"> ${data.sub_category} </a> / </h4>`;
    }

    if (data.subsub_category_id) {
        subsub_category = `<h4><a href="${BASE_URL}product/subsub_cat/${data.subsub_category_id}"> ${data.subsub_category} </a> </h4>`;
    }
    if (data.product_information && (strip_tags(data.product_information))) {
        product_information = `
        <h3> <strong> Produktinformation</strong></h3>
        <p>${data.product_information}</p>
        <br>
        `;
    }
    //    if (data.origin) {
    //        origin = `
    //        <div class="product-country">
    //            <i class="bi bi-globe"></i>
    //
    //            <div class="country-info">
    //                <p>Ursprung:- ${data.origin}</p>
    //            </div>
    //        </div>
    //        `;
    //    }

    if (data.origin && (strip_tags(data.origin))) {
        origin = `
        <h3> <strong> Ursprungsland</strong></h3>
        <p>${data.origin}</p>
        <br>
        `;
    }


    if (data.nutritional_content && (strip_tags(data.nutritional_content))) {
        nutritional_content = `
        <h3> <strong> Näringsinnehåll</strong></h3>
        <p>${data.nutritional_content}</p>
        <br>
        `;
    }
    let ingredients = "";
    if (data.ingredients && (strip_tags(data.ingredients))) {
        ingredients = `
        <h3> <strong>Ingredienser</strong></h3>
        <p>${data.ingredients}</p>
        <br>
        `;
    }
    let storage = "";
    if (data.storage) {
        storage = `
        <h3> <strong>Lagring</strong></h3>
        <p>${data.storage}</p>
        <br>
        `;
    }
    let other_information = "";
    if (data.other_information && (strip_tags(data.other_information))) {
        other_information = `
        <h3> <strong>Övrig information</strong></h3>
        <p>${data.other_information}</p>
        <br>
        `;
    }
    let discount_price_hidden = "";
    if (data.buy_two_for) {
        if (cart_item && cart_item.quantity > 1) {
            discount_price_hidden = "";
        } else {
            discount_price_hidden = "hidden";
        }

    } else {
        if (price_format(data.discount_price) > 0) {
            discount_price_hidden = "";
        } else {
            preview_price_hidden = "";
            discount_price_hidden = "hidden";
        }
    }

    let Jfr = "";
    if (data.compare_price) {
        Jfr = `<span>Jfr pris <span class="${buy_two_for_compare} hidden"> ${data.price_per_item}</span><span class="price_per_item">${data.compare_price}</span></span>`;
    }
    let preview = `

    <div class="preview-modal modal fade" data-tax="${data.tax}" id="${modal_name}-${data.id
        }" tabindex="-1" aria-labelledby="${data.name}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <i class="bi bi-x cursor-pointer" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body px-2">
                <div class="preview relative">
                    <div >
                        <div class="row " id="${data.id}">

                            <div class="col-lg-12 mx-auto mb-20">
                                ${buy_two_for}
                                <img class="product-image" src="${data.image
        }" alt="${data.name}">

                                <div class="like">

                                        ${favourite}
                                </div>

                                <div class="links">
                                    <i class="bi bi-house-door-fill"></i>
                                    ${category}
                                    ${sub_category}
                                    ${subsub_category}


                                </div>

                                <div class="product">
                                    <div class="product-1">
                                        <h1 class="product-name">${data.name
        }</h1>
                                        <p class="my-3">${data.weight}</p>
                                        ${pant}
                                    </div>


                                </div>


                                ${product_information}


                                ${origin}

                                <div class="product-discription">


                                </div>

                                ${ingredients}
                                ${nutritional_content}
                                ${storage}
                                ${other_information}

                            </div>
                        </div>

                        <div class="buy-now sticky ${data.id}" id="${data.id}">
                            <div class="buy-content">
                                <span>
                                    <h4 class="product-discount-price discount-price ${discount_price_hidden}">${preview_discount_price}:-</h4>
                                    <p> <span class="${preview_price_hidden}"> <s class="product-real-price real-price ${discount_price_hidden ? "no-underline text-base" : ""
        }" >${data.price}</s></span> ${Jfr}</p>
                                </span>

                                <div class="card-counter-div card-counter d-flex" style="${(cart_item !== undefined &&
            cart_item.quantity > 0) ||
            quantity > 0
            ? "justify-content:space-between;background-color:rgb(232, 232, 232)"
            : "justify-content:flex-end;background-color:white"
        } ">
                                    <a class="card-minus-div ${(cart_item !== undefined &&
            cart_item.quantity > 0) ||
            quantity > 0
            ? ""
            : "hidden"
        }"><i class="bi bi-dash-circle-fill minus"></i></a>
                                    <input type="number" class="st   ${(cart_item !== undefined &&
            cart_item.quantity > 0) ||
            quantity > 0
            ? ""
            : "hidden"
        } card-quantity-div" value="${(cart_item !== undefined && cart_item.quantity > 0) || quantity > 0
            ? quantity > 0
                ? quantity
                : cart_item.quantity
            : 0
        }" size="2">
                                    <a class="card-plus-div ${(cart_item !== undefined &&
            cart_item.quantity > 0) ||
            quantity > 0
            ? ""
            : "hidden"
        } "><i class="bi bi-plus-circle-fill plus"></i></a>
                                    <button class="first-btn  ${(cart_item !== undefined &&
            cart_item.quantity > 0) ||
            quantity > 0
            ? "hidden"
            : ""
        }" >
                                        Köp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
    </div>
    `;

    return preview;
}

function discountPrice(price) {
    let cart_discount_card =
        document.getElementsByClassName("side-cart-discount");
    let cart_discount = document.getElementById("cart-discount");

    if (cart_discount) {
        if (price > 0) {
            cart_discount_card[0].classList.remove("hidden");
            cart_discount.innerHTML = price_display_format(price);
        } else {
            cart_discount_card[0].classList.add("hidden");
            cart_discount.innerHTML = 0;
        }
    }
}

function EmptyCart() {
    let cart = document.getElementById("cart-product");
    document.getElementById("p-bar").style.width = 0 + "%";
    document.getElementById("p_message").innerHTML = "Handla för 650,00 till";
    document.getElementsByClassName("side-cart-discount")[0].classList.add("hidden");
    TotalCartCount(0);
    if (localStorage.getItem("cart")) {
        // $('#shopping').show();
        localStorage.setItem("cart", "[]");
    }
    $.ajax({
        url: BASE_URL + "api/cart/destroy",
        type: "DELETE",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {
            cart.innerHTML = "";
            $("#staticBackdrop").modal("hide");
            GetCartProducts();
            // $('#shopping').hide();
            window.location.reload();
        },
    });
}

const emptyCartBtn = document.getElementById("empty-basket");
if (emptyCartBtn) {
    emptyCartBtn.addEventListener("click", EmptyCart);
}

// -----------------search-bar-------------------- //
const searchInput = document.getElementById("SearchInput");
if (searchInput) {
    searchInput.addEventListener("keydown", function (e) {
        if (e.key == "Enter") {
            // submit
            let searchForm = document.getElementsByClassName("nav-search")[0];
            if (searchForm) {
                searchForm.submit();
            }
        }
    });
}
function Search(search) {
    const controller = new AbortController();

    fetch(BASE_URL + "api/search/" + search, { signal: controller.signal })
        .then((response) => response.json())
        .then((data) => GetSessionData(data))
        .catch((err) => console.error(err));
    if (searchInput) {
        searchInput.addEventListener("keydown", () => {
            controller.abort();
        });
    }
}

const inputElements = [...document.querySelectorAll("input.code-input")];
inputElements.forEach((ele, index) => {
    ele.addEventListener("keydown", (e) => {
        // if the keycode is backspace & the current field is empty
        // focus the input before the current. Then the event happens
        // which will clear the "before" input box.
        if (e.keyCode === 8 && e.target.value === "")
            inputElements[Math.max(0, index - 1)].focus();
    });
    ele.addEventListener("input", (e) => {
        // take the first character of the input
        // this actually breaks if you input an emoji like :man-woman-girl-boy:....
        // but I'm willing to overlook insane security code practices.
        const [first, ...rest] = e.target.value;
        e.target.value = first ?? ""; // first will be undefined when backspace was entered, so set the input to ""
        const lastInputBox = index === inputElements.length - 1;
        const didInsertContent = first !== undefined;
        if (didInsertContent && !lastInputBox) {
            // continue to input the rest of the string
            inputElements[index + 1].focus();
            inputElements[index + 1].value = rest.join("");
            inputElements[index + 1].dispatchEvent(new Event("input"));
        }
    });
});

function GetPostCodeSession() {
    let output = $.ajax({
        url: BASE_URL + "postcode",
        type: "GET",
        success: function (response) {
            if (document.getElementById("post-number-btn")) {

                if (response.length > 0) {
                    if (response != 404) {

                        localStorage.setItem("postcode", response);

                        document.getElementById("post-number-btn").innerHTML =
                            "Hemleverans till : " + response + "";
                        document
                            .getElementById("reserve-time-btn")
                            .classList.remove("hidden");
                        document
                            .getElementById("postcode_error")
                            .classList.add("hidden");
                        document.getElementById("postcode_close").click();
                        return 200;
                    } else {
                        document
                            .getElementById("postcode_error")
                            .classList.remove("hidden");
                        return 404;
                    }
                } else {
                    document.getElementById("post-number-btn").innerHTML =
                        "Postnummer ";
                    document
                        .getElementById("postcode_error")
                        .classList.remove("hidden");
                    // localStorage.setItem("cart", JSON.stringify());

                    return 404;
                }
            }
        },
        error: function (response) {
            document.getElementById("post-number-btn").innerHTML =
                "Postnummer ";
            document
                .getElementById("postcode_error")
                .classList.remove("hidden");
            // localStorage.setItem("cart", JSON.stringify());

            return 404;
        },
    });
    return output;
}

function sizeObj(obj) {
    return Object.keys(obj).length;
}

function GetDeliveryTimeSession() {
    let output = $.ajax({
        url: BASE_URL + "deliverytime",
        type: "GET",
        success: function (response) {
            if (document.getElementById("reserve-time-btn")) {

                if (sizeObj(response) > 0) {
                    localStorage.setItem(
                        "delivery_datetime",
                        JSON.stringify(response)
                    );
                    document.getElementById("reserve-time-btn").innerHTML =
                        "Datum : " +
                        response["delivery_date"] +
                        "" +
                        " Tid : " +
                        response["start_time"].substr(
                            0,
                            response["start_time"].length - 3
                        ) +
                        " - " +
                        response["end_time"].substr(
                            0,
                            response["end_time"].length - 3
                        );
                    return 200;
                } else {
                    document.getElementById("reserve-time-btn").innerHTML =
                        "Reservera tid";
                    return 400;
                }
            }
        },
    });
    return output;
}

let postnumberSaveBtn = document.getElementById("postnumber-save-btn");
if (postnumberSaveBtn) {
    postnumberSaveBtn.addEventListener("click", function () {
        // document.getElementById("reserve-time-btn").click();
    });
}

if (localStorage.getItem("delivery_datetime")) {
    GetDeliveryTimeSession();
}

function currentDates() {
    let date = new Date();
    let dates = [date];
    for (let i = 1; i < 31; i++) {
        const newDate = new Date(
            date.getFullYear(),
            date.getMonth(),
            date.getDate() + i
        );

        dates.push(newDate);
    }

    return dates;
}

function minTwoDigits(n) {
    return (n < 10 ? "0" : "") + n;
}

let weekdays = new Array(7);
weekdays[0] = "Söndag";
weekdays[1] = "Måndag";
weekdays[2] = "Tisdag";
weekdays[3] = "Onsdag";
weekdays[4] = "Torsdag";
weekdays[5] = "Fredag";
weekdays[6] = "Lördag";
let deliveryDates = document.getElementById("pills-tabs");
let deliveryTimes = document.getElementById("pills-tabContent");
let timeCardSlider = document.getElementsByClassName("time-card-slider")[0];
const dates = currentDates();
let deliverydate = "";
let deliverytime = "";
var minimum_delivery_days = 0;
$.ajax({
    url: BASE_URL + 'api/get-minimum_delivery-days',
    type: "GET",
    success: function (response) {
        if (response) {
            if (response.minimum_delivery_days) {
                minimum_delivery_days = response.minimum_delivery_days;
            }
        }
    }
})
$.ajax({
    url: BASE_URL + "api/admin/deliverytime",
    type: "GET",
    success: function (response) {
        let disabledfiltered = response.filter(
            (item) => item.status == 0 && item.start_time == "00:00:00"
        );
        let disableddates = disabledfiltered.map((data) => data.date);
        let disabledtimefiltered = response.filter(
            (data) => data.status == 0 && data.start_time != "00:00:00"
        );
        let disabledtime = disabledtimefiltered.map(
            (data) => data.date + "/" + data.start_time + "-" + data.end_time
        );
        let disabledtimedate = disabledtimefiltered.map((data) => data.date);
        let onlyoncetime = true;
        let onlyoncedate = true;

        for (let i = minimum_delivery_days; i < dates.length; i++) {
            let dateformat = `${dates[i].getFullYear()}-${minTwoDigits(
                dates[i].getMonth() + 1
            )}-${minTwoDigits(dates[i].getDate())}`;
            let deliverydatadisabled = disableddates.includes(dateformat)
                ? " disabled"
                : "";

            let checked = "";
            let hidden = "";
            let on = "";
            if (i == 0) {
                hidden = "hidden";
            }
            let valid = false;
            if (!deliverydatadisabled && onlyoncedate) {
                checked = "checked";
                valid = true;
                on = "active";
                onlyoncedate = false;
            }
            deliverydate += `
            <li class="${hidden} nav-item swiper-slide time-slide" role="presentation">
                <label id="time-card-${weekdays[dates[i].getDay()]}-${dates[
                    i
                ].getDate()}-tab" data-bs-toggle="pill" data-bs-target="#time-card-${weekdays[dates[i].getDay()]
                }-${dates[i].getDate()}"
                    type="button" role="tab" aria-controls="pills-${weekdays[dates[i].getDay()]
                }-${dates[
                    i
                ].getDate()}" class="${on}" aria-selected="${valid}">
                    <div class="item">
                        <label class="">
                            <input ${deliverydatadisabled} name="date" required class="radio" type="radio" value="${dates[
                    i
                ].getFullYear()}-${dates[i].getMonth() + 1}-${dates[
                    i
                ].getDate()}" ${checked}>

                            <span class="plan-details select-day-card">
                                <span class="plan-type"></span>
                                <span class="plan-cost"></span>
                                <div class="select-day-date">
                                    <p>${weekdays[dates[i].getDay()]}</p>
                                    <h1>${dates[i].getDate()}</h1>
                                    <p>${dates[i].toLocaleString("sv-SE", {
                    month: "long",
                })}</p>
                                </div>
                            </span>
                        </label>
                    </div>

                </label>

            </li>
            `;
            let active = "";
            if (!deliverydatadisabled && onlyoncetime) {
                active = "active show";
                onlyoncetime = false;
            }

            deliverytime += `

                <div class="${hidden} tab-pane fade ${active}" id="time-card-${weekdays[dates[i].getDay()]
                }-${dates[
                    i
                ].getDate()}${deliverydatadisabled}" role="tabpanel" aria-labelledby="time-card-${weekdays[dates[i].getDay()]
                }-${dates[i].getDate()}-tab">
                    <div class="select-time">
                        <div class="select-day-time">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="width: 100%;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-6-12-${i}-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-6-12-${i}" type="button" role="tab"
                                        aria-controls="pills-6-12-${i}" aria-selected="true">08:00 - 14:00</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-12-18-${i}-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-12-18-${i}" type="button" role="tab"
                                        aria-controls="pills-12-18-${i}" aria-selected="false">14:00 -
                                        18:00</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-18-23-${i}-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-18-23-${i}" type="button" role="tab"
                                        aria-controls="pills-18-23-${i}" aria-selected="false">18:00 -
                                        22:00</button>
                                </li>
                            </ul>

                                <div class="tab-content w-100" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-6-12-${i}" role="tabpanel"
                                        aria-labelledby="pills-6-12-${i}-tab">
                                        <div class="select-time-slot">



                                                <div class="time-slot">
                                                    <label>
                                                    <div class="flex">
                                                        <input type="radio" name="time" class="time" id="${dateformat}/08:00:00-10:00:00" required value="08:00:00-10:00:00">
                                                        <p>8:00-10:00</p>
                                                        <span></span>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div class="time-slot">
                                                    <label>
                                                    <div class="flex">
                                                        <input type="radio" name="time" class="time" id="${dateformat}/10:00:00-12:00:00" required value="10:00:00-12:00:00">
                                                        <p>10:00-12:00</p>
                                                        <span></span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="time-slot">

                                                    <label>
                                                    <div class="flex">
                                                        <input type="radio" name="time" class="time" id="${dateformat}/12:00:00-14:00:00" required value="12:00:00-14:00:00">
                                                        <p>12:00-14:00</p>
                                                        <span></span>
                                                        </div>
                                                    </label>
                                                </div>

                                        </div>
                                    </div>



                                    <div class="tab-pane fade" id="pills-12-18-${i}" role="tabpanel"
                                        aria-labelledby="pills-12-18-${i}-tab">
                                        <div class="select-time-slot">




                                                <div class="time-slot">
                                                    <label>
                                                    <div class="flex">
                                                        <input type="radio" name="time" class="time" id="${dateformat}/14:00:00-16:00:00" required value="14:00:00-16:00:00">
                                                        <p>14:00-16:00</p>
                                                        <span></span>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div class="time-slot">
                                                    <label>
                                                    <div class="flex">
                                                        <input type="radio" name="time" class="time" id="${dateformat}/16:00:00-18:00:00" required value="16:00:00-18:00:00">
                                                        <p>16:00-18:00</p>
                                                        <span></span>
                                                        </div>
                                                    </label>
                                                </div>

                                        </div>
                                    </div>



                                    <div class="tab-pane fade" id="pills-18-23-${i}" role="tabpanel"
                                        aria-labelledby="pills-18-23-${i}-tab">
                                        <div class="select-time-slot">


                                                <div class="time-slot">

                                                    <label type="radio">
                                                    <div class="flex">
                                                        <input type="radio" name="time" class="time" id="${dateformat}/18:00:00-20:00:00" required value="18:00:00-20:00:00">
                                                        <p> 18:00-20:00</p>
                                                        <span></span>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div class="time-slot">
                                                    <label>
                                                    <div class="flex">
                                                        <input type="radio" name="time" class="time" id="${dateformat}/20:00:00-22:00:00" required value="20:00:00-22:00:00">
                                                        <p>20:00-22:00</p>

                                                        <span></span>
                                                        </div>
                                                    </label>
                                                </div>



                                        </div>
                                    </div>


                                </div>


                        </div>
                    </div>
                </div>

            `;
        }

        if (deliveryDates) {
            deliveryDates.innerHTML = deliverydate;
        }

        if (deliveryTimes) {
            deliveryTimes.innerHTML = deliverytime;
        }
        let timeRanges = document.getElementsByClassName("time");
        const currentDateTime = new Date();

        for (let i = 0; i < timeRanges.length; i++) {
            const timeRange = timeRanges[i];
            const timedate = timeRange.id;
            const check = disabledtime.includes(timedate);

            if (check) {
                timeRange.setAttribute("disabled", "");
                const div = document.createElement("div");
                div.innerHTML = "inte tillgänglig";
                timeRange.parentElement.parentElement.appendChild(div);
            }
        }
    },
});

function ToggleDate(date, start_time = "00:00:00", end_time = "24:00:00") {
    let temp = null;
    $.ajax({
        url: BASE_URL + "admin/deliverytime/store",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        data: {
            date: date,
            start_time: start_time,
            end_time: end_time,
        },

        success: function (response) {

            temp = response;
        },
    });
    return temp;
}

export function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Visa kundvagnen";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Visa kundvagnen";
        moreText.style.display = "inline";
    }
}
function B_myFunction() {
    var dots = document.getElementById("dots2");
    var moreText2 = document.getElementById("more2");
    var btnText2 = document.getElementById("myBtn2");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText2.innerHTML = "";
        moreText2.style.display = "none";
        RemoveOrderMessage();
    } else {
        dots.style.display = "none";
        btnText2.innerHTML = "";
        moreText2.style.display = "inline";
    }
}
function C_myFunction() {
    var dots = document.getElementById("dots3");
    var moreText3 = document.getElementById("more3");
    var btnText3 = document.getElementById("myBtn3");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText3.innerHTML = "";
        moreText3.style.display = "none";
        RemoveRecurringDelivery();
    } else {
        dots.style.display = "none";
        btnText3.innerHTML = "";
        moreText3.style.display = "inline";
    }
}

function RecurringDelivery(cycle = "every_week") {
    $.ajax({
        url: BASE_URL + "orders/recurring_delivery",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",

        data: {
            cycle: cycle,
        },
        success: function (response) {

        },
    });
}

function RemoveRecurringDelivery() {
    $.ajax({
        url: BASE_URL + "orders/recurring_delivery/remove",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",

        success: function (response) {

        },
    });
}
function OrderMessage(message) {
    $.ajax({
        url: BASE_URL + "orders/message",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        data: {
            message: message,
        },
        success: function (response) { },
    });
}
function RemoveOrderMessage() {
    $.ajax({
        url: BASE_URL + "orders/message/remove",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",

        success: function (response) { },
    });
}
function OrderLeaveOutside() {
    $.ajax({
        url: BASE_URL + "orders/leave_outside",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        type: "POST",

        success: function (response) {

        },
    });
}

function RemoveOrderLeaveOutside() {
    $.ajax({
        url: BASE_URL + "orders/leave_outside/remove",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        type: "POST",

        success: function (response) { },
    });
}

function validate_coupon(coupon_code = null) {
    // const total = parseFloat(((document.getElementById('total').innerHTML).replace(match_string,'').replace(match_dot,'.')))
    const total = parseFloat(
        price_format(document.getElementById("total").innerHTML)
    );
    if (
        window.location.href.indexOf("checkout") != -1 ||
        window.location.href.indexOf("klarna-payment") != -1
    ) {

        $.ajax({
            url: BASE_URL + "validate_coupon",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            data: {
                code: coupon_code,
                total: total,
                mainId: mainId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },

            type: "POST",

            success: function (response) {
                console.log(response);
                console.log(response == 404);
                if (response == 404) {
                    const error = document.getElementById("error");

                    localStorage.removeItem("valid_coupon");
                    error.innerHTML = "INTE EN GILTIGT KUPONG";
                } else if (response == 400) {
                    localStorage.removeItem("valid_coupon");
                } else {
                    console.log(total);
                    console.log(response.amount);
                    const error = document.getElementById("error");

                    if (total > response.amount) {
                        let cart = JSON.parse(localStorage.getItem("cart"));
                        localStorage.setItem(
                            "valid_coupon",
                            JSON.stringify(response)
                        );



                        error.innerHTML = "GILTIGT KUPONG";
                    } else {
                        localStorage.removeItem("valid_coupon");
                        // window.location.reload();
                    }
                }

                GetCartProductFromCache();
            },
        });
    }
}

validate_coupon();

const coupon = document.getElementById("coupon");
if (coupon) {
    coupon.addEventListener("change", function () {
        validate_coupon(coupon.value);
    });
}
let validated_coupon = JSON.parse(localStorage.getItem("valid_coupon"));
if (validated_coupon) {
    validate_coupon(validated_coupon.code);
}
const checkout_recurring_delivery = document.getElementById(
    "checkout_recurring_delivery"
);
if (checkout_recurring_delivery) {
    const weekly = document.getElementById("every_week");
    const biweekly = document.getElementById("bi_weekly");

    weekly.addEventListener("click", function () {
        RecurringDelivery("every_week");
        UpdateKlarnaToSubscription("WEEK", 1);
    });
    biweekly.addEventListener("click", function () {
        RecurringDelivery("bi_weekly");

        UpdateKlarnaToSubscription("WEEK", 2);
    });
}

const checkout_message_toggle = document.getElementsByClassName(
    "checkout_message_toggle"
)[0];
if (checkout_message_toggle) {
    const checkout_message = document.getElementById("checkout_message");
    checkout_message.addEventListener("change", function () {
        OrderMessage(checkout_message.value);
    });
}
//
const checkout_leave_outside = document.getElementById(
    "checkout_leave_outside"
);

if (checkout_leave_outside) {
    checkout_leave_outside.addEventListener("change", function () {
        if ($("#checkout_leave_outside").is(":visible")) {
            OrderLeaveOutside();
        } else {
            RemoveOrderLeaveOutside();
        }
    });
}
let currentRequest = null;

function GetSessionData(data) {
    let search_dropdown = $("#drop-down-box");
    let cart = JSON.parse(localStorage.getItem("cart"));

    // new_data = JSON.parse(response);
    let totalquantity = 0;
    let searchPreview = document.getElementById("search-preview-cards");
    if (searchPreview) {
    }

    searchPreview.innerHTML = "";
    for (let i = 0; i < data.length; i++) {
        let all_products = [];
        for (let item of cart) {
            for (let product of item.products) {
                all_products.push(product);
            }
        }

        let findExisting = all_products.find(
            (product) => product.item_id == data[i].id
        );

        let div = document.createElement("div");
        div.setAttribute("data-tax", data[i].tax)
        div.classList.add(
            "custom-row",
            "row",
            "header-search-item",
            "m-0",
            "items-center"
        );

        div.id = data[i].id;
        div.classList.add(data[i].id);
        let div1 = document.createElement("div");
        div1.classList.add("col-2", "ps-2", "pe-0");
        let img = document.createElement("img");
        img.src = data[i].image;
        img.classList.add(
            "w-full",
            "min-w-[40px]",
            "search-img",
            "product-image"
        );
        div1.appendChild(img);
        div.appendChild(div1);
        let div2 = document.createElement("div");
        div2.classList.add("col-6", "pe-0");
        let h4 = document.createElement("h4");
        h4.classList.add(
            "text-dark",
            "text-sm",
            "sm:text-lg",
            "pt-2",
            "text-primary",
            "cursor-pointer",
            "product-name"
        );
        h4.setAttribute("data-bs-toggle", "modal");
        h4.setAttribute("data-bs-target", "#data-" + data[i].id);
        h4.innerHTML = data[i].name;
        div2.appendChild(h4);
        let p = document.createElement("p");
        p.classList.add("text-xs", "sm:text-sm");
        let a1 = document.createElement("a");
        let a2 = document.createElement("a");
        let a3 = document.createElement("a");
        a1.href = BASE_URL + "product/category?category=" + data[i].category_id;
        a1.classList.add("product-category");
        a1.innerHTML = data[i].category + " /";
        a2.href = BASE_URL + "product/sub_cat/" + data[i].sub_category_id;
        a2.innerHTML = data[i].sub_category + " /";
        a3.href = BASE_URL + "product/subsub_cat/" + data[i].subsub_category_id;
        a3.innerHTML = data[i].subsub_category;

        p.appendChild(a1);
        p.appendChild(a2);
        p.appendChild(a3);
        let pricediv = document.createElement("div");
        pricediv.classList.add("flex", "gap-2");
        let p1 = document.createElement("p");

        let p2 = document.createElement("p");
        p1.classList.add("product-real-price", "real-price", "no-underline");
        p2.classList.add(
            "product-discount-price",
            "discount-price",
            "text-[#007033]"
        );

        if (data[i].discount_price !== null) {
            if (data[i].buy_two_for) {
                p1.classList.add("text-sm", "font-bold");
                if (findExisting && findExisting.quantity > 1) {
                    p1.classList.remove("no-underline");
                } else {
                    p2.classList.add("hidden");
                }
            } else {
                p1.classList.remove("no-underline");
                p1.classList.add("text-sm", "font-bold");
            }
            p2.innerHTML = data[i].discount_price + ":-";
        } else {
            p1.classList.add("text-sm", "font-bold");
        }
        p2.classList.add("text-sm", "font-bold");
        p1.innerHTML = data[i].price + ":-";

        div2.appendChild(p);
        pricediv.appendChild(p1);
        pricediv.appendChild(p2);
        div2.appendChild(pricediv);

        div.appendChild(div2);

        let div3 = document.createElement("div");
        div3.classList.add(
            "col-4",
            "d-flex",
            "justify-content-end",
            "items-center",
            "px-1"
        );
        let div4 = document.createElement("div");
        div4.classList.add(
            "row",
            "justify-between",
            "card-counter-div",
            "card-counter",
            "bg-white",
            "items-center",
            "h-fit",
            "flex-nowrap",
            "m-0.5",
            "max-w-[150px]"
        );
        if (data[i].buy_two_for) {
            div4.classList.add("buy_two_for");
            div4.classList.add("buy_two_for_compare");
        }
        let button = document.createElement("div");
        let input = document.createElement("input");
        input.classList.add("card-quantity-div");
        let button1 = document.createElement("div");
        button.addEventListener("click", function (e) {
            e.preventDefault();
            this.nextElementSibling.value = parseInt(
                this.nextElementSibling.value
            );
            handleClick(RemoveQuantity, this);
        });
        button1.addEventListener("click", function (e) {
            e.preventDefault();
            this.previousElementSibling.value =
                parseInt(this.previousElementSibling.value) + 1;
            console.log("maa goo");
            handleClick(AddQuantity, this);
        });
        input.readOnly = true;
        let i1 = document.createElement("i");
        let i2 = document.createElement("i");
        i1.classList.add(
            "bi",
            "bi-plus-circle-fill",
            "plus",
            "cursor-pointer",
            "text-xl",

            "sm:text-2xl",

            "text-[#007033]"
        );
        i2.classList.add(
            "bi",
            "bi-dash-circle-fill",
            "minus",
            "text-xl",
            "cursor-pointer",
            "sm:text-2xl",

            "text-[#007033]"
        );
        // let array = isInArray(data[i].id, new_data)
        if (findExisting) {
            div4.classList.remove("bg-white");
            button.classList.add(
                "ms-0",
                "flex",
                "justify-center",
                "items-center",
                "w-6",
                "h-6",
                "sm:w-8",
                "sm:h-8",
                "card-minus-div"
            );
            input.classList.add(
                "form-control",
                "form-control-sm",
                "w-25",
                "px-0",
                "text-center",
                "bg-transparent",
                "quantity"
            );
            button1.classList.add(
                "flex",
                "justify-center",
                "items-center",
                "w-6",
                "h-6",
                "sm:w-8",
                "sm:h-8",
                "rounded-circle",
                "card-plus-div"
            );
            input.value = findExisting.quantity;
            totalquantity =
                parseFloat(totalquantity) + parseFloat(findExisting.quantity);
        } else {
            div4.classList.add("bg-white");
            button.classList.add(
                "ms-0",
                "flex",
                "justify-center",
                "items-center",
                "w-6",
                "h-6",
                "sm:w-8",
                "sm:h-8",
                "card-minus-div",
                "hidden"
            );
            input.classList.add(
                "form-control",
                "form-control-sm",
                "w-25",
                "px-0",
                "bg-transparent",
                "text-center",
                "quantity",
                "hidden"
            );
            button1.classList.add(
                "flex",
                "justify-center",
                "items-center",
                "w-6",
                "h-6",
                "sm:w-8",
                "sm:h-8",
                "rounded-circle",
                "card-plus-div"
            );
            input.value = 0;
        }
        if (data[i].pant) {
            let pantp = document.createElement("p");
            let pantspan = document.createElement("span");
            pantspan.innerHTML = data[i].pant;
            pantspan.classList.add("pant", "hidden");
            pantp.innerHTML = "+pant";
            pantp.classList.add("text-sm");
            pantp.append(pantspan);
            div2.appendChild(pantp);
        }
        // TotalCartCount(totalquantity)

        button1.appendChild(i1);
        button.appendChild(i2);
        div4.appendChild(button);
        div4.appendChild(input);
        div4.appendChild(button1);
        div3.appendChild(div4);
        div.appendChild(div3);
        let hr = document.createElement("hr");
        div.appendChild(hr);
        let div5 = document.createElement("div");
        div5.appendChild(div);
        search_dropdown.append(div5);

        let origin = "";
        if (data[i].origin) {
            origin = `<div class="product-country">
                        <i class="bi bi-globe"></i>

                        <div class="country-info">
                            <p>Ursprung</p>
                            <h3>${data[i].origin}</h3>
                        </div>
                    </div>`;
        }
        let modal = document.getElementById("data-" + data[i].id);

        if (!modal) {
            let preview = previewModel(data[i], "data");

            let searchPreview = document.getElementById("search-preview-cards");
            if (searchPreview) {
                searchPreview.innerHTML += preview;
            }
        }
    }
    search_dropdown.show();
}

function TotalCartPrice(price) {
    let cartItemBtnPrices = document.getElementsByClassName(
        "cart-total-price-overview"
    );

    for (let i = 0; i < cartItemBtnPrices.length; i++) {
        const cartItemBtnPrice = cartItemBtnPrices[i];
        if (price <= 0) {
            cartItemBtnPrice.classList.add("hidden");
        } else {
            cartItemBtnPrice.classList.remove("hidden");
            cartItemBtnPrice.innerHTML = price_display_format(price);
        }
    }
}
function TotalCartCount(qty) {
    let cartItemBtns = document.getElementsByClassName("cart-item-amount");
    let cartItemTotalCount = document.getElementById("cart-items-count");

    for (let i = 0; i < cartItemBtns.length; i++) {
        const cartItemBtn = cartItemBtns[i];
        if (qty <= 0) {
            cartItemBtn.classList.add("hidden");
        } else {
            cartItemBtn.classList.remove("hidden");
            cartItemBtn.innerHTML = qty;
        }
    }

    if (cartItemTotalCount) {
        if (qty <= 0) {
            cartItemTotalCount.innerHTML = 0;
            if (document.getElementById("cdp-bar")) {
                document.getElementById("cdp-bar").style.width = 0 + "%";
            }
            if (document.getElementById("p-bar")) {
                document.getElementById("p-bar").style.width = 0 + "%";
            }
            let counter = document.getElementById("counter");
            if (counter) {
                counter.innerHTML = 'Handla för 1500 till';
            }
        } else {
            cartItemTotalCount.innerHTML = qty;
        }
    }
}

function isInArray(value, array) {
    if (array.length == 0) {
        return false;
    } else {
        for (let i = 0; i < array.length; i++) {
            if (array[i][0] === value) {
                return array[i][1];
            }
        }
    }
    return false;
}

$(document).ready(function () {
    if (document.getElementById("total")) {
        GetCartProductFromCache();
    }
    GetProducts();
    let search_dropdown = $("#drop-down-box");
    $(document).on("click", function (event) {
        if (
            !search_dropdown.is(event.target) &&
            search_dropdown.has(event.target).length === 0
        ) {
            search_dropdown.hide();
            lightbg();
            $("#body").removeClass("overflow-auto");
        }
    });

    $("#SearchInput").on(
        "input",
        debounce(function () {
            let search = $(this).val().toLowerCase();
            if (search.length == 0) {
                search_dropdown.hide();
                lightbg();
            } else {
                search_dropdown.empty();
                Search(search);
            }
        })
    );
});

let pageId = document.getElementById("page-id");
if (pageId) {
    pageId = pageId.value;
} else {
    pageId = "";
}
let PageModal = document.getElementById("all-preview-modals");

const categoriesPageItems = document.getElementsByClassName(
    "category-page-items"
)[0];

function CategoryAjax(
    url,
    pageItems,
    classes = "card-box col-xxl-2 col-xl-2  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
) {
    $.ajax({
        url: url + pageId,
        type: "GET",
        data: {
            mainId: mainId,
            sortby: home_sortby
        },
        success: function (new_data) {
            // const loadMore = document.getElementsByClassName("LoadMore")[0];
            const loadMore = $(".LoadMore");
            if (loadMore) {
                if (new_data.length < 24) {
                    // loadMore.classList.add("hidden");
                    loadMore.addClass("hidden");
                } else {
                    // loadMore.classList.remove("hidden");
                    loadMore.removeClass("hidden");
                }
            }
            new_data.forEach((item, index) => {
                let cardContent = card(item, "data", classes);
                let cardModal = previewModel(item, "data");

                pageItems.innerHTML += cardContent;
                // pageItems.appendChild(cardContent)
                PageModal.innerHTML += cardModal;
            });
            $("#body").addClass("loaded");
        },
    });
}
function CategoryAjax2(
    url,
    pageItems,
    classes = "card-box col-xxl-2 col-xl-2  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
) {
    $.ajax({
        url: url + pageId,
        type: "GET",
        data: {
            mainId: mainId,
            sortby: home_sortby
        },
        success: function (new_data) {
            // const loadMore = document.getElementsByClassName("LoadMore")[0];
            const loadMore = $(".LoadMore");
            if (loadMore) {
                if (new_data.length < 24) {
                    // loadMore.classList.add("hidden");
                    loadMore.addClass("hidden");
                } else {
                    // loadMore.classList.remove("hidden");
                    loadMore.removeClass("hidden");
                }
            }
            let home_catagorie_section = document.getElementsByClassName("home-catagorie-section")[0];
            if (home_catagorie_section) {
                let html = '';
                (new_data.categories).forEach(cat => {
                    html += `<a data-category-id="${cat.id}" class="home-category-btn Categories-btn">${cat.name} <i
                                class="bi bi-chevron-right"></i></a>`;
                })
                home_catagorie_section.innerHTML = html;
            }
            Array.from(home_catagorie_section.getElementsByClassName('home-category-btn')).forEach(button => {
                button.addEventListener("click", () => {
                    let data_category_id = button.getAttribute("data-category-id");

                    let url = BASE_URL + "api/home/home-category/"
                    let data = {
                        sortby: home_sortby,
                        category_id: data_category_id
                    }
                    update_home_products(url, data);
                    main_category_id = data_category_id;
                    let my_home_breadcrumb = document.getElementById("my_home_breadcrumb");
                    if (my_home_breadcrumb) {
                        my_home_breadcrumb.style.display = "block";
                        let my_home_breadcrumb_container = my_home_breadcrumb.getElementsByClassName("my_home_breadcrumb_container")[0];
                        my_home_breadcrumb_container.innerHTML = `

<li class="inline-flex items-center">
                    <a href="/"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Hem
                    </a>
                </li>
                <li>
                    <div class="flex items-center cursor-pointer">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a data-category-id="${main_category_id}" class="home-category-btn ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">${button.textContent}</a>
                    </div>
                </li>
                        `;
                        Array.from(my_home_breadcrumb_container.getElementsByClassName("home-category-btn")).forEach(ele => {
                            ele.addEventListener("click", () => {
                                let data_category_id = ele.getAttribute("data-category-id");

                                let url = BASE_URL + "api/home/home-category/"
                                let data = {
                                    sortby: home_sortby,
                                    category_id: data_category_id
                                }
                                update_home_products(url, data);
                                main_sub_category_id = null;
                                main_sub_sub_category_id = null;
                            })
                        })


                    }
                })
            })
            Array.from(new_data.formated_data).forEach((item, index) => {
                let cardContent = card(item, "data", classes);
                let cardModal = previewModel(item, "data");

                pageItems.innerHTML += cardContent;
                // pageItems.appendChild(cardContent)
                PageModal.innerHTML += cardModal;
            });
            $("#body").addClass("loaded");
        },
    });
}
const categoryModal = document.getElementById("category-modal");
if (categoriesPageItems) {
    const url = BASE_URL + "api/category/";
    CategoryAjax(
        url,
        categoriesPageItems,
        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
    );
}

const favourites = document.getElementById("favourite-cards");

if (favourites) {
    let url = BASE_URL + "api/favourites";
    CategoryAjax(url, favourites);
    console.log(url);
    favourites.addEventListener("click", function (e) {
        if (e.target && e.target.className == "bi bi-heart-fill likebtn") {
            e.target.parentElement.parentElement.parentElement.parentElement.style.display =
                "None";
        }
    });
}

const offers = document.getElementById("extrapriser-cards");
const home_offer = document.getElementById("home-extrapriser-cards");
if (home_offer) {
    let url = BASE_URL + "api/home/home-category";
    let css_class = "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6";
    CategoryAjax2(url, home_offer, css_class)
}
if (offers) {
    let url = BASE_URL + "api/offer";
    if (offers.classList.contains("home-category-page-items")) {
        let css_class = "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6";
        CategoryAjax(url, offers, css_class);
    }
    else {
        CategoryAjax(url, offers);
    }
}
const homeVeckans = document.getElementById("veckans-extrapriser-cards-home");
if (homeVeckans) {

    $.ajax({
        url: BASE_URL + "api/veckans-extrapriser",
        type: "GET",
        data: {
            mainId: mainId
        },
        headers: {
            "X-XSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (new_data) {

            new_data.forEach((item, index) => {
                let cardContent = card(
                    item,
                    "data",
                    "col-lg-12 col-md-12 col-sm-12",
                    true
                );

                const owl = $(".card-slides2").trigger("add.owl.carousel", [
                    cardContent,
                ]);
                let modal = document.getElementById("data-" + item.item_id);
                if (!modal) {
                    let cardModal = previewModel(item, "data");
                    PageModal.innerHTML += cardModal;
                }
            });
            owlCarousel2.trigger("refresh.owl.carousel");
        },
    });

}
const home_category = document.getElementById("home-category");
if (home_category) {
    let url = BASE_URL + "api/"
}
const veckans = document.getElementById("veckans-extrapriser-cards");
if (veckans) {
    let url = BASE_URL + "api/veckans-extrapriser";
    CategoryAjax(url, veckans);
}

const subCategoriesPageItems = document.getElementById("sub-category");
if (subCategoriesPageItems) {
    let url = BASE_URL + "api/sub_category/";
    CategoryAjax(
        url,
        subCategoriesPageItems,
        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
    );
}
const subSubCategoriesPageItems = document.getElementById("subsub_category");
if (subSubCategoriesPageItems) {
    let url = BASE_URL + "api/subsub_category/";
    CategoryAjax(
        url,
        subSubCategoriesPageItems,
        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
    );
}

const search = document.getElementById("search");
if (search) {
    let url = BASE_URL + "api/search/";
    CategoryAjax(url, search);
}

const homeExtrapriser = document.getElementById("home-extrapriser");
const homeAll = document.getElementById("home-all");
let homeExtrapriserModal = document.getElementById("home-extrapriser-modal");
const owl = document.getElementsByClassName("card-slides");
// const discount_sortby = document.getElementById("discount_sortby").value;

if (homeExtrapriser) {
    $.ajax({
        url: BASE_URL + "api/home",
        type: "GET",
        data: {
            mainId: mainId,
            sortby: home_sortby
        },
        headers: {
            "X-XSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (new_data) {

            const loadMore = document.getElementsByClassName("LoadMore")[0];
            if (loadMore) {
                if (new_data.length < 24) {
                    loadMore.classList.add("hidden");
                } else {
                    loadMore.classList.remove("hidden");
                }
            }

            new_data.forEach((item, index) => {
                let cardContent = card(
                    item,
                    "data",
                    "card-box col-xxl-2 col-xl-2  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
                );
                let cardModal = previewModel(item, "data");

                homeAll.innerHTML += cardContent;
                PageModal.innerHTML += cardModal;
            });
        },
    });

    $.ajax({
        url: BASE_URL + "api/home-extrapriser",
        type: "GET",
        data: {
            mainId: mainId
        },
        headers: {
            "X-XSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (new_data) {
            // let allContent =
            new_data.forEach((item, index) => {
                if (price_format(item.discount_price) > 0) {
                    let cardContent = card(
                        item,
                        "data",
                        "col-lg-12 col-md-12 col-sm-12",
                        true
                    );

                    const owl = $(".card-slides").trigger("add.owl.carousel", [
                        cardContent,
                    ]);
                    let modal = document.getElementById("data-" + item.item_id);
                    if (!modal) {
                        let cardModal = previewModel(item, "data");
                        PageModal.innerHTML += cardModal;
                    }
                }
            });
            owlCarousel.trigger("refresh.owl.carousel");

            $("#body").addClass("loaded");
        },
    });
}


$(document).ready(function () {
    var offset = 24;
    $("#loadMore").click(function () {
        $.ajax({
            url: BASE_URL + "api/load-more-products/" + offset,
            type: "GET",
            data: {
                sortby: home_sortby
            },
            dataType: "json",
            success: function (response) {
                var products = response;
                if (products.length < 24) {
                    $("#loadMore").hide();
                }
                let html = "";
                let modalContent = "";
                products.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-2 col-xl-2  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;
                });
                $("#home-all").append(html);
                $("#all-preview-modals").append(modalContent);
                offset += 24;
            },
            error: function (response) {

            },
        });
    });
});

const sidenavmenu = document.getElementsByClassName("side-nav-menu");
jQuery(".sidenav-first").on("click", function () {
    $(this).parent().addClass("main-mobile-nav");
    $(this).next().addClass("first-selected-nav");
    $(this).next().show();
    if (sidenavmenu) {
        $(sidenavmenu[0]).scrollTop(0);
    }
});

jQuery(".sidenav-second").on("click", function () {
    $(this).parent().addClass("main-mobile-nav");
    $(this).next().addClass("second-selected-nav");
    $(this).next().show();
    if (sidenavmenu) {
        $(sidenavmenu[0]).scrollTop(0);
    }
});

jQuery(".first-previous-nav").on("click", function () {
    $(this).parent().removeClass("first-selected-nav");
    $(this).parent().parent().removeClass("main-mobile-nav");
    $(this).parent().hide();
    if (sidenavmenu) {
        $(sidenavmenu[0]).scrollTop(0);
    }
});

jQuery(".second-previous-nav").on("click", function () {
    $(this).parent().removeClass("first-selected-nav");
    $(this).parent().parent().removeClass("main-mobile-nav");
    $(this).parent().hide();
    if (sidenavmenu) {
        $(sidenavmenu[0]).scrollTop(0);
    }
});

function isObjectEmpty(obj) {
    return Object.keys(obj).length === 0;
}

const Mainbody = document.getElementById("body");
if (Mainbody) {
    if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", "[]");
    }
    Mainbody.addEventListener("click", function (e) {
        if (e.target && e.target.className == "bi bi-dash-circle-fill minus") {
            let parentElement = e.target.parentElement.parentElement;
            let quantity =
                parentElement.getElementsByClassName("card-quantity-div")[0];
            let minus = e.target.parentElement;
            let plus = parentElement.getElementsByClassName("card-plus-div")[0];
            let firstbtn = parentElement.getElementsByClassName("first-btn")[0];

            if (quantity.value < 2) {
                quantity.value = 0;
                handleClick(RemoveQuantity, minus);
                minus.classList.add("hidden");
                quantity.classList.add("hidden");
                plus.classList.add("hidden");
                if (firstbtn) firstbtn.classList.remove("hidden");
                parentElement.style.backgroundColor = "white";
                parentElement.style.justifyContent = "flex-end";
            } else {
                handleClick(RemoveQuantity, minus);
            }
        } else if (
            e.target &&
            e.target.className == "bi bi-plus-circle-fill plus"
        ) {
            let parentElement = e.target.parentElement.parentElement;
            let quantity =
                parentElement.getElementsByClassName("card-quantity-div")[0];

            let plus = e.target.parentElement;
            let minus =
                parentElement.getElementsByClassName("card-minus-div")[0];
            let firstbtn = parentElement.getElementsByClassName("first-btn")[0];

            quantity.value = parseInt(quantity.value) + 1;

            parentElement.style.justifyContent = "space-between";

            handleClick(AddQuantity, plus);
            if (minus.classList.contains("hidden")) {
                minus.classList.remove("hidden");
                parentElement.style.backgroundColor = "rgb(232, 232, 232)";
            }
            if (quantity.classList.contains("hidden")) {
                quantity.classList.remove("hidden");
            }
        } else if (
            e.target &&
            !isObjectEmpty(e.target.className) &&
            e.target.className.trim() == "first-btn"
        ) {
            let parentElement = e.target.parentElement;
            let quantity =
                parentElement.getElementsByClassName("card-quantity-div")[0];
            let firstbtn = e.target;
            let plus = parentElement.getElementsByClassName("card-plus-div")[0];
            let minus = parentElement.getElementsByClassName("card-minus-div")[0];

            parentElement.style.justifyContent = "space-between";
            quantity.value = 1;

            handleClick(AddQuantity, plus);

            if (minus.classList.contains("hidden")) {
                minus.classList.remove("hidden");
                firstbtn.classList.add("hidden");
                parentElement.style.backgroundColor = "rgb(232, 232, 232)";
                plus.classList.remove("hidden");
            }
            if (quantity.classList.contains("hidden")) {
                quantity.classList.remove("hidden");
            }

            // }
        } else if (e.target && e.target.id == "likebtn") {
            // ---------like-btn favourite---------
            var likeBtn = e.target;

            // for (let i = 0; i < likeBtns.length; i++) {
            //     const likeBtn = likeBtns[i];
            const product = likeBtn.parentNode.parentNode.parentNode;
            const product_id = product.id;
            const productLike = document.getElementsByClassName(
                "likebtn-" + product_id
            );

            if (likeBtn.style.color == "red") {
                if (productLike) {
                    for (let i = 0; i < productLike.length; i++) {
                        const element = productLike[i];
                        element.style.color = "#E0E0E0";
                    }
                }
                $.ajax({
                    url: BASE_URL + "api/favourites/delete/" + product_id,
                    type: "GET",
                    headers: {
                        "X-XSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: {},
                    success: function (data) {
                        if (data == 401) {
                            console.log(401);
                            console.log(data);
                            // window.location.replace(BASE_URL+"login");
                        } else {
                            //
                        }
                        $("#body").addClass("loaded");
                    },
                    error: function () {
                        // window.location.replace(BASE_URL+"login");
                    },
                });
            } else {
                $.ajax({
                    url: BASE_URL + "api/favourites/store/" + product_id,
                    type: "GET",
                    headers: {
                        "X-XSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: {},
                    success: function (data) {
                        if (data == 401) {
                            console.log(401);
                            console.log(data);
                            // window.location.replace(BASE_URL+"login");
                        } else {
                            //
                        }
                        $("#body").addClass("loaded");
                    },
                    error: function () {
                        // window.location.replace(BASE_URL+"login");
                    },
                });
                if (productLike) {
                    for (let i = 0; i < productLike.length; i++) {
                        const element = productLike[i];
                        element.style.color = "red";
                    }
                }
            }
        }
    });
}

$(document).ajaxComplete(function () {
    const q1Editor = document.getElementsByClassName("ql-editor");

    for (let i = 0; i < q1Editor.length; i++) {
        const element = q1Editor[i];
        element.setAttribute("contenteditable", "false");
    }

    const qlClipboard = document.getElementsByClassName("ql-clipboard");
    for (let i = 0; i < qlClipboard.length; i++) {
        const element = qlClipboard[i];
        element.classList.add("hidden");
    }

    const qlTooltip = document.getElementsByClassName("ql-tooltip");
    for (let i = 0; i < qlTooltip.length; i++) {
        const element = qlTooltip[i];
        element.classList.add("hidden");
    }
});

if (localStorage.getItem("postcode")) {
    if (document.getElementById("post-number-btn")) {
        document.getElementById("post-number-btn").innerHTML =
            "Hemleverans till : " + localStorage.getItem("postcode") + "";
        document.getElementById("reserve-time-btn").classList.remove("hidden");
    }
}

if (mainId) {

    if (!localStorage.getItem("postcode")) {
        $.ajax({
            url: BASE_URL + "postcode/" + mainId,
            type: "GET",

            success: function (data) {

                if (data != 404) {
                    localStorage.setItem("postcode", data);
                    if (document.getElementById("post-number-btn")) {
                        document.getElementById("post-number-btn").innerHTML =
                            "Hemleverans till : " + data + "";
                        document
                            .getElementById("reserve-time-btn")
                            .classList.remove("hidden");
                    }
                }
            },
        });
    }
}


// postcode_add
let postcode_form = document.getElementById("postcode_add");
if (postcode_form) {
    postcode_form.addEventListener("submit", function (e) {
        e.preventDefault();
        const data = new FormData(postcode_form);
        //   console.log(data)
        let postcode = {};
        data.forEach(function (value, key) {
            postcode[key] = value;
        });

        $.ajax({
            url: BASE_URL + "postcode",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": postcode._token,
            },
            data: postcode,
            success: function (data) {

                if (data != 404) {
                    GetPostCodeSession();
                    document.getElementById("reserve-time-btn").click();

                } else {
                    document
                        .getElementById("postcode_error")
                        .classList.remove("hidden");

                    $("#input-code").hide();
                    $("#exampleModalToggle").modal("show");
                    sessionStorage.setItem("postcode", postcode);
                }
            },
        });
    });
}

// https://livsham.softwarebyte.co/deliverytime
let checkout_redirect = false;
let delivery_time = document.getElementById("delivery-time");
if (delivery_time) {
    delivery_time.addEventListener("submit", async function (e) {
        e.preventDefault();
        const data = new FormData(delivery_time);
        //   console.log(data)
        let delivery_datetime = {};
        data.forEach(function (value, key) {
            delivery_datetime[key] = value;
        });

        let res1 = await $.ajax({
            type: "GET",
            url: BASE_URL + "api/get-session-data/postcode",
        })

        if (res1.length < 1) {

            document.getElementById("post-number-btn").click();
            return;
        }
        else {
            $.ajax({
                url: BASE_URL + "deliverytime",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": delivery_datetime._token,
                },
                data: delivery_datetime,
                success: function (data) {

                    GetDeliveryTimeSession();
                    if (checkout_redirect) {
                        ta
                        window.location.replace(BASE_URL + "checkout");
                    }
                    let checkout_redirect_cache = JSON.parse(localStorage.getItem("checkout_redirect"))
                    if (checkout_redirect_cache) {
                        window.location.replace(BASE_URL + "checkout");
                        localStorage.setItem("checkout_redirect", false);
                    }
                },
            });

        }

    });
}
// function validCheckoutSession(){
if (window.location.href.indexOf("checkout") > -1) {
    let cart = JSON.parse(localStorage.getItem("cart"));

    if (!cart.length) {
        window.location.replace(BASE_URL + "");
        // alert('Vänligen ange varor i kundvagnen innan du går vidare till kassan');
        // generateModal('Vänligen ange varor i kundvagnen innan du går vidare till kassan')
        // alert(cart.length)
    }
}
// }

let cartOffCanvas = document.getElementById("cart");
$(cartOffCanvas).on('show.bs.offcanvas', function (event) {
    const cartItems = JSON.parse(localStorage.getItem("cart"));
    const productItems = cartItems.reduce((acc, category) => {
        return acc.concat(category.products.map(product => product));
    }, []);

    $.ajax({
        url: BASE_URL + 'check-cart-items',
        method: "POST",
        data: { items: productItems },
        success: function (response) {
            let show_update_alert = false;
            if (response.out_of_stock.length > 0) {
                show_update_alert = true;
            }
            if (response.price_changed) {
                show_update_alert = true;

                Object.keys(cartItems).forEach(function (_key) {
                    let _category = cartItems[_key];
                    Object.keys(_category.products).forEach(function (__key) {
                        let productInCart = cartItems[_key].products[__key]
                        const productInfo = response.products.find(product => product.id == productInCart.item_id);
                        if (productInfo) {
                            productInCart.item_name = productInfo.name;
                            productInCart.item_price = productInfo.price;
                            productInCart.item_sale_price = productInfo.sale_price;
                            productInCart.tax = productInfo.tax;
                            productInCart.pant = Number(productInfo.pant); // Assuming pant is a number
                            productInCart.buy_two = Boolean(productInfo.buy_two); // Assuming buy_two is a boolean

                            cartItems[_key].products[__key] = productInCart;
                        }
                    });
                });

            }
            if (show_update_alert) {
                $('#change_alert').modal('show');
            }
            localStorage.setItem("cart", JSON.stringify(cartItems));
            GetCartProductFromCache();
        }
    });


});

let checkout = document.getElementById("checkout");

if (checkout) {

    let try_once_in_checkout = true;
    let cart_change_alert2 = false;
    localStorage.setItem("reload", false);
    checkout.addEventListener("click", async function (e) {
        checkout_redirect = true;
        e.preventDefault();
        if (!mainId) {
            $('#loginModal').modal('show');
            localStorage.setItem("checkout_redirect", true);
            return false;
        }

        let cartItems = JSON.parse(localStorage.getItem("cart"));

        if (cartItems.length > 0) {
            // Collect all product IDs to fetch in one request
            let productIds = [];
            cartItems.forEach(category => {
                category.products.forEach(product => {
                    productIds.push(product.item_id);
                });
            });

            // Fetch all product details in one request
            // try {
            let response = await $.ajax({
                url: BASE_URL + "api/get-products-for-checkout",
                type: "GET",
                data: { ids: productIds },
                contentType: "application/json",
                dataType: "json"
            });

            // let fetchedDataMap = new Map();
            // response.data.forEach(productData => {
            //     fetchedDataMap.set(productData.item_id, productData);
            // });

            let fetchedDataMap = Object.values(response.data[0]);
            if (fetchedDataMap.length > 0) {
                cartItems.forEach((category, cartIndex) => {
                    category.products.forEach(product => {
                        let fetchedData = fetchedDataMap.find(item => item.id == product.item_id);

                        if (fetchedData) {
                            if (fetchedData.buy_two && product.buy_two != fetchedData.buy_two) {
                                cart_change_alert2 = true;
                                product.buy_two = fetchedData.buy_two;
                            }
                            if (fetchedData.category && category.category != fetchedData.category) {
                                cart_change_alert2 = true;
                                category.category = fetchedData.category;
                            }
                            if (fetchedData.category && product.category != fetchedData.category) {
                                cart_change_alert2 = true;
                                product.category = fetchedData.category;
                            }
                            if (fetchedData.image && product.image != fetchedData.image) {
                                cart_change_alert2 = true;
                                product.image = fetchedData.image;
                            }
                            if (fetchedData.name && product.item_name != fetchedData.name) {
                                cart_change_alert2 = true;
                                product.item_name = fetchedData.name;
                            }
                            if (fetchedData.price && product.item_price != fetchedData.price) {
                                cart_change_alert2 = true;
                                product.item_price = fetchedData.price;
                            }
                            if (fetchedData.discount_price && product.item_sale_price != fetchedData.discount_price.toString()) {
                                cart_change_alert2 = true;
                                product.item_sale_price = fetchedData.discount_price.toString();
                            }
                            if (fetchedData.tax && product.tax != fetchedData.tax) {
                                cart_change_alert2 = true;
                                product.tax = fetchedData.tax;
                            }
                            localStorage.setItem("cart", JSON.stringify(cartItems));
                            checkout_redirect = true;
                        } else {

                            removeItemFromCart2(product.item_id, category.category);
                            cartItems = JSON.parse(localStorage.getItem("cart"));
                            checkout_redirect = true;
                            cart_change_alert2 = true;

                        }
                    });
                });
            }
            else {
                cartItems = [];
                localStorage.setItem("reload", true);
                checkout_redirect = false;
                cart_change_alert2 = true;

            }
            // localStorage.setItem("cart", JSON.stringify(cartItems));
            if (cartItems && cartItems[0] && cartItems[0].length < 1) {
                localStorage.removeItem("cart");
                checkout_redirect = false;
                // cart_change_alert2 = true;
            } else {
                // cart_change_alert2 = true;
                localStorage.setItem("cart", JSON.stringify(cartItems));
            }
            // } catch (error) {

            //     console.error("Error fetching product data:", error);
            // }
        } else {
            cart_change_alert2 = false;
            localStorage.setItem("reload", false);
            checkout_redirect = false;
        }

        if (cart_change_alert2 && try_once_in_checkout) {

            // await showModalAndWait(cartItems);

            if (JSON.parse(localStorage.getItem("reload"))) {
                localStorage.setItem("reload", false);
                window.location.reload();
                return
            }
            cart_change_alert2 = false;
            try_once_in_checkout = false;
        }

        let res1 = await $.ajax({
            type: "GET",
            url: BASE_URL + "api/get-session-data/postcode",
        })

        if (res1.length < 1) {
            document.getElementById("post-number-btn").click();
            return;
        }


        let delivery_time = JSON.parse(
            localStorage.getItem("delivery_datetime")
        );
        let postnumber = JSON.parse(
            JSON.stringify(localStorage.getItem("postcode"))
        );
        let my_return = false;
        if (postnumber) {

            let response = await $.ajax({
                type: "GET",
                url: BASE_URL + "api/find/postcode/" + postnumber,
                async: true,

            })
            if (response.length < 1) {
                document.getElementById("post-number-btn").click();
                if (document.getElementById("postcode_error")) {
                    document.getElementById("postcode_error").classList.remove("hidden");
                }
                if (document.getElementsByClassName("post_title")[0]) {
                    document.getElementsByClassName("post_title")[0].innerText = "Ange ett nytt postnummer";
                }
                if (document.getElementsByClassName("post_details")[0]) {
                    document.getElementsByClassName("post_details")[0].style.display = "none";
                }
                if (document.getElementById("postcode_error")) {
                    document.getElementById("postcode_error").innerText = "Vi kan tyvärr inte leverera till ditt angivna postnummer. Vänligen prova ett nytt postnummer för hemleverans..";
                }
                my_return = true;
                $("#postcode_add").on("submit", function () {

                    const delivery_number_pattern = /\d/;
                    let delivery_time_button = document.getElementById("reserve-time-btn").textContent;
                    if (delivery_time_button && !delivery_number_pattern.test(delivery_time_button)) {
                        document.getElementById("reserve-time-btn").click();
                        return;
                    }
                })
                return;
            } else {
                if (document.getElementById("postcode_error")) {
                    document.getElementById("postcode_error").classList.add("hidden")
                    document.getElementById("postcode_error").innerText = '';
                }
                if (document.getElementsByClassName("post_details")[0]) {
                    document.getElementsByClassName("post_details")[0].style.display = "block";
                }

                // document.getElementById("reserve-time-btn").click();
            }
        }

        const delivery_number_pattern = /\d/;
        let delivery_time_button = document.getElementById("reserve-time-btn").textContent;
        if (delivery_time_button && !delivery_number_pattern.test(delivery_time_button)) {
            document.getElementById("reserve-time-btn").click();
            return;
        }

        let cart = JSON.parse(localStorage.getItem("cart"));
        if (postnumber) {
            if (delivery_time) {
                if (cart.length) {
                    window.location.replace(BASE_URL + "checkout");
                    localStorage.setItem("checkout_redirect", false);

                } else {
                    // alert('Vänligen ange varor i kundvagnen innan du går vidare till kassan')
                }
            } else {
                document.getElementById("reserve-time-btn").click(); t
            }
        } else {
            document.getElementById("post-number-btn").click();
        }
    });
}
$.ajax({
    type: "GET",
    async: false,
    url: BASE_URL + "get-logged-in-user-data",
    success: async function (response) {

        if (response.name) {

            let checkout_redirect_cache = JSON.parse(localStorage.getItem("checkout_redirect"));

            if (checkout_redirect_cache == true) {

                // checkout.click();
                let res1 = await $.ajax({
                    type: "GET",
                    url: BASE_URL + "api/get-session-data/postcode",
                })

                if (res1.length > 0) {

                    document.getElementById("post-number-btn").click();
                    // localStorage.setItem("checkout_redirect", false);
                    return;
                }

            }

        }

    }
})




function getCSRFToken() {
    var metaTag = document.querySelector('meta[name="csrf-token"]');
    if (metaTag) {
        return metaTag.getAttribute("content");
    }
    return null;
}

// Function to send the AJAX request with the orderId
function sendOrderUpdate(orderId) {
    const csrfToken = getCSRFToken();
    if (!csrfToken) {
        console.error("CSRF token not found.");
        return;
    }
    // Your AJAX code here
    fetch(BASE_URL + "api/order/" + orderId, {
        method: "POST", // Change this to the appropriate HTTP method if needed
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: "order_id=" + orderId, // Sending the orderId as data in the AJAX request
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle the success response from the server if needed
            //   alert("Beställningsartiklar har lagts till i varukorgen!");
            //   generateModal("Beställningsartiklar har lagts till i varukorgen!")

            localStorage.setItem("cart", JSON.stringify(data));
            sendOrderCancel(orderId);
            // window.location.reload();
            window.location.href = "/";
        })
        .catch((error) => {
            // Handle any errors that occurred during the fetch request
            console.error("Något gick fel:", error);
            window.location.href = "/";
        });
}

// Function to send the AJAX request to cancel the order
function sendOrderCancel(orderId) {
    const csrfToken = getCSRFToken();
    if (!csrfToken) {
        console.error("CSRF token not found.");
        return;
    }
    // Your AJAX code here
    fetch(BASE_URL + "api/order/delete/" + orderId, {
        method: "DELETE", // Change this to the appropriate HTTP method if needed
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: "order_id=" + orderId, // Sending the orderId as data in the AJAX request
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle the success response from the server if needed
            //   alert("Beställningen avbröts framgångsrikt!");
            generateModal("Beställningen avbröts framgångsrikt!")
            //   console.log(data)
            // window.location.href = "/orders";
            window.location.href = "/";
        })
        .catch((error) => {
            // Handle any errors that occurred during the fetch request
            // console.error("Något gick fel:", error);
            generateModal("Beställningen avbröts framgångsrikt!")
            // window.location.href = "/orders";
            window.location.href = "/";
        });
}

document.addEventListener("DOMContentLoaded", function () {
    var updateOrderButtons = document.querySelectorAll(".update-order");
    var cancelOrderButtons = document.querySelectorAll(".cancel-order");
    var updateOrderBtn = document.getElementById("update-order-btn");
    var cancelOrderBtn = document.getElementById("cancel-order-btn");

    updateOrderButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            // Extract the data from the custom attribute "data-order-id"
            var orderId = this.getAttribute("data-order-id");

            updateOrderBtn.setAttribute("data-order-id", orderId);
        });
    });
    if (updateOrderBtn) {
        updateOrderBtn.addEventListener("click", function () {
            // Extract the data from the custom attribute "data-order-id"
            //   console.log("test");
            var orderId = this.getAttribute("data-order-id");
            // Call the function to send the AJAX request with the orderId
            sendOrderUpdate(orderId);
        });
    }
    cancelOrderButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            // Extract the data from the custom attribute "data-order-id"
            var orderId = this.getAttribute("data-order-id");

            cancelOrderBtn.setAttribute("data-order-id", orderId);
        });
    });
    if (cancelOrderBtn) {
        cancelOrderBtn.addEventListener("click", function () {
            //   console.log("test");
            var orderId = this.getAttribute("data-order-id");
            // Call the function to send the AJAX request with the orderId

            sendOrderCancel(orderId);
        });
    }
});

$(document).ready(function () {
    $("#shopping-card-submit").submit(function (e) {
        e.preventDefault();
        var shopName = $("#name").val();
        let cart = document.getElementById("cart-product");
        let cartItems = JSON.parse(localStorage.getItem("cart"));
        $.each(cartItems, function (key, value) {
            var products = value.products;
            $.each(products, function (key, value) {

            });
        });


        for (let i = 0; i < cartItems.length; i++) {
            // category = document.createElement("h2");

            for (let j = 0; j < cartItems[i].products.length; j++) {

                $("#p").html(cartItems[i].products[j].item_id);
                var item = cartItems[i].products[j].item_id;
            }
        }
        var wishlistItems = [];

        // Iterate over each product item in the cart
        $("#shopping-card").each(function () {
            // var productID = $(this).data('product-id');
            var productID = cartItems;
            // var shopName = $(this).data('shop-name');

            // Collect the product information
            var wishlistItem = {
                product_id: productID,
            };

            wishlistItems.push(wishlistItem);

        });

        // Send the wishlist items to the server
        saveWishlistItems(wishlistItems);

        function saveWishlistItems(items) {
            if (mainId == 0) {
                window.location.replace(BASE_URL + "login");
                return 0;
            }
            $.ajax({
                type: "POST",
                url: BASE_URL + "shopping/store",
                data: { items: items, shopname: shopName, mainId: mainId },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    // Handle the success response
                    document.getElementById("shoppinglist_modal_close").click();
                    window.location.replace(BASE_URL + "shopping-list");
                },
                error: function (error) {
                    // Handle the error case
                    console.error(error);
                },
            });
        }
    });
});

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
            _token: $('meta[name="csrf-token"]').attr("content"),
        },

        success: function (data) {
            let cartItems = JSON.parse(localStorage.getItem("cart"));
            if (cartItems.length > 0) {
                for (let i = 0; i < cartItems.length; i++) {
                    for (let j = 0; j < cartItems[i].products.length; j++) {

                        let item = searchProducts(
                            data,
                            cartItems[i].products[j].item_id
                        );
                        let modal = document.getElementById(
                            "data-" + cartItems[i].products[j].item_id
                        );

                        if (!modal && item && PageModal) {
                            let cardModal = previewModel(item, "data");
                            PageModal.innerHTML += cardModal;
                        }
                    }
                }
            }
        },
    });
}
getCartData();

function handleServerData(data) {

    let cart = JSON.parse(localStorage.getItem("cart"));
    if (!cart.length) {
        // cart = [];
        localStorage.setItem("cart", JSON.stringify(data));
        GetCartProductFromCache();
        return;
    }
    for (let i = 0; i < data.length; i++) {
        const category = data[i].category;
        // let findExistingCategory = cart.find((categories) => categories.category == category);
        let findExistingCategory = {};
        let cart_array_index = 0;

        for (let k = 0; k < cart.length; k++) {
            if (cart[k].category == category) {
                findExistingCategory = cart[k];
                cart_array_index = k;
                break;
            }
        }

        if (findExistingCategory && findExistingCategory.products) {
            for (let j = 0; j < data[i].products.length; j++) {
                const id = data[i].products[j].item_id;

                let findExisting = {};

                findExisting = findExistingCategory.products.find(
                    (product) => product.item_id == id
                );
                let findExistingIndex = findExistingCategory.products.findIndex(
                    (product) => product.item_id == id
                );

                if (!findExisting) {
                    cart[cart_array_index].products.push(data[i].products[j]);

                    continue;
                } else {
                    cart[cart_array_index].products[
                        findExistingIndex
                    ].quantity =
                        parseInt(
                            cart[cart_array_index].products[findExistingIndex]
                                .quantity
                        ) + parseInt(data[i].products[j].quantity);
                }
            }
        } else {
            cart.push(data[i]);
        }
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    GetCartProductFromCache();
}

function sendShoppingListItemToCart(shopping_id) {
    const csrfToken = getCSRFToken();
    if (!csrfToken) {
        console.error("CSRF token not found.");

        return;
    }
    // Your AJAX code here
    fetch(BASE_URL + "api/shoppingcart/" + shopping_id, {
        method: "POST", // Change this to the appropriate HTTP method if needed
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: "shopping_list_id=" + shopping_id, // Sending the orderId as data in the AJAX request
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle the success response from the server if needed
            //   alert("Varor har lagts till i kundvagnen!");
            //   generateModal("Varor har lagts till i kundvagnen!")
            //   localStorage.setItem("cart", JSON.stringify(data));
            //   console.log(data)
            //   return
            handleServerData(data);
            //   GetCartProductFromCache()
            //   window.location.reload();
        })
        .catch((error) => {
            // Handle any errors that occurred during the fetch request
            console.error("Något gick fel:", error);
        });
}

//   localStorage.removeItem("cart");

const shoppinglistToCart = document.getElementById("all_cart");
if (shoppinglistToCart) {
    shoppinglistToCart.addEventListener("click", function () {
        const shopping_id = shoppinglistToCart.getAttribute("data-shopping-id");
        sendShoppingListItemToCart(shopping_id);
    });
}

//  new postcode modal
$(document).ready(function () {
    $("#postcode_closes").on("click", function () {
        window.location = "/";
        // $("#exampleModalToggles").modal('hide');
    });
    // document.getElementById('postcode_errors').classList.remove('hidden')
    $("#exampleModalToggles").hide();
    $("#save-btnss").on("click", function (e) {
        e.preventDefault();
        var email = $("#email").val();
        var formdata = $("#postcode_add").serializeArray();
        //   console.log(formdata);
        if (email == "") {
            $("#postcode_closes").modal("show");
            $("#emailError").show();
        } else {
            $("#emailError").hide();
            $.ajax({
                url: "/admin/postnumber/store",
                type: "POST",
                data: { formdata: formdata, email: email },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    //   console.log(response);
                    if (response) {
                        //   document.getElementById('postcode_errors').classList.add('hidden')
                        $("#postcode_closes").click();
                        document.getElementById("email").value = "";
                        // setTimeout(function(){
                        document.getElementById("postcode_closes").click();
                        // },1000);
                    }
                },
            });
        }
    });
});

function generateModal(message) {
    const message_modal_id = document.getElementById("message-modal-btn");
    const message_modal = document.getElementById("message-modal-message");
    if (message_modal_id) {
        if (message_modal) {
            message_modal.innerHTML = message;
            message_modal_id.click();
        }
    }
}
//all category

// load more button with category
$(document).ready(function () {
    let offset = 24;
    $("#CategoryLoadMore").click(function () {
        let categoryId = $(this).data("id");

        $.ajax({
            url: BASE_URL + "api/load-more-category/",
            type: "GET",
            data: { categoryId, offset, mainId, sortby: home_sortby },
            dataType: "json",
            success: function (response) {
                var products = response;
                if (products.length < 24) {
                    $("#CategoryLoadMore").hide();
                }
                let html = "";
                let modalContent = "";
                products.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6 "
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;
                });
                $("#LoadCategory").append(html);
                $("#all-preview-modals").append(modalContent);
                offset += 24;
            },
            error: function (response) {

            },
        });
    });
});
// subCategoryLoadMore

// load more button with subcategory
$(document).ready(function () {
    let offset = 24;
    $("#SubCategoryLoadMore").click(function () {
        let subId = $(this).data("id");

        $.ajax({
            url: BASE_URL + "api/load-more-sub/",
            type: "GET",
            data: { subId, offset, mainId, sortby: home_sortby },
            dataType: "json",
            success: function (response) {
                var products = response;
                if (products.length < 24) {
                    $("#SubCategoryLoadMore").hide();
                }
                let html = "";
                let modalContent = "";
                products.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6 "
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;
                    //    console.log(html)
                });
                $("#sub-category").append(html);
                $("#all-preview-modals").append(modalContent);
                offset += 24;
            },
            error: function (response) {

            },
        });
    });
});

// load more button with subcategory
$(document).ready(function () {
    let offset = 24;
    $("#SubSubCategoryLoadMore").click(function () {
        let subsubId = $(this).data("id");

        $.ajax({
            url: BASE_URL + "api/load-more-subsub/",
            type: "GET",
            data: { subsubId, offset, mainId, sortby: home_sortby },
            dataType: "json",
            success: function (response) {
                var products = response;
                if (products.length < 24) {
                    $("#SubSubCategoryLoadMore").hide();
                }

                let html = "";
                let modalContent = "";
                products.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6 "
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;

                });
                $("#subsub_category").append(html);
                $("#all-preview-modals").append(modalContent);
                offset += 24;
            },
            error: function (response) {

            },
        });
    });
});

// load more button with offer
$(document).ready(function () {
    let offset = 24;
    $("#LoadMore").click(function () {
        // let subId=$(this).data('id');

        $.ajax({
            url: BASE_URL + "api/load-home-extrapriser/",
            type: "GET",
            data: { offset: offset, mainId: mainId },
            dataType: "json",
            success: function (response) {
                var products = response;

                if (products.length < 24) {
                    $("#LoadMore").hide();
                }
                let html = "";
                let modalContent = "";
                products.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;
                    //    console.log(html)
                });
                $("#extrapriser-cards").append(html);
                $("#extrapriser-modal").append(modalContent);
                offset += 24;
            },
            error: function (response) {

            },
        });
    });
});

// load more button with veckans
$(document).ready(function () {
    let offset = 24;
    $("#VeckansLoadMore").click(function () {

        $.ajax({
            url: BASE_URL + "api/load-veckans-extrapriser/",
            type: "GET",
            data: { offset: offset, mainId: mainId },
            dataType: "json",
            success: function (response) {
                var products = response;
                if (products.length < 24) {
                    $("#VeckansLoadMore").hide();
                } else {
                    $("#VeckansLoadMore").show();
                }
                let html = "";
                let modalContent = "";
                products.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-2 col-xl-2  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6 "
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;
                    //    console.log(html)
                });
                $("#veckans-extrapriser-cards").append(html);
                $("#veckans-extrapriser-modal").append(modalContent);
                offset += 24;
            },
            error: function (response) {

            },
        });
    });
});

// load more button with offer
$(document).ready(function () {
    let offset = 24;
    $("#favouriteLoadMore").click(function () {
        // let subId=$(this).data('id');

        $.ajax({
            url: BASE_URL + "api/load-favourites/",
            type: "GET",
            data: { mainId: mainId, offset: offset },
            dataType: "json",
            success: function (response) {
                var products = response;

                if (products.length < 24) {
                    $("#favouriteLoadMore").hide();
                }

                let html = "";
                let modalContent = "";
                products.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-2 col-xl-2  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6 "
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;

                });
                $("#favourite-cards").append(html);
                $("#favourites-modal").append(modalContent);
                offset += 24;
            },
            error: function (response) {

            },
        });
    });
});

const shoppingAll = document.getElementById("shopping-all");

if (shoppingAll) {
    var id = shoppingAll.getAttribute("data-shopping-id");

    $.ajax({
        url: BASE_URL + "shopping/details",
        type: "POST",
        data: {
            id: id,
            mainId: mainId,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (new_data) {

            // let allContent =
            new_data.forEach((item, index) => {

                let cardContent = card(
                    item.product,
                    "data",
                    "card-box col-xxl-2 col-xl-2  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6",
                    false,
                    item.quantity
                );
                let cardModal = previewModel(
                    item.product,
                    "data",
                    item.quantity
                );

                shoppingAll.innerHTML += cardContent;
                PageModal.innerHTML += cardModal;
            });
        },
    });
}
// serach
$(document).ready(function () {
    let offset = 24;
    $(".search").click(function () {
        let searchname = $(this).data("id");
        $.ajax({
            url: BASE_URL + "api/load-more-search/" + offset,
            type: "GET",
            data: {
                searchname: searchname,
            },
            dataType: "json",
            success: function (response) {
                var products = response;
                if (products.length < 24) {
                    $(".search").hide();
                }
                let html = "";
                let modalContent = "";
                products.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-2 col-xl-2  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6 "
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;
                });
                $("#search").append(html);
                $("#search-modal").append(modalContent);
                offset += 24;
            },
            error: function (response) {

            },
        });
    });
});

// home sort by filter
$(document).ready(function () {

    // Category sort by
    $("#category-sortby-dropdown>ul>li>a").click(function (e) {
        e.preventDefault();
        home_sortby = $(this).attr('data-val');
        var txt = $(this).text();

        $('#category_sortby').val(home_sortby);
        $("#category-sortby-dropdown>button").text(txt);
        const home_category_page_items = document.getElementsByClassName("home-category-page-items")[0];
        if (home_category_page_items) {
            home_category_page_items.innerHTML = "";
            const url = BASE_URL + "api/home/home-category";
            let data = {
                // category_id: main_category_id,
                sortby: home_sortby
            };
            if (main_category_id) {
                data = {
                    category_id: main_category_id,
                    sortby: home_sortby
                };
            }
            if (main_sub_category_id) {
                data = {
                    subcat: main_sub_category_id,
                    sortby: home_sortby
                }
            }
            if (main_sub_sub_category_id) {
                data = {
                    subcat: main_sub_sub_category_id,
                    sortby: home_sortby
                }
            }
            update_home_products(url, data);

        }
        const categoriesPageItems = document.getElementsByClassName(
            "category-page-items"
        )[0];
        if (categoriesPageItems) {
            categoriesPageItems.innerHTML = "";
            const url = BASE_URL + "api/category/";
            CategoryAjax(
                url,
                categoriesPageItems,
                "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
            );
        }

        const subCategoriesPageItems = document.getElementById("sub-category");
        if (subCategoriesPageItems) {
            subCategoriesPageItems.innerHTML = "";
            let url = BASE_URL + "api/sub_category/";
            CategoryAjax(
                url,
                subCategoriesPageItems,
                "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
            );
        }

        const subSubCategoriesPageItems = document.getElementById("subsub_category");
        if (subSubCategoriesPageItems) {
            subSubCategoriesPageItems.innerHTML = "";
            let url = BASE_URL + "api/subsub_category/";
            CategoryAjax(
                url,
                subSubCategoriesPageItems,
                "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6"
            );
        }


    });

});

// add popularity point
function addPopularityPoint(product_id, type) {
    if (product_id && type) {
        $.ajax({
            url: BASE_URL + "api/popularity/point-add",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                product_id: product_id,
                type: type
            },
            success: function (data) {

            },
        });
    }
}
// Modal open point add
$(window).on('shown.bs.modal', function (e) {
    if (e.target.id) {
        var id = e.target.id;
        var id_arr = id.split('-');
        var product_id = parseInt(id_arr[1]);
        if (product_id) {
            addPopularityPoint(product_id, 'open');
        }
    }
});

$(document).ready(function () {


    // $(".home-category-btn").on("click", function (e) {
    //     let category_id = e.target.getAttribute("data-category-id");
    //     main_category_id = category_id;
    //     let url = BASE_URL + "api/home/home-category/";
    //     update_home_products(url, home_sortby, category_id);
    // })
    let home_offset_product = 24;

    $("#HomeCategoryLoadMore").on("click", function () {
        let url = BASE_URL + "api/home/load-more-discount-product/" + home_offset_product;
        let section = document.getElementsByClassName("home-catagorie-section")[0];
        let ele = section.getElementsByClassName("home-category-btn")[0];
        // let category_id = ele.getAttribute("data-category-id");
        let data = {
            // category_id: main_category_id,
            sortby: home_sortby
        };
        if (main_category_id) {
            data = {
                category_id: main_category_id,
                sortby: home_sortby
            };
        }
        if (main_sub_category_id) {
            data = {
                subcat: main_sub_category_id,
                sortby: home_sortby
            }
        }
        if (main_sub_sub_category_id) {
            data = {
                subcat: main_sub_sub_category_id,
                sortby: home_sortby
            }
        }
        $.ajax({
            url: url,
            type: "GET",
            data: data,
            headers: {
                "X-XSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                var products = response;

                if (products.length < 24) {
                    $(".home-category-load-more-btn").hide();
                }
                else {
                    $(".home-category-load-more-btn").show();
                }


                let html = "";
                let modalContent = "";
                products.formated_data.forEach(function (product) {
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6 "
                    );
                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;

                });
                $("#home-extrapriser-cards").append(html);
                $("#extrapriser-modal").append(modalContent);
                home_offset_product += 24;
            }

        })
    })
})
var selected_category = null;

async function update_home_products(url, data) {
    await $.ajax({
        url: url,
        type: "GET",
        data: data,
        headers: {
            "X-XSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            let products = response.formated_data;

            let categories = response.categories;


            if (products.length < 24) {
                $(".home-category-load-more-btn").hide();
            } else {
                $(".home-category-load-more-btn").show();
                $(".title-home-page").empty();
                $(".title-home-page").html(response.title);

                let html = "";
                let modalContent = "";
                $("#home-extrapriser-cards").empty();
                products.forEach(function (product, index) {
                    if (index >= 24) {
                        return;
                    }
                    let content = card(
                        product,
                        "data",
                        "card-box col-xxl-3 col-xl-3  col-md-3 col-sm-6 col-xs-6 px-1 py-3 col-6 "
                    );

                    let modal = previewModel(product, "data");
                    html += content;
                    modalContent += modal;
                });

                $("#home-extrapriser-cards").append(html);
                $("#extrapriser-modal").append(modalContent);


                let categories_html = ''
                let home_category_section = document.getElementsByClassName("home-catagorie-section")[0];
                if (response.sub_cat.length > 0) {
                    (response.sub_cat).forEach(cat => {
                        categories_html += `<a data-sub-category-id="${cat.id}" data-old-category-id="${main_category_id}" class="home-category-btn Categories-btn">${cat.name} <i
                            class="bi bi-chevron-right"></i></a>`
                    })
                    home_category_section.innerHTML = categories_html;
                    Array.from(home_category_section.getElementsByClassName("home-category-btn")).forEach(e => {
                        e.addEventListener("click", async () => {


                            let sub_category_id = e.getAttribute("data-sub-category-id");
                            let old_category_id = e.getAttribute("data-old-category-id");
                            let url = BASE_URL + "api/home/home-category"
                            let data = {
                                sortby: home_sortby,
                                old_category_id: old_category_id,
                                subcat: sub_category_id,
                            }
                            main_sub_category_id = sub_category_id;
                            update_home_products(url, data);
                            let data1 = null;
                            let data2 = null;
                            let data3 = null;
                            if (main_category_id) {
                                let category_id_data = {
                                    category_id: main_category_id,
                                }
                                data1 = await get_category_by_id(category_id_data)

                            }
                            if (main_sub_category_id) {
                                let sub_category_id_data = {
                                    subcat: main_sub_category_id,
                                }
                                data2 = await get_category_by_id(sub_category_id_data)

                            }
                            if (main_sub_sub_category_id) {
                                let sub_sub_category_id_data = {
                                    subsubcat: main_sub_sub_category_id,
                                }
                                data3 = await get_category_by_id(sub_sub_category_id_data)

                            }
                            let my_home_breadcrumb = document.getElementById("my_home_breadcrumb");
                            if (my_home_breadcrumb) {
                                my_home_breadcrumb.style.display = "block";
                                let my_home_breadcrumb_container = my_home_breadcrumb.getElementsByClassName("my_home_breadcrumb_container")[0];
                                my_home_breadcrumb_container.innerHTML = `<li class="inline-flex items-center">
                    <a href="/"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Hem
                    </a>
                </li>
                <li>
                    <div class="flex items-center cursor-pointer">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a data-category-id="${main_category_id}"
                            class="home-category-btn ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">${data1.name}</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a "
                            class=" ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">${data2.name}</a>
                    </div>
                </li>`;
                                Array.from(my_home_breadcrumb_container.getElementsByClassName("home-category-btn")).forEach(ele => {
                                    ele.addEventListener("click", (e) => {
                                        let data_category_id = ele.getAttribute("data-category-id");
                                        let data_sub_category_id = ele.getAttribute("data-sub-category-id");
                                        if (data_category_id) {
                                            let url = BASE_URL + "api/home/home-category/"
                                            let data = {
                                                sortby: home_sortby,
                                                category_id: data_category_id
                                            }
                                            update_home_products(url, data);
                                        }
                                        if (data_sub_category_id) {
                                            let url = BASE_URL + "api/home/home-category/"
                                            let data = {
                                                sortby: home_sortby,
                                                subcat: data_sub_category_id
                                            }
                                            update_home_products(url, data);
                                        }

                                        if (e.target.closest('.home-category-btn').getAttribute("data-category-id")) {
                                            document.getElementsByClassName("my_home_breadcrumb_container")[0].children[2].remove()
                                        }

                                    })
                                })


                            }

                        })

                    })
                }

                if (response.subsub_cat.length > 0) {
                    categories_html = '';
                    let home_category_section = document.getElementsByClassName("home-catagorie-section")[0];

                    (response.subsub_cat).forEach(cat => {

                        categories_html += `<a data-sub-sub-category-id="${cat.id}" data-sub-category-id="${main_category_id}" class="home-category-btn Categories-btn" >
                            ${cat.name} <i class="bi bi-chevron-right"></i></a>`

                    })
                    home_category_section.innerHTML = categories_html;

                    home_category_section.querySelectorAll(".home-category-btn").forEach(ele => {
                        ele.addEventListener("click", async () => {
                            let sub_sub_category_id = ele.getAttribute("data-sub-sub-category-id");
                            let old_sub_category_id = ele.getAttribute("data-sub-sub-category-id");
                            let data = {
                                sortby: home_sortby,
                                old_sub_category_id: old_sub_category_id,
                                subsubcat: sub_sub_category_id,
                            }
                            main_sub_sub_category_id = sub_sub_category_id;
                            update_home_products(url, data);
                            let data1 = null;
                            let data2 = null;
                            let data3 = null;
                            if (main_category_id) {
                                let category_id_data = {
                                    category_id: main_category_id,
                                }
                                data1 = await get_category_by_id(category_id_data)

                            }
                            if (main_sub_category_id) {
                                let sub_category_id_data = {
                                    subcat: main_sub_category_id,
                                }
                                data2 = await get_category_by_id(sub_category_id_data)

                            }
                            if (main_sub_sub_category_id) {
                                let sub_sub_category_id_data = {
                                    subsubcat: main_sub_sub_category_id,
                                }
                                data3 = await get_category_by_id(sub_sub_category_id_data)

                            }
                            let my_home_breadcrumb = document.getElementById("my_home_breadcrumb");
                            if (my_home_breadcrumb) {
                                my_home_breadcrumb.style.display = "block";
                                let my_home_breadcrumb_container = my_home_breadcrumb.getElementsByClassName("my_home_breadcrumb_container")[0];
                                my_home_breadcrumb_container.innerHTML = `<li class="inline-flex items-center">
                    <a href="/"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Hem
                    </a>
                </li>
                <li>
                    <div class="flex items-center cursor-pointer">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a data-category-id="${main_category_id}"
                            class="home-category-btn ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">${data1.name}</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center ">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a
                            class=" ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">${data2.name}</a>
                    </div>
                </li>
                `;
                                Array.from(my_home_breadcrumb_container.getElementsByClassName("home-category-btn")).forEach(ele => {
                                    ele.addEventListener("click", (e) => {


                                        let data_category_id = ele.getAttribute("data-category-id");
                                        let data_sub_category_id = ele.getAttribute("data-sub-category-id");
                                        let data_sub_sub_category_id = ele.getAttribute("data-sub-sub-category-id");
                                        if (data_category_id) {
                                            let url = BASE_URL + "api/home/home-category/"
                                            let data = {
                                                sortby: home_sortby,
                                                category_id: data_category_id
                                            }
                                            selected_category = "data_category_id";
                                            my_home_breadcrumb_container.getElementsByClassName("home-category-btn").innerHTML = ''
                                            update_home_products(url, data);

                                        }
                                        if (data_sub_category_id) {
                                            let url = BASE_URL + "api/home/home-category/"
                                            let data = {
                                                sortby: home_sortby,
                                                subcat: data_sub_category_id
                                            }
                                            selected_category = "data_sub_category_id";
                                            update_home_products(url, data);

                                        }
                                        if (data_sub_category_id) {
                                            let url = BASE_URL + "api/home/home-category/"
                                            let data = {
                                                sortby: home_sortby,
                                                subsubcat: data_sub_sub_category_id
                                            }
                                            selected_category = "data_sub_sub_category_id";

                                            update_home_products(url, data);
                                        }

                                        if (e.target.closest('.home-category-btn').getAttribute("data-category-id")) {
                                            document.getElementsByClassName("my_home_breadcrumb_container")[0].children[2].remove()
                                        }

                                    })
                                })


                            }
                        })
                    })
                }

                if (selected_category) {
                    let my_home_breadcrumb_container = document.getElementsByClassName("my_home_breadcrumb_container")[0];
                    Array.from(my_home_breadcrumb_container.getElementsByClassName("home-category-btn")).forEach(ele => {
                        if (ele.getAttribute(selected_category)) {
                            ele.parentElement.parentElement.remove();
                        }
                    })
                }

            }
        }
    })

    async function get_category_by_id(data) {
        try {
            let response = await $.ajax({
                type: "GET",
                url: BASE_URL + "api/get_category_by_id",
                data: data,
                async: false,
            });
            return response.category[0];
        } catch (error) {
            console.error('Error fetching category:', error);
            throw error;
        }
    }
}
