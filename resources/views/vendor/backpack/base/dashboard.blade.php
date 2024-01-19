@extends(backpack_view('blank'))
@section('content')

<div class="container">

    <div class="row">
        @foreach($dashboard as $item)
        <div class="card col-3 mt-2 mb-2 mr-2 ml-2 border border-primary bg-secondary">
            <div class="card-body">
                <h5 class="card-title text-dark">{{$item['name']}}</h5>
                <h2 class="card-subtitle mb-2 text-primary">{{$item['count']}}
                    <span style="font-size: 20px;">{{$item['unit']}}</span>
                </h2>
            </div>
        </div>
        @endforeach
    </div>



    {{-- Default box --}}
    <div class="row">

        <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
            <thead>
                <tr>
                    <th></th>
                    <th>Produk</th>
                    <th>Tanggal Dibuat</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                <tr>
                    <td><img src="/{{$item->image}}" width="25px" height="25px"></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>Rp {{$item->price}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection


@section('after_styles')
{{-- DATA TABLES --}}
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">