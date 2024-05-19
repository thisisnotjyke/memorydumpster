<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">Memory Dumpster</h2>
            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <table class="border-collapse w-full text-sm">
                        <thead>
                            <tr>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-white text-left">Title</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-white text-left">Created At</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-white text-left">Updated At</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-white text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800">
                            {{-- populate our post data --}}
                            @foreach ($posts as $post)
                            <tr>
                                <td class="border-b border-gray-700 p-4 pl-8 text-white">{{ $post->title }}</td>
                                <td class="border-b border-gray-700 p-4 pl-8 text-white">{{ $post->created_at }}</td>
                                <td class="border-b border-gray-700 p-4 pl-8 text-white">{{ $post->updated_at }}</td>
                                <td class="border-b border-gray-700 p-4 pl-8 text-white">
                                    <a href="{{ route('posts.show', $post->id) }}" class="border border-blue-500 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-md transition duration-300 ease-in-out">SHOW</a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="border border-yellow-500 hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-md transition duration-300 ease-in-out">EDIT</a>
                                    {{-- add delete button using form tag --}}
                                    <form method="post" action="{{ route('posts.destroy', $post->id) }}" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-md transition duration-300 ease-in-out">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
