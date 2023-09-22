@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Sale New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('sales.index')}}"> {{trans('dashboard.back')}}</a>
                <!-- Modal for Due Payment-->
                <div class="modal fade " id="customer_modal" tabindex="-1" aria-labelledby="CustomerModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Customer Details</h1>
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" >
                               <div class="card">
                                   <div class="card-body">
                                       <div class="form-group">
                                           <strong>{{trans('dashboard.customer_management_search_customer')}}:</strong>
                                           <select name="customer_id" id="due_customer_id" class="form-control" onchange="get_customers(this)">

                                           </select>
                                       </div>
                                   </div>
                               </div>

                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_name')}}:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Name" id="due_customer_name" required="required">
                                </div>

                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_phone')}}:</strong>
                                    <input class="form-control" type="number" name="phone" placeholder="Phone" id="due_customer_phone" required="required">
                                </div>
                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_address')}}:</strong>
                                    <textarea class="form-control" type="text" name="address" placeholder="Address" cols="20" rows="5" id="due_customer_address"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add_customer_modal">{{trans('dashboard.customer_management_add_new_customer')}}</button>
                                <button type="button" class="btn btn-sm btn-primary" id="submit_due">{{trans('dashboard.save')}}</button>
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{trans('dashboard.close')}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Add User-->
                <div class="modal fade " id="add_customer_modal" tabindex="-1" aria-labelledby="CustomerModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('dashboard.customer_management_add_new_customer')}}</h1>
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" >
                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_name')}}:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Name" id="new_customer_name"  required="required">
                                </div>

                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_phone')}}:</strong>
                                    <input class="form-control" type="number" name="phone" placeholder="Phone" id="new_customer_phone" required="required">
                                </div>
                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_address')}}:</strong>
                                    <textarea class="form-control" type="text" name="address" placeholder="Address" id="new_customer_address" cols="20" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#customer_modal" onclick="add_new_customer()">{{trans('dashboard.save')}}</button>
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{trans('dashboard.close')}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for adding customer without dues -->
                <div class="modal fade " id="add_no_due_customer_modal" tabindex="-1" aria-labelledby="CustomerModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('dashboard.customer_management_add_new_customer')}}</h1>
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" >
                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_name')}}:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Name" id="new_no_due_customer_name"  required="required">
                                </div>

                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_phone')}}:</strong>
                                    <input class="form-control" type="number" name="phone" placeholder="Phone" id="new_no_due_customer_phone" required="required">
                                </div>
                                <div class="form-group">
                                    <strong>{{trans('dashboard.customer_management_address')}}:</strong>
                                    <textarea class="form-control" type="text" name="address" placeholder="Address" id="new_no_due_customer_address" cols="20" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal" onclick="add_no_due_new_customer()">{{trans('dashboard.save')}}</button>
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

    <table id='table' class="table table-bordered">
        <thead>
        <tr>
{{--            <th>SL</th>--}}
            <th>{{trans('dashboard.product_management_product_name')}}</th>
            <th class="d-none">Product id</th>
            <th>{{trans('dashboard.unit_management_unit_name')}}</th>
            <th class="d-none">Unit id:</th>
            <th>{{trans('dashboard.selling_price')}}</th>
            <th>{{trans('dashboard.quantity')}}</th>
            <th>{{trans('dashboard.product_management_available_stock')}}</th>
            <th>{{trans('dashboard.subtotal')}}</th>
            <th>{{trans('dashboard.action')}}</th>
        </tr>
        </thead>
        <tr>
{{--            <td class="serial">1</td>--}}
            <td>
                <div>
                    <input type="text"  name="product_text[]" class="form-control product_text">
                </div>
            </td>
            <td class="d-none">
                <div>
                    <input type="text" name="product_id[]" class="form-control product_id" readonly="">
                </div>
            </td>
            <td>
                <div>
                    <input  type="text" name="unit_text[]" class="form-control unit_text" readonly="">
                </div>
            </td>
            <td class="d-none">
                <div>
                    <input  type="text" name="unit_id[]" class="form-control unit_id" readonly="">
                </div>
            </td>
            <td>
                <div>
                    <input  type="text" name="selling_price[]" class="form-control selling_price" readonly="">
                </div>
            </td>
            <td>
                <div>
                    <input  type="number" name="quantity[]" class="form-control quantity" onkeyup="get_subtotal(this)">
                </div>
            </td>
            <td>
                <div>
                    <input  type="number" class="form-control stock" readonly="">
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

    <div class="row">

        <div class="container">
            <br>
            <div>
                <div class="row">
                    <div class="col col-4">
                        <div class="card" >
                            <div class="card-body">
                                    <div class="form-group row">
                                        <strong>{{trans('dashboard.customer_management_name')}}:</strong>
                                        <div class="col d-inline-flex">
                                            <select name="customer_id" id="customer_id" class="form-control">
                                                <option value=''>Please choose one...</option>
                                                {{--                                            @foreach($customers as $customer)--}}
                                                {{--                                                <option value="{{ $customer->id }}">{{ $customer->name}}</option>--}}
                                                {{--                                            @endforeach--}}
                                            </select>
                                            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_no_due_customer_modal">+</button>
                                        </div>
                                    </div>
                                <div class="">
                                    <div class="form-group">
                                        <strong>{{trans('dashboard.status')}}:</strong>
                                        <select name="status" id="status_id" class="form-control" onchange="check_payment_status(this)">
                                            <option value="0">Cash</option>
                                            <option value="1">Due</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-4">

                    </div>
                    <div class="col col-4">
                        <div class="card">
                            <div class="card-body">

                                <div><br></div>
                                <ul class="list-group">
                                    <li class="list-group-item">{{trans('dashboard.voucher_management_discount')}} :<input class="form-control" type="number" id="discount" name="discount" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">{{trans('dashboard.voucher_management_extra_charge')}}:<input class="form-control" type="number" id="extra_charge" name="extra_charge" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">{{trans('dashboard.customer_management_total_bill')}}: <input class="form-control" type="number" id="total_bill" name="total_bill" disabled></li>
                                    <li class="list-group-item">{{trans('dashboard.customer_management_total_paid')}}:<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">{{trans('dashboard.purchase_management_return_amount')}}  : <span id="change_amount" ></span>  </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <br>
                    <button type="button" class="btn btn-sm btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >{{trans('dashboard.submit')}} </button>
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
            td:nth-of-type(5):before { content: "{{trans('dashboard.selling_price')}}"; }
            td:nth-of-type(6):before { content: "{{trans('dashboard.quantity')}}"; }
            td:nth-of-type(7):before { content: "{{trans('dashboard.product_management_available_stock')}}"; }
            td:nth-of-type(8):before { content: "{{trans('dashboard.subtotal')}}"; }
            /*td:nth-of-type(9):before { content: "GPA"; }*/
            /*td:nth-of-type(10):before { content: "Arbitrary Data"; }*/
        }
    </style>

    <script>

        window.onload = function() {
            $.ajax({
                url: "{{route('sales.ajax_all_customer')}}",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    id: "pass",
                },
                success: function(dataResult){
                    console.log(dataResult);
                    var data = dataResult.customer_data_ajax
                    var main_data = "<option value=''>" + " " + "</option>";
                    $.each(data, function(v) {
                        var val = data[v]
                        main_data += "<option value='" + val.id + "'>" + val.name + "</option>";
                    });
                    $('#customer_id').html(main_data);
                }
            });
        };

        function add_no_due_new_customer(){
            $.ajax({
                url: "{{route('sales.add_new_customer')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    customers:{
                        name: $('#new_no_due_customer_name').val(),
                        phone: $('#new_no_due_customer_phone').val(),
                        address: $('#new_no_due_customer_address').val(),
                    },

                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                }
            });
            alert("Customer added successfully")

            $.ajax({
                url: "{{route('sales.ajax_all_customer')}}",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    id: "pass",
                },
                success: function(dataResult){
                    console.log(dataResult);
                    var data = dataResult.customer_data_ajax
                    // var formoption = "<option value=''>" + "Please Select One" + "</option>";
                    $.each(data, function(v) {
                        var val = data[v]
                        formoption += "<option value='" + val.id + "'>" + val.name + "</option>";
                    });
                    $('#customer_id').html(formoption);
                }
            });

        }


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
                get_available_units(row,ui.item.value)
            },
            search: function (event) {
                let row = $(event.target).closest('tr')
                row.find('.product_id').val('')
                row.find('.unit_text').val('')
                row.find('.unit_id').val('')
                row.find('.selling_price').val('')
                row.find('.quantity').val('')
                row.find('.stock').val('')
                row.find('.subtotal').val('')
            }

        });

        //

        $(document).on("focus", '#table tr:last-child td:nth-child(6)', function() {
            console.log(addedProduct_id)
            var table = $("#table");
            var element = '<tr>\
        <td><div><input  type="text" name="product_text[]" class="form-control product_text"></div>\
        </td>\
        <td class="d-none"><div> <input  type="text" name="product_id[]" class="form-control product_id" readonly=""></div>\
         </td>\
        <td><div><input  type="text" name="unit_text[]" class="form-control unit_text" readonly=""></div>\
        </td>\
        <td class="d-none"><div> <input  type="text" name="unit_id[]" class="form-control unit_id" readonly=""></div>\
         </td>\
        <td><div><input  type="text" name="selling_price[]" class="form-control selling_price" readonly=""></div>\
        </td>\
        <td><div> <input  type="number" name="quantity[]" class="form-control quantity" onkeyup="get_subtotal(this)"></div>\
         </td>\
        <td><div><input  type="number" name="" class="form-control stock" readonly></div>\
        </td>\
        <td><div><input type="number" name="subtotal[]" class="form-control subtotal" readonly=""></div>\
         </td>\
        <td><button type="button" class="btn btn-danger btn-sm" title="Delete This Row" onclick="remove_cell(this)"><i class="fa fa-trash"></i></button>\
         </td>\
       </tr>';
            table.append(element)

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
                        get_available_units(row,ui.item.value)
                    }
                },
                search: function (event) {
                    let row = $(event.target).closest('tr')
                    row.find('.product_id').val('')
                    row.find('.unit_text').val('')
                    row.find('.unit_id').val('')
                    row.find('.selling_price').val('')
                    row.find('.quantity').val('')
                    row.find('.stock').val('')
                    row.find('.subtotal').val('')
                }
            });
        });

        function setProductInfo(row, value) {
            console.log(value);
            row.find('.product_id').val(value);
        }

        function setProductUnits(row, value) {
            var available_stock = value.available_stock_ajax;
            var selling_price = value.product_price;
            var data = value.available_units_ajax;

            // console.log(data[0].unit_name);
            row.find('.selling_price').val(selling_price)
            row.find('.unit_text').val(data[0].unit_name);
            row.find('.unit_id').val(data[0].unit_id);
            row.find('.stock').val(available_stock);
            // get_subtotal(row);
        }


        function get_available_units(row,value){
            // var product_id = id.value;
            console.log(row);
            $.ajax({
                url: "{{route('sales.available_units_ajax')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    product_id: value,
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    setProductUnits(row,dataResult)

                    // var available_stock = dataResult.available_stock_ajax;
                    // var selling_price = dataResult.product_price;
                    // var data = dataResult.available_units_ajax;

                    // $('.stock').val(available_stock);
                    // $('.selling_price').val(selling_price);
                    // $('.unit_id').val(data.unit_id);
                    // $('.unit_text').val(data.unit_name);
                }

            });

        }

        function get_available_stock_price(){
            // var product_id = id.value;
            // alert(value);

            $.ajax({
                url: "{{route('sales.available_stock_price_ajax')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    product_id: $('#product_id option:selected').val(),
                    unit_id: $('#unit_id option:selected').val(),
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    var available_stock = dataResult.available_stock_ajax;
                    var selling_price = dataResult.product_price;
                    $('#available_stock').html(available_stock);
                    $('#product_price').val(selling_price);
                },

            });

        }

        function get_subtotal(value){
            // var product_price = $(".selling_price").val();
            var quantity = parseInt($(value).closest('tr').find('.quantity').val())
            var selling_price = parseInt($(value).closest('tr').find('.selling_price').val())
            var subtotal = quantity * selling_price
            var available_stock = parseInt($(value).closest('tr').find('.stock').val())
            console.log(available_stock);
            console.log(quantity);
            console.log(quantity > available_stock);
            if(quantity > available_stock){
                alert("Quantity is greater than Stock Or Cannot be blank")
                parseInt($(value).closest('tr').find('.quantity').val(''))
                parseInt($(value).closest('tr').find('.subtotal').val(0))

            }else{
                console.log("correct")
                parseInt($(value).closest('tr').find('.subtotal').val(subtotal))
                bill_calculation();
            }
            // $(value).closest('tr').find('.subtotal').val(subtotal)
            // bill_calculation();
            // var current_stock = false;
            //
            // if(available_stock < quantity){
            //     current_stock = true;
            // }
            // if(current_stock == true){
            //      alert('Quantity is greater than Stock');
            //     $(value).closest('tr').find('.quantity').val('0')
            // }else{
            //     $(value).closest('tr').find('.subtotal').val(subtotal)
            //     bill_calculation();
            // }
            // console.log(quantity,selling_price);

        }

        function add_new_customer(){
            $.ajax({
                url: "{{route('sales.add_new_customer')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    customers:{
                        name: $('#new_customer_name').val(),
                        phone: $('#new_customer_phone').val(),
                        address: $('#new_customer_address').val(),
                    },

                },
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    alert("Customer added successfully")
                    $('#add_customer_modal').modal('hide');
                    $('#customer_modal').modal('show');
                }
            });
            all_ajax_customers()
        }

        // add list to the table
        // var item = 0;

        // $("button#add_list").click(function() {
        //     // alert('hello');
        //     item++;
        //     var customer_id = $('#customer_id').val();
        //     var product_id = $("#product_id").val();
        //     var product_text = $("#product_id option:selected").text();
        //     var product_price = $("#product_price").val();
        //     var quantity = $("#quantity").val();
        //     var unit_id = $("#unit_id").val();
        //     var unit_text = $("#unit_id option:selected").text();
        //     var subtotal = product_price * quantity;
        //     // return console.log(expiry_date);
        //     if(product_id === ""){
        //         alert("Product field is missing");
        //         return false;
        //     }else if(unit_id === ""){
        //         alert("Unit field is missing");
        //         return false;
        //     }else if(product_price === ""){
        //         alert("Product Price field is missing");
        //         return false;
        //     }else if(quantity === ""){
        //         alert("Quantity field is missing");
        //         return false;
        //     }else if(customer_id === ""){
        //         alert("Customer field is missing");
        //         return false;
        //     }
        //     var new_row = '<tr>' +
        //         '<td style="position: relative;left: 30px;">' + ($('#myTable > tr').length + 1) + '</td>'+
        //         '<td class="product_id" style="display: none">' + product_id + '</td>' +
        //         '<td class="unit_id" style="display: none">' + unit_id + '</td>' +
        //         '<td class="product_text">' + product_text + '</td>' +
        //         '<td class="unit_text">' + unit_text + '</td>' +
        //         '<td class="product_price">' + product_price + '</td>'+
        //         '<td class="quantity">' + quantity + '</td>' +
        //         '<td class="subtotal">' + subtotal + '</td>' +
        //         '<td><input type="button" style="background-color: red;" onclick="remove_cell(this)"/></td></tr>';
        //     var btn = document.createElement('tr');
        //     btn.innerHTML = new_row;
        //     document.getElementById('myTable').appendChild(btn);
        //     bill_calculation();
        // });

        // $("button#clear_list-item").click(function() {
        //     $('#product_id').val('').trigger('change');
        //     $('#unit_id').val('').trigger('change');
        //     $('#product_price').val('');
        //     $('#quantity').val('');
        //     $('#product_subtotal_sale').val('');
        //     //$('#mySelect').val('2').trigger('change');
        //
        // });


        function remove_cell(value){
            $(value).parents("tr").remove()
            // console.log(value.closest("tr"));
            bill_calculation();
        }

        function bill_calculation(){
            var total =0;
            // $('.subtotal').each(function(index, tr) {
            //     // debugger
            //     total = total + parseInt($(this).val());
            // });
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
            // alert("check_payment_");
            var value = selectObject.value;
            // console.log(value);
            if(value == 1){
                all_ajax_customers();
                $('#customer_modal').modal('show');
            }
        }

        $("button#submit_due").click(function() {
            if($("#due_customer_name").val() == ""){
                alert("Please Select a Customer")
                return false;
            }
            var data = [];
            var product_id,quantity, product_price,unit_id
            // return alert(payment_status);
            $("#table tbody tr").each(function(index) {
                product_id = $(this).find('.product_id').val();
                unit_id = $(this).find('.unit_id').val();
                quantity = $(this).find('.quantity').val();
                product_price = $(this).find('.selling_price').val();
                data.push({
                    product_id,
                    unit_id,
                    quantity,
                    product_price,
                });
            });
            console.log(data);
            var found = false;
            data.map((item, index) => {
                if (!item?.quantity) {
                    // console.log(`array index =>[${index}] is null or empty.`);
                    found = true;
                }

            });
            if (found == true) {
                alert("All blanks must be filled")
            } else {
                submit_due_sales(data)

            }
                // percentage_cal(data)
                // submit_stock_order(data)
                // return window.print();
        });

        $("button#submit").click(function() {
           // return console.log($("#customer_id").val() == '')
            if($("#customer_id").val() == ''){
                alert("Please Select a Customer")
                return false;
            }
            var data = [];
            var product_id,quantity, product_price,unit_id
            // return alert(payment_status);
            // $("#myTable >tr").each(function(index) {
            $("#table tbody tr").each(function(index) {
                product_id = $(this).find('.product_id').val();
                unit_id = $(this).find('.unit_id').val();
                quantity = $(this).find('.quantity').val();
                product_price = $(this).find('.selling_price').val();
                data.push({
                    product_id,
                    unit_id,
                    quantity,
                    product_price,
                });
            });
            console.log(data);
            var found = false;
            data.map((item, index) => {
                if (!item?.quantity) {
                    // console.log(`array index =>[${index}] is null or empty.`);
                    found = true;
                }

            });
            if (found == true) {
                alert("All blanks must be filled")
            } else if((parseInt($('#paid_amount').val()) < parseInt($('#total_bill').val())) && $("#status_id").val() == 0 ) {
                alert("Please Change Status to Due because Billing amount is greater than Payable amount")
                return false
            }else if(($('#paid_amount').val() < $('#total_bill').val()) && $("#status_id").val() == 1 ) {
                submit_sales(data)
            }else {
                submit_sales(data)
            }

            // return percentage_cal();
            // return console.log(data);
            // if(data == ""){
            //     alert("Please Add list then try again ")
            // }else if($('#paid_amount').val() !== $('#total_bill').val() ){
            //     alert("Please Change Status to Due because Billing amount is greater than Payable amount")
            //     return false;
            // }
            // else{
            //     // percentage_cal(data)
            //     // submit_stock_order(data)
            //     // return window.print();
            //     submit_sales(data)
            // }

        });

        function get_customers(customer_due_id){
            var customer_id = customer_due_id.value;
            $.ajax({
                url: "{{route('sales.customer_details')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    id: customer_id,
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    var resultData = dataResult;
                    // var bodyData = '';
                    // var i=1;
                    $.each(resultData,function(index,row){
                        $('#due_customer_name').val(row.name);
                        $('#due_customer_phone').val(row.phone);
                        $('#due_customer_address').val(row.address);
                    })
                }
            });
        }

        function all_ajax_customers(){
            $.ajax({
                url: "{{route('sales.ajax_all_customer')}}",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    id: "pass",
                },
                success: function(dataResult){
                    console.log(dataResult);
                    var data = dataResult.customer_data_ajax
                    var formoption = "<option value=''>" + "Please Select One" + "</option>";
                    $.each(data, function(v) {
                        var val = data[v]
                        formoption += "<option value='" + val.id + "'>" + val.name + "</option>";
                    });
                    $('#due_customer_id').html(formoption);
                }
            });
        }

        function showmsg(){
            alert("New Order Created")
            // window.location.reload();
            {{--window.location.href = '{{route('sales.print_sale_invoice',1)}}';--}}
        }

        function submit_sales(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)

            $.ajax({
                url: "{{route('sales.store')}}",
                type: "POST",
                // contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json", // Set dataType to "text" to prevent automatic parsing
                data: {
                    "_token": "{{ csrf_token() }}",
                    sale_order_details: data,
                    sale_order: {
                        customer_id: $("#customer_id").val(),
                        paid_amount: $("#paid_amount").val(),
                        billing_amount: $("#total_bill").val(),
                        extra_charge: $("#extra_charge").val(),
                        discount: $("#discount").val(),
                        status: $("#status_id").val(),
                    }
              },
                success: function(data) {
                    console.log(data);
                    alert("New Order Created");
                    window.location.href = data.link;
                }
            })
        }

        function submit_due_sales(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "{{route('sales.store')}}",
                type: "POST",
                // contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    sale_order_details: data,
                    sale_order: {
                        customer_id: $("#due_customer_id").val(),
                        paid_amount: $("#paid_amount").val(),
                        billing_amount: $("#total_bill").val(),
                        extra_charge: $("#extra_charge").val(),
                        discount: $("#discount").val(),
                        status: $("#status_id").val(),
                    }
                },
                success: function (data) {
                    console.log(data)
                    alert("New Order Created");
                    window.location.href = data.link;
                }
            })
        }

    </script>
@endsection
