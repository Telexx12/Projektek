@extends('components.master')

@section('page-content')
    <div class="grid grid-cols-3 gap-10 mt-6 mx-6">
        <livewire:stats.users-count/>
        <livewire:stats.orders-count/>
        <livewire:stats.revenue/>
    </div>
@endsection
