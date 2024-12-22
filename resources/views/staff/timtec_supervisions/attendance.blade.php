<x-staff-layout>

<div class="flex flex-col border-0 w-[95%] mx-auto">
        <section class="border-b border-gray-200 py-4 mt-2">
                <div class="text-2xl font-semibold ">
                    Invigilators Attendance              
                </div>
                
        </section>
    
        
        
    @if ($supervision)
                <!-- Current Session Semester Information //-->
                <section class="flex flex-col py-1 mt-4" >
                    <div class="flex flex-col border border-0">
                            <div class='text-xl'>
                                {{ $supervision->semester->academic_session->name }} Academic Session 
                            </div>
                            <div class='text-xl'>
                                {{ ucfirst(strtolower($supervision->semester->name)) }} Semester
                            </div>
                    </div>
                </section>
                <!-- end of current session semesters information //-->


                
                <section class="py-2 mt-2 border ">
                        <div>
                            <div  class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center"><!-- former form //-->
                                
                                
                                <div class="flex flex-col w-[95%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                                        
                                        <div class='text-xl font-semibold'>
                                                {{ $supervision->exam_day->name }} - {{ \Carbon\Carbon::parse($supervision->exam_day->date)->format('l jS F, Y') }}
                                        </div>
                                
            
                                        <!-- Venue Category Group //-->
                                       @foreach ($supervision->venue_category_group->venue_categories as $venue_category)
                                            <div class="flex flex-col py-4">
                                                    <div>
                                                            <div class='bg-gray-100 py-6 px-4 font-semibold'>
                                                                    {{ $venue_category->name }}
                                                            </div>
                                                            <div class='border px-4 py-4'>
                                                                    @foreach($venue_category->venues as $venue)
                                                                        <div class='border '>
                                                                                <div class='py-4 px-2 md:px-8 '>
                                                                                        <span class="font-semibold">{{ $venue->name }} </span>
                                                                                        <span class='text-sm'> 
                                                                                                - {{ $venue->venue_type->name }} [Max. Invigilators: {{ $venue->max_invigilators }}]

                                                                                        </span>
                                                                                </div>
                                                                                <div class='px-2 py-4 md:px-8'>   
                                                                                        <!-- sort out my schedule from the day's schedule based on venues in the 
                                                                                        category, in the venue group category //-->
                                                                                        @foreach($schedules as $schedule)

                                                                                            @if ($schedule->venue_id == $venue->id)

                                                                                                <!-- get the invigilators in the schedule filter by time period that matches 
                                                                                                supervisor's time //-->

                                                                                                @foreach($schedule->invigilators as $invigilator)
                                                                                                    @if ($invigilator->time_period_id == $supervision->time_period_id)
                                                                                                        <!-- Display Invigilator //-->
                                                                                                         <div class='flex flex-row border w-full'>
                                                                                                                <div class="px-4 py-4 w-[30%] md:w-[20%]">
                                                                                                                                <div class="">
                                                                                                                                    @if ($invigilator->invigilator->staff->profile!=null && ($invigilator->invigilator->staff->profile->avatar != "" || $invigilator->invigilator->staff->profile->avatar != null))
                                                                                                                                        <img src="{{ asset('storage/'.$invigilator->invigilator->staff->profile->avatar) }}" class="w-16 h-16 rounded-full" />
                                                                                                                                    @else
                                                                                                                                        <img src="{{ asset('images/avatar_150.jpg') }}" class="w-16 h-16" />
                                                                                                                                    @endif
                                                                                                                                </div>           
                                                                                                                </div>
                                                                                                                <div class='py-4 px-2 w-full border-blue-900'>
                                                                                                                        <div class='text-base'>
                                                                                                                                <a class='hover:underline' href="{{ route('staff.profile.email_user_profile',['email'=>$invigilator->invigilator->email]) }}">
                                                                                                                                        {{ $invigilator->invigilator->staff->staff_title->title}} 
                                                                                                                                        {{ ucfirst(strtolower($invigilator->invigilator->staff->surname)) }} 
                                                                                                                                        {{ $invigilator->invigilator->staff->firstname }}
                                                                                                                                        ({{ $invigilator->invigilator->staff->fileno }})
                                                                                                                                </a>

                                                                                                                        </div>
                                                                                                                        @php
                                                                                                                            $is_recorded = false;
                                                                                                                            $attendance_name = '';

                                                                                                                            foreach ($attendances as $attendance)
                                                                                                                            {
                                                                                                                                if ($attendance->invigilator_allocation_id == $invigilator->id )
                                                                                                                                {
                                                                                                                                     $is_recorded = true;  
                                                                                                                                     $attendance_name = $attendance->attendance;                                                                                                
                                                                                                                                }
                                                                                                                            }

                                                                                                                        @endphp

                                                                                                                        <div class="border-0 border-red-900 w-full">
                                                                                                                                <form action="{{ route('staff.exams.timtec_supervisions.attendance.store',['supervision'=>$supervision->id]) }}" method="POST" class="flex flex-row w-full border-0 border-blue-900">
                                                                                                                                    @csrf
                                                                                                                                                <!--  Attendance //-->
                                                                                                                                                <input type="hidden" name="invigilation_id" value="{{ $invigilator->id }}" /> 
                                                                                                                                                <div class="flex flex-row space-x-2 w-full md:w-[60%]">    
                                                                                                                                                                <div class="flex flex-col border-0 border-red-900 w-[80%] md:w-[100%] py-2">
                                                                                                                                                                    
                                                                                                                                                                         @if ($is_recorded) 
                                                                                                                                                                                    <div name="attendance" @if ($is_recorded) disabled @endif class="border border-1 border-gray-400 bg-gray-50
                                                                                                                                                                                                            w-full p-3 rounded-l-md 
                                                                                                                                                                                                            focus:outline-none
                                                                                                                                                                                                            focus:border-blue-500 
                                                                                                                                                                                                            focus:ring
                                                                                                                                                                                                            focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                                                                                                                            
                                                                                                                                                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                                                                                                                            
                                                                                                                                                                                                            >
                                                                                                                                                                                                            {{ $attendance_name }}
                                                                                                                                                                                    </div>






                                                                                                                                                                         @else
                                                                                                                                                                                    <select name="attendance" @if ($is_recorded) disabled @endif class="border border-1 border-gray-400 bg-gray-50
                                                                                                                                                                                                            w-full p-3 rounded-l-md 
                                                                                                                                                                                                            focus:outline-none
                                                                                                                                                                                                            focus:border-blue-500 
                                                                                                                                                                                                            focus:ring
                                                                                                                                                                                                            focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                                                                                                                            
                                                                                                                                                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                                                                                                                            required
                                                                                                                                                                                                            >
                                                                                                                                                                                                            <option value=''>-- Select Attendance --</option>
                                                                                                                                                                                                                         @foreach($attendance_options as $option)  
                                                                                                                                                                                                                                <option value="{{ $option->id }}" >{{ $option->name }}</option>
                                                                                                                                                                                                                         @endforeach
                                                                                                                                                                                                            </select>
                                                                                                                                        
                                                                                                                                                                                                            @error('attendance')
                                                                                                                                                                                                                <span class="text-red-700 text-sm">
                                                                                                                                                                                                                    {{$message}}
                                                                                                                                                                                                                </span>
                                                                                                                                                                                                            @enderror
                                                                                                                                                                        @endif
                                                                                                                                                                    
                                                                                                                                                                </div>
                                                                                                                                                                @if(!$is_recorded)
                                                                                                                                                                    <div class="flex flex-col itemx-center justify-center">
                                                                                                                                                                        <button class='border py-3 px-4 bg-green-600 text-white rounded-r-md'>Submit</button>
                                                                                                                                                                    </div>
                                                                                                                                                                @endif

                                                                                                                                                </div>
                                                                                                                                                
                                                                                                                                                <!-- end of Attendance  //-->
    
                                                                                                                                </form>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                         </div>

                                                                                                    @endif                                                                                                    

                                                                                                @endforeach


                                                                                                    <!-- check for Support Venue in the current day schedule //-->
                                                                                                    @foreach ($schedule->support_venues as $support_venue)
                                                                                                         @if ($support_venue->venue_id == $venue->id)
                                                                                                                {{ $support_venue }}
                                                                                                         @endif
                                                                                                    @endforeach
                                                                                                    <!-- end of check for check for venue in the current day schedule //-->

                                                                                            @endif 
                                                                                        @endforeach
                                                                                </div>
                                                                        </div>
                                                                    @endforeach
                                                            </div>

                                                    </div>
                                            
                                            </div>

                                       @endforeach                                  
                                </div>
                            </div><!-- former form //-->
                        </div>
                </section>
    
    






                
           

            
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
                    <div class="flex flex-row border-0 justify-center 
                                text-2xl font-semibold text-gray-300 py-8">
                            There is no Alloted Supervision
                    </div>
                </section>
        @endif

    

       

        

        
</div>
    
</x-staff-layout>


