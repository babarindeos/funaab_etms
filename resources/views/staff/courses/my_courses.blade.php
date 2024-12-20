<x-staff-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">My Courses</h1>
                    </div>
                    
            </div>
        </section>
        <!-- end of page header //-->



        <!-- body //-->
        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-2 md:px-4">


            <div class="py-2">
                    <div class='text-xl font-semibold'>
                        {{ Auth::user()->staff->staff_title->title }} 
                        {{ ucfirst(strtolower(Auth::user()->staff->surname)) }} 
                        {{ Auth::user()->staff->firstname }} ({{ Auth::user()->staff->fileno }})
                        
                    </div>
                    <div>
                        {{ Auth::user()->staff->department->name}} ({{ Auth::user()->staff->department->code}}), {{ Auth::user()->staff->department->college->code }}
                    </div>
            </div>


            <!-- current session //-->
            <div class="py-4">
                <div class="font-semibold">
                    {{ $current_academic_session->name }} Academic Session
                </div>

            </div>
            <!-- end of current session //-->


            <!-- course lecturer //-->
             <div class="flex flex-col md:flex-row w-full md:space-x-4 space-y-4 md:space-y-0">

                    <!-- Course Lecturer Information //-->
                    <div class="border rounded-md w-full md:w-1/2 p-4">
                            <div class="py-3 border-b font-medium text-lg">
                                Courses ({{ Auth::user()->coordinator->count() }})
                            </div>

                            <div>
                                            <table width='100%' class="">
                                                <tbody>
                                                    @foreach(Auth::user()->coordinator as $coordinator)
                                                            @php
                                                                $counter = 0;
                                                            @endphp
                                                            <tr class='border-b'>
                                                                <td width='10%' class='text-center py-8'> {{ ++$counter }}. </td>
                                                                <td class='py-4'>
                                                                        <a class='hover:underline' href="{{ route('staff.hod.department.course.show', ['course'=>$coordinator->course->id]) }}">
                                                                             {{ $coordinator->course->title }} ( {{ $coordinator->course->code }} ) 

                                                                        </a>
                                                                        @if ($coordinator->course->enrolment != null)
                                                                            - {{ $coordinator->course->enrolment-enrolment }}
                                                                        @endif
                                                                        
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
                            

                    </div>
                    <!-- end of enrolment //-->


            </div>



            <!-- end of course lecturer and enrolment //-->



        </section>
        <!-- end of bodu //-->



       
        
        
    </div>
</x-staff-layout>

