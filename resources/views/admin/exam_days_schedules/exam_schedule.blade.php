<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Exam Day Schedule</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.exams.exam_days.select_exam_days') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500">Exam Days</a>

                            
                    </div>
                    
            </div>
        </section>
        <!-- end of page header //-->


        <!-- //-->
         <section class="flex flex-col py-2 px-2 justify-end w-[100%] border-0 md:px-2" >
            <div class="w-full px-3 md:px-2 md:w-[95%] border-0 mx-auto" >
                    <div class='text-xl'>{{ $exam_day->exam->name }}</div>
                    <div class='text-lg font-medium'>{{ $exam_day->name }} - {{ \Carbon\Carbon::parse($exam_day->date)->format('l jS F, Y') }}</div>

            </div>
        </section>

        <!-- end of exam day title //-->



        @if (count($exam_schedules) > 0)

                    <section class="flex flex-col py-2 px-2 justify-end w-[100%] border-0 md:px-4">
                        <div class='w-full px-3 md:px-2 md:w-[95%] border-0 mx-auto'>
                                    <div class="flex justify-end border-0">
                                    
                                            <input type="text" name="search" class="w-full md:w-2/5 border border-gray-400 bg-gray-50
                                                        p-2 rounded-l-md 
                                                        focus:outline-none
                                                        focus:border-blue-500 
                                                        focus:ring
                                                        focus:ring-blue-100" placeholder="Search"                
                                                    
                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                                            
                                            /> 
                                            <button class="bg-green-600 text-white px-5 border-r rounded-r-md "><i class="fa-solid fa-magnifying-glass"></i><button> 
                                    </div>
                        </div>
                        
                    </section>
                    
                <div class="flex flex-col overflow-x-auto">
                   
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-2 md:px-4">

                       
                                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                                >
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th width='8%' class="text-center font-semibold py-4">SN</th>
                                                <th width='35%' class="font-semibold py-2 text-left">Course</th> 
                                                <th width='10%' class="font-semibold py-2 text-left">Exam Type</th>
                                                <th width='30%' class="font-semibold py-2 text-left">Venue</th>
                                                <th width='20%' class="font-semibold py-2 text-left">Time Period</th> 
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = 0;
                                            @endphp

                                                @foreach ($exam_schedules as $exam_schedule)
                                                <tr >
                                                    <td class='text-center py-8'>{{ ++$counter }}.</td>
                                                    <td>
                                                         <a href="#" class='hover:underline'>
                                                                {{ $exam_schedule->course->title }} ({{ $exam_schedule->course->code }})                                                                
                                                         </a>
                                                         @if ($exam_schedule->course->enrolment != null)
                                                            - <span class="text-sm hover:overline" title='Student enrolment for course' style="cursor:pointer"> [{{ $exam_schedule->course->enrolment->enrolment }}]</span>
                                                         @endif
                                                         <div class="text-xs">
                                                            {{ $exam_schedule->course->department->name}} ({{ $exam_schedule->course->code }}), 
                                                            {{ $exam_schedule->course->department->college->code }}
                                                        </div>
                                                    </td>
                                                    <td>        
                                                         {{ $exam_schedule->exam_type->name }}                                            
                                                    </td>
                                                    <td>        
                                                         {{ $exam_schedule->venue->name}} ({{ $exam_schedule->venue->venue_category->name}}) 
                                                         <div class='text-sm'>
                                                                    {{ $exam_schedule->venue->venue_type->name }}: {{$exam_schedule->venue->student_capacity}} student caps 
                                                        </div>
                                                    </td>
                                                    <td>
                                                         {{ $exam_schedule->time_period->name }}
                                                         <div class="text-sm">
                                                            {{ \Carbon\Carbon::parse($exam_schedule->time_period->start_time)->format('g:i a') }} - 
                                                            {{ \Carbon\Carbon::parse($exam_schedule->time_period->end_time)->format('g:i a') }}
                                                        </div>
                                                    </td>                                          

                                                </tr>
                                                <tr class="border border-b border-gray-200 text-sm">
                                                            <td></td>
                                                            <td class='py-2' colspan='4'>
                                                                <!-- Invigilators //-->
                                                                @if ($invigilators->count())
                                                                <div class='flex flex-row space-x-4'>
                                                                    <span class='font-semibold'>Invigilators: </span>
                                                                    <span class='space-x-4'>
                                                                        @foreach($invigilators as $invigilator)
                                                                            @if (($invigilator->venue_id == $exam_schedule->venue->id) && ($invigilator->time_period_id == $exam_schedule->time_period_id))
                                                                                <a href="{{ route('admin.profile.user_profile',['fileno' => $invigilator->invigilator->staff->fileno ]) }}" class='hover:underline'>
                                                                                    @php
                                                                                        $surname = $invigilator->invigilator->staff->surname;
                                                                                        $surname = ucwords(strtolower($surname))
                                                                                        
                                                                                    @endphp
                                                                                    {{ $invigilator->invigilator->staff->staff_title->title }} 
                                                                                    {{$surname}} 
                                                                                    {{$invigilator->invigilator->staff->firstname}} 

                                                                                    - <span class='text-xs'>[ {{$invigilator->invigilator->staff->gender}}  ]</span>
                                                                                </a>
                                                                                
                                                                            @endif
                                                                        @endforeach 
                                                                    </span>                                                             
                                                                </div>
                                                                @endif
                                                                <!-- end of Invigilators //-->


                                                                <!-- Chief  -->
                                                                <!-- @if ($chiefs->count())
                                                                <div class='flex flex-row space-x-4 py-1'>
                                                                    <span class='font-semibold'>Chief: </span>
                                                                    <span class='space-x-4'>
                                                                        @foreach($chiefs as $chief)
                                                                            @php
                                                                                $chief_time_period_id = $chief->time_period_id;
                                                                                $chief_title = $chief->chief->staff->staff_title->title;
                                                                                $chief_surname = ucwords(strtolower($chief->chief->staff->surname));
                                                                                $chief_firstname = $chief->chief->staff->firstname;
                                                                                $chief_names = $chief_title.' '.$chief_surname.' '.$chief_firstname;

                                                                            @endphp             
                                                                            
                                                                            

                                                                            @foreach($chief->venue_category_group->venue_categories as $venue_categories)
                                                                                @if (($venue_categories->id == $exam_schedule->venue->venue_category->id) && ($chief_time_period_id == $exam_schedule->time_period_id))
                                                                                    <span>
                                                                                        <a class='hover:underline' href='#'>
                                                                                            {{ $chief_names }}
                                                                                        </a>
                                                                                    </span>
                                                                                @endif
                                                                                
                                                                            @endforeach
                                                                        @endforeach
                                                                    </span>           
                                                                </div> -->
                                                                <!-- @endif -->
                                                                <!-- end of Chief -->


                                                                <!-- TIMTEC Member //-->
                                                                @if($timtec_members->count())
                                                                <div class='flex flex-row space-x-4 py-0'>
                                                                    <span class='font-semibold'>Timtec Observers: </span>
                                                                    <span class='space-x-4'>
                                                                            @foreach($timtec_members as $timtec_member)
                                                                                @php
                                                                                    $timtec_member_time_period_id = $timtec_member->time_period_id;
                                                                                    $timtec_member_title = $timtec_member->timtec_member->staff->staff_title->title;
                                                                                    $timtec_member_surname = ucwords(strtolower($timtec_member->timtec_member->staff->surname));
                                                                                    $timtec_member_firstname = $timtec_member->timtec_member->staff->firstname;
                                                                                    $timtec_member_names = $timtec_member_title.' '.$timtec_member_surname.' '.$timtec_member_firstname;

                                                                                @endphp    

                                                                                @foreach($timtec_member->venue_category_group->venue_categories as $venue_categories)
                                                                                    @if (($venue_categories->id == $exam_schedule->venue->venue_category->id) && ($timtec_member_time_period_id == $exam_schedule->time_period_id))
                                                                                        <span>
                                                                                            <a class='hover:underline' href='#'>
                                                                                                {{ $timtec_member_names }}
                                                                                            </a>
                                                                                        </span>
                                                                                    @endif                                                                                
                                                                                @endforeach
                                                                            @endforeach
                                                                    </span>
                                                                </div>
                                                                @endif
                                                                <!-- end of TIMTEC Member //-->


                                                            </td>
                                                </tr>
                                                @endforeach
                                            
                                            
                                        </tbody>

                                    </table>
                       

                        


                    </section>
            </div>
        @else
                    <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                            <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                                There is currently no Exam Scheduled for this Day
                            </div>
                    </section>
        @endif
        
        
        
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

