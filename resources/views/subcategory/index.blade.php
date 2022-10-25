@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{ route('subcategory.create') }}" class="btn btn-success" role="button">Create Sub Category</a> 
    @if(session("alert"))
        <div class="alert alert-{{ session(`alert-style`) }}">{{session("alert")}}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
           
        <div class="mt-2 mb-2">
            <table id="subcategoryTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Alt Kategori</th>
                    <th>Ana Kategori</th>
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
            
            var table = $('#subcategoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('subcategory.getData') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false}
                ]
            });
            
        });
        </script>
        
        </component>
      
@endsection

