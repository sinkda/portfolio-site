<div>
    <div class="flex justify-end mb-6">
        <input type="search" wire:model.debounce="search" placeholder="Search Results" class="w-full md:w-64 text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
    </div>

    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full shadow-lg">
            <thead class="bg-gray-300 border-b-2 border-gray-200">
                <th class="p-3 text-sm font-semibold tracking-wide text-left">Project</th>
                <th class="w-28 p-3 text-sm font-semibold tracking-wide text-left">Shown</th>
                <th class="w-16 p-3 text-sm font-semibold tracking-wide text-left">Live</th>
                <th class="w-16 p-3 text-sm font-semibold tracking-wide text-left">Code</th>
                <th class="w-56 p-3 text-sm font-semibold tracking-wide text-left">Actions</th>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @forelse ($projects as $project)
                    <tr @class(['', 'bg-gray-100' => (($loop->index % 2) == true), 'bg-white' => (($loop->index % 2) == false)])>
                        <td class="whitespace-nowrap p-2 text-sm text-gray-700">{{ $project->name }}</td>
                        <td class="whitespace-nowrap p-2">
                            @if( $project->isShown() )
                                <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-600 bg-green-200 rounded-lg bg-opacity-50">Shown</span>
                            @else
                                <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-red-600 bg-red-400 rounded-lg bg-opacity-50">Hidden</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap p-2 text-sm text-gray-700">
                            @if( $project->hasLiveLink() )
                                <span class="text-xs font-medium text-gray-700 ">
                                    <a href="{{ $project->live_link }}">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </span>
                            @else
                                <span class="text-xs font-medium text-gray-400 ">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap p-2">
                            @if( $project->hasCodeLink() )
                                <span class="text-xs font-medium text-gray-700 ">
                                    <a href="{{ $project->code_link }}">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </span>
                            @else
                                <span class="text-xs font-medium text-gray-400 ">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap p-2 flex space-x-4">
                            <a href="{{ route('admin.projects.edit', $project->slug) }}" class="py-2 flex items-center justify-center focus:outline-none text-white text-sm
                                            bg-blue-500 hover:bg-blue-600 rounded-xl w-16 transition duration-150 ease-in">Edit</a>

                            @if( $project->isShown() )
                                <button wire:click="$emit('markHide', {{ $project->id }})" class="py-2 flex items-center justify-center focus:outline-none text-gray-700 hover:text-white text-sm
                                            bg-purple-200 hover:bg-purple-600 rounded-xl w-28 transition duration-150 ease-in">Hide Project</button>
                            @else
                                <button wire:click="$emit('markShow', {{ $project->id }})" class="py-2 flex items-center justify-center focus:outline-none text-gray-700 hover:text-white text-sm
                                            bg-green-400 hover:bg-green-600 rounded-xl w-28 transition duration-150 ease-in">Show Project</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="whitespace-nowrap p-4 text-center bg-gray-100">There are no projects</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-end mt-2 text-xs">Showing Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }} with {{ $projects->total() }} projects.</div>
    

    <div class="mt-6">
        {{ $projects->links() }}
    </div>

    <div class="mt-6 flex justify-end">
        <a href="{{route('admin.projects.create')}}" 
           class="flex items-center bg-blue-500 hover:bg-blue-600 transition duration-150 ease-in-out rounded-lg text-white px-4 py-2">Create New Project</a>
    </div> 
</div>