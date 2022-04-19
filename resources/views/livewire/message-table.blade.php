<div>
    <div class="flex justify-end mb-6">
        <input type="search" wire:model.debounce="search" placeholder="Search Results" class="w-full md:w-64 text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
    </div>

    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full shadow-lg">
            <thead class="bg-gray-300 border-b-2 border-gray-200">
                <th class="w-48 p-3 text-sm font-semibold tracking-wide text-left">Name</th>
                <th class="w-72 p-3 text-sm font-semibold tracking-wide text-left">Email</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">Subject</th>
                <th class="w-28 p-3 text-sm font-semibold tracking-wide text-left">Status</th>
                <th class="w-56 p-3 text-sm font-semibold tracking-wide text-left">Actions</th>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @forelse ($messages as $message)
                    <tr @class(['', 'bg-gray-100' => (($loop->index % 2) == true), 'bg-white' => (($loop->index % 2) == false)])>
                        <td class="whitespace-nowrap p-2 text-sm text-gray-700">{{ $message->name }}</td>
                        <td class="whitespace-nowrap p-2 text-sm text-gray-700">{{ $message->email }}</td>
                        <td class="whitespace-nowrap p-2 text-sm text-gray-700">{{ $message->subject }}</td>
                        <td class="whitespace-nowrap p-2 text-sm text-gray-700">
                            @if( $message->isRead() )
                                <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-purple-600 bg-purple-200 rounded-lg bg-opacity-50">Read</span>
                            @else
                                <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-600 bg-red-400 rounded-lg bg-opacity-50">Unread</span>
                            @endif
                            
                        </td>
                        <td class="whitespace-nowrap p-2 flex space-x-4">
                            <a href="{{ route('admin.messages.view', $message->id) }}" class="py-2 flex items-center justify-center focus:outline-none text-white text-sm
                                            bg-blue-500 hover:bg-blue-600 rounded-xl w-16 transition duration-150 ease-in">View</a>

                            @if( $message->isRead() )
                                <button wire:click="$emit('markUnread', {{ $message->id }})" class="py-2 flex items-center justify-center focus:outline-none text-gray-700 hover:text-white text-sm
                                            bg-purple-200 hover:bg-purple-600 rounded-xl w-28 transition duration-150 ease-in">Mark Unread</button>
                            @else
                                <button wire:click="$emit('markRead', {{ $message->id }})" class="py-2 flex items-center justify-center focus:outline-none text-gray-700 hover:text-white text-sm
                                            bg-green-400 hover:bg-green-600 rounded-xl w-28 transition duration-150 ease-in">Mark Read</button>
                            @endif
                            
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="whitespace-nowrap p-4 text-center bg-gray-100">There are no messages</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-end mt-2 text-xs">Showing Page {{ $messages->currentPage() }} of {{ $messages->lastPage() }} with {{ $messages->total() }} messages.</div>
    

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>