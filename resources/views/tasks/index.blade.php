@extends('layouts.app')

@section('content')
    <!-- ✅ Success Alert -->
    @if (session()->has('message'))
        <div class="p-3 mb-4 rounded-lg bg-green-500 text-white shadow-lg">
            {{ session('message') }}
        </div>
    @endif
    @livewire('task-search')
@endsection
