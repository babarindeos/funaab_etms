<header class="flex flex-col shadow-md bg-gradient-to-b from-green-700 to-green-500">

    
    
    <nav class="py-3 border-0">
        <div class="mx-auto px-2 sm:px-8 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <div class="flex flex-shrink-0">
                    <!-- logo //-->
                    <div class="flex flex-row px-2 md:px-4 py-2">
                        <img src="{{ asset('images/logo.png')}}" />
                    </div>
                    <!-- end of logo //-->
                    <!-- Name //-->
                    <div class="flex flex-col item-center justify-center">
                            <div class="text-white font-bold text-2xl font-serif">TIMTEC</div>
                            <div class="text-white font-semibold font-serif opacity-80 hidden md:block">Exam Timetable Management System (ETMS)</div>
                                
                    </div>
                    <!-- end of name //-->
                </div>

               
                <!-- Mobile Menu Button -->
                <div class="lg:hidden px-4">
                    <button class="text-white focus:outline-none" id="mobile-menu-button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <!-- Main Menu -->
                <div class="hidden lg:flex lg:px-4 space-x-4">
                    @auth
                        @if (Auth::user()->role==='manager')

                            <a href="#" class="flex font-semibold items-center text-white hover:border-b-yellow-100 hover:border-b-4 mx-2 ">Dashboard</a>

                            <a href="{{ route('manager.announcements.index') }}" class="flex font-semibold items-center text-white hover:border-b-yellow-100 hover:border-b-4 mx-2 ">Announcements</a>

                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Monitoring
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[250%]">
                                    <!-- <a href="{{ route('admin.monitoring.chiefs.select_exam_chief') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Chief Supervision</a> -->
                                    <a href="{{ route('manager.monitoring.timtecs.select_exam_timtec') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">TIMTEC Observers</a>
                                    <a href="{{ route('manager.monitoring.invigilators.select_exam_invigilator') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Invigilators</a>
                                    <a href="" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Attendance</a>
                                    <a href="" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Remuneration</a>
                                    <a href="" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8 ">Reports</a>
                                    <a href="" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8 hidden">Malpractice Incidence</a>
                                </div>
                            </div>
                           
                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Exams
                                </button>
                                <!-- Sub-menu -->   
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[400%]">
                                    <a href="{{ route('manager.exams.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Exams</a>                              
                                    <a href="{{ route('manager.exams.exam_days.select_exam_days') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Exam Days</a>                                    
                                    
                                </div>
                            </div>
                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    User
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[450%]">
                                    <a href="{{ route('manager.staff.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Manage Users</a>
                                    
                                    <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8 hidden">Titles</a>
                                    <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8 hidden">Statuses</a>
                                    <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8 hidden">Roles</a>
                                </div>
                            </div>

                           <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Invigilation
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[250%]">
                                    <a href="{{ route('manager.course.invigilation.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Allocations</a>
                                   
                                </div>
                            </div>

                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Observation
                                </button>
                                 <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[250%]">
                                    <a href="{{ route('admin.staff.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">By Venue</a>
                                    <a href="{{ route('admin.staff.create') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">By Timtec Observers</a>
                                    
                                </div>
                            </div>

                             <a href="#" class="flex font-semibold items-center text-white hover:border-b-yellow-100 hover:border-b-4 mx-2 ">Venues</a>


                            
                            
                           
                            <form action="{{ route('admin.auth.logout') }}" method="POST" class="flex items-center justify-center border-0">
                                @csrf
                                
                                <button type="submit" class="flex font-semibold items-center hover:border-b-yellow-100 text-white hover:border-b-4 mx-3 ">Sign Out</button>
                            </form>  
                        @endif
                    @endauth     
                </div>
                
            </div>
            
            <!-- Mobile Menu -->
            <div class="lg:hidden hidden" id="mobile-menu">
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Dashboard</a>
                <div class="relative">
                    <button class="block w-full text-left text-white px-4 py-2 hover:bg-gray-700 rounded-md focus:outline-none" id="services-mobile">
                        Office
                    </button>
                    <!-- Sub-menu for Mobile -->
                    <div class="hidden bg-slate-50 rounded-md" id="services-sub-menu-mobile">
                        <a href="{{ route('admin.cells.index') }}" class="block px-4 py-2 hover:bg-gray-200">Cells</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Circles</a>
                        <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200">Admin</a>
                        <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200">Staff</a>
                    </div>
                </div>
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Users</a>
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Documents</a>
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Tracker</a>
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Analytics</a>
                <form action="{{ route('admin.auth.logout') }}" method="POST" class="block w-full">
                    @csrf
                    
                    <button type="submit" class="block w-full text-white px-4 py-2 hover:bg-gray-700 rounded-md">Sign Out</button>
                </form> 
            </div>
        </div>
    </nav>
    
    <script>
        // Toggle Mobile Menu
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    
        // Toggle Mobile Sub-menu
        document.getElementById('services-mobile').addEventListener('click', function () {
            document.getElementById('services-sub-menu-mobile').classList.toggle('hidden');
        });
    </script>

    
</header>
