@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>{{trans('dashboard.supplier_management_add_new_supplier')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('suppliers.index')}}"> {{trans('dashboard.back')}}</a>
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

    <form action="{{route('suppliers.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.supplier_management_supplier_name')}}:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.supplier_management_phone')}}:</strong>
                    <input class="form-control" type="number" name="phone" id="phone" placeholder="Phone" required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.supplier_management_address')}}:</strong>
                    <input class="form-control" type="text" name="address" placeholder="Address">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.status')}}:</strong>
                    <select name="status" id="" class="form-control" required>
                        <option value="1">Enabled</option>
                        <option value="0">Disabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.supplier_management_remarks')}}:</strong>
                    <textarea class="form-control" type="text" name="remarks" placeholder="Remarks" cols="10" rows="4"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-lg">{{trans('dashboard.submit')}}</button>
            </div>
        </div>

    </form>

    <script>
        document.getElementById('phone').onkeyup = function(){
            if(this.value.match(/^[a-z0-9_.,'"!?;:& ]+$/i)){
                console.log('English');
            }
            else{
                // console.log('Not English');
                alert('Please number in English')
                return $('#phone').val('');
            }
        }
    </script>
@endsection
