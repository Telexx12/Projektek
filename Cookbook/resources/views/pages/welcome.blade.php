@extends('components.master')

@section('page-content')
    <div class="bg-gray-700 rounded-md border my-8 mx-80 px-6 py-6">
         <livewire:chart-orders />
    </div>
@endsection

@section('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

