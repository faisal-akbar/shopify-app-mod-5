@extends('layouts.master')

@section('title', 'Create Collection')

@section('contents')
    <section class="bg-gray-100 hidden" id="create-Collection">
        <div class="py-14">
            <div class="max-w-screen-xl mx-auto px-4 text-gray-600 md:px-8">
                <div class="gap-12 flex justify-between">
                    <div class="max-w-lg space-y-3">
                        <h3 class="text-indigo-700 font-semibold">Collections</h3>
                        <p class="text-gray-800 text-3xl font-semibold sm:text-4xl">
                            Create new Collections
                        </p>
                        <p>
                            Collections are the categories of the each product. You can create as many collections as you want and add product to them.
                        </p>
                    </div>
                    <div>
                        <button onclick="hideCreateCollection()"
                            class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </button>
                    </div>
                </div>

                <div class="flex-1 mt-12 sm:max-w-lg lg:max-w-md">
                    <form method="POST" action="{{ route('collection.save') }}" class="space-y-5">
                        @sessionToken
                        <input type="hidden" name="host" value="{{getHost()}}">
                        <input type="hidden" name="collectionId" id="collectionId" value="0">
                        <div>
                            <label class="font-medium"> Collection Name</label>
                            <input type="text" id="name" name="name" required
                                class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-slate-600 shadow-sm rounded-lg" />
                        </div>
                        <div>
                            <label class="font-medium"> Description </label>
                            <textarea rows="3" id="description" name="description"
                                class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-slate-600 shadow-sm rounded-lg"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-white font-medium bg-slate-600 hover:bg-slate-500 active:bg-slate-600 rounded-lg duration-150">
                            Save Collection
                        </button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="py-14">
            <div class="max-w-screen-xl mx-auto px-4 text-gray-600 md:px-8">
                <div class=" mx-auto gap-12">
                    <div class="flex justify-between">
                        <div class="max-w-lg space-y-3">
                            <h3 class="text-indigo-600 font-semibold">Collections</h3>
                            <p class="text-gray-800 text-3xl font-semibold sm:text-4xl">
                                Available Collections
                            </p>
                            <p>
                                Here are your available Collections. You can edit or delete them.
                            </p>
                        </div>
                        <div>
                            <button onclick="showCreateCollection()"
                                class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded">
                                Create Collection
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($collections as $collection)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $collection->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $collection->description }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <button onclick="editCollection(this)"
                                                class="py-1.5 px-3 text-gray-600 hover:text-gray-500 duration-150 hover:bg-gray-50 border rounded-lg"
                                                data-id="{{ $collection->id }}" data-name="{{ $collection->name }}"
                                                data-description="{{ $collection->description }}">Edit</button>
                                            &nbsp;
                                            <a href="{{ URL::tokenRoute('collection.products', ['collectionId' => $collection->id]) }}"
                                                class="py-1.5 px-3 text-red-600 hover:text-gray-500 duration-150 hover:bg-red-50 border rounded-lg">Products</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>


                <!-- <div class="max-w-screen-xl mx-auto px-4 py-4 md:px-8">
                    <div class="mt-12 relative h-max overflow-auto">
                        <table class="w-full table-auto text-sm text-left">
                            <thead class="text-gray-600 font-medium border-b">
                                <tr>
                                    <th class="py-3 pr-6">name</th>
                                    <th class="py-3 pr-6">date</th>
                                    <th class="py-3 pr-6">status</th>
                                    <th class="py-3 pr-6"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 divide-y">
                                @foreach ($collections as $collection)
                                    <tr>
                                        <td class="pr-6 py-4 whitespace-nowrap ">
                                            {{ $collection->name }}
                                        </td>
                                        <td class="pr-6 py-4 whitespace-nowrap ">
                                            {{ $collection->description }}
                                        </td>
                                        <td class="pr-6 py-4 whitespace-nowrap"><span
                                                class="px-3 py-2 rounded-full font-semibold text-xs text-green-600 bg-green-50">Active</span>
                                        </td>

                                        <td class="text-right whitespace-nowrap">
                                            <button onclick="editCollection(this)"
                                                class="py-1.5 px-3 text-gray-600 hover:text-gray-500 duration-150 hover:bg-gray-50 border rounded-lg"
                                                data-id="{{ $collection->id }}" data-name="{{ $collection->name }}"
                                                data-description="{{ $collection->description }}">Edit</button>
                                            &nbsp;
                                            <a href="{{ URL::tokenRoute('collection.products', ['collectionId' => $collection->id]) }}"
                                                class="py-1.5 px-3 text-red-600 hover:text-gray-500 duration-150 hover:bg-red-50 border rounded-lg">Products</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> -->
            </div>
        </div>
        </div>
    </section>



@endsection

@push('scripts')
    <script>
        function showCreateCollection() {
            document.getElementById('create-Collection').classList.remove('hidden');
        }

        function hideCreateCollection() {
            document.getElementById('create-Collection').classList.add('hidden');
            //clear the values
            document.getElementById('name').value = '';
            document.getElementById('description').value = '';
            document.getElementById('collectionId').value = '';
        }

        function editCollection(button) {
            console.log(button.dataset);
            document.getElementById('create-Collection').classList.remove('hidden');
            //get the data-name, data-description and data-id
            document.getElementById('name').value = button.dataset.name;
            document.getElementById('description').value = button.dataset.description;
            document.getElementById('collectionId').value = button.dataset.id;
        }
    </script>
@endpush
