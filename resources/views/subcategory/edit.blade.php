@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{ route('subcategory.index') }}" class="btn btn-warning" role="button">Back</a> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mt-2 mb-2">

                <div class="card">
                <div class="card-header">Alt Kategori Detayı</div>
                <div class="card-body">
       
                <form action="{{route('subcategory.update', ['subcategoryId' => $subcategory[0]['id']])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Alt Kategori Adı</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"value="{{$subcategory[0]['name']}}" required autocomplete="name" autofocus>

                            @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                        <label for="category_id" class="col-md-4 col-form-label text-md-end">Kategori Adı</label>

                        <div class="col-md-6">
                        <select class="form-control m-bot15" name="category_id" id="category_id">

                            @if ($categories->count())

                                @foreach($categories as $category)
                                    <option id="category_id" value="{{ $category->id }}" {{ $category->id == $subcategory[0]['category_id'] ? 'selected' : '' }}>{{ $category->category_name }}</option>    
                                @endforeach
                            @endif

                        </select>
                        </div>
                    </div>
                                    
                        <div class="row mt-50">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" name="submit" class="btn btn-success btn-block">
                                Kategori Güncelleştir
                            </button>
                        </div>
                        </div>
                
                    </form> 
                </div>
            </div>
    
            </div>
        </div>
    </div>
</div>

@endsection
