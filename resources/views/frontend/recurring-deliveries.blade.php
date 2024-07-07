@extends('frontend.master')


@section('content')



    <!-- ----------------recurring delivery------------->

    <section class="recurring-delivery">
        <div class="">
            <div class="row px-2 w-100 m-0">
                <div class="recurring max-w-screen-xl mx-auto px-[16px] py-[12px]">
                    <h3>My recurring deliveries</h3>

                    <div class="">
                        <div class="row">
                            <div class="order-content col-lg-12 ">
                                <h3>Kommande leveranser <span></span></h3>

                                <div class="row">
                                    <ol class="recurring-list">
                                        @forelse($recurring_orders as $order)
                                        <li>
                                            <div class="recurring-inner" >
                                                @php
                                                $date=$date=date_create($order->created_at);;
                                                
                                                @endphp
                                                <h4>{{ date_format($date,"jS F Y") }}</h4>
                                                <h2>Order-number: <span>{{$order->id}}</span></h2>
                                                <span><a href="{{ route('order-details', ['order_id'=>$order->id]) }}">View details</a></span>
                                            </div>
                                        </li>
                                        @empty
                                        <div class="subscription">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            <p>Oops! There were no subscriptions here</p>
                                        </div>
                                        @endforelse
                                        
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </section>

 
@endsection
@section('js')

    
@endsection
