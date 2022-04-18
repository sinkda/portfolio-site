@extends('admin')

@section('title', 'Messages')

@section('content')
{{-- About Section --}}
<section class="flex flex-col md:flex-row w-full shadow-md rounded-xl bg-white p-8">
    <div class="w-full">
        <livewire:message-table />
    </div>
</section>
@endsection