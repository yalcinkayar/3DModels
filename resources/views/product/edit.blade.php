@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{ route('product.index') }}" class="btn btn-warning" role="button">Back</a> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mt-2 mb-2">

                <div class="card">
                <div class="card-header">Tasarım Detayı</div>
                <div class="card-body">
                <div>
                        <img src="../uploads/{{$product[0]['image_path']}}" alt="Product Picture" width="750">
                </div>
                <form action="{{route('product.update', ['productId' => $product[0]['id']])}}" method="post" enctype="multipart/form-data">
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
                        
                        <div class="form-group">
                            <label class="custom-file-label" for="chooseFile">Resim Seçiniz</label>
                            <input type="file" name="file" class="custom-file-input" id="chooseFile">        
                        </div>
                        <div class="form-group">
                            <label class="custom-input-label" for="title">Ürün Adı</label>
                            <input type="text" name="title" class="text" id="title" value="{{$product[0]['title']}}">        
                        </div>
                        <div className="form-group">
                            <label for="description">Ürün Açıklama</label>
                            <textarea name="description" id="description" type="text" className='form-control'>{{$product[0]['description']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="custom-input-label" for="price">Fiyat</label>
                            <input type="number" step=".01" name="price" class="text" id="price" value="{{$product[0]['price']}}">        
                        </div>
                        <div className="form-group d-flex justify-content-center align-items-center">
                            <button type="submit" name="submit" class="btn btn-success btn-block mt-4">
                                Ürün Güncelleştir
                            </button>
                        </div>
                
                    </form> 
                </div>
            </div>
    
            </div>
        </div>
    </div>
</div>

@endsection
