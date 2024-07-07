<!-- <li><a class="dropdown-item" data-value="alphabetically" href="#">Alphabetically</a></li>
<li><a class="dropdown-item" data-value="popularity" href="#">Popularity</a></li>
<li><a class="dropdown-item" data-value="price_low_to_high" href="#">Price Low to High</a></li>
<li><a class="dropdown-item" data-value="price_high_to_low" href="#">Price High to Low</a></li> -->


<!-- Example single danger button -->
<div class="btn-group">
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Action
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </div>

{{-- <div class="dropdown custom-dropdown">
    <a href="#" data-toggle="dropdown" class="dropdown-link" aria-haspopup="true" aria-expanded="false"> <span class="icon-dashboard2 mr-2"></span>
    Dashboard <span class="icon-keyboard_arrow_down arrow"></span>
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Dashboard 1</a>
        <a class="dropdown-item" href="#">Dashboard 2</a>
        <a class="dropdown-item" href="#">Dashboard 3</a>
        <a class="dropdown-item" href="#">Dashboard 4 <span>New</span></a>
        <a class="dropdown-item" href="#">Dashboard 5 <span>New</span></a>
    </div>
</div>

<style>

.custom-dropdown .dropdown-link {
    background: #007bff;
    color: #fff;
    padding: 10px 10px;
}
.custom-dropdown .dropdown-menu {
    border: 1px solid transparent !important;
    -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
    margin-top: -10px !important;
    padding-top: 0;
    padding-bottom: 0;
    opacity: 0;
    border-radius: 0;
    background: #007bff;
    right: auto !important;
    left: auto !important;
    -webkit-transition: .3s margin-top ease, .3s opacity ease, .3s visibility ease;
    -o-transition: .3s margin-top ease, .3s opacity ease, .3s visibility ease;
    transition: .3s margin-top ease, .3s opacity ease, .3s visibility ease;
    visibility: hidden;
}
.custom-dropdown .dropdown-menu a {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 14px;
    padding: 15px 40px;
    position: relative;
}
</style>
<script>
    $(function() {

$('.custom-dropdown').on('show.bs.dropdown', function() {
   var that = $(this);
  setTimeout(function(){
      that.find('.dropdown-menu').addClass('active');
  }, 100);
  

});
$('.custom-dropdown').on('hide.bs.dropdown', function() {
  $(this).find('.dropdown-menu').removeClass('active');
});

});

</script> --}}



{{-- 

<div class="u-flex">
    <div class="Dropdown Dropdown--stripped Dropdown--limitHeight u-outlineSolidBase2" tabindex="0" aria-label="Sortera">
        <p class="Dropdown-header">Populärast<svg name="arrow-right" class="Dropdown-arrow Icon" role="img">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/Assets/Build/sprite.svg?v=61745#arrow-right"></use>
            </svg>
        </p>
        <div class="Dropdown-list">
            <ul class="List List--noSpacing u-colorBaseMid">
                <li><button type="button">Populärast</button></li>
                <li><button type="button">A-Ö</button></li>
                <li><button type="button">Pris (lägst till högst)</button></li>
                <li><button type="button">Pris (högst till lägst)</button></li>
            </ul>
        </div>
    </div>
</div>
<style>
    .u-flex {
        display: flex!important;
    }
    .Dropdown.Dropdown--stripped {
        background: none;
        min-width: auto;
    }
    .Dropdown {
        position: relative;
        cursor: pointer;
        display: inline-block;
        max-width: 100%;
        min-width: 150px;
        user-select: none;
    }

.Dropdown.Dropdown--stripped .Dropdown-header {
    align-items: center;
    border: none;
    border-radius: 20px;
    display: flex;
    font-size: .875rem;
    height: 40px;
}

.Dropdown-header {
    border: 1px solid #ededed;
    border-radius: 4px;
    display: block;
    height: 40px;
    margin: 0;
    overflow: hidden;
    padding: 0.625rem 2.5rem 0.625rem 0.93750234rem;
    text-overflow: ellipsis;
    white-space: nowrap;
    z-index: 2;
}
.Dropdown, .Dropdown-header {
    background: #fff;
    position: relative;
}
.Dropdown.Dropdown--stripped .Dropdown-list {
    border: none;
    box-shadow: 5px 5px 30px 0 rgba(0,0,0,.15);
    margin-top: 1.25rem;
    min-width: 100%;
    width: auto;
}
.Dropdown.is-expanded .Dropdown-list {
    display: flex;
}
.Dropdown-list {
    background: #fff;
    border-left: 1px solid #ededed;
    border-radius: 0 0 4px 4px;
    border-right: 1px solid #ededed;
    display: none;
    flex-direction: column;
    font-size: .875rem;
    list-style-type: none;
    padding: 0;
    position: absolute;
    right: 0;
    width: 100%;
    z-index: 1;
}
.Dropdown.Dropdown--stripped .Dropdown-list:before {
    border-bottom: 10px solid #fff;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    content: "";
    display: block;
    height: 0;
    position: absolute;
    right: 60px;
    top: -10px;
    width: 0;
}
.Dropdown.Dropdown--limitHeight .Dropdown-list ul {
    max-height: 345px;
    overflow: auto;
}
.List.List--noSpacing {
    margin: 0;
    padding: 0;
}
.List {
    list-style-type: none;
}
.u-colorBaseMid {
    color: #777!important;
}
.Dropdown-list li {
    align-items: center;
    display: flex;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.Dropdown-list, .Dropdown-list li {
    border-bottom: 1px solid #ededed;
    margin: 0;
}
.Dropdown-list li a, .Dropdown-list li button {
    align-items: center;
    display: flex;
    height: 40px;
    justify-content: space-between;
    padding: 0.625rem 0.93750234rem;
    width: 100%;
}
button:not(.u-outlineDefault) {
    outline: none;
}
button {
    background: none;
    border: 0;
    padding: 0;
}

</style> --}}