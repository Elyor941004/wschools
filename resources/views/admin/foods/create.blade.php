@extends('layouts.admin')
@section('content')
<div class="container">
    <form action="{{route('foods.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <div class="alert alert-danger">
          <ul style="list-style: none">
            @foreach($errors->all() as $error)
              <li>
                {{$error}}
              </li>
            @endforeach
          </ul>
        </div>
      @endif
        <div class="form-group">
            <label for="name">Названия:</label>
            <input type="text" class="form-control" id="name" placeholder="Названия:" name="name">
            <label for="text">Текст:</label>
            <input type="text" class="form-control" id="text" placeholder="Текст:" name="text">
            <label for="images">Фотография:</label>
            <input type="file" class="form-control" id="images" name="image">
            <label for="time">Время готовить:</label>
            <input type="text" class="form-control" id="time" placeholder="Время:" name="times">
            <label for="tips">Виберите тип:</label>
            <select name="tips" class="form-control" id="tips">
                @foreach($type_foods as $model)
                    <option value="{{$model}}">{{$model}}</option>
                @endforeach
            </select>
            <label> Ингредиенты:</label>
            <div id = "ingredient">

            </div>
            <a class="btn btn-success" onclick="addIngredient()">+</a><br>
            <label> Как подготовить:</label>
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
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>


@endsection
