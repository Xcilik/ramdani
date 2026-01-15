@extends('layouts.admin')

@section('title', 'EDIT CATEGORY')

@section('content')
    <div class="min-h-screen bg-gray-50/50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            {{-- Header Icon & Title --}}
            <div class="text-center">
                <div class="mx-auto w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-4 text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Collection</h2>
                
                <div class="mt-2 flex items-center justify-center gap-2">
                    <span class="text-sm text-gray-500">Updating category details</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 font-mono">
                        ID: {{ substr(md5($category->id), 0, 6) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            {{-- FORM CARD --}}
            <div class="bg-white py-8 px-4 shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-2xl sm:px-10 border border-gray-100 relative overflow-hidden">
                
                {{-- Decorative Blob --}}
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 rounded-full bg-indigo-50 blur-2xl opacity-50 pointer-events-none"></div>

                <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6 relative">
                    @csrf
                    @method('PUT')

                    {{-- Input Field --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Category Name
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $category->name) }}"
                                   class="block w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition-all placeholder-gray-400 sm:text-sm font-medium" 
                                   placeholder="e.g. Limited Edition" 
                                   required>
                        </div>
                        
                        @error('name')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1 font-medium">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="pt-2 space-y-3">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#111] hover:bg-black hover:shadow-lg hover:shadow-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all transform hover:-translate-y-0.5">
                            Update Changes
                        </button>

                        <div class="text-center">
                            <a href="{{ route('admin.categories.index') }}" class="text-xs font-medium text-gray-400 hover:text-gray-600 transition-colors">
                                Cancel & Return
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection