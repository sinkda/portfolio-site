@extends('admin')

@section('title')
    Message: {{ $message->subject }}
@endsection

@section('content')
<section class="flex flex-col md:flex-row w-full shadow-md rounded-xl bg-white p-8">
    <div class="w-full" x-data="{readStatus: {{ $message->isRead() ? 'true' : 'false' }}}">
        <h2 class="text-xl text-gray-700 font-bold">Message From: {{ $message->name }}</h2>

        <div class="flex flex-col mt-6 space-y-4 text-md text-gray-700">
            <div class="flex flex-col md:flex-row">
                <span class="inline-block font-semibold w-40">E-Mail Address: </span>
                <span>{{ $message->email }}</span>
            </div>

            <div class="flex flex-col md:flex-row">
                <span class="inline-block font-semibold w-40">Sent On: </span>
                <span>{{ $message->created_at->format('l, F jS @ g:i A') }}</span>
            </div>

            <div class="flex flex-col md:flex-row">
                <span class="inline-block font-semibold w-40">Status: </span>
                <template x-if="readStatus">
                    <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-purple-600 bg-purple-200 rounded-lg bg-opacity-50 w-12 md:w-auto">Read</span>
                </template>
                <template x-if="!readStatus">
                    <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-600 bg-red-400 rounded-lg bg-opacity-50 w-16 md:w-auto">Unread</span>
                </template>
            </div>

            <div class="flex flex-col md:flex-row">
                <span class="inline-block font-semibold w-40">Subject: </span>
                <span>{{ $message->subject}}</span>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="inline-block font-semibold">Message: </span>
                <span class="whitespace-pre-line">{{ $message->message }}</span>
            </div>
        </div>

        <div class="flex justify-end mt-10">
            <template x-if="readStatus">
                <button x-on:click.prevent="Livewire.emit('markUnread', {{ $message->id }}); readStatus = false" class="py-2 flex items-center justify-center focus:outline-none text-gray-700 hover:text-white text-sm
                            bg-purple-200 hover:bg-purple-600 rounded-xl w-28 transition duration-150 ease-in">Mark Unread</button>
            </template>
            <template x-if="!readStatus">
                <button x-on:click.prevent="Livewire.emit('markRead', {{ $message->id }}); readStatus = true" class="py-2 flex items-center justify-center focus:outline-none text-gray-700 hover:text-white text-sm
                            bg-green-400 hover:bg-green-600 rounded-xl w-28 transition duration-150 ease-in">Mark Read</button>
            </template>
        </div>
    </div>
</section>
@endsection