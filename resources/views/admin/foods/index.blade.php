@extends('layouts.admin')
@section('content')
<div class="container">
    <div>
      <span >Добавит категории</span> <br>
      <a type="button" class="btn btn-success" href="{{route('foods.create')}}">Create</a>
    </div>
    <br>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>Ид</th>
            <th>Названия</th>
            <th>Текст</th>
            <th>фотография</th>
            <th>Время</th>
            <th>Функции</th>
          </tr>
        </thead>
        <tbody>
          @foreach($models as $model)
              <tr class="success">
                <td>{{$model->id}}</td>
                <td>{{$model->name}}</td>
                <td>{{$model->text}}</td>
                 <td><img src="{{asset('storage/'.$model->image)}}" alt="" height="150px"></td>
                  <td>{{$model->time}}</td>
                  <td>
                  <a href="{{route('foods.edit', $model->id)}}" class="btn btn-success" style="margin-bottom: 4px" type="button">update</a>
                  <form method="post" action="{{route('foods.destroy', $model->id)}}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
          @endforeach
        </tbody>
    </table>
    {{$models->links("pagination::bootstrap-4")}}
</div>
@endsection
