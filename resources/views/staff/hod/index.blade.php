<x-staff-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Department</h1>
                    </div>
                    
            </div>
        </section>
        <!-- end of page header //-->



        <!-- body //-->
        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-2 md:px-4">


            <div class="py-2">
                    <div class='text-xl font-semibold'>
                        {{ $department->name }} ({{ $department->code }})
                        
                    </div>
                    
            </div>


           


            <!-- Departments //-->
             <div class="flex flex-col md:flex-row w-full md:space-x-4 space-y-4 md:space-y-0">

                    <!-- Department Information //-->
                    <div class="border rounded-md w-full md:w-1/2 p-4">
                            <div class="py-3 border-b font-medium text-lg">
                                Staff ({{ $department->staff->count() }})
                            </div>

                            <div class="py-4"> <!-- list of departments //-->
                                <table width='100%' class="">
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach($department->staff as $person)
                                                
                                                <tr class='border-b'>
                                                    <td width='10%' class='text-center py-4'> {{ ++$counter }}. </td>
                                                    <td>
                                                        <div class="flex flex-row ">
                                                                <div class="flex flex-col justify-center items-center 
                                                                            border-0 px-8 py-4 rounded-md">
                                                                        <div class="">
                                                                            @if ($person->profile!=null && ($person->profile->avatar != "" || $person->profile->avatar != null))
                                                                                <img src="{{ asset('storage/'.$person->profile->avatar) }}" class="w-16 h-16 rounded-full" />
                                                                            @else
                                                                                <img src="{{ asset('images/avatar_150.jpg') }}" class="w-16 h-16" />
                                                                            @endif
                                                                        </div>                                                                      

                                                                </div>
                                                                <div class="flex border-0 items-center">
                                                                        <a class='hover:underline' href="{{ route('staff.profile.email_user_profile', ['email' => $person->user->email]) }}">
                                                                            {{ $person->staff_title->title }} {{ ucfirst(strtolower($person->surname )) }} {{ $person->firstname }} 
                                                                            <div>
                                                                                ({{ $person->fileno }})
                                                                            </div>
                                                                        </a>
                                                                </div>
                                                        </div>
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
                            <div class="py-3 border-b font-medium text-lg">
                                Courses ({{ $department->courses->count() }})
                            </div>

                            <div class="py-4"> <!-- list of departments //-->

                                        <table width='100%' class="">
                                                <tbody>
                                                    @foreach($department->courses as $course)
                                                            @php
                                                                $counter = 0;
                                                            @endphp
                                                            <tr class='border-b'>
                                                                <td width='10%' class='text-center py-4'> {{ ++$counter }}. </td>
                                                                <td>
                                                                    <a class='hover:underline' href="{{ route('staff.hod.department.course.show', ['course' => $course->id]) }}">
                                                                        {{ $course->title }} ({{ $course->code }})
                                                                    </a>
                                                                </td>
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
</x-staff-layout>

