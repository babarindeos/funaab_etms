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
                            <div class="text-white font-bold text-2xl font-serif">FUNAAB</div>
                            <div class="text-white font-semibold font-serif">Exam Timetable Management System (ETMS)</div>
                                
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
                        @if (Auth::user()->role==='admin')

                            <a href='{{ route('admin.dashboard.index') }}' class="flex font-semibold items-center text-white hover:border-b-yellow-100 hover:border-b-4 mx-2 ">Dashboard</a>

                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Monitoring
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[250%]">
                                    <a href="{{ route('admin.cells.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Chief Supervision</a>
                                    <a href="{{ route('admin.cells.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">TIMTEC Observance</a>
                                    <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Invigilation</a>
                                    <a href="{{ route('admin.staff.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Attendance</a>
                                    <a href="{{ route('admin.staff.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Remuneration</a>
                                </div>
                            </div>
                           
                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Exams
                                </button>
                                <!-- Sub-menu -->   
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[400%]">
                                    <a href="{{ route('admin.cells.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Roaster</a>
                                    <a href="{{ route('admin.exams.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Exams</a>
                                    <a href="{{ route('admin.exams.exam_scheduler.select_exam_day') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Exam Scheduler</a>
                                    <a href="{{ route('admin.exams.exam_types.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Exam Types</a>
                                    <a href="{{ route('admin.exams.exam_days.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Exam Days</a>
                                    <a href="{{ route('admin.exams.exam_time_periods.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Exam Time Periods</a>
                                    <a href="{{ route('admin.staff.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Chief Allocation</a>
                                    <a href="{{ route('admin.exams.invigilator_allocation.select_exam_day') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Invigilator Allocation</a>
                                </div>
                            </div>
                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Users
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[350%]">
                                    <a href="{{ route('admin.staff.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Manage Users</a>
                                    <a href="{{ route('admin.staff.create') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Create User</a>
                                    <a href="{{ route('admin.staff.titles.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Titles</a>
                                    <a href="{{ route('admin.staff.statuses.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Statuses</a>
                                    <a href="{{ route('admin.staff.roles.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Roles</a>
                                </div>
                            </div>
                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Venues
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[350%]">
                                    <a href="{{ route('admin.venues.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Manage Venues</a>
                                    <a href="{{ route('admin.venues.create') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Create Venue</a>
                                    <a href="{{ route('admin.venue_types.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Venue Types</a>
                                    <a href="{{ route('admin.venue_categories.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Venue Categories</a>
                                    <a href="{{ route('admin.venue_categories_group.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Venue Group Categories</a>
                                </div>
                            </div>
                            
                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Settings
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[280%]">
                                    <a href="{{ route('admin.academic_sessions.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Academic Sessions</a>
                                    <a href="{{ route('admin.semesters.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200 hover:border-l-yellow-500 hover:border-l-4 pr-8">Semesters</a>
                                    <a href="{{ route('admin.colleges.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Colleges</a>
                                    <a href="{{ route('admin.departments.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Departments</a>
                                    <a href="{{ route('admin.courses.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Courses</a>
                                    <a href="{{ route('admin.remuneration_rates.index') }}" class="flex flex-row px-4 py-2 hover:bg-gray-200  hover:border-l-yellow-500 hover:border-l-4 pr-8">Remuneration Rates</a>
                                </div>
                            </div>
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
