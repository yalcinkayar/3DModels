@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{ route('product.index') }}" class="btn btn-warning" role="button">Back</a> 
    @if(session("alert"))
        <div class="alert alert-{{ session(`alert-style`) }}">{{session("alert")}}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
           
            <div class="mt-2 mb-2">
            <form action="{{route('createdProduct')}}" method="post" enctype="multipart/form-data">
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
            
            <div style = "margin-left:200px;" class="row mb-3">
                <label for="chooseFile">Select Files</label>
                <div class="col-md-6">
                <input name="photo[]" type="file" id = "chooseFile" multiple accept=".jpg,.jpeg,.png">
                </div>
            </div>
            <div class="row mb-3">
                <label for="title" class="col-md-4 col-form-label text-md-end">Product NAme</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                    @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                    <label for="description" class="col-md-4 col-form-label text-md-end">Product Description</label>

                    <div class="col-md-6">
                    <textarea name="description" id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>
                        @error('description')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
               
            </div>
            <div class="row mb-3">
            <label for="price" class="col-md-4 col-form-label text-md-end">Product Price</label>

            <div class="col-md-6">
                <input id="price" step=".01" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                @error('price')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                        </span>
                @enderror
                </div>
            </div>
                        
            <div class="row mt-50">
               <div class="col-md-6 offset-md-4">
                <button type="submit" name="submit" class="btn btn-success btn-block">
                    Ürün Ekle
                </button>
               </div>
            </div>
    
        </form>
        </div>
    </div>
</div>
@endsection
