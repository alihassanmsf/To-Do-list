@extends('layouts.app')

@section('content')
    @foreach($tasks as $task)
        <ul>
            <li>{{$task->name}}</li>
        </ul>
    @endforeach

@endsection
