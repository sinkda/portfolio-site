<div>
    <div class="flex flex-col justify-start space-y-3"
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">   

        @empty($previous)
            @if($passed)
                <img class="w-64 h-64" src="{{ $image->temporaryUrl() }}">
            @endif
        @else
            <img class="w-64 h-64" src="{{ asset('storage/projects/'. $previous) }}">
        @endif

        <input type="file" wire:model="image" name="image"
            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-500 file:text-white hover:file:bg-blue-600">

        <div x-show="isUploading" x-cloak>
            <progress max="100" x-bind:value="progress"></progress>
        </div>

        @error('image') 
            <span class="text-sm text-red-300">{{ $message }}</span> 
        @enderror
    </div>

</div>
