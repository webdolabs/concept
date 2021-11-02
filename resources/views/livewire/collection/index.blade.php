<div>
    @section('title')
        {{ ucfirst($collection['label_m']) }}
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <button wire:click="create('{{ $collection['name'] }}')" type="button" class="btn-primary">
                <span class="px-3 py-1">Vytvořit příspěvek</span>
            </button>
        </div>
    </x-layout.page-title>
    <div 
        x-data="{
            confirmModalDelete: false,
            submitDelete() {
                alert();
            }
        }"
        class="flex flex-col"
    >
        {{-- <x-confirm-alert alpineVar="confirmModalDelete">
            <x-slot name="header">
                <p class="font-bold">Potvrdit smazání</p>
                <p class="text-sm">Po potvrzení již nebude možno žadné obnovy.</p>
            </x-slot>
            <x-slot name="buttons">
                <button @click="submitDelete" class="text-white transition bg-red-500 btn hover:bg-red-600">
                    Potvrdit
                </button>
                <button @click="confirmModalDelete = null" class="text-gray-600 transition bg-transparent btn hover:bg-gray-200">
                    Zrušit
                </button>
            </x-slot>
        </x-confirm-alert> --}}
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-4 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 pl-6"></th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                                    Titulek, autor
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                                    Vytvoření / Poslední úprava
                                </th>
                                <th scope="col" class="py-3 pr-6"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($records as $key => $record)
                                <tr>
                                    <td class="py-3 pl-6 whitespace-nowrap">
                                        {{ $records->firstItem()+$key }}
                                    </td>
                                    <td class="w-full px-4 py-3 whitespace-nowrap">
                                        <a href="{{ url('collection/' . $collection['name'] . '/edit/' . app()->getLocale() . '/' . $record->id) }}" class="text-sm text-left text-gray-900 hover:text-light-blue-500">
                                            <div>
                                                {{ $record->locale->post_title }}
                                            </div>
                                            <div class="text-gray-500">
                                                {{-- {{ $article->user->name }} --}}
                                            </div>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-right text-gray-500 whitespace-nowrap">
                                        {{ date("H:i d.m.Y", strtotime($record->created_at)) }} 
                                        <span class="text-gray-400">/</span> 
                                        {{ date("H:i d.m.Y", strtotime($record->updated_at)) }}
                                    </td>
                                    <td class="py-3 pr-6 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="#" class="text-yellow-400 hover:text-yellow-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ url('collection/' . $collection['name'] . '/edit/' . $record->id) }}" class="text-light-blue-400 hover:text-light-blue-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <button @click="confirmModalDelete = '{{ $record->id }}'" type="button" class="text-red-400 hover:text-red-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             </div>
        </div>
        <div class="flex items-center justify-center pt-4">
            {{ $records->links() }}
        </div>
    </div>
</div>