@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{ route('product.create') }}" class="btn btn-success" role="button">Create Product</a> 
    @if(session("alert"))
        <div class="alert alert-{{ session(`alert-style`) }}">{{session("alert")}}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
           
        <div class="mt-2 mb-2">
            <table id="productTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Açıklama</th>
                    <th>Fiyat</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
            </thead>
            </table>
            </div>
        </div>
</div>
</div>
@endsection

@vite(['resources/js/jquery.min.js', 'resources/js/jquery.dataTables.min.js'])
@section('footer')

       <component :is="'script'">
           <script type='module'>
           $(function () {
                var table = $('#productTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('product.getData') }}",
                    columns: [
                        {data: 'title', name: 'title'},
                        {data: 'description', name: 'description'},
                        {data: 'price', name: 'price'},
                        {data: 'edit', name: 'edit', orderable: false, searchable: false},
                        {data: 'delete', name: 'delete', orderable: false, searchable: false}
                    ],
                    columnDefs: [{
                        "defaultContent": "-",
                        "targets": "_all"
                    }]
                });
                
            });
            </script>
        </component>
@endsection

