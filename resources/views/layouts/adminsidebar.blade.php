<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/adminsidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
  
</head>

<body>

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-white rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600  ">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-58 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto dark:bg-gray-800 flex flex-col">
            <ul class="space-y-2 font-medium flex-grow">
                <div class="flex justify-center">
                    <img src="{{ asset('images/hplogo.jpg') }}" alt="logo">
                </div>

                <div class="sidey flex-grow">
                    <ul style="margin-top: 60px;">
                        <li >
                           <a href="{{ asset('home') }}"
                                class="font-semibold flex items-center mt-4 p-2 text-white rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <ion-icon name="list" style="font-size: 30px;"></ion-icon>

                               
                                <span class="flex-1 ms-3 whitespace-nowrap">Appointment List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.upload-photos') }}"
                               class="font-semibold flex items-center mt-4 p-2 text-white rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <ion-icon name="images" style="font-size: 30px;"></ion-icon>
                                <span class="flex-1 ms-3 whitespace-nowrap">Photos</span>
                            </a>
                        </li>
                        
                        <li>
                        <li>
                          <a href="{{ asset('calendar') }}"
                                class="font-semibold flex items-center mt-4 p-2 text-white rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <ion-icon name="calendar" style="font-size:30px;"></ion-icon>
                                <span class="flex-1 ms-3 whitespace-nowrap">Calendar</span>
                            </a>
                        </li>
                        <li>
                        <li>
                            <a href="{{ asset('msg') }}"
                                class="font-semibold flex items-center mt-4 p-2 text-white rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <ion-icon name="mail" style="font-size: 30px;"></ion-icon>
                                <span class="flex-1 ms-3 whitespace-nowrap">Message</span>
                              </a>
                        </li>

                </div>
              
<li class="logout" style="margin-top: 7%;">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
       style="color: #EECC8C; background-color: transparent; padding: 12px; display: flex; align-items: center; text-decoration: none; border-radius: 8px;"
       class="font-semibold flex items-center p-3 text-white rounded-lg dark:text-white group"
       onmouseover="this.style.backgroundColor='black'; this.style.color='#EECC8C';" 
       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#EECC8C';">
        <svg style="color:#EECC8C;" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
        </svg>
        <span class="flex-1 ms-3 whitespace-nowrap" style="color: #EECC8C;">Sign Out</span>
    </a>
</li>
                
                
            </ul>

        </div>
    </aside>
    <div class="mb-10 p-2 sm:ml-60">
        @yield('content')
    </div>




    
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>


<!--ionicons-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
<script></script>
</html>
