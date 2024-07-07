 {{-- Billing address --}}
 <div class="profile-side-form offcanvas offcanvas-end" tabindex="-1" id="side-form-billing"
 aria-labelledby="offcanvasRightLabel">
     <div class="offcanvas-body">
         <section class="address-box">
             <div class="address-box-head">
                 <h1>Fakturaadress</h1>
                 <i id="billing-address-close-modal2" class="bi bi-x-lg" class="btn-close text-reset"
                     data-bs-dismiss="offcanvas" aria-label="Close"></i>
             </div>

             <div class="row m-3">

                 @if ($billing_addresses->count())
                     @foreach ($billing_addresses as $delivery_address)
                         <div class="col-lg-12 col-sm-12 col-md-12">
                             <div class="add-address">

                                 <h4>{{ $delivery_address->fname }} {{ $delivery_address->lname??'' }}</h4>

                                 <h5 class="street_addresss">{{ $delivery_address->street_address??'' }}</h5>
                                 <h5 class="postal_code">{{ $delivery_address->zip_code??'' }}
                                     {{ $delivery_address->postal_address??'' }}</h5>

                                 <div class="flex justify-between">
                                     <div class="flex items-center gap-3 form-openss">
                                         <i class="bi bi-plus-circle-fill" data-bs-toggle="offcanvas"
                                             data-bs-target="#offcanvasBilling-{{ $delivery_address->id }}"
                                             aria-controls="offcanvasRightChange"></i>
                                         <p> Ändra</p>
                                     </div>
                                     <button data-id="{{ $delivery_address->id }}" class="billing-address-add-btn"
                                         style="color: white; background-color: #006b30; text-decoration: none; padding: 10px 15px; border-radius: 10px;">
                                         Bekräfta
                                     </button>
                                 </div>




                             </div>
                         </div>
                     @endforeach
                 @endif
                 <div class="col-lg-12 col-sm-12 col-md-12">
                     <div class="add-address">
                         <p>Lägg till ny address</p>
                         <span data-bs-toggle="offcanvas" data-bs-target="#side-form-billing-address"
                             aria-controls="offcanvasRight">
                             <i class="bi bi-plus-circle-fill"></i>
                             <p>Lägg till</p>
                         </span>
                     </div>
                 </div>
             </div>
         </section>
     </div>
 </div>

 @if ($billing_addresses->count())
            @foreach ($billing_addresses as $delivery_address)
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBilling-{{ $delivery_address->id }}"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-body p-0">
                        <section class="address-box">
                            <div class="address-box-head">
                                <h1>Redigera adress</h1>
                                <h5 data-bs-toggle="offcanvas" data-bs-target="#side-form-billing" aria-controls="side-form"
                                    aria-label="Close">Avbryt</h5>
                            </div>

                            <div class="row">
                                <form method="POST" action="{{ route('edit_address') }}">
                                    @csrf
                                    <div class="side-form col-lg-11 mx-auto px-4">

                                        <p>Fakturaadress</p>

                                        <div class="row g-3">
                                            <div class="col-{{ $businessCust ? 12: 6}}">
                                                <input type="hidden" name="id" value="{{ $delivery_address->id }}">
                                                <input type="hidden" name="billingAddress" value="1">

                                                <input type="text" required name="fname" placeholder="{{ $businessCust ? 'Företags namn*' : 'Förnamn*' }}"
                                                    value="{{ $delivery_address->fname }}" aria-label="{{ $businessCust ? 'Företags namn' : 'First name' }}">
                                            </div>
                                            @if(!$businessCust)
                                            <div class="col-6">
                                                <input type="text" name="lname" placeholder="Efternamn*"
                                                    value="{{ $delivery_address->lname }}" aria-label="Last name">
                                            </div>
                                            @endif
                                        </div>
                                        @if($businessCust)
                                        <input type="text" required name="organization" placeholder="Organisationsnummer*" value="{{ $delivery_address->organization??'' }}">
                                        @endif

                                        <input type="text" required name="street_address"
                                            value="{{ $delivery_address->street_address }}"
                                            placeholder="Gatuadress*">

                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" required name="zip_code" placeholder="Postnummer*"
                                                    value="{{ $delivery_address->postal_code }}"
                                                    aria-label="Zip code">
                                            </div>
                                            <!--<div class="col-6">-->
                                            <!--    <input type="text" name="postal_address" placeholder="Postort*" aria-label="Postort*">-->
                                            <!--</div>-->
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-12">
                                                <input type="text" required name="mobile_number" placeholder="Mobilnummer*"
                                                    value="{{ $delivery_address->phone }}"
                                                    aria-label="Mobile number">
                                            </div>

                                        </div>

                                        <div class="row g-3">
                                            <div class="col-12">
                                                <input type="text" required name="city"
                                                    value="{{ $delivery_address->city }}" placeholder="Ort*"
                                                    aria-label="Locality">
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <input type="email" required name="invoice_email" value="{{ $delivery_address->invoice_email??null }}" placeholder="Invoice Email*"
                                                    aria-label="Invoice Email">
                                            </div>
                                        </div>

                                        <button class="add-btn">Lägg till</button>

                                    </div>

                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="offcanvas offcanvas-end" tabindex="-1" id="side-form-billing-address"
            aria-labelledby="side-form-billing-address">
            <div class="offcanvas-body p-0">
                <section class="address-box">
                    <div class="address-box-head">
                        <h1>Skapa ny adress</h1>
                        <h5 data-bs-toggle="offcanvas" data-bs-target="#side-form-billing" aria-controls="side-form-billing"
                            aria-label="Close">Avbryt</h5>
                    </div>

                    <div class="row">
                        <form method="POST" action="{{ route('add_billing_address') }}">
                            @csrf
                            <div class="side-form col-lg-11 mx-auto px-4">

                                <p>Fakturaadress</p>

                                <div class="row g-3">
                                    <div class="col-{{ $businessCust ? 12: 6}}">
                                        <input type="text" required name="fname" placeholder="{{ $businessCust ? 'Företags namn*' : 'Förnamn*' }}" value="{{ auth()->user()->name??'' }}"
                                            aria-label="{{ $businessCust ? 'Företags namn' : 'First name' }}">
                                    </div>
                                    @if(!$businessCust)
                                    <div class="col-6">
                                        <input type="text" name="lname" placeholder="Efternamn*"
                                            aria-label="Last name">
                                    </div>
                                    @endif
                                </div>
                                @if($businessCust)
                                <input type="text" required name="organization" placeholder="Organisationsnummer*" value="{{ auth()->user()->organization ?? ''}}">
                                @endif
                                <input type="text" required name="street_address" placeholder="Gatuadress*">

                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" required name="zip_code" placeholder="Postnummer*"
                                            aria-label="Zip code">
                                    </div>
                                    <!--<div class="col-6">-->
                                    <!--    <input type="text" name="postal_address" placeholder="Postort*" aria-label="Postort*">-->
                                    <!--</div>-->
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="text" required name="city" placeholder="Ort"
                                            aria-label="Locality">
                                    </div>
                                </div>
                                <!--<input type="text" name="port_code" placeholder="Portkod*">-->


                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="number" required name="mobile_number" placeholder="Mobilnummer*"
                                            aria-label="Mobile number">
                                    </div>
                                    <!--<div class="col-6">-->
                                    <!--    <input type="number" name="home_phone" placeholder="Hemtelefon*" aria-label="Hemtelefon">-->
                                    <!--</div>-->
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="email" required name="invoice_email" placeholder="Invoice Email*"
                                            aria-label="Invoice Email">
                                    </div>
                                </div>




                                <button class="add-btn">Lägg till</button>

                            </div>

                        </form>
                    </div>
                </section>
            </div>
        </div>