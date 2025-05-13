<x-staff-layout>

<div class="flex flex-col border-0 w-[95%] mx-auto">
        <section class="border-b border-gray-200 py-4 mt-2">
                <div class="text-2xl font-semibold ">
                    My Invigilation Schedule              
                </div>
                
        </section>
    
        
        
    @if ($exam->semester->current)
                <!-- Current Session Semester Information //-->
                <section class="flex flex-col py-1 mt-4" >
                    <div class="flex flex-col border border-0">
                            <div class='text-xl'>
                                {{ $exam->semester->academic_session->name }} Academic Session 
                            </div>
                            <div class='text-xl'>
                                {{ ucfirst(strtolower($exam->semester->name)) }} Semester
                            </div>
                    </div>
                </section>
                <!-- end of current session semesters information //-->


                <!-- User Personal Details //-->
                <section class="flex flex-col md:flex-row py-1 mt-4 justify-between" >
                    <div class="flex flex-col md:w-1/2 border border-0">
                            <div class='text-md font-semibold'>
                                {{ Auth::user()->staff->staff_title->title }} 
                                {{ ucfirst(strtolower(Auth::user()->staff->surname)) }} {{ Auth::user()->staff->firstname }} 
                                ({{ Auth::user()->staff->fileno }})
                            </div>
                            <div class='text-md'>
                                My Schedules ( {{ $my_invigilations->count() }} )
                            </div>
                    </div>
                    <div class='border-0 md:w-1/2'>
                                    <div class="flex justify-end border-0">
                                        
                                        <input type="text" name="search" class="w-full md:w-2/5 border border-1 border-gray-400 bg-gray-50
                                                    p-2 rounded-md 
                                                    focus:outline-none
                                                    focus:border-blue-500 
                                                    focus:ring
                                                    focus:ring-blue-100" placeholder="Search"                
                                                
                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                                        
                                        />  
                                    </div>

                    </div>
                </section>
                <!-- end of Personal Details //-->






                <!-- Schedule //-->
                 
                        @php
                            $counter = 0;
                        @endphp

                        @foreach($my_invigilations as $invigilation)
                            <table class="mb-8 border shadow-md">
                                <tbody>
                                    <tr class='border-0'>
                                        <td width='15%' class='text-center py-8 text-3xl w-[10%] md:w-[15%]'>{{ ++$counter }}.</td>
                                        <td>
                                            <div class='flex flex-col'>
                                                <div class='text-2xl'>
                                                    {{ $invigilation->exam_day->name }}
                                                </div>
                                                <div class='text-xl font-semibold'>
                                                    {{ \Carbon\Carbon::parse($invigilation->exam_day->date)->format('l jS F, Y') }}
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <!-- second row //-->
                                    <tr class='border border-b'>
                                        <td></td>
                                        <td class="border-0">
                                            <!-- inner table //-->
                                            <table width="100%" class="border-0">
                                                <tbody>
                                                    <tr class='border-b'>
                                                            <td width="60%" class='py-2'>
                                                                    <div class='border-0 flex flex-col md:flex-row'>
                                                                            <div class='text-lg pr-2 border-0 flex-2'>
                                                                                {{ $invigilation->venue->name}} 
                                                                            </div>
                                                                            <div class='flex flex-col md:flex-row text-sm border-0 md:items-center'>
                                                                                <div class="">
                                                                                    ({{ $invigilation->venue->venue_type->name}} :  
                                                                                    {{ $invigilation->venue->student_capacity}} students cap)
                                                                                </div>
                                                                                <div class='flex flex-col text-sm px-1'> 
                                                                                    -  {{$invigilation->venue->venue_category->name}}
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                            </td>
                                                            <td width="40%" class="border-0 flex flex-col w-full py-2">
                                                                    <div class='flex flex-col md:flex-row md:items-center md:space-x-1 md:justify-start border-0'>
                                                                            <div class='text-lg'>
                                                                                {{ $invigilation->time_period->name }} 
                                                                            </div>
                                                                            <div>
                                                                                ({{ \Carbon\Carbon::parse( $invigilation->time_period->start_time)->format('g:i a') }} - 
                                                                                {{ \Carbon\Carbon::parse( $invigilation->time_period->end_time)->format('g:i a') }})
                                                                            </div>
                                                                    </div>                                                                    
                                                            </td>

                                                    </tr>
                                                    <tr>
                                                            <td class='py-2 pb-8'colspan="2">
                                                                    {{ $invigilation->exam_schedule->course->title }} 
                                                                    ({{ $invigilation->exam_schedule->course->code }})
                                                                    <div class='text-xs'>
                                                                                    @if ( $invigilation->exam_schedule->course->department != '')
                                                                                        {{ $invigilation->exam_schedule->course->department->code  }}, 
                                                                                    
                                                                                        {{ $invigilation->exam_schedule->course->department->college->code  }}
                                                                                    @endif
                                                                    </div>

                                                            </td>
                                                    </tr>
                                                    <!-- buttons //-->
                                                     <tr>
                                                         <td class='py-2 pb-8'colspan="2">
                                                                    <div class='space-x-4 text-center'>

                                                                         <a href="{{ route('staff.exams.live_chat', ['exam'=>$exam->id]) }}" class='border rounded-md 
                                                                                        px-4 py-1 text-sm border-green-400 
                                                                                        hover:bg-green-400 hover:text-white'>Live Chat</a>
                                                                         <a href="{{ route('staff.exams.exam_schedules.report.create',['exam'=>$exam->id,'exam_schedule'=>$invigilation->exam_schedule->id ]) }}" class='border rounded-md 
                                                                                        px-4 py-1 text-sm border-green-400 
                                                                                        hover:bg-green-400 hover:text-white'>Report</a>
                                                                         <a href="{{ route('staff.exams.exam_schedules.malpractice.create', ['exam'=>$exam->id, 'exam_schedule'=>$invigilation->exam_schedule->id]) }}" class='border rounded-md 
                                                                                        px-4 py-1 text-sm border-green-400 
                                                                                        hover:bg-green-400 hover:text-white'>Misconduct Incidence</a>
                                                                    </div>

                                                                    
                                                         </td>   

                                                    </tr>

                                                    <!-- end of buttons //-->
                                                </tbody>
                                            </table>
                                            <!-- end of inner table //-->
                                        </td>
                                    </tr>
                                    <!-- end of second row //-->

                                </tbody>
                            </table>
                        @endforeach
                   
                <!-- end of Schedule //-->

           

            
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
                    <div class="flex flex-row border-0 justify-center 
                                text-2xl font-semibold text-gray-300 py-8">
                            No Academic Semester is currently set
                    </div>
                </section>
        @endif

    

       

        

        
</div>
    
</x-staff-layout>

<script>
    $(document).ready(function() {
        $("input[name='search']").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            
            $("table tbody tr").filter(function() {
                // Get the text content excluding the title link
                // Get the text content excluding the title link
                var rowText = $(this).find("td").not(":first").text().toLowerCase();
                $(this).toggle(rowText.indexOf(value) > -1 || $(this).find("td").length === 1); // Keep the heading row visible
            });
        });
    });
</script>

