@extends('layouts.adminsidebar')

@section('content')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="{{ asset('css/ahome.css') }}">


    <div class="appointy">
        <p class="text-left text-3xl text-black font-bold">Appointment List</p>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search..." class="search-input">
            <button class="search-btn" onclick="filterTable()">
                <i class="material-icons">search</i>
            </button>
        </div>
        <button class="appoint-btn">Set Appointment</button>
    </div>

    <!-- Table outside the loop -->
    <div>
        <table class="appointment-table text-black" id="appointmentTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Message</th>
                    <th>Feedback</th>
                    <th>More</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td class="margin-left:30%;">{{ $appointment->fname }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}</td>

                        <td>
                            <label for="actionSelect" style="border-radius: 30%; " class="sr-only">Action</label>
                            <select id="actionSelect" class="custom-select" onchange="handleSelectChange(this)"
                                style="height: 42.5px; width: 130px; padding: 10px 15px;  font-size: 16px; border: none; text-align: right; background-color: rgb(235, 229, 229);">
                                <option class="option" value="" disabled selected
                                    style="background-color: rgb(235, 229, 229); border-radius: 10%;">
                                    {{ ucfirst($appointment->status) }}</option>
                                <option class="option" value="{{ url('admin/accepted/' . $appointment->id) }}"
                                    style="background-color: green; color: white; border-radius: 10%;">Approved</option>
                                <option class="option" value="{{ url('admin/declined/' . $appointment->id) }}"
                                    style="background-color: red; color: white; border-radius: 10%;">Declined</option>
                            </select>

                        </td>

                        <td>
                            <button data-modal-target="message-modal-{{ $appointment->id }}"
                                data-modal-toggle="message-modal-{{ $appointment->id }}"
                                class="bg-[#4496c8] text-white font-medium rounded-lg px-5 py-2.5 text-center hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                type="button">
                                Message
                            </button>

                            <!-- Main modal -->
                            <div id="message-modal-{{ $appointment->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Send a Message to {{ $appointment->fname }}
                                            </h3>
                                            <button type="button" data-modal-target="message-modal-{{ $appointment->id }}"
                                                data-modal-toggle="message-modal-{{ $appointment->id }}"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form class="space-y-4" action="{{ route('send.message', $appointment->id) }}"
                                                method="POST">
                                                @csrf
                                                <div>
                                                    <label for="message"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                                        Message</label>
                                                    <textarea name="message" id="message" rows="4"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Type your message here..." required></textarea>
                                                </div>
                                                <button type="submit"
                                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send
                                                    Message</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>


                        <td>
                            @if ($appointment->feedback_requested)
                                <!-- View Feedback Button -->
                                <button data-modal-target="feedback-modal-{{ $appointment->id }}"
                                    data-modal-toggle="feedback-modal-{{ $appointment->id }}"
                                    style="background-color: #4DA167; color:white; width: 100px;border-radius: 15px;  border: none; display: flex; align-items: center; justify-content: center; padding: 10px; "
                                    type="button">
                                    <span class="material-symbols-outlined" style="font-size: 21px; margin-right: 18px;">
                                        visibility
                                    </span>
                                    View
                                </button>

                                <!-- Feedback Modal Structure -->
                                <div id="feedback-modal-{{ $appointment->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Feedback from {{ $appointment->fname }}
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="feedback-modal-{{ $appointment->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                @if ($appointment->feedback)
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        {{ $appointment->feedback }}
                                                    </p>
                                                @else
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        No feedback provided yet.
                                                    </p>
                                                @endif
                                            </div>
                                            <!-- Modal footer -->
                                            <div
                                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="feedback-modal-{{ $appointment->id }}"
                                                    type="button"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Request Feedback Form -->
                                <form action="{{ route('request.feedback', $appointment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"
                                        style="width: 100px;border-radius: 15px; color:black; background-color: rgb(235, 229, 229); border: none; display: flex; align-items: center; justify-content: center; padding: 10px;">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 21px; margin-right: 8px;">
                                            today
                                        </span>
                                        Request
                                    </button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown" style="position: relative;">
                                <span
                                    style="background-color: #D9D9D9; display: inline-block; padding: 3px; border: 1px solid rgb(8, 8, 10); border-radius: 10px; cursor: pointer;"
                                    class="material-symbols-outlined" onclick="toggleMenu(this)">
                                    more_horiz
                                </span>
                                <div class="dropdown-menu" style="display: none; position: absolute; z-index: 1;">
                                    <a 
                                        data-modal-target="details-modal-{{ $appointment->id }}" 
                                        data-modal-toggle="details-modal-{{ $appointment->id }}"
                                        class="inline-flex items-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" 
                                        onclick="showDetailsModal({{ $appointment->id }})">
                                        <ion-icon name="newspaper" class="mr-2"></ion-icon> Details
                                    </a>
                                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                        Toggle modal
                                      </button>
                                      
                                   
                                    <!-- Edit Link with Blue Background -->
                                    <a href="{{ url('admin/editappoint/' . $appointment->id) }}" class="action-edit">
                                        <ion-icon name="create"></ion-icon> Edit
                                    </a>

                                    
                        
                                    <!-- Delete Link with Red Background -->
                                    <a href="{{ url('admin/delete-appointment/' . $appointment->id) }}" class="action-delete">
                                        <ion-icon name="trash"></ion-icon> Delete
                                    </a>
                                </div>

                                <!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Terms of Service
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
            </div>
        </div>
    </div>
</div>
                        
                                <div id="details-modal-{{ $appointment->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                                    <div class="bg-white rounded-lg p-2 max-w-md w-full">
                                        <h3 class="text-lg font-semibold">Appointment Details</h3>
                                        <hr>
                        
                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            <ion-icon name="person-circle"></ion-icon> {{ $appointment->fname }}
                                        </p>
                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            <ion-icon name="mail"></ion-icon> {{ $appointment->email }}
                                        </p>
                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            <ion-icon name="call"></ion-icon> {{ $appointment->phone }}
                                        </p>
                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            <ion-icon name="document"></ion-icon> {{ $appointment->details }}
                                        </p>
                                        <button 
                                            class="mt-4 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5"
                                            onclick="hideDetailsModal({{ $appointment->id }})">
                                            Exit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                @endforeach
            </tbody>
        </table>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="{{ asset('js/ahome.js') }}"></script>
    <script>
        function toggleMenu(element) {
            const menu = element.nextElementSibling;
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
        
    </script>
@endsection
