{{--@include('backend.partials.all_links')--}}
{{--<html>--}}
{{--<body>--}}
{{--<div class="container-fluid">--}}
{{--    <section>--}}
{{--        <header class="clearfix">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="d-flex justify-content-center">--}}
{{--                        <img src="{{url('images/nowshad_enterprise_edited.jpg')}}" style="height: 100px; width: 200px">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <div class="col-12">--}}
{{--                    <div class="d-flex justify-content-center">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-12"><h2 class="d-flex justify-content-center">নওশাদ এন্টারপ্রাইজ</h2></div>--}}
{{--                            <div class="col-12"><h4 class="d-flex justify-content-center">মোঃ সাহান নাজমুস সাদ্দাত</h4></div>--}}
{{--                            <div class="col-12"><h5 class="d-flex justify-content-center">এখানে রড, সিমেন্ট,স্যানিটারি ও হার্ডওয়্যার এর সকল পণ্য খুচরা ও পাইকারী বিক্রয় হয়</h5></div>--}}
{{--                            <div class="col-12"><h5 class="d-flex justify-content-center">মোবাইল:০১৭১৬৯৯৪৮৪৮,০১৭৯৪৪০৪৫৪৬,০১৭১৬৯৯৪৮৪৮,০১৭৯৪৪০৪৫৪৬ </h5></div>--}}
{{--                            <div class="col-12"><h5 class="d-flex justify-content-center">ছোটবনগ্রাম,চন্দ্রিমাথানার মোড়,রাজশাহী</h5></div>--}}
{{--                            <div class="col-12"><h5 class="d-flex justify-content-center">ইমেলঃ najmussaddat149@gmail.com</h5></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </header>--}}
{{--        <hr>--}}
{{--    </section>--}}
{{--    <div class="card">--}}
{{--        <div class="card-body">--}}
{{--            <div class="row">--}}
{{--                <div class="col-8">--}}
{{--                    <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_name')}}: </strong> {{$customers->name}}</div>--}}
{{--                    <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_phone')}}: </strong> {{$customers->phone}}</div>--}}
{{--                    <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_address')}}: </strong> {{$customers->address}}</div>--}}
{{--                </div>--}}
{{--                <div class="col-4">--}}
{{--                    <strong>{{trans('dashboard.date')}}: <span>{{$sale_order->created_at->format('d F Y')}}</span></strong>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <table class=" table table-bordered">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>{{trans('dashboard.customer_management_no')}}</th>--}}
{{--            <th>{{trans('dashboard.product_management_product_name')}}</th>--}}
{{--            <th>{{trans('dashboard.unit_management_unit_name')}}</th>--}}
{{--            <th>{{trans('dashboard.selling_price')}}</th>--}}
{{--            <th>{{trans('dashboard.quantity')}}</th>--}}
{{--            <th>{{trans('dashboard.subtotal')}}</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($sale_order_details as $key=>$sale_order_detail )--}}
{{--            <tr>--}}
{{--                <td>{{$key + 1}}</td>--}}
{{--                <td>{{$sale_order_detail->product->product_name}}</td>--}}
{{--                <td>{{$sale_order_detail->unit->unit_name}}</td>--}}
{{--                <td>{{$sale_order_detail->product_selling_price}}</td>--}}
{{--                <td>{{$sale_order_detail->quantity}}</td>--}}
{{--                <td>{{($sale_order_detail->quantity) * ($sale_order_detail->product_selling_price)}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <br>--}}
{{--    <div>--}}
{{--        <div class="row">--}}
{{--            <div class="offset-8 col-4">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <ul class="list-group">--}}
{{--                            <li class="list-group-item">{{trans('dashboard.voucher_management_discount')}}: {{$sale_order->discount??''}}</li>--}}
{{--                            <li class="list-group-item">{{trans('dashboard.voucher_management_extra_charge')}}:{{$sale_order->extra_charge??''}}</li>--}}
{{--                            <li class="list-group-item">{{trans('dashboard.customer_management_total_bill')}}: {{$sale_order->billing_amount??''}}</li>--}}
{{--                            <li class="list-group-item">{{trans('dashboard.customer_management_bill_paid')}}: {{$sale_order->paid_amount??''}}</li>--}}
{{--                            <li class="list-group-item">{{trans('dashboard.purchase_management_return_amount')}} : {{$sale_order->change_amount??''}}</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--        @include('backend.partials.footer')--}}
{{--</div>--}}
{{--<script>--}}
{{--    window.onload = function () {--}}
{{--        window.print();--}}
{{--    }--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">
{{--    <div class="row p-0">--}}
{{--        <div class="col-3 card-body"><a class="btn btn-primary" onclick="window.print()">{{trans('dashboard.print')}}</a></div>--}}
{{--        <div class="col-3 card-body"><a href="{{route('sales.create')}}" class="btn btn-primary">{{trans('dashboard.back')}}</a></div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="no-print col-12" id="upper_button">
            <div style="background: white; text-align: right">
                <button type="button" class="btn btn-primary" onclick="print_bill()">Print</button>
                <a href="{{route('sales.index')}}" class="btn btn-warning">Back</a>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-0">
                        <div class="col-md-3 col-sm-3">
                            <img src="{{url('images/nowshad_enterprise_edited.jpg')}}" style="height: 100px; width: 220px; padding-top: 5px;padding-left: 10px">
                        </div>
                        <div class="col-md-6 col-sm-6 text-center">
                            <p class="mb-0"><b style="font-size: 48px;font-family: 'Kalpurush', sans-serif;">মেসার্স নওশাদ এন্টারপ্রাইজ</b></p>
                            <p class="mb-0 text-dark" style="font-size: 12px;font-family: 'Kalpurush', sans-serif;">এখানে রড, সিমেন্ট,স্যানিটারি ও হার্ডওয়্যার এর সকল পণ্য খুচরা ও পাইকারী বিক্রয় হয়</p>
                            <p class="mb-0 text-dark" style="font-size: 12px;font-family: 'Kalpurush', sans-serif;">ছোটবনগ্রাম,চন্দ্রিমাথানার মোড়,রাজশাহী</p>
                        </div>
                        <div class="col-md-3 col-sm-3 text-right" style="padding-top: 13px;padding-right: 20px">
                            {{--                            <p class="mb-1 font-weight-bold ">নওশাদ এন্টারপ্রাইজ</p>--}}
                            {{--                            <p class="mb-1 text-dark">এখানে রড, সিমেন্ট,স্যানিটারি ও হার্ডওয়্যার এর সকল পণ্য খুচরা ও পাইকারী বিক্রয় হয়</p>--}}
                            <p class="mb-1 text-dark" style="font-family: 'Kalpurush', sans-serif; font-weight: bolder;font-size: 13px">প্রোঃ মোঃ সাহান নাজমুস সাদ্দাত</p>
                            <p class="mb-1 text-dark" style="font-family: 'Kalpurush', sans-serif; font-size: 13px">মোবাইলঃ ০১৭৯৪৪০৪৫৪৬,০১৭১৬৯৯৪৮৪৮</p>
                            <p class="mb-1 text-dark" style="font-family: 'Kalpurush', sans-serif;font-size: 13px">ইমেলঃ najmussaddat149@gmail.com</p>
                        </div>
                    </div>

                    <hr class="my-0" >
                    <div class="row">
                        <div class="col-md-6 py-2" style="padding-left:25px">
                            <p class="font-weight-bold mb-1" style="font-family: 'Kalpurush', sans-serif;"><u>{{trans('dashboard.customer_information')}}</u></p>
                            <p class="mb-0" style="font-family: 'Kalpurush', sans-serif;">{{$customers->name}}</p>
                            <p class="mb-0" style="font-family: 'Kalpurush', sans-serif;">{{$customers->phone}}</p>
                            <p class="mb-0" style="font-family: 'Kalpurush', sans-serif;">{{$customers->address}}</p>
                        </div>

                        <div class="col-md-6 text-right py-2">
                            <p class="mb-1" ><span class="text-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.date')}}: </span>{{$sale_order->created_at->format('d F Y')}}</p>
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                <tr>
                                    <th class="border-0 text-uppercase small font-weight-bold" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_management_no')}} </th>
                                    <th class="border-0 text-uppercase small font-weight-bold" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.product_management_product_name')}} </th>
                                    <th class="border-0 text-uppercase small font-weight-bold" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.units')}} </th>
                                    <th class="border-0 text-uppercase small font-weight-bold" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.selling_price')}} </th>
                                    <th class="border-0 text-uppercase small font-weight-bold" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.quantity')}} </th>
                                    <th class="border-0 text-uppercase small font-weight-bold" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.subtotal')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale_order_details as $key=>$sale_order_detail)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$sale_order_detail->product->product_name }} </td>
                                        <td>{{$sale_order_detail->unit->unit_name}}</td>
                                        <td>{{$sale_order_detail->product_selling_price}}</td>
                                        <td>{{$sale_order_detail->quantity}}</td>
                                        <td>{{($sale_order_detail->quantity) * ($sale_order_detail->product_selling_price)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse bg-light text-dark p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management_discount')}}</div>
                            <div class="h2 font-weight-dark">{{$sale_order->discount}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management_extra_charge')}}</div>
                            <div class="h2 font-weight-dark">{{$sale_order->extra_charge}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_management_total_bill')}}</div>
                            <div class="h2 font-weight-dark">{{$sale_order->billing_amount}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_management_bill_paid')}}: </div>
                            <div class="h2 font-weight-dark">{{$sale_order->paid_amount}}</div>
                        </div>

                    </div>
                </div>
                @include('backend.partials.footer')
            </div>
        </div>
    </div>

    {{--    <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>--}}

</div>



<style>
    body {
        background: grey;
        margin-top: 120px;
        margin-bottom: 120px;
    }
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }

</style>

<script>
    function print_bill(){
        // $('#upper_button').hide()
            window.print();
        // $('#upper_button').show()
    }
    window.onload = function () {
        // $('#upper_button').hide()
        window.print();
        // $('#upper_button').show()
    }
</script>
