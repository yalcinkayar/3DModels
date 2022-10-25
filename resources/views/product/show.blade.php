@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mt-2 mb-2">

                <div class="card">
                <div class="card-header">Tasarım Detayı</div>
                <div class="card-body">
                <div>
                        <img src="../uploads/{{$product->image_path}}" alt="Product Picture" width="750">
                </div>
                <b> Ürün Adı :</b> {{$product->title}}<br>
                <b> Açıklama :</b> {{$product->description}}<br>
                <b> Fiyat :</b> {{$product->price}} 
                </div>
            </div>
    
            </div>
        </div>
    </div>
</div>

@endsection
