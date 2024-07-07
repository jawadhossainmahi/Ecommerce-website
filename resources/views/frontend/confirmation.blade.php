@extends('frontend.master')
@section('content')
@if (count($error) > 0)
    <div class="alert alert-danger">
        {{ __('Email Can not be send to the email address.') }} <br><br>
        <ul>
        @foreach ($error->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
        </ul>
    </div>
    @endif
<input type="hidden" id="clear_cart" value="{{ $clear_cart }}" >
{!!$klarna_order_confirmation->html_snippet??''!!}
@endsection
@section('js')

<script >
    if(document.getElementById('clear_cart').value == "true"){
        localStorage.setItem("cart", "[]")
        
    }
    if({{ $clear_cart }}){
        localStorage.setItem("cart", "[]")
        
    }
    localStorage.removeItem('delivery_datetime')
</script>
@endsection
