@extends('frontend.master')


@section('content')

 <!-- ----------------shopping-list------------->
<style>
    .flex-boxs {
  display:flex;
  justify-content:space-between;
  outline: 2px solid rgb(247, 243, 243);
}
</style>
    <section data-shoppinglist-count="{{ $shoppingList->count() }}" class="shopping">
        <div class="container">
            <div class="row">
                <div class="shopping-list col-lg-10 mx-auto">
                    <h3>Mina inköpslistor</h3>
                    @forelse($shoppingList as $key => $item)
                        <div class="row">
                            <ol class="recurring-list">
                                <li>
                                    <div class="recurring-inner" >
                                        <a href="{{route('shopping.view',["id"=>$item->id, "mainId"=>auth()->user()->id])}}"><h3  data-id="{{$item->id}}" >{{$item->name}}</h3> 
                                        <p style="align-items: center">Skapad: {{$item->created_at->format('Y-m-d')}}</p>
                                        <a style="text-align: right;" href="{{route('shopping.delete',$item->id)}}"><button class="btn btn-success"  class="btn btn-success" style="justify-content:end" ><i class="bi bi-trash-fill"></i></button></a>
                                    </div>
                                </li>
                            </ol>
                        </div>

                @empty
                <div class="list col-lg-12 p-3">
                    <p>Inga sparade inköpslistor hittades</p>
                </div>
                @endforelse
                  <div id="title">
                    <h1 id="title"></h1>
                  </div>
                    {{-- <div class="row">
                
                    <div class="list col-lg-12 p-3">
                      
                       <h4 ></h4>   
                       <p></p>
                    
                    </div>
                </a>
                </div> --}}
                </div>
            </div>
        </div>
        
    </section>
    
    <script>
           
        
            // const list = document.getElementsByClassName("shopping")[0]
            // console.log(list.getAttribute('data-shoppinglist-count'))
            // if(list.getAttribute('data-shoppinglist-count')){
                
            //     const newElement = document.createElement('p')
            //     newElement.style.border = 'none'
            //     newElement.innerHTML = "Unfortunately, no saved shopping lists (which are a clever way to shop quickly) were found."
            //     list.append(newElement)

            // }
    
    </script>


 
@endsection
@section('js')

@endsection
