<img src="/img/plateiaEscritorio.png" alt="plateiaEscritorio">
<h1>Tetando a tela</h1>

@if($nome == 'felipe' && $idade == 25)
    <p>O seu nome é {{$nome}} e sua idade é {{$idade}} anos</p>
@elseif($nome == 'romeu' && $idade==2)
<p>O seu nome é {{$nome}} e sua idade é {{$idade}} anos</p>
@else
    <p>Usuario invalido</p>
@endif

@for ($i = 0; $i < count($array); $i++)
<p>{{$array[$i]}} - index {{$i}}
@if($i==2)
<p>O I é 2</p>
@endif    
@endfor

@for($i =0; $i<count($nomes); $i++)
<p>{{$i+1}} - {{$nomes[$i]}}</p>
@endfor

@foreach ($nomes as $i)
    <p>{{$loop->index}}</p>
    <p>{{$i}}</p>
@endforeach

{{--este é um comentario blade--}}
<!--comentario html-->