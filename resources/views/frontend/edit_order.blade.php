@extends('frontend.master')


@section('content')
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>



    <section class="list-view">
        <div class="">
            <div class="row m-0 w-100 px-2">
                <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">
                    <div class="flex flex-wrap justify-content-between mt-12">

                        <h4 class="list-view-heading text-lg sm:text-xl mt-4 md:text-2xl">Order-nummer
                            <span>{{ $order->custom_order_id ? $order->custom_order_id : $order->id }}</span>
                        </h4>
                        <h4 class="list-view-heading text-lg sm:text-xl  mt-4 md:text-2xl">Leveransdatum:
                            <span>{{ $order->getdeliverytime->date }}</span>
                        </h4>
                    </div>
                    @if ($order->status == '0' && $order->getdeliverytime->date >= date('Y-m-d'))
                        <div class="flex justify-start flex-wrap flex-col p-3">

                            {{-- <div class="dropdown inline-block relative">
                                  <button class="bg-white-300 font-semibold py-2 px-4 rounded inline-flex items-center">
                                    <span class="mr-1 underline ">Mer</span>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                                  </button> --}}
                            {{-- <ul class="dropdown-menu pt-1">
                                    <li class=""><a data-bs-toggle="modal" data-bs-target="#order-update-modal" data-order-id="{{ $order->id }}" class="update-order text-sm rounded-t bg-white-200  text-gray-900 hover:bg-white-400 py-2 ps-3 pe-1 block whitespace-no-wrap" data-bs-toggle="tooltip" data-bs-placement="right" title="Du kommer inte att kunna uppdatera beställningen på leveransdagen {{ $order->getdeliverytime->date }}" style="color:black" href="">Uppdatera ordern</a></li>
                                    <li class=""><a data-bs-toggle="modal" data-bs-target="#order-cancel-modal" data-order-id="{{ $order->id }}" class="cancel-order  text-sm rounded-t bg-white-200  text-red-900 hover:bg-white-400 py-2 ps-3 pe-1 block whitespace-no-wrap" data-bs-toggle="tooltip" data-bs-placement="right" title="Du kommer inte att kunna avbryta beställningen på leveransdagen {{ $order->getdeliverytime->date }}" style="color:red" href="">Avbryt ordern</a></li>
                                    
                                  </ul> --}}
                            {{-- </div> --}}
                            <a data-bs-toggle="modal" data-bs-target="#order-update-modal" data-order-id="{{ $order->id }}"
                                class="update-order text-sm rounded-t bg-white-200  text-gray-900 hover:bg-white-400 py-2 ps-3 pe-1 block whitespace-no-wrap"
                                data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Du kommer inte att kunna uppdatera beställningen på leveransdagen {{ $order->getdeliverytime->date }}"
                                style="color:black" href="">Uppdatera ordern</a>
                            <a data-bs-toggle="modal" data-bs-target="#order-cancel-modal"
                                data-order-id="{{ $order->id }}"
                                class="cancel-order  text-sm rounded-t bg-white-200  text-red-900 hover:bg-white-400 py-2 ps-3 pe-1 block whitespace-no-wrap"
                                data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Du kommer inte att kunna avbryta beställningen på leveransdagen {{ $order->getdeliverytime->date }}"
                                style="color:red" href="">Avbryt ordern</a>

                        </div>
                    @endif
                    <ol class="order-product-list">
                        @foreach ($order->getorder as $item)
                            <li>
                                <div class="list-product">
                                    <img src="{{ asset($item->getproduct->image ? $item->getproduct->image->path : 'frontend/images/no-item.png') }}"
                                        alt="">
                                    <div class="list-product-inner">
                                        <h3>{{ $item->getproduct->name }}</h3>
                                        <p>{{ $item->getproduct->weight }} </p>
                                        <p>{{ $item->getproduct->pant ? ' +' . $item->getproduct->pant . ' pant' : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="list-product-price">
                                    <p>x {{ $item->qty }}</p>
                                    <h3>{{ $item->getproduct->discount_price > 0 ? format_subtotal_price($item->getproduct->discount_price) : format_subtotal_price($item->getproduct->price) }}:-
                                    </h3>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                    <div class="col-md-4  ml-auto">
                        <h5>Total</h5>
                        <p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Delsumma</th>
                                    <td>



                                        {{ display_price_format($total) }}
                                    </td>


                                </tr>

                                <tr>
                                    <th scope="row">Delsumma - "Pant"</th>
                                    <td>

                                        @php
                                            $total_pant = 0;

                                        @endphp
                                        @foreach ($order->getorder as $item)
                                            @php

                                                $total_pant += $item->getproduct->pant * $item->qty;

                                            @endphp
                                        @endforeach
                                        @if ($total_pant)
                                            {{ display_price_format($total_pant) }}
                                        @else
                                            Ingen
                                        @endif

                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">Rabatt</th>
                                    <td>


                                        {{ display_price_format($discount_without_coupons) }}

                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">Rabattkod</th>
                                    <td>
                                        {{ !$order->coupon->isEmpty() ? $order->coupon[0]->code : 'Ingen' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Kupongrabatt</th>

                                    <td>
                                        {{ !$order->coupon->isEmpty() ? display_price_format($total_discount) : 'Ingen' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Transport</th>

                                    <td>
                                        @if ($order->getuser->customer_type == 1)
                                            {{ display_price_format(0) }}
                                        @else
                                            {{ $order->total_price - 95 < 650 ? display_price_format($tax) : display_price_format(0) }}
                                        @endif
                                    </td>
                                    </th>
                                </tr>

                                @if ($totalTaxAmt12 > 0)
                                    <tr>
                                        <th scope="row">Varav 12% moms</th>
                                        <td>
                                            {{ display_price_format(number_format($totalTaxAmt12, 2)) }}
                                        </td>
                                    </tr>
                                @endif

                                @if ($totalTaxAmt25 > 0)
                                    <tr>
                                        <th scope="row">Varav 25% moms</th>
                                        <td>
                                            {{ display_price_format(number_format($totalTaxAmt25, 2)) }}
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <th scope="row">Total beställning</th>
                                    <td>

                                        {{ display_price_format($order->total_price) }}
                                    </td>
                                </tr>


                            </tbody>
                        </table>

                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade" id="order-update-modal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="order-update-modal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="order-update-modal">Uppdatera beställning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Om du önskar uppdatera din order, kommer varorna från din tidigare beställning flyttas till varukorgen
                    och din förra beställning annulleras och återbetalas från Klarna, nu kan du göra en ny beställning med
                    önskade ändringar. Bekräfta om du vill göra en uppdatering på din beställning.
                </div>
                <div class="modal-footer justify-center">
                    <button type="button" class="btn modal-btn-3" data-bs-dismiss="modal">Nej</button>
                    <button data-order-id="" id="update-order-btn" class="btn modal-btn-4">Ja</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="order-cancel-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="order-cancel-modal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="order-cancel-modal">Avbryt Beställning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Är du säker på att du vill avbryta beställningen? Denna åtgärd är oåterkallelig.
                </div>
                <div class="modal-footer justify-center">
                    <button type="button" class="btn modal-btn-3" data-bs-dismiss="modal">Nej</button>
                    <button data-order-id="" id="cancel-order-btn" class="btn modal-btn-4">Ja</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
