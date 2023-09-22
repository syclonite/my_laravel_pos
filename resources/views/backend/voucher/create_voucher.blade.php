@extends('backend.layout')
@section('content')
    <div class="">
        <!-- Add Customer Modal -->
        <div class="modal fade " id="add_voucher_customer_modal" tabindex="-1" aria-labelledby="CustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('dashboard.customer_management_add_new_customer')}} </h1>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <div class="form-group">
                            <strong>{{trans('dashboard.customer_management_name')}} :</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name" id="new_customer_name"  required>
                        </div>

                        <div class="form-group">
                            <strong>{{trans('dashboard.customer_management_phone')}} :</strong>
                            <input class="form-control" type="text" name="phone" placeholder="Phone" id="new_customer_phone" required>
                        </div>
                        <div class="form-group">
                            <strong>{{trans('dashboard.customer_management_address')}} :</strong>
                            <textarea class="form-control" type="text" name="address" placeholder="Address" id="new_customer_address" cols="20" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" onclick="add_new_customer()">{{trans('dashboard.save')}} </button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{trans('dashboard.close')}} </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Customer Modal -->

        <section>
            <header class="clearfix">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center" >
                            <img src="{{url('images/nowshad_enterprise_edited.jpg')}}" style="height: 100px; width: 200px;margin-top:-48px;">
                        </div>
                        <br>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <div class="row">
                                <div class="col-12"><h2 class="d-flex justify-content-center">নওশাদ এন্টারপ্রাইজ</h2></div>
                                <div class="col-12"><h4 class="d-flex justify-content-center">মোঃ সাহান নাজমুস সাদ্দাত</h4></div>
                                <div class="col-12"><h5 class="d-flex justify-content-center">এখানে রড, সিমেন্ট,স্যানিটারি ও হার্ডওয়্যার এর সকল পণ্য খুচরা ও পাইকারী বিক্রয় হয়</h5></div>
                                <div class="col-12"><h5 class="d-flex justify-content-center">মোবাইল:০১৭১৬৯৯৪৮৪৮,০১৭৯৪৪০৪৫৪৬,০১৭১৬৯৯৪৮৪৮,০১৭৯৪৪০৪৫৪৬ </h5></div>
                                <div class="col-12"><h5 class="d-flex justify-content-center">ছোটবনগ্রাম,চন্দ্রিমাথানার মোড়,রাজশাহী</h5></div>
                                <div class="col-12"><h5 class="d-flex justify-content-center">ইমেলঃ najmussaddat149@gmail.com</h5></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <hr>
        </section>

        <section>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <strong>{{trans('dashboard.voucher_management_search_customer')}} :</strong>
                                <div class="col-12 d-inline-flex" >
                                    <select name="customer_id" id="voucher_customer_id" class="form-control" onchange="customer_info()" style="width: 300px">
                                        <option value=''>Please choose one...</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}|{{ $customer->phone}}|{{ $customer->address}}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_voucher_customer_modal">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 customer_section">
                            <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_name')}} :</strong><span id="voucher_customer_name"></span></div>
                            <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_phone')}} :</strong><span id="voucher_customer_phone"></span></div>
                            <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_address')}} :</strong><span id="voucher_customer_address"></span></div>
                        </div>
                        <div class="col-2">
                            <a href="{{route('voucher.voucher_index')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <hr>
        <section>
            <div class="d-flex justify-content-center"><h1><u>{{trans('dashboard.voucher_management_add_product_list')}}</u></h1></div>
            <br>
{{--            <div class="row">--}}
{{--                <div class="col-xs-6 col-sm-6 col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <strong>{{trans('dashboard.product_management_product_name')}} </strong>--}}
{{--                        <select name="product_id" id="product_id" class="form-control" >--}}
{{--                            <option value=''>Please choose one...</option>--}}
{{--                            @foreach($products as $product)--}}
{{--                                <option value="{{ $product->id }}">{{ $product->product_name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xs-6 col-sm-6 col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <strong>{{trans('dashboard.units')}} :</strong>--}}
{{--                        <select name="unit_id" id="unit_id" class="form-control" onchange="get_product_price()">--}}
{{--                            <option value=''>Please choose one...</option>--}}
{{--                            @foreach($units as $unit)--}}
{{--                                <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xs-6 col-sm-6 col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <strong>{{trans('dashboard.selling_price')}} </strong>--}}
{{--                        <input type="number" name="product_price" class="form-control" placeholder="Product Price" id="product_price" disabled>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xs-6 col-sm-6 col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <strong>{{trans('dashboard.quantity')}} </strong>--}}
{{--                        <input type="number" name="quantity" class="form-control" placeholder="Quantity" id="quantity">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div><br><button type="button" class="btn btn-sm btn-primary col-2 col-md-2 col-sm-2 savebtn" id="add_list" style="float:left">{{trans('dashboard.add_new')}}  </button></div>--}}

{{--                <div class="container">--}}
{{--                    <br>--}}
{{--                    <table id="myTable" class="table table-bordered">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Serial No</th>--}}
{{--                            <th>{{trans('dashboard.product_management_product_name')}} </th>--}}
{{--                            <th>{{trans('dashboard.units')}} </th>--}}
{{--                            <th>{{trans('dashboard.selling_price')}} </th>--}}
{{--                            <th>{{trans('dashboard.quantity')}} </th>--}}
{{--                            <th>{{trans('dashboard.subtotal')}} </th>--}}
{{--                            <th>{{trans('dashboard.customer_management_action')}} </th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}

{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

{{--                    <br>--}}
{{--                    <div>--}}
            <div>
                <table id='table' class="table table-bordered table-container">
                    <thead>
                    <tr>
                        {{--            <th>SL</th>--}}
                        <th>{{trans('dashboard.product_management_product_name')}}</th>
                        <th class="d-none">Product id</th>
                        <th>{{trans('dashboard.unit_management_unit_name')}}</th>
                        <th class="d-none">Unit id:</th>
                        <th>{{trans('dashboard.selling_price')}}</th>
                        <th>{{trans('dashboard.quantity')}}</th>
                        {{--                    <th>{{trans('dashboard.product_management_available_stock')}}</th>--}}
                        <th>{{trans('dashboard.subtotal')}}</th>
                        <th>{{trans('dashboard.action')}}</th>
                    </tr>
                    </thead>
                    <tr>
                        {{--            <td class="serial">1</td>--}}
                        <td>
                            <div>
                                <input type="text" name="product_text[]" class="form-control product_text">
                            </div>
                        </td>
                        <td class="d-none">
                            <div>
                                <input  type="text" name="product_id[]" class="form-control product_id" readonly="">
                            </div>
                        </td>
                        <td>
                            <div>
                                <input  type="text" name="unit_text[]" class="form-control unit_text" readonly="">
                            </div>
                        </td>
                        <td class="d-none">
                            <div>
                                <input type="text" name="unit_id[]" class="form-control unit_id" readonly="">
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="number" name="selling_price[]" class="form-control selling_price" readonly="">
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="number" name="quantity[]" id="quantity" class="form-control quantity" onchange="get_subtotal(this)">
                            </div>
                        </td>
                        {{--                    <td>--}}
                        {{--                        <div>--}}
                        {{--                            <input style="width: 100px" type="text" class="stock" readonly="">--}}
                        {{--                        </div>--}}
                        {{--                    </td>--}}
                        <td>
                            <div>
                                <input  type="text" name="subtotal[]" class="form-control subtotal" readonly="">
                            </div>
                        </td>
                        <td>
                            <div>
                                <button type="button" class="btn btn-danger btn-sm d-none" title="Delete This Row" onclick="remove_cell(this)"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <section id="bill_section">
                <div class="row">
                    <div class="offset-md-8 offset-sm-2 col-4">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">{{trans('dashboard.voucher_management_discount')}}  :<input class="form-control" type="number" id="discount" name="discount" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">{{trans('dashboard.voucher_management_extra_charge')}}   :<input class="form-control" type="number" id="extra_charge" name="extra_charge" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">{{trans('dashboard.customer_management_total_bill')}}  : <input class="form-control" type="number" id="total_bill" name="total_bill" disabled></li>
                                    {{--                                            <li class="list-group-item">Paid Amount :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>--}}
                                    {{--                                            <li class="list-group-item">Return Amount : <span id="change_amount" ></span>  </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <br>
                            <button type="submit" class="btn btn-sm btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >{{trans('dashboard.submit')}}  </button>
                        </div>
{{--                    </div>--}}
{{--                </div>--}}
{{--                <br>--}}
{{--            </div>--}}
        </section>

    </div>

    <div class="container" id="your-element">

    </div>

    <style>
        div .customer_section div span{
            padding-left: 5px;
        }

        @media screen and (max-width: 480px ) {
            [class*="col-"] {
                width: 100%;
            }

            h2,h4,h5{
                font-size: 13px;
            }
            img{
                width: 50%;
            }
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
            td:nth-of-type(7):before { content: "{{trans('dashboard.subtotal')}}"; }
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
                row.find('.subtotal').val('')
            }

        });

        $(document).on("focus", '#table tr:last-child td:nth-child(6)', function() {
            console.log(addedProduct_id)
            var table = $("#table");
            var element = '<tr>\
        <td><div><input type="text" name="product_text[]" class="form-control product_text"></div>\
        </td>\
        <td class="d-none"><div> <input  type="text" name="product_id[]" class="form-control product_id" readonly=""></div>\
         </td>\
        <td><div><input  type="text" name="unit_text[]" class="form-control unit_text" readonly=""></div>\
        </td>\
        <td class="d-none"><div> <input type="text" name="unit_id[]" class="form-control unit_id" readonly=""></div>\
         </td>\
        <td><div><input type="number" name="selling_price[]" class="form-control selling_price" readonly=""></div>\
        </td>\
        <td><div> <input type="number" name="quantity[]" id="quantity" class="form-control quantity" onchange="get_subtotal(this)"></div>\
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
                        get_available_units(row,ui.item.value)
                    }
                    // setProductInfo(row,ui.item.value)
                    // get_available_units(row,ui.item.value)
                },
                search: function (event) {
                    let row = $(event.target).closest('tr')
                    row.find('.product_id').val('')
                    row.find('.unit_text').val('')
                    row.find('.unit_id').val('')
                    row.find('.selling_price').val('')
                    row.find('.quantity').val('')
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
                }
            });
        }


        function get_subtotal(value){
            // var product_price = $(".selling_price").val();
            var quantity = $(value).closest('tr').find('.quantity').val()
            var selling_price = $(value).closest('tr').find('.selling_price').val()
            var subtotal = quantity * selling_price
            // console.log(quantity,selling_price);
            $(value).closest('tr').find('.subtotal').val(subtotal)
            bill_calculation();
            console.log(quantity);

        }

        function add_new_customer(){
            $.ajax({
                url: "{{route('voucher.add_customer_voucher')}}",
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
                }
            });
            all_ajax_customers()
        }

        function all_ajax_customers(){
            $.ajax({
                url: "{{route('voucher.all_voucher_customer_ajax')}}",
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
                    var formoption = "";
                    $.each(data, function(v) {
                        var val = data[v]
                        formoption += "<option value='" + val.id + "'>" + val.name +'|'+ val.phone +"</option>";
                    });
                    $('#voucher_customer_id').html(formoption);

                }
            });
        }

        function customer_info(){
            var customer_id = $('#voucher_customer_id option:selected').val();
            $.ajax({
                url: "{{route('voucher.voucher_selected_customer')}}",
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
                        $('#voucher_customer_name').text(row.name);
                        $('#voucher_customer_phone').text(row.phone);
                        $('#voucher_customer_address').text(row.address);
                    })
                }
            });
        }

        // add list to the table
        // var item = 0;
        //
        // $("button#add_list").click(function() {
        //     // alert('hello');
        //     item++;
        //     var product_id = $("#product_id").val();
        //     var product_text = $("#product_id option:selected").text();
        //     var product_price = $("#product_price").val();
        //     var quantity = $("#quantity").val();
        //     var unit_id = $("#unit_id").val();
        //     var unit_text = $("#unit_id option:selected").text();
        //     var subtotal = product_price * quantity;
        //     // return console.log(expiry_date);
        //     var new_row = '<tr>' +
        //         // '<td>' + ($('#myTable > tr').length + 1) + '</td>'+
        //         '<td class="product_id" style="display: none">' + product_id + '</td>' +
        //         '<td class="unit_id" style="display: none">' + unit_id + '</td>' +
        //         '<td class="product_text">' + product_text + '</td>' +
        //         '<td class="unit_text">' + unit_text + '</td>' +
        //         '<td class="product_price">' + product_price + '</td>'+
        //         '<td class="quantity">' + quantity + '</td>' +
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
        }

        function get_product_price(){
           // var product_id = $('#product_id:selected').val();
           // var unit_id = $('#unit_id:selected').val();
            $.ajax({
                url: "{{route('voucher.all_voucher_product_price_ajax')}}",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    parameters:{
                        product_id: $("#product_id").val(),
                        unit_id: $("#unit_id").val(),
                    },
                },
                success: function(dataResult){
                    console.log(dataResult.product_price);
                    var data = dataResult.product_price
                    $('#product_price').val(data);

                }
            });

        }

        $("button#submit").click(function() {
            if($("#voucher_customer_id").val() == ''){
                alert("Please Select a Customer")
                return false;
            }
            // return console.log($("#voucher_customer_id").val())
            var data = [];
            var product_id,unit_id,quantity, product_price,subtotal;
            // return alert(payment_status);
            $("#table tbody tr").each(function(index) {
                product_id = $(this).find('.product_id').val();
                unit_id = $(this).find('.unit_id').val();
                quantity = $(this).find('.quantity').val();
                product_price = $(this).find('.selling_price').val();
                subtotal = $(this).find('.subtotal').val();
                data.push({
                    product_id,
                    unit_id,
                    quantity,
                    product_price,
                    subtotal,
                });
            });
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
                submit_voucher_details(data)

            }
            // if(data == ""){
            //     alert("Please Add list then try again ")
            // }else{
            //     // percentage_cal(data)
            //     // submit_stock_order(data)
            //     // return window.print();
            //     submit_voucher_details(data)
            // }

        });

        // function showmsg(){
        //     window.location.reload();
        // }

        function submit_voucher_details(data){
            $.ajax({
                url: "{{route('voucher.voucher_store')}}",
                type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    item_list: data,
                    voucher_order: {
                        customer_id: $('#voucher_customer_id option:selected').val(),
                        billing_amount: $("#total_bill").val() || 0,
                        extra_charge: $("#extra_charge").val() || 0,
                        discount: $("#discount").val() || 0,
                    },
                    success: function (data) {
                        alert("New Voucher Created")
                        window.location.href = "{{route('voucher.voucher_index')}}"
                    }
                }
            })
        }
    </script>
@endsection
