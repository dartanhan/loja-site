@extends('layouts.layout')



@section('content')
      <div class="container-fluid tm-container-content tm-mt-60">
            <div class="row mb-4">
                <nav aria-label="bread-crumb">
                    <ol class="bread-crumb">
                        <li class="bread-crumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="bread-crumb-item">CATEGORIA</li>
                        <li class="bread-crumb-item active" aria-current="page">{{$categorias[0]->nome}}</li>
                    </ol>
                </nav>
            </div>
            <div class="row tm-mb-90 tm-gallery ">
                @foreach($categorias as $categoria)
                    <div class="gallery-item text-left container-img">
                        <figure class="effect-ming tm-video-item">
                            <img src="{{URL::asset('../../'.env('ASSET_URL_IMAGE_CATEGORIA_PRODUTO').'/'.$categoria->id.'/'.$categoria->imagem)}}" alt="Image" class="img-fluid">
                            <figcaption class="d-flex align-items-center justify-content-center">
                                <h2>{{$categoria->descricao}}</h2>
                                                                                                     <!-- ID CATEGORIA PAI -         ID PRODUTO-->
                                <a href="#" onclick="postLink('{{ route('produto-detalhe-variacoes')}}' ,{{$idCategoria}} ,{{$categoria->id}})"></a>
                            </figcaption>
                        </figure>
                        <div class="d-flex justify-content-between tm-text-gray">
                            <span class="tm-text-gray-light"></span>
                            <span>12,460 views</span>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
@section('footer')
    @include('footer')
@endsection

