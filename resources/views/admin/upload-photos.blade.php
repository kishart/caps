@extends('layouts.adminsidebar')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/uphotos.css') }}">
    <title>Upload Photos</title>


    <div class="toggle-container">
        <input type="checkbox" id="toggle" class="toggleCheckbox" />
        <label for="toggle" class="toggleContainer">
            <div id="uploadPhotos" class="toggle-label" onclick="showDiv('upload-photos')">Upload Photos</div>
            <div id="viewPhotos" class="toggle-label" onclick="showDiv('list-photos')">View Photos</div>
        </label>
    </div>

    <!-- Upload Photos Section -->
    <div id="uploadPhotosDiv" class="upload-photos">

        <!-- Upload Form -->
        <form action="{{ route('admin.upload-photos') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="display" class="display containera mt-3">

                <div class="left">
                    <!-- Display Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    <!-- file upload modal -->
                    <article aria-label="File Upload Modal"
                        class="relative h-full flex flex-col bg-white shadow-xl rounded-md" ondrop="dropHandler(event);"
                        ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);"
                        ondragenter="dragEnterHandler(event);">
                        <!-- overlay -->
                        <div id="overlay"
                            class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
                            <i>
                                <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                                </svg>
                            </i>
                            <p class="text-lg text-blue-700">Drop files to upload</p>
                        </div>

                        <!-- scroll area -->
                        <section class=" overflow-auto p-8 w-full h-full flex flex-col">
                            <header
                                class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center"
                                name="photos[]">
                                <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                                    <span>Drag and drop your</span>&nbsp;<span>files anywhere or</span>
                                </p>

                                <input name="photos[]" id="hidden-input" type="file" multiple class="hidden" />


                                <button id="button" style="background-color: #A36361; "
                                    onmouseover="this.style.backgroundColor='#A36361';"
                                    onmouseout="this.style.backgroundColor='#E8B298'; "
                                    class="mt-2 rounded-sm px-3 py-1 text-white hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                                    Upload a file
                                </button>
                            </header>

                            <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
                                To Upload
                            </h1>

                            <ul id="gallery" class="flex flex-1 flex-wrap -m-1">
                                <li id="empty"
                                    class="h-full w-full text-center flex flex-col justify-center items-center">
                                    <img class="mx-auto w-32"
                                        src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                                        alt="no data" />
                                    <span class="text-small text-gray-500">No files selected</span>
                                </li>
                            </ul>
                        </section>


                    </article>
                    <!-- using two similar templates for simplicity in js code -->
                    <template id="file-template">
                        <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                            <article tabindex="0"
                                class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                                <img alt="upload preview"
                                    class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />

                                <section
                                    class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                                    <h1 class="flex-1 group-hover:text-blue-800"></h1>
                                    <div class="flex">
                                        <span class="p-1 text-blue-800">
                                            <i>
                                                <svg class="fill-current w-4 h-4 ml-auto pt-1"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                                                </svg>
                                            </i>
                                        </span>
                                        <p class="p-1 size text-xs text-gray-700"></p>
                                        <button
                                            class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                                            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path class="pointer-events-none"
                                                    d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                            </svg>
                                        </button>
                                    </div>
                                </section>
                            </article>
                        </li>
                    </template>

                    <template id="image-template">
                        <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                            <article tabindex="0"
                                class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                                <img alt="upload preview"
                                    class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

                                <section
                                    class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                                    <h1 class="flex-1"></h1>
                                    <div class="flex">
                                        <span class="p-1">
                                            <i>
                                                <svg class="fill-current w-4 h-4 ml-auto pt-"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                                </svg>
                                            </i>
                                        </span>

                                        <p class="p-1 size text-xs"></p>
                                        <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                                            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path class="pointer-events-none"
                                                    d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                            </svg>
                                        </button>
                                    </div>
                                </section>
                            </article>
                        </li>
                    </template>


                </div>


                <div class="right">

                    <div class="description text-black mt-3 ">

                        <h1 class="text-start font-bold" style="margin-bottom: 20px;">Choose a username: </h1>
                        <select name="user_id" style="width: 300px; border-radius: 10px;" required>
                            <option value="" disabled selected>Select a username</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>



                        <div style="margin-top:30px;">

                            <label for="description"
                                class="block pb-4 text-sm text-left font-bold text-black dark:text-white">Description:
                            </label>
                            <textarea id="description" rows="10" name="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                                placeholder="Write your thoughts here..."></textarea>
                        </div>
                    </div>
                    <!-- HTML !-->
                    <button type="submit" style="margin-top:30px;" class="buttonsub" role="button">Submit</button>

                </div>


            </div>
        </form>

    </div>


    {{-- list-photos --}}
    <div id="listPhotosDiv" class="list-photos" style="display: none;">

   
        
        <div class="table-container">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">Photos</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Username</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($photos as $photo)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">
                                @if (!empty($photo->photo_paths) && is_array(json_decode($photo->photo_paths)))
                                    @foreach (json_decode($photo->photo_paths) as $path)
                                        <img src="{{ asset('storage/' . $path) }}" alt="Photo"
                                            class="h-16 w-16 object-cover rounded">
                                    @endforeach
                                @else
                                    <span>No photos available</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $photo->description }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $photo->user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ url('admin/editphotos/' . $photo->id) }}" class="action-edit">
                                    <ion-icon name="create"></ion-icon> Edit
                                </a>
                                <form action="{{ route('admin.delete-photo', $photo->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        


        <script>
            function showDiv(side) {
                const leftDiv = document.querySelector('.upload-photos');
                const rightDiv = document.querySelector('.list-photos');

                if (side === 'left') {
                    leftDiv.style.display = 'flex';
                    rightDiv.style.display = 'none';
                } else if (side === 'list-photos') {
                    leftDiv.style.display = 'none';
                    rightDiv.style.display = 'flex';
                }
            }

            function openEditModal(photo) {
                // Set the form action dynamically
                const form = document.getElementById('editPhotoForm');
                const actionUrl = `/admin/photos/${photo.id}/update`; // Use the correct ID in the URL
                form.action = actionUrl;

                // Populate fields with the current values
                document.getElementById('edit_user_id').value = photo.user_id;
                document.getElementById('edit_description').value = photo.description;

                // Open the modal
                document.getElementById('editPhotoModal').classList.remove('hidden');
            }

            function closeEditModal() {
                // Close the modal
                document.getElementById('editPhotoModal').classList.add('hidden');
            }
        </script>


        <script src="{{ asset('js/uphotos.js') }}"></script>
    @endsection
