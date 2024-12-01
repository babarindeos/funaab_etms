<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Courses</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.courses.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Courses</a>

                    </div>
            </div>
        </section>
        <!-- end of page header //-->



        <!-- body //-->
        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-2 md:px-4">


            <div class="py-2">
                    <div class='text-xl font-semibold'>
                        {{ $course->title }} ({{ $course->code }})
                        
                    </div>
                    <div>
                        {{ $course->department->name}} ({{ $course->department->code}})
                    </div>
            </div>


            <!-- current session //-->
            <div class="py-4">
                <div class="font-semibold">
                    {{ $current_session->name }} Academic Session
                </div>

            </div>
            <!-- end of current session //-->


            <!-- course lecturer //-->
             <div class="flex flex-col md:flex-row w-full md:space-x-4 space-y-4 md:space-y-0">

                    <!-- Course Lecturer Information //-->
                    <div class="border rounded-md w-full md:w-3/5 p-4">
                            <div class="py-3 border-b">
                                Course Lecturer
                            </div>

                            <div>




                            </div>

                    </div>
                    <!-- end of Course Lecturer Information //-->


                    <!-- Enrollment //-->
                    <div class="border rounded-md w-full md:w-2/5 p-4">
                            <div class="py-3">

                                        Current Enrolment - 
                                    
                            </div>


                            <div class="py-4">
                                        Other Academic Sessions
                                    </div>
                            </div>

                    </div>
                    <!-- end of enrolment //-->


            </div>



            <!-- end of course lecturer and enrolment //-->



        </section>
        <!-- end of bodu //-->



       
        
        
    </div>
</x-admin-layout>

<script>
    $(document).ready(function(){
         $("input[name='search']").on('keyup', function(){
                var value = $(this).val().toLowerCase();
                
                $("table tbody tr").filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1 );
                });
         });
    });

</script>