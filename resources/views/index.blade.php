@extends('layouts.main')
@section('content')
    <main>
        <header class="row tm-welcome-section">
            <h2 class="col-12 text-center tm-section-title">{{__('index.Foods recepies')}}</h2>
            <p class="col-12 text-center">{{__('index.Site teaches you')}}</p>
        </header>
        <div class="tm-paging-links">
            <nav>
                <ul>
                    @if(app()->getLocale()==null)
                        <li class="tm-paging-item"><a href="{{route('index', 'en')}}" class="tm-paging-link {{ (request()->is('/'))?'active':''}}">{{__('index.Foods')}}</a></li>
                        <li class="tm-paging-item"><a href="{{route('desserts', 'en')}}" class="tm-paging-link {{ (request()->is('desserts'))?'active':'' }}">{{__('index.Desserts')}}</a></li>
                        <li class="tm-paging-item"><a href="{{route('cookies', 'en')}}" class="tm-paging-link {{ (request()->is('cookies'))?'active':'' }}">{{__('index.Cookies')}}</a></li>
                    @else
                        <li class="tm-paging-item"><a href="{{route('index', app()->getLocale())}}" class="tm-paging-link {{ (request()->is('/'))?'active':''}}">{{__('index.Foods')}}</a></li>
                        <li class="tm-paging-item"><a href="{{route('desserts', app()->getLocale())}}" class="tm-paging-link {{ (request()->is('desserts'))?'active':'' }}">{{__('index.Desserts')}}</a></li>
                        <li class="tm-paging-item"><a href="{{route('cookies', app()->getLocale())}}" class="tm-paging-link {{ (request()->is('cookies'))?'active':'' }}">{{__('index.Cookies')}}</a></li>
                    @endif
                </ul>
            </nav>
        </div>
        <!-- Gallery -->
        <div class="row tm-gallery">
            @if(isset($foods))
                <div class="tm-gallery-page">
                @foreach($foods as $food)
                    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                        <a href="{{route('food', [app()->getLocale(), $food->id])}}">
                            <figure>
                                <img src="{{asset('storage/'.$food->image)}}" alt="Image" class="img-fluid tm-gallery-img" style="height: 240px !important;"/>
                                <figcaption>
                                    <h4 class="tm-gallery-title">{{$food->name}}</h4>
                                    <p class="tm-gallery-description">{{\Illuminate\Support\Str::limit($food->text, 60, '...')}}</p>
                                    <p class="tm-gallery-price">{{$food->time.' min'}}</p>
                                </figcaption>
                            </figure>
                        </a>
                    </article>
                @endforeach
                {{$foods->links("pagination::bootstrap-4")}}
                </div> <!-- gallery page 1 -->
            @endif
            @if(isset($desserts))
                <div class="tm-gallery-page">
                    @foreach($desserts as $dessert)
                        <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                            <a href="{{route('food', [app()->getLocale(), $dessert->id])}}">
                                <figure>
                                    <img src="{{asset('storage/'.$dessert->image)}}" alt="Image" class="img-fluid tm-gallery-img" style="height: 240px !important;"/>
                                    <figcaption>
                                        <h4 class="tm-gallery-title">{{$dessert->name}}</h4>
                                        <p class="tm-gallery-description">{{\Illuminate\Support\Str::limit($dessert->text, 60, '...')}}</p>
                                        <p class="tm-gallery-price">{{$dessert->time.' min'}}</p>
                                    </figcaption>
                                </figure>
                            </a>
                        </article>
                    @endforeach
                    {{$desserts->links("pagination::bootstrap-4")}}
                </div> <!-- gallery page 3 -->
            @endif
            @if(isset($cookies))
                <div class="tm-gallery-page ">
                    @foreach($cookies as $cookie)
                        <a href="{{route('food', [app()->getLocale(), $cookie->id])}}">
                        <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
                            <figure>
                                    <img src="{{asset('storage/'.$cookie->image)}}" alt="Image" class="img-fluid tm-gallery-img" style="height: 240px !important;"/>
                                <figcaption>
                                    <h4 class="tm-gallery-title">{{$cookie->name}}</h4>
                                    <p class="tm-gallery-description">{{\Illuminate\Support\Str::limit($cookie->text, 60, '...')}}</p>
                                    <p class="tm-gallery-price">{{$cookie->time.' min'}}</p>
                                </figcaption>
                            </figure>
                        </article>
                    @endforeach
                    {{$cookies->links("pagination::bootstrap-4")}}
                </div>
            @endif
        </div>
    </main>
@endsection
