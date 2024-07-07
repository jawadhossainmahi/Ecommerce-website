<div class="offcanvas offcanvas-start side-filters" tabindex="-1" id="filters" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body p-0">
            <div class="filter-box">
                <div class="filter-box-head">
                    <h1>Filter</h1>
                    <h5 data-bs-dismiss="offcanvas" aria-label="Close">cancel</h5>
                </div>
                <form method="GET">
                    @if(request()->has('category'))
                    <input type="hidden" name="category" value="{{request()->category}}" />
                    @endif
                    
                    <div class="marking">
                        <div class="container">
                            <div class="marking-heading">
                                <h4>Origin</h4>
                            </div>
                            <div class="row">
                                @foreach($origins as $origin)
                                <span class="col-lg-6">
                                    <input type="checkbox" name="origin_id" {{ request()->has('origin_id') && request()->origin_id == $origin->id ? 'checked="checked"' : '' }} value="{{$origin->id}}">
                                    <h3>{{ $origin->name }}</h3>
                                </span>
                                @endforeach    
                            </div>
                        </div>
                    </div>
                    <div class="marking">
                        <div class="container">
                            <div class="marking-heading">
                                <h4>Trademarks</h4>
                            </div>
                            <div class="row">
                                @foreach($trademarks as $trademark)
                                <span class="col-lg-6">
                                    <input type="checkbox" name="trademark_id" {{ request()->has('trademark_id') && request()->trademark_id == $trademark->id ? 'checked="checked"' : '' }} value="{{$trademark->id}}">
                                    <h3>{{ $trademark->name }}</h3>
                                </span>
                                @endforeach                            
                            </div>
                        </div>
                    </div>
                    <div class="filter-box-footer">
                        <button type="submit" class="button">Show item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>