@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>{{trans('dashboard.product_management_add_new_product')}}</h2>
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

    <!-- Modal to Add Unit -->

    <!-- Modal -->
    <div class="modal fade" id="add_unit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_unitLabel">{{trans('dashboard.unit_management_add_new_unit')}}</h5>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans('dashboard.unit_management_unit_name')}}:</strong>
                                <input type="text" name="unit_name" class="form-control" placeholder="Unit Name" id="unit_name" required="required">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans('dashboard.unit_management_unit_description')}}:</strong>
                                <input class="form-control" type="text" name="unit_des" placeholder="Unit Description" id="unit_des">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" onclick="add_new_unit()">{{trans('dashboard.save')}}</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{trans('dashboard.close')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal to Add Unit -->

    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>{{trans('dashboard.product_management_product_name')}}:</strong>
                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" required="required">
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group row">
                    <strong>{{trans('dashboard.unit_management_unit_name')}}:</strong>
                        <div class="col d-inline-flex">
                            <select name="unit_id" id="unit_id" class="form-control" required="required">
                                <option value=''>Please choose one...</option>
                                @foreach($units??'' as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_unit">+</button>
                        </div>
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>{{trans('dashboard.quantity')}}:</strong>
                    <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity" required="required">
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>{{trans('dashboard.purchase_price')}}:</strong>
                    <input type="number" name="purchase_price" class="form-control" id="purchase_price" placeholder="Purchase Price" required="required">
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>{{trans('dashboard.selling_price')}}:</strong>
                    <input type="number" name="selling_price" class="form-control" id="selling_price" placeholder="Selling Price" onchange="check_validation()" required>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>{{trans('dashboard.product_management_product_description')}}:</strong>
                    <input class="form-control" type="text" name="product_des" placeholder="Product Description">
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>{{trans('dashboard.product_management_subcategories')}}:</strong>
                    <select name="subcategory_id" id="" class="form-control" required="required">
                        <option value=''>Please choose one...</option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>{{trans('dashboard.status')}}:</strong>
                    <select name="status" id="" class="form-control" required="required">
                        <option value="1">Enabled</option>
                        <option value="0">Disabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-sm btn-primary" onclick="check_validation()">{{trans('dashboard.submit')}}</button>
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

        function add_new_unit(){
            $('#add_unit').modal("hide");
            alert('Unit Saved')
            $.ajax({
                url: "{{route('units.store')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                        unit_name: $('#unit_name').val(),
                        unit_des: $('#unit_des').val(),

                },

                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                }
            });
            get_ajax_unit();
        }

        function get_ajax_unit(){
            $.ajax({
                url: "{{route('products.get_unit_ajax')}}",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    id: "pass",
                },
                success: function(dataResult){
                    console.log(dataResult);
                    var data = dataResult.unit_data_ajax
                    var formoption = "<option value=''>" + "Please Select one" + "</option>";
                    $.each(data, function(v) {
                        var val = data[v]
                        formoption += "<option value='" + val.id + "'>" + val.unit_name + "</option>";
                    });
                    $('#unit_id').html(formoption);
                }
            });
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

