@section('header')
    @include('header')
@endsection


<div class="container-fluid tm-container-content tm-mt-60">

    <div class="row tm-mb-90 tm-gallery">
        @foreach($categorias as $categoria)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{URL::asset(env('ASSET_URL_IMAGE_CATEGORIA_SITE').'/'.$categoria->id.'/'.$categoria->imagem)}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>{{$categoria->nome}}</h2>
                        <a href="#" onclick="postLink('{{ route('produto-detalhe')}}' , {{$categoria->id}})"></a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light"></span>
                    <span>12,460 views</span>
                </div>
            </div>
        @endforeach
    </div>
</div> <!-- container-fluid, tm-container-content -->
@section('footer')
    @include('footer')
@endsection
