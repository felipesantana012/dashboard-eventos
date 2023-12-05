
@extends('layouts.main')
@section('title', 'HDC Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um Evento</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
        <h2>Buscando por: {{$search}}</h2>
    @else
    <h2>Proximos Eventos</h2>
    <p class="subtitle">Veja os eventos dos proximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach ($events as $item)
            <div class="card col-md-3">
                <img src="/img/events/{{$item->image}}" alt="{{$item->title}}">
                <div class="card-body">
                    <p class="card-date">{{date('d/m/y', strtotime ($item->date))}}</p>
                    <h5 class="card-title">{{$item->title}}</h5>
                    <p class="card-participants">{{count($item->users)}} participantes</p>
                    <a href="/events/{{$item->id}}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>   
        @endforeach
            @if(count($events) == 0 && $search)
                <p>Não foi possivel encontrar nenhum evento com {{$search}} !</p>
                <a href="/">Ver todo os eventos disponiveis</a>
            @elseif(count($events) ==0)
                <p>Não há eventos disponiveis</p>
            @endif
    </div>

</div>
    
@endsection
