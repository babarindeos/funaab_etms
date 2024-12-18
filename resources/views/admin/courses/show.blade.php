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
                        {{ $course->department->name}} ({{ $course->department->code}}), {{ $course->department->college->code }}
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
                    <div class="border rounded-md w-full md:w-1/2 p-4">
                            <div class="py-3 border-b">
                                Course Lecturer ({{ $course->coordinators->count() }})
                            </div>

                            <div>
                                        <table width='100%' class="">
                                                <tbody>
                                                    @foreach($course->coordinators as $coordinator)
                                                            @php
                                                                $counter = 0;
                                                            @endphp
                                                            <tr class='border-b'>
                                                                <td width='10%' class='text-center py-4'> {{ ++$counter }}. </td>
                                                                <td>
                                                                    <a class='hover:underline' href="{{ route('admin.profile.user_profile',['fileno'=>$coordinator->coordinator->staff->fileno]) }}">
                                                                        {{ $coordinator->coordinator->staff->staff_title->title }} 
                                                                        {{ ucfirst(strtolower($coordinator->coordinator->surname)) }}
                                                                        {{ ucfirst(strtolower($coordinator->coordinator->firstname)) }} 
                                                                        {{ ucfirst(strtolower($coordinator->coordinator->fileno)) }}
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                    @endforeach                               
                                                </tbody>
                                        </table>



                            </div>

                    </div>
                    <!-- end of Course Lecturer Information //-->


                    <!-- Enrollment //-->
                    <div class="border rounded-md w-full md:w-1/2 p-4">
                            <!-- form //-->
                            <form action="{{ route('admin.courses.enrolments.set_enrolment', ['course'=>$course->id]) }}" method="POST">
                                @csrf
                                    <div class="py-3">
                                                    @include('partials._session_response')

                                                    Current Enrolment
                                                
                                                        @foreach($current_session->semesters as $semester)
                                                            @if ($semester->current)
                                                                <input type='hidden' name='semester_id' value="{{ $semester->id }}" />
                                                                <div class='text-sm'>
                                                                    {{ $semester->academic_session->name }} {{ ucfirst($semester->name) }} Semester
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    

                                                    <!-- Course title //-->
                                                    <div class="flex flex-row border-red-900 w-[80%] md:w-[40%] py-3 space-x-0">
                                                        
                                                            
                                                        <input type="number" name="enrolment" class="border border-1 border-gray-400 bg-gray-50
                                                                                                w-full p-4 rounded-l-md 
                                                                                                focus:outline-none
                                                                                                focus:border-blue-500 
                                                                                                focus:ring
                                                                                                focus:ring-blue-100" placeholder="Course Enrolment"
                                                                                                
                                                                                                @if ($course_enrolment != null)
                                                                                                    value="{{ $course_enrolment->enrolment }}"
                                                                                                @endif
                                                                                                
                                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                required
                                                                                                />  
                                                                                                                                                                    

                                                                                                @error('enrolment')
                                                                                                    <span class="text-red-700 text-sm">
                                                                                                        {{$message}}
                                                                                                    </span>
                                                                                                @enderror
                                                                                    <button class="border px-4 bg-gray-400 hover:bg-gray-500 text-white rounded-r">
                                                                                            Submit
                                                                                    </button>
                                                        
                                                    </div><!-- end of course title //-->

                                            
                                    </div>
                            </form><!-- end of form //-->


                            <div class="py-4">
                                Enrolments By Academic Sessions and Semesters
                            </div>

                            <div>
                                <table width='100%' class='border '>
                                    <thead >
                                        <tr class='bg-gray-100'>
                                            <th width='12%' class='py-3 text-center'>SN</th>
                                            <th width='40%' class='text-start'>Session</th>
                                            <th class='text-start'>Semester</th>
                                            <th class='text-center'>Enrolment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach($semesters_enrolments as $enrolment)
                                            <tr class='border-b'>
                                                <td class='text-center py-3'>{{ ++$counter }}.</td>
                                                <td>{{ $enrolment->semester->academic_session->name }}</td>
                                                <td>{{ ucfirst(strtolower($enrolment->semester->name)) }} Semester</td>
                                                <td class='text-center'>{{ $enrolment->enrolment }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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