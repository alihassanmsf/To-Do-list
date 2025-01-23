@extends('layouts.app')

@section('content')
    <h1>Total Users: {{$totalUsers}}</h1>
    <h1>Total Tasks: {{$totalTasks}}</h1>
    <h1>Total Open Tasks: {{$totalOpenedTasks}}</h1>
    <h1>Total Pending Tasks: {{$totalPandingTasks}}</h1>
    <h1>Total Completed Tasks: {{$totalCompletedTasks}}</h1>

@endsection
