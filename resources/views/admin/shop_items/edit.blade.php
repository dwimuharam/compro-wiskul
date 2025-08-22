<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Shop Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{$error}}
                        </div>         
                    @endforeach
                @endif

                <form method="POST" action="{{ route('admin.shop_items.update', $shopItem) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          value="{{ $shopItem->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea name="description" id="description" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ $shopItem->description }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" step="0.01"
                          value="{{ $shopItem->price }}" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select name="category" id="category" class="py-3 rounded-lg pl-3 w-full border border-slate-300" required>
                            <option value="">Choose Category</option>
                            <option value="ebook" {{ $shopItem->category == 'ebook' ? 'selected' : '' }}>E-Book</option>
                            <option value="merchandise" {{ $shopItem->category == 'merchandise' ? 'selected' : '' }}>Merchandise</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <img src="{{ Storage::url($shopItem->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px] mb-3">
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Shop Item
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
