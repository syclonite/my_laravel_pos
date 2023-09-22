@extends('backend.layout')

@section('content')
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h2>{{trans('dashboard.purchase_management_purchase_product')}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{route('purchase.index')}}"> {{trans('dashboard.back')}}</a>
            <!-- Modal for Due Payment Supplier-->
            <div class="modal fade " id="supplier_modal" tabindex="-1" aria-labelledby="SupplierModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('dashboard.supplier_management_supplier_details')}}</h1>
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" >
                            <div class="form-group">
                                <strong>{{trans('dashboard.supplier_management_search_supplier')}}:</strong>
                                <select name="supplier_id" id="due_supplier_id" class="form-control" onchange="get_suppliers(this)">
                                    <option value=''>Please choose one...</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <strong>{{trans('dashboard.supplier_management_supplier_name')}}:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Name" id="due_supplier_name" required>
                            </div>

                            <div class="form-group">
                                <strong>{{trans('dashboard.supplier_management_phone')}}:</strong>
                                <input class="form-control" type="number" name="phone" placeholder="Phone" id="due_supplier_phone" required>
                            </div>
                            <div class="form-group">
                                <strong>{{trans('dashboard.supplier_management_address')}}:</strong>
                                <textarea class="form-control" type="text" name="address" placeholder="Address" cols="20" rows="5" id="due_supplier_address"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add_supplier_modal">{{trans('dashboard.supplier_management_add_new_supplier')}}</button>
                            <button type="button" class="btn btn-smb tn-primary" id="submit_due">{{trans('dashboard.save')}}</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{trans('dashboard.close')}}</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Add Supplier-->
            <div class="modal fade " id="add_supplier_modal" tabindex="-1" aria-labelledby="SupplierModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('dashboard.supplier_management_add_new_supplier')}}</h1>
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" >
                            <div class="form-group">
                                <strong>{{trans('dashboard.supplier_management_supplier_name')}}:</strong>
                                <input type="text" name="supplier_name" class="form-control" placeholder="Name" id="new_supplier_name"  required>
                            </div>

                            <div class="form-group">
                                <strong>{{trans('dashboard.supplier_management_phone')}}:</strong>
                                <input class="form-control" type="number" name="supplier_phone" placeholder="Phone" id="new_supplier_phone" required>
                            </div>
                            <div class="form-group">
                                <strong>{{trans('dashboard.supplier_management_address')}}:</strong>
                                <textarea class="form-control" type="text" name="supplier_address" placeholder="Address" id="new_supplier_address" cols="20" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#supplier_modal" onclick="add_new_supplier()">{{trans('dashboard.save')}}</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{trans('dashboard.close')}}</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Add new Unit -->
            <div class="modal fade " id="add_unit_modal" tabindex="-1" aria-labelledby="UnitModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('dashboard.unit_management_add_new_unit')}}</h1>
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" >
                            <div class="form-group">
                                <strong>{{trans('dashboard.unit_management_unit_name')}}:</strong>
                                <input type="text" name="unit_name" class="form-control" placeholder="Name" id="new_unit_name" required>
                            </div>

                            <div class="form-group">
                                <strong>{{trans('dashboard.unit_management_unit_description')}}:</strong>
                                <textarea class="form-control" type="text" name="unit_des" placeholder="Address" id="new_unit_description" cols="20" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" onclick="add_new_unit()">{{trans('dashboard.save')}}</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{trans('dashboard.close')}}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div><br>

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

<div class="row">
{{--    <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--        <div class="form-group row">--}}
{{--             <strong>{{trans('dashboard.product_management_product_name')}}</strong>--}}
{{--             <div class="col d-inline-flex">--}}
{{--                 <select name="product_id" id="product_id" class="form-control" >--}}
{{--                     <option value=''>Please choose one...</option>--}}
{{--                     @foreach($products as $product)--}}
{{--                         <option value="{{ $product->id }}">{{ $product->product_name }}</option>--}}
{{--                     @endforeach--}}
{{--                 </select>--}}
{{--             </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--        <div class="form-group row">--}}
{{--            <strong>{{trans('dashboard.unit_management_unit_name')}}:</strong>--}}
{{--            <div class="col d-inline-flex">--}}
{{--                <select name="unit_id" id="unit_id" class="form-control">--}}
{{--                    <option value=''>Please choose one...</option>--}}
{{--                    @foreach($units as $unit)--}}
{{--                        <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_unit_modal">+</button>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--       <div class="form-group">--}}
{{--        <strong>{{trans('dashboard.purchase_price')}}</strong>--}}
{{--            <input type="number" name="purchase_price" class="form-control" placeholder="Purchase Price" id="purchase_price">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--        <div class="form-group">--}}
{{--            <strong>{{trans('dashboard.selling_price')}}</strong>--}}
{{--            <input type="number" name="sale_price" class="form-control" placeholder="Sale Price" id="selling_price">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--        <div class="form-group">--}}
{{--            <strong>{{trans('dashboard.quantity')}}</strong>--}}
{{--            <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="quantity">--}}
{{--            <p>Available Stock: <span id="available_stock"></span></p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-xs-4 col-sm-4 col-md-4">--}}

        <div class="form-group row" style="width: 500px">
            <strong>{{trans('dashboard.supplier_management_supplier_name')}}:</strong>
              <div class="col d-inline-flex">
               <select name="supplier_id" id="supplier_id" class="form-control">
                   <option value="">Please Select One</option>
                   @foreach($suppliers as $supplier)
                       <option value="{{$supplier->id}}">{{$supplier->supplier_name}} </option>
                   @endforeach
               </select>
               <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_supplier_modal">+</button>
              </div>
        </div>
{{--    </div>--}}
{{--    <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--        <div class="form-group">--}}
{{--            <strong>{{trans('dashboard.status')}}:</strong>--}}
{{--            <select name="status" id="status_id" class="form-control" onchange="check_payment_status(this)">--}}
{{--                <option value="0">Cash</option>--}}
{{--                <option value="1">Due</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div><br><button type="button" class="btn btn-sm btn-primary col-2 col-md-2 col-sm-2 savebtn" id="add_list" style="float:left">{{trans('dashboard.add_new')}}</button></div>--}}

    <div class="container-fluid">
        <br>
{{--        <table id="myTable" class="table table-bordered">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                --}}{{--                            <th>Serial No</th>--}}
{{--                <th>{{trans('dashboard.product_management_product_name')}}</th>--}}
{{--                <th>{{trans('dashboard.unit_management_unit_name')}}</th>--}}
{{--                <th>{{trans('dashboard.purchase_price')}}</th>--}}
{{--                <th>{{trans('dashboard.quantity')}}</th>--}}
{{--                <th>{{trans('dashboard.selling_price')}}</th>--}}
{{--                <th>{{trans('dashboard.subtotal')}}</th>--}}
{{--                <th>{{trans('dashboard.action')}}</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}

{{--            <tbody>--}}
{{--            <tr>--}}
{{--        --}}{{--                <td></td>--}}
{{--        --}}{{--                <td></td>--}}
{{--        --}}{{--                <td></td>--}}
{{--        --}}{{--                <td></td>--}}
{{--        --}}{{--                <td></td>--}}
{{--        --}}{{--                <td></td>--}}
{{--        --}}{{--                <td></td>--}}
{{--        --}}{{--                <td></td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
        <table id='table' class="table table-bordered">
            <thead>
            <tr>
                {{--            <th>SL</th>--}}
                <th>{{trans('dashboard.product_management_product_name')}}</th>
                <th class="d-none">Product id</th>
                <th>{{trans('dashboard.unit_management_unit_name')}} <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_unit_modal">+</button></th>
                <th class="d-none">Unit id</th>
                <th>{{trans('dashboard.purchase_price')}}</th>
                <th>{{trans('dashboard.quantity')}}</th>
                <th>{{trans('dashboard.selling_price')}}</th>
                <th>{{trans('dashboard.subtotal')}}</th>
                <th>{{trans('dashboard.action')}}</th>
            </tr>
            </thead>
            <tr>
                {{--            <td class="serial">1</td>--}}
                <td>
                    <div>
                        <input  type="text" name="product_text[]" class="form-control product_text">
                    </div>
                </td>
                <td class="d-none">
                    <div>
                        <input type="text" name="product_id[]" class="form-control product_id" readonly="">
                    </div>
                </td>
                <td>
                    <div>
                        <input  type="text" name="unit_text[]" class="form-control unit_text">
                    </div>
                </td>
                <td class="d-none">
                    <div>
                        <input type="text" name="unit_id[]" class="form-control unit_id" readonly="">
                    </div>
                </td>
                <td>
                    <div>
                        <input type="number" name="purchase_price[]" class="form-control purchase_price" >
                    </div>
                </td>
                <td>
                    <div>
                        <input  type="number" name="quantity[]" class="form-control quantity" onchange="get_subtotal(this)">
                    </div>
                </td>
                <td>
                    <div>
                        <input type="number" name="selling_price[]" class="form-control selling_price" onchange="check_prices()" required>
                    </div>
                </td>
                <td>
                    <div>
                        <input type="text" name="subtotal[]" class="form-control subtotal" readonly="">
                    </div>
                </td>
                <td>
                    <div>
                        <button type="button" class="btn btn-danger btn-sm d-none" title="Delete This Row" onclick="remove_cell(this)"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        </table>
        <br>
        <div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>{{trans('dashboard.status')}}:</strong>
                        <select name="status" id="status_id" class="form-control" onchange="check_payment_status(this)">
                            <option value="0">Cash</option>
                            <option value="1">Due</option>
                        </select>
                    </div>
                </div>
                <div class="offset-sm-2 offset-md-8 col-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">{{trans('dashboard.voucher_management_discount')}} :<input class="form-control" type="number" id="discount" name="discount" onchange="bill_calculation()"></li>
                                <li class="list-group-item">{{trans('dashboard.voucher_management_extra_charge')}} :<input class="form-control" type="number" id="extra_charge" name="extra_charge" onchange="bill_calculation()"></li>
                                <li class="list-group-item">{{trans('dashboard.supplier_management_total_bill')}} : <input class="form-control" type="number" id="total_bill" name="total_bill" disabled></li>
                                <li class="list-group-item">{{trans('dashboard.supplier_management_total_paid')}} :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>
                                <li class="list-group-item">{{trans('dashboard.purchase_management_return_amount')}} : <span id="change_amount" ></span>  </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="button" class="btn btn-sm btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >{{trans('dashboard.submit')}}</button>
            </div>
        </div>
    </div>
    <br>
</div>

<style>
    @media screen and (max-width: 480px ) {

        [class*="col-"] {
            width: 100%;
        }

        /*table {*/

        /*    display: block;*/
        /*    max-width: fit-content;*/
        /*    margin: 0 auto;*/
        /*    overflow-x: auto;*/
        /*    white-space: nowrap;*/

        /*}*/
        table, thead, tbody, th, td, tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            margin: 0 0 1rem 0;
        }

        tr:nth-child(odd) {
            background: #ccc;
        }

        /*td {*/
        /*    !* Behave  like a "row" *!*/
        /*    border: none;*/
        /*    border-bottom: 1px solid #eee;*/
        /*    position: relative;*/
        /*    padding-left: 50%;*/
        /*}*/

        /*td:before {*/
        /*    !* Now like a table header *!*/
        /*    position: absolute;*/
        /*    !* Top/left values mimic padding *!*/
        /*    top: 0;*/
        /*    left: 6px;*/
        /*    width: 45%;*/
        /*    padding-right: 10px;*/
        /*    white-space: nowrap;*/
        /*}*/

        /*
        Label the data
    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
        */
        td:nth-of-type(1):before { content: "{{trans('dashboard.product_management_product_name')}}"; }
        td:nth-of-type(2):before { content: "Last Name"; }
        td:nth-of-type(3):before { content: "{{trans('dashboard.unit_management_unit_name')}}"; }
        td:nth-of-type(4):before { content: "Favorite Color"; }
        td:nth-of-type(5):before { content: "{{trans('dashboard.purchase_price')}}"; }
        td:nth-of-type(6):before { content: "{{trans('dashboard.quantity')}}"; }
        td:nth-of-type(7):before { content: "{{trans('dashboard.selling_price')}}"; }
        td:nth-of-type(8):before { content: "{{trans('dashboard.subtotal')}}"; }
        /*td:nth-of-type(9):before { content: "GPA"; }*/
        /*td:nth-of-type(10):before { content: "Arbitrary Data"; }*/
    }
</style>

<script>

    document.getElementById('discount').onkeyup = function(){
        if(this.value.match(/^[a-z0-9_.,'"!?;:& ]+$/i)){
            console.log('English');
        }
        else{
            // console.log('Not English');
            alert('Please enter number in English')
            return $('#discount').val('');
        }
    }

    document.getElementById('extra_charge').onkeyup = function(){
        if(this.value.match(/^[a-z0-9_.,'"!?;:& ]+$/i)){
            console.log('English');
        }
        else{
            // console.log('Not English');
            alert('Please enter number in English')
            return $('#extra_charge').val('');
        }
    }

    document.getElementById('paid_amount').onkeyup = function(){
        if(this.value.match(/^[a-z0-9_.,'"!?;:& ]+$/i)){
            console.log('English');
        }
        else{
            // console.log('Not English');
            alert('Please enter number in English')
            return $('#paid_amount').val('');
        }
    }

    var addedProduct_id = [];
    $(".product_text").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "{{route('sales.get_product_ajax')}}",
                type: "GET",
                data: {search:request.term},
                success: function (data) {
                    console.log(data);
                    response($.map(data, function (el) {
                        return {
                            label: el.product_name,
                            value: el.id,
                        };
                    }));
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();
            // alert(ui.item.label)
            // Prevent value from being put in the input:
            this.value = ui.item.label;
            // Set the next input's value to the "value" of the item.
            $(this).next(".product_text").val(ui.item.label);
            let row = $(event.target).closest('tr');
            addedProduct_id.push(ui.item.value)
            setProductInfo(row,ui.item.value)
            // get_available_units(row,ui.item.value)
        },
        // search: function (event) {
        //     let row = $(event.target).closest('tr')
        //     row.find('.purchase_price').val('')
        //     row.find('.quantity').val('')
        //     row.find('.selling_price').val('')
        //     row.find('.subtotal').val('')
        // }

    });

    $(".unit_text").autocomplete({
        source: function (request, response) {
            $('#add_unit_modal').modal('hide');
            $.ajax({
                url: "{{route('purchase.get_units_all_ajax')}}",
                type: "GET",
                data:{
                    search: request.term,
                },
                success: function(data){
                    console.log(data);
                    response($.map(data, function (el) {
                        return {
                            label: el.unit_name,
                            value: el.id,
                        };
                    }));
                }
            })
        },
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();
            // alert(ui.item.label)
            // Prevent value from being put in the input:
            this.value = ui.item.label;
            // Set the next input's value to the "value" of the item.
            $(this).next(".unit_text").val(ui.item.label);
            let row = $(event.target).closest('tr');
            setUnitInfo(row,ui.item.value)
            // get_available_units(row,ui.item.value)
        },
        search: function (event) {
            let row = $(event.target).closest('tr')
            row.find('.purchase_price').val('')
            row.find('.quantity').val('')
            row.find('.selling_price').val('')
            row.find('.subtotal').val('')
        }

    });

    function check_prices(){
        $("#table tbody tr").each(function(index){
           var selling_price = parseInt($(this).find('.selling_price').val());
           var purchase_price = parseInt($(this).find('.purchase_price').val());

           if(selling_price < purchase_price){
               alert("Purchase price is greater than sell price")
               parseInt($(this).find('.selling_price').val(''));
               return false
           }

        });
    }

    $(document).on("focus", '#table tr:last-child td:nth-child(6)', function() {
        var table = $("#table");
        var element = '<tr>\
        <td><div><input  type="text" name="product_text[]" class="form-control product_text"></div>\
        </td>\
        <td class="d-none"><div> <input type="text" name="product_id[]" class="form-control product_id" readonly=""></div>\
         </td>\
        <td><div><input type="text" name="unit_text[]" class="form-control unit_text"></div>\
        </td>\
        <td class="d-none"><div> <input type="text" name="unit_id[]" class="form-control unit_id" readonly=""></div>\
         </td>\
        <td><div><input type="number" name="purchase_price[]" class="form-control purchase_price" ></div>\
        </td>\
        <td><div> <input  type="number" name="quantity[]" class="form-control quantity" onchange="get_subtotal(this)"></div>\
         </td>\
        <td><div><input  type="number" name="selling_price[]" class="form-control selling_price" onchange="check_prices()" required></div>\
        </td>\
        <td><div><input  type="number" name="subtotal[]" class="form-control subtotal" readonly=""></div>\
         </td>\
        <td><button type="button" class="btn btn-danger btn-sm" title="Delete This Row" onclick="remove_cell(this)"><i class="fa fa-trash"></i></button>\
         </td>\
       </tr>';
        table.append(element);
        console.log($("#table tr:last-child").find(".product_text"));
        $("#table tr:last-child").find(".product_text").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{route('sales.get_product_ajax')}}",
                    type: "GET",
                    data: {search:request.term},
                    success: function (data) {
                        console.log(data);
                        response($.map(data, function (el) {
                            return {
                                label: el.product_name,
                                value: el.id,
                            };
                        }));
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                // Prevent value from being put in the input:
                this.value = ui.item.label;
                // Set the next input's value to the "value" of the item.
                $(this).next(".product_text").val(ui.item.label);
                let row = $(event.target).closest('tr');
                var product_id = ui.item.value;
                var test_data = $.inArray(product_id, addedProduct_id);
                if (test_data >= 0) {
                    return alert("You already added this Product");
                } else {
                    addedProduct_id.push(ui.item.value)
                    setProductInfo(row,ui.item.value)
                }
            },
            // search: function (event) {
            //     let row = $(event.target).closest('tr')
            //     row.find('.purchase_price').val('')
            //     row.find('.quantity').val('')
            //     row.find('.selling_price').val('')
            //     row.find('.subtotal').val('')
            // }
        });

        $("#table tr:last-child").find(".unit_text").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{route('purchase.get_units_all_ajax')}}",
                    type: "GET",
                    data: {search:request.term},
                    success: function (data) {
                        console.log(data);
                        response($.map(data, function (el) {
                            return {
                                label: el.unit_name,
                                value: el.id,
                            };
                        }));
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                // Prevent value from being put in the input:
                this.value = ui.item.label;
                // Set the next input's value to the "value" of the item.
                $(this).next(".unit_text").val(ui.item.label);
                let row = $(event.target).closest('tr');
                setUnitInfo(row,ui.item.value)
            },
            search: function (event) {
                let row = $(event.target).closest('tr')
                row.find('.purchase_price').val('')
                row.find('.quantity').val('')
                row.find('.selling_price').val('')
                row.find('.subtotal').val('')
            }
        });
    });

    function setProductInfo(row, value) {
        console.log(value);
        row.find('.product_id').val(value);
    }

    function setUnitInfo(row, value) {
        console.log(value);
        row.find('.unit_id').val(value);
    }

    function get_subtotal(value){
        // var product_price = $(".selling_price").val();
        var quantity = $(value).closest('tr').find('.quantity').val()
        var purchase_price = $(value).closest('tr').find('.purchase_price').val()
        var subtotal = quantity * purchase_price
        // console.log(quantity,selling_price);
        $(value).closest('tr').find('.subtotal').val(subtotal)
        bill_calculation();

    }


    function add_new_supplier(){
        $.ajax({
            url: "{{route('purchase.add_new_supplier')}}",
            type: "POST",
            data:{
                _token:'{{ csrf_token() }}',
                suppliers:{
                   supplier_name: $('#new_supplier_name').val(),
                   supplier_phone: $('#new_supplier_phone').val(),
                   supplier_address: $('#new_supplier_address').val(),
                },

            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                console.log(dataResult);
            }
        });
        all_ajax_supplier()
    }

    function all_ajax_supplier(){
        // alert('Supplier Added');
        // $('#add_supplier_modal').modal('hide');
        $.ajax({
            url: "{{route('purchase.ajax_all_supplier')}}",
            type: "POST",
            cache: false,
            dataType: 'json',
            data:{
                _token:'{{ csrf_token() }}',
                id: "pass",
            },
            success: function(dataResult){
                console.log(dataResult);
                var data = dataResult.supplier_data_ajax
                var formoption = "<option value=''>" + "Please Select One" + "</option>";
                $.each(data, function(v) {
                    var val = data[v]
                    formoption += "<option value='" + val.id + "'>" + val.supplier_name + "</option>";
                });
                $('#supplier_id').html(formoption);
                $('#due_supplier_id').html(formoption);
            }
        });
    }

    // add list to the table
    // var item = 0;
    //
    // $("button#add_list").click(function() {
    //     // alert('hello');
    //     item++;
    //     var supplier_id = $('#supplier_id').val();
    //     var product_id = $("#product_id").val();
    //     var product_text = $("#product_id option:selected").text();
    //     var purchase_price = $("#purchase_price").val();
    //     var selling_price = $("#selling_price").val();
    //     var quantity = $("#quantity").val();
    //     var unit_id = $("#unit_id").val();
    //     var unit_text = $("#unit_id option:selected").text();
    //     var subtotal = purchase_price * quantity;
    //     // return console.log(expiry_date);
    //     if(product_id === ""){
    //         alert("Product field is missing");
    //         return false;
    //     }else if(unit_id === ""){
    //         alert("Unit field is missing");
    //         return false;
    //     }else if(purchase_price === ""){
    //         alert("Purchase Price field is missing");
    //         return false;
    //     }else if(selling_price === ""){
    //         alert("Selling Price field is missing");
    //         return false;
    //     }else if(quantity === ""){
    //         alert("Quantity field is missing");
    //         return false;
    //     }else if(supplier_id === ""){
    //         alert("Supplier field is missing");
    //         return false;
    //     }
    //     var new_row = '<tr>' +
    //         // '<td>' + ($('#myTable > tr').length + 1) + '</td>'+
    //         '<td class="product_id" style="display: none">' + product_id + '</td>' +
    //         '<td class="unit_id" style="display: none">' + unit_id + '</td>' +
    //         '<td class="product_text">' + product_text + '</td>' +
    //         '<td class="unit_text">' + unit_text + '</td>' +
    //         '<td class="purchase_price">' + purchase_price + '</td>'+
    //         '<td class="quantity">' + quantity + '</td>' +
    //         '<td class="selling_price">' + selling_price + '</td>' +
    //         '<td class="subtotal">' + subtotal + '</td>' +
    //         '<td><input type="button" value="Delete" onclick="remove_cell(this)"/></td></tr>';
    //     var btn = document.createElement('tr');
    //     btn.innerHTML = new_row;
    //     document.getElementById('myTable').appendChild(btn);
    //     bill_calculation();
    // });

    function remove_cell(value){
        $(value).parents("tr").remove()
        bill_calculation();
    }

    function bill_calculation(){
        var total =0;
        $('.subtotal').each((i, el) => total = total + parseInt($(el).val()|| 0));
        console.log(total)
        $('#total_bill').val(total);
        var discount = $('#discount').val();
        // var extra_charge = $('#extra_charge').val();
        var total_bill = total;
        if( discount != '' || extra_charge != ''){
            var result_1 = (total_bill - discount);
            var result_2 =  parseInt(result_1) + Number($('#extra_charge').val());
            // console.log(result_2);
            $("#total_bill").val(result_2);
        }
        var paid_amount = $("#paid_amount").val();
        if (result_2 >= paid_amount){
            var change_amount = result_2 - paid_amount;
            $("#change_amount").text("Due -"+ change_amount);
            // alert("if condition");
        }else{
            change_amount = paid_amount - result_2;
            $("#change_amount").text(change_amount);
        }
    }

    function check_payment_status(selectObject){
        var value = selectObject.value;
        // console.log(value);
        if(value == 1){
            all_ajax_supplier();
            $('#supplier_modal').modal('show');
        }
    }

    $("button#submit_due").click(function() {
        if($("#due_supplier_name").val() == ''){
            alert("Please Select a Supplier")
            return false;
        }
        var data = [];
        var product_id,quantity, purchase_price,selling_price,unit_id,supplier_id
        // return alert(payment_status);
        $("#table tbody tr").each(function(index) {
            product_id = $(this).find('.product_id').val();
            quantity = $(this).find('.quantity').val();
            purchase_price = $(this).find('.purchase_price').val();
            selling_price = $(this).find('.selling_price').val();
            unit_id = $(this).find('.unit_id').val();
            supplier_id = $("#due_supplier_id").val();
            data.push({
                product_id,
                unit_id,
                quantity,
                purchase_price,
                selling_price,
                supplier_id,
            });
        });
        var found = false;
        data.map((item, index) => {
            console.log(item.product_id, item.unit_id, item.quantity,item.purchase_price)
            if (!item?.quantity || !item?.unit_id || !item?.selling_price) {
                // console.log(`array index =>[${index}] is null or empty.`);
                found = true;
            }

        });
        if (found == true) {
            alert("All blanks must be filled")
        } else {
            submit_due_purchase(data)
        }

    });

    $("button#submit").click(function() {
        if($("#supplier_id").val() == ''){
            alert("Please Select a Supplier")
            return false;
        }
        var data = [];
        var product_id,quantity, purchase_price,unit_id,selling_price
        // return alert(payment_status);
        $("#table tbody tr").each(function(index) {
            product_id = $(this).find('.product_id').val();
            unit_id = $(this).find('.unit_id').val();
            quantity = $(this).find('.quantity').val();
            purchase_price = $(this).find('.purchase_price').val();
            selling_price = $(this).find('.selling_price').val();
            data.push({
                product_id,
                unit_id,
                quantity,
                purchase_price,
                selling_price,
            });
        });
        console.log(data);
        var found = false;
        data.map((item, index) => {
            console.log(item);
            if (!item?.quantity || !item?.unit_id || !item?.selling_price) {
                // console.log(`array index =>[${index}] is null or empty.`);
                found = true;
            }

        });
        if (found == true) {
            alert("All blanks must be filled")
        }else if(( parseInt($('#paid_amount').val()) < parseInt($('#total_bill').val())) && $('#status_id').val() == 0){
            alert("Please Change Status to Due because Billing amount is greater than Payable amount")
            return false;
        }else if($('#status_id').val() == 1 && ($('#paid_amount').val() < $('#total_bill').val())){
            // percentage_cal(data)
            // submit_stock_order(data)
            // return window.print();
            submit_purchase(data)
        }else{
            submit_purchase(data)
        }
        // if(data == ""){
        //     alert("Please Add list then try again ")
        // }else if($('#paid_amount').val() < $('#total_bill').val() ){
        //     alert("Please Change Status to Due because Billing amount is greater than Payable amount")
        //     return false;
        // }else{
        //     submit_purchase(data)
        // }

    });

    function get_suppliers(supplier_due_id){
        var supplier_id = supplier_due_id.value;
        $.ajax({
            url: "{{route('purchase.supplier_details')}}",
            type: "POST",
            data:{
                _token:'{{ csrf_token() }}',
                id: supplier_id,
            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                console.log(dataResult);
                var resultData = dataResult;
                // var bodyData = '';
                // var i=1;
                $.each(resultData,function(index,row){
                    $('#due_supplier_name').val(row.supplier_name);
                    $('#due_supplier_phone').val(row.phone_1);
                    $('#due_supplier_address').val(row.address);
                })
            }
        });
    }

    function showmsg(){
        alert("Purchase Order Created")
        window.location.href = '{{route('purchase.print_purchase_invoice',1)}}';
    }

    function submit_purchase(data){
         console.log(data);
        // return console.log("percentage status_value:"+value)
        $.ajax({
            url: "{{route('purchase.store')}}",
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
            data: {
                "_token": "{{ csrf_token() }}",
                purchase_order_details: data,
                purchase_order: {
                    supplier_id: $("#supplier_id").val(),
                    paid_amount: $("#paid_amount").val(),
                    billing_amount: $("#total_bill").val(),
                    extra_charge: $("#extra_charge").val(),
                    discount: $("#discount").val(),
                    status: $("#status_id").val(),
                }
            },
            success: function (data) {
                console.log(data)
                alert("Purchase Order Created")
                window.location.href = data.link;
            }
        })
    }

    function submit_due_purchase(data){
        // return console.log(data);
        // return console.log("percentage status_value:"+value)
        $.ajax({
            url: "{{route('purchase.store')}}",
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
            data: {
                "_token": "{{ csrf_token() }}",
                purchase_order_details: data,
                purchase_order: {
                    supplier_id: $("#due_supplier_id").val(),
                    paid_amount: $("#paid_amount").val(),
                    billing_amount: $("#total_bill").val(),
                    extra_charge: $("#extra_charge").val(),
                    discount: $("#discount").val(),
                    status: $("#status_id").val(),
                }
            },
            success: function (data) {
                console.log(data)
                alert("Purchase Order Created")
                window.location.href = data.link;
            }
        })
    }


    function add_new_unit(){
        $.ajax({
            url: "{{route('purchase.add_new_unit')}}",
            type: "POST",
            data:{
                _token:'{{ csrf_token() }}',
                units:{
                    unit_name: $('#new_unit_name').val(),
                    unit_des: $('#new_unit_description').val(),
                },

            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                console.log(dataResult);
            }
        });
        all_ajax_unit()
    }
    function all_ajax_unit(){
        alert('Unit Added')
        $('#add_unit_modal').modal('hide');
        $.ajax({
            url: "{{route('purchase.get_units_all_ajax')}}",
            type: "POST",
            cache: false,
            dataType: 'json',
            data:{
                _token:'{{ csrf_token() }}',
                id: "pass",
            },
            success: function(dataResult){
                console.log(dataResult);
                var data = dataResult.units_data_ajax
                var formoption = "";
                $.each(data, function(v) {
                    var val = data[v]
                    formoption += "<option value='" + val.id + "'>" + val.unit_name + "</option>";
                });
                $('#unit_id').html(formoption);
            }
        });
    }
</script>

@endsection
