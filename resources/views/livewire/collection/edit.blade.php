<div>
    <x-layout.form-header>
        <x-slot name="title">
            Vytvořit {{ strtolower($collection['label']) }}
        </x-slot>
        <x-slot name="buttons">
            <a href="{{ url('collection/' . $collection['name'] . '/index') }}" class="transition duration-300 bg-light-blue-100 text-light-blue-500 btn hover:text-light-blue-600">
                <span class="px-3 py-1">Zrušit</span>
            </a>
            <button wire:click="submit" type="button" class="transition duration-300 bg-green-500 btn hover:bg-green-600 text-green-50 hover:text-white">
                <span class="px-3 py-1">Uložit</span>
                <x-loading-spin size="6" target="submit" />
            </button>
        </x-slot>
    </x-layout.form-header>    

    <div
        x-data="{
            showSidebar: false,
        }" 
        class="flex items-start w-full mx-auto max-w-7xl"
    >
        <div class="w-full px-6 py-4 mt-8">
            {{ $post->locale->post_title }}
            <x-form.filepond 
                name="gallery" 
                multiple="true" 
                acceptedFileTypes="['image/png', 'image/jpeg']"
                maxFileSize="10mb"
                :media="$media" 
                :prev="$post->getMedia('gallery')" 
            />
        </div>
        <div class="absolute right-0 flex items-start xl:space-x-6 xl:static">
            <button 
                @click="showSidebar = !showSidebar" 
                type="button" 
                class="p-2 mt-8 text-white rounded-l-lg xl:hidden bg-light-blue-400"
            >
                <svg 
                    :class="{ 'transform rotate-180': showSidebar }"
                    class="transition duration-300 w-7 h-7" fill="none" viewBox="0 0 24 24"
                >
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                </svg>
            </button>
            <div 
                :class="{ 'hidden xl:flex': !showSidebar }"
                class="flex flex-col px-6 py-4 transition duration-300 xl:mt-12 bg-gray-50 xl:static h-screen--80 xl:h-auto w-80"
            >
                <p>thumbnail</p>
                <x-form.filepond 
                    name="thumbnail"
                    acceptedFileTypes="['image/png', 'image/jpeg']"
                    maxFileSize="10mb"
                    :media="$media" 
                    :prev="$post->getMedia('thumbnail')" 
                />
                <p>thumbnail-small</p>
                <x-form.filepond 
                    name="thumbnail_small"
                    acceptedFileTypes="['image/png', 'image/jpeg']"
                    maxFileSize="10mb"
                    :media="$media" 
                    :prev="$post->getMedia('thumbnail_small')" 
                />
            </div>
        </div>
    </div>
</div>