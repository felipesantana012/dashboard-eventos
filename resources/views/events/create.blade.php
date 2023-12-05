@extends('layouts.main')
@section('title', 'Criar Evento')
@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>

    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf <!--diretiva do blade para conseguir enviar os dados pro banco-->

        <div class="form-group">
            <label for="image">Imagens do evento : </label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
    
        <br>

        <div class="form-group">
            <label for="title">Evento : </label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
        </div>

        <br>

        <div class="form-group">
             <label for="title">Cidade : </label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento">
        </div>

        <br>

        <div class="form-group">
            <label for="date">Data do Evento: </label>
            <input type="date" class="form-control" id="date" name="date">
        </div>

        <br>

        <div class="form-group">
            <label for="title">O Evento é privado ?</label>
            <select name="private" id="private" class="form-control">
            <option value="0">Não</option>
            <option value="1">Sim</option>
            </select>
        </div>

        <br>

        <div class="form-group">
            <label for="title">Descricao : </label>
            <textarea name="description" id="description" class="form-control" placeholder="Oque vai acontecer no evento ?"></textarea>
        </div>

        <div class="form-group">
            <label for="title">Adicione itens de infraestrutura: </label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras">Cadeiras
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco">Palco
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja Gratis">Cerveja Gratis
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food">Open Food
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes">Brindes
            </div>

        </div>

        <br>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
        
    </form>

</div>

@endsection