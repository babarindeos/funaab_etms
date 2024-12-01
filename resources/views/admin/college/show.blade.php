<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">College</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.colleges.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Colleges</a>

                    </div>
            </div>
        </section>
        <!-- end of page header //-->



        <!-- body //-->
        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-2 md:px-4">


            <div class="py-2">
                    <div class='text-xl font-semibold'>
                        {{ $college->name }} ({{ $college->code }})
                        
                    </div>
                    
            </div>


           


            <!-- Departments //-->
             <div class="flex flex-col md:flex-row w-full md:space-x-4 space-y-4 md:space-y-0">

                    <!-- Department Information //-->
                    <div class="border rounded-md w-full md:w-3/5 p-4">
                            <div class="py-3 border-b">
                                Departments ({{ count($college->departments) }})
                            </div>

                            <div class="py-4"> <!-- list of departments //-->
                                <ol class="list-disc">
                                    @foreach($college->departments as $department)
                                        <option>&raquo; {{ $department->name }} </option>
                                    @endforeach
                                </ol>
                            </div>

                    </div>
                    <!-- end of Course Lecturer Information //-->


                    <!-- Enrollment //-->
                    <div class="border-0 rounded-md w-full md:w-2/5 p-4">
                            

                    </div>
                    <!-- end of enrolment //-->


            </div>



            <!-- end of course lecturer and enrolment //-->



        </section>
        <!-- end of bodu //-->



       
        
        
    </div>
</x-admin-layout>

