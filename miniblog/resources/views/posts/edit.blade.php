<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">



                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg mt-5 ml-5 font-medium leading-6 text-gray-900">Update the of your post</h3>

                        </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">

                        <form method="PUT" action="{{ route('posts.update') }}" >

                        @csrf
                            <input name="post" id="post" type="hidden" value={{ $post->id }}>
                            <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 ">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input value="{{ $post->title }}" type="text" name="title" id="title" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                                        @if ($errors->has('title'))
                                        <div class="mb-2 text-red">
                                            {{ $errors->first('title') }}
                                        </div>
                                        @endif
                                </div>

                                <div class="col-span-6">
                                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                                    <textarea id="content" name="content" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="add your post content">{{ $post->content }}</textarea>
                                         @if ($errors->has('content'))
                                        <div class="mb-2 text-green">
                                            {{ $errors->first('content') }}
                                        </div>
                                        @endif

                                </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update
                                </button>
                            </div>
                            </div>
                        </form>


                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</x-app-layout>
