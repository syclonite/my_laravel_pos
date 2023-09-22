@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>{{trans('dashboard.product_management_update_product')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('products.index')}}"> {{trans('dashboard.back')}}</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.product_management_product_name')}}:</strong>
                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="{{$product->product_name}}" required="required">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.subcategory_management_subcategory_name')}}:</strong>
                    <select name="subcategory_id" id="" class="form-control" required="required">
                        {{--                        <option value=''>Please choose one...</option>--}}
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"{{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->subcategory_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.unit_management_unit_name')}}:</strong>
                    <select name="unit_id" id="" class="form-control" required="required">
                        <option value=''>Please choose one...</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}"{{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.quantity')}}:</strong>
                    <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity" value="{{$product->quantity}}" required="required">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.purchase_price')}}:</strong>
                    <input type="number" name="purchase_price" class="form-control" id="purchase_price" placeholder="Purchase Price" value="{{$product->purchase_price}}" required="required">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.selling_price')}}:</strong>
                    <input type="number" name="selling_price" class="form-control" id="selling_price" placeholder="Selling Price" value="{{$product->selling_price}}" required="required" onchange="check_validation()">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.product_management_product_description')}}:</strong>
                    <input class="form-control" type="text" name="product_des" placeholder="Product Description" value="{{$product->product_description}}" >
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.status')}}:</strong>
                    <select name="status" id="" class="form-control" required="required">
                        <option value='1' {{ $product->status == '1' ? 'selected':'' }}>Enabled</option>
                        <option value='0' {{ $product->status == '0' ? 'selected':'' }}>Disabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-sm">{{trans('dashboard.submit')}}</button>
            </div>
        </div>

    </form>

    <script>
        document.getElementById('selling_price').onkeyup = function(){
            if(this.value.match(/^[a-z0-9_.,'"!?;:& ]+$/i)){
                console.log('English');
            }
            else{
                // console.log('Not English');
                alert('Please enter number in English')
                return $('#selling_price').val('');
            }
        }

        document.getElementById('purchase_price').onkeyup = function(){
            if(this.value.match(/^[a-z0-9_.,'"!?;:& ]+$/i)){
                console.log('English');
            }
            else{
                // console.log('Not English');
                alert('Please enter number in English')
                return $('#purchase_price').val('');
            }
        }

        document.getElementById('quantity').onkeyup = function(){
            if(this.value.match(/^[a-z0-9_.,'"!?;:& ]+$/i)){
                console.log('English');
            }
            else{
                // console.log('Not English');
                alert('Please enter number in English')
                return $('#quantity').val('');
            }
        }


        function check_validation(){
            // var quantity = $("#quantity").val();
            var purchase_price = parseInt($("#purchase_price").val());
            var selling_price = parseInt($("#selling_price").val());
            console.log(purchase_price > selling_price)
            if(purchase_price > selling_price){
                alert("Purchase price is greater than sell price")
                $("#selling_price").val('');
                return false
            }
        }
    </script>
@endsection
