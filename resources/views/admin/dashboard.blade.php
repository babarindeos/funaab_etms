<x-admin-layout>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="flex flex-col border-0 w-[95%] mx-auto">

        <!-- Page Header //-->
        <section class="border-b border-gray-200 py-2 mt-2">
            <div class="text-2xl font-semibold ">
                Dashboard         
            </div>            
        </section>
        <!-- end of Page Header //-->


        <!-- board //-->
        <section class="flex flex-row border border-0 py-1 mt-3">
                <div class="flex flex-col md:flex-row mx-auto md:space-x-2 w-4/5 justify-center items-center border-0 border-black">
                    
                    <a href="{{ route('admin.exams.index') }}" class="flex flex-col border border-1 border-yellow-500 
                                w-full md:w-1/6 px-4 py-4 mt-1 rounded-md bg-yellow-500 hover:bg-yellow-400">
                        <div class="text-white text-3xl">
                            {{ number_format($exams_count)}}
                        </div>
                        <div class="text-sm text-white font-normal">
                            Exams
                        </div>
                    </a>

                    <a href="{{ route('admin.courses.index') }}" class="flex flex-col border border-1 border-pink-500 
                                w-full md:w-1/6 px-4 py-4 mt-1 rounded-md bg-pink-500 hover:bg-pink-400">
                        <div class="text-white text-3xl">
                            {{ number_format($courses_count)}}
                        </div>
                        <div class="text-sm text-white font-normal">
                            Courses
                        </div>
                    </a>


                    <a href="{{ route('admin.colleges.index') }}" class="flex flex-col border border-1 border-blue-500 
                                w-full md:w-1/6 px-4 py-4 mt-1 rounded-md bg-blue-500 hover:bg-blue-400">
                        <div class="text-white text-3xl">
                             {{ number_format($colleges_count) }}
                        </div>
                        <div class="text-sm text-white">
                            Colleges
                        </div>
                    </a>


                    <a href="{{ route('admin.departments.index') }}" class="flex flex-col border border-1 border-green-500 
                                w-full md:w-1/6 px-4 py-4 mt-1 rounded-md bg-green-500 hover:bg-green-400">
                        <div class="text-white text-3xl">
                             {{ number_format($departments_count) }}
                        </div>
                        <div class="text-sm text-white">
                            Departments
                        </div>
                    </a>

                    <a href="{{ route('admin.staff.index') }}" class="flex flex-col border border-1 border-purple-500 
                                w-full md:w-1/6 px-4 py-4 mt-1 rounded-md bg-purple-500 hover:bg-purple-400">
                        <div class="text-white text-3xl">
                            {{ $staff_count}}
                        </div>
                        <div class="text-sm text-white">
                            Staff
                        </div>
                    </a>

                    
                </div>
        </section>
        <!-- end of board //-->





            
    </div>
</x-admin-layout>

