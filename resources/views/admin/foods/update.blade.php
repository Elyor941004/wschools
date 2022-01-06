@extends('layouts.admin')
@section('content')
<div class="container">
    <form action="{{route('foods.update', $model->id)}}" method="post" enctype="multipart/form-data">
       @if($errors->any())
        <div class="alert alert-danger">
          <ul  style="list-style: none">
            @foreach($errors->all() as $error)
              <li>
                {{$error}}
              </li>
            @endforeach
          </ul>
        </div>
      @endif
      @method('PUT')
      @csrf
        <div class="form-group">
            <label for="name">Названия:</label>
            <input type="text" class="form-control" id="name" placeholder="Филм названия:" name="name" value="{{$model->name}}">
            <label for="publication">Текст:</label>
            <input type="text" class="form-control" id="publication" placeholder="публикатция:" name="text"  value="{{$model->text}}">
            <label for="images">Фотография:</label>
            <input type="file" class="form-control" id="images" name="image" value="{{$model->image}}">
            <label for="time">Время готовить:</label>
            <input type="text" class="form-control" id="time" placeholder="публикатция:" name="times" value="{{$model->time}}">
            <label for="tips">Виберите тип:</label>
            <select name="tips" class="form-control" id="tips">
                @foreach($type_foods as $type_food)
                    <option value="{{$type_food}}" {{$model->tips == $type_food?'selected':''}}>{{$type_food}}</option>
                @endforeach
            </select>
            <label> <b>Ингредиенты:</b></label>
            @foreach($ingredients as $ingredient)
                <input type="text" class="form-control" id="time" placeholder="публикатция:" name="ingredient[]" value="{{$ingredient->name}}">
                <br>
            @endforeach
            <div id = "ingredient">
            </div>
            <a class="btn btn-success" onclick="addIngredient()">+</a><br>
            <label> <b>Как подготовить:</b></label>
            @foreach($directions as $direction)
                <input type="text" class="form-control" id="time" placeholder="публикатция:" name="directions[]" value="{{$direction->text}}">
                <br>
            @endforeach
            <div id = "directions">

            </div>
            <a class="btn btn-success" onclick="addDirections()">+</a>
            <script>
                function addIngredient() {
                    var inputs = document.createElement("input");
                    var br = document.createElement("br");
                    var clas = document.createAttribute("class");
                    var name = document.createAttribute("name");
                    clas.value = "form-control";
                    name.value = "ingredient[]";
                    inputs.setAttributeNode(clas);
                    inputs.setAttributeNode(name);
                    document.getElementById('ingredient').appendChild(inputs);
                    document.getElementById('ingredient').appendChild(br);
                }
                function addDirections() {
                    var inputs = document.createElement("input");
                    var br = document.createElement("br");
                    var clas = document.createAttribute("class");
                    var name = document.createAttribute("name");
                    clas.value = "form-control";
                    name.value = "directions[]";
                    inputs.setAttributeNode(clas);
                    inputs.setAttributeNode(name);
                    document.getElementById('directions').appendChild(inputs);
                    document.getElementById('directions').appendChild(br);
                }
            </script>
        </div>
           <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
