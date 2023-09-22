
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">
    <div class="row">
        <div class="no-print col-12" id="upper_button">
            <div style="background: white; text-align: right">
                <button type="button" class="btn btn-primary" onclick="print_bill()">Print</button>
                <a href="{{route('voucher.voucher_index')}}" class="btn btn-warning">Back</a>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <img src="{{url('images/nowshad_enterprise_edited.jpg')}}" style="height: 100px; width: 220px; padding-top: 5px;padding-left: 10px">
                        </div>
                        <div class="col-md-6 col-sm-6 text-center" id="shop_name">
                            <p class="mb-0"><b style="font-size: 48px;font-family: 'Kalpurush', sans-serif;">মেসার্স নওশাদ এন্টারপ্রাইজ</b></p>
                            <p class="mb-0 text-dark" style="font-size: 12px;font-family: 'Kalpurush', sans-serif;">এখানে রড, সিমেন্ট,স্যানিটারি ও হার্ডওয়্যার এর সকল পণ্য খুচরা ও পাইকারী বিক্রয় হয়</p>
                            <p class="mb-0 text-dark" style="font-size: 12px;font-family: 'Kalpurush', sans-serif;">ছোটবনগ্রাম,চন্দ্রিমাথানার মোড়,রাজশাহী</p>
                        </div>
                        <div class="col-md-3 col-sm-3 text-right" style="padding-top: 13px;padding-right: 20px" id="shop_details">
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

                        <div class="col-md-6 text-right py-2" style="padding-right: 25px">
                            <p class="mb-1"><span class="text-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.date')}}: </span>{{$voucher->created_at->format('d F Y')}}</p>
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
                                @foreach($voucher_details as $key=>$voucher_detail )
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$voucher_detail->product->product_name }} </td>
                                        <td>{{$voucher_detail->unit->unit_name}}</td>
                                        <td>{{$voucher_detail->product_price}}</td>
                                        <td>{{$voucher_detail->quantity}}</td>
                                        <td>{{$voucher_detail->subtotal}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse bg-light text-dark p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management_discount')}}</div>
                            <div class="h2 font-weight-dark">{{$voucher->discount??''}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management_extra_charge')}}</div>
                            <div class="h2 font-weight-dark">{{$voucher->extra_charge??''}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-dark" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_management_total_bill')}}</div>
                            <div class="h2 font-weight-dark">{{$voucher->billing_amount??''}}</div>
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
        window.print();
    }
</script>
