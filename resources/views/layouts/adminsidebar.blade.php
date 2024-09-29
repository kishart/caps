<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary: #A36361;
        }

        #default-sidebar {
            background-color: var(--primary);
            border-top-right-radius: 2%;
            border-bottom-right-radius: 2%;
        }

        img {
            width: 160px;
            height: 175px;
            margin-top: 15%;
        }

        div.sidey {
            margin-bottom: 50%;
        }
        ul li a:hover {
    color: #A36361 !important; /* Force color change on hover */
  }
    </style>
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

                <div class="sidey">
                    <ul style="margin-top: 60px;">
                        <li >
                           <a href="{{ asset('home') }}"
                                class="font-semibold flex items-center mt-4 p-3 text-white rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <ion-icon name="list" style="font-size: 30px;"></ion-icon>

                               
                                <span class="flex-1 ms-3 whitespace-nowrap">Appointment List</span>
                            </a>
                        </li>
                        <li>
                             <a href="{{ asset('uphotos') }}"
                                class=" font-semibold flex items-center mt-4 p-2 text-white rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
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
                <li style="margin-top: 70%;">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
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

    <div class="flex  justify-center">
        @yield('content')
    </div>




    
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>


<!--ionicons-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
<script></script>
</html>
