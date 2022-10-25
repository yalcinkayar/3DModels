@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{ route('category.create') }}" class="btn btn-success" role="button">Create Category</a> 
    @if(session("alert"))
        <div class="alert alert-{{ session(`alert-style`) }}">{{session("alert")}}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
           
        <div class="mt-2 mb-2">
            <table id="categoryTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Kategori</th>
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
       console.log("yjgujh");
           $(function () {
            
            var table = $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.getData') }}",
                columns: [
                    {data: 'category_name', name: 'category_name'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false}
                ]
            });
            
        });
        </script>
        
        </component>
      
@endsection

