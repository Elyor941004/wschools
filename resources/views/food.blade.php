@extends('layouts.food')
@section('content')
    <div class="container">
        <main>
            <header class="row tm-welcome-section">
                <h2 class="col-12 text-center tm-section-title">{{$foods->name}}</h2>
                <p class="col-12 text-center">{{$foods->text}}</p>
            </header>
            <div class="tm-container-inner">
                <div class="row">
                    <div class="tm-history-inner">
                        <div class="tm-history-img tm-history-border">
                            <img src="{{asset('storage/'.$foods->image)}}" alt="Image" class="img-fluid tm-history-img"/>
                        </div>
                        <div class="tm-history-text">
                            <h4 class="tm-history-title">Recepies</h4>
                            <ol>
                                @foreach($ingredients as $ingredient)
                                    <li class="tm-mb-p"> {{$ingredient->name}} </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                    <div class="directions">
                        <h4 class="tm-history-title">Directions</h4>
                        <ol>
                            @foreach($directions as $direction)
                                <li class="tm-mb-p">
                                    {{$direction->text}}
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
