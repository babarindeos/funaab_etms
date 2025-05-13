<x-admin-layout>
    <div class="flex flex-col w-[90%] md:w-[85%] mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] mt-8 px-0 border-0 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Monitoring: Invigilators</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.monitoring.timtecs.select_exam_timtec') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Invigilators</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new exam type form //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-8 px-0 border-red-900 mx-auto">
            <!-- exam name  //-->
            <div class='text-xl'>
                    {{ $exam->name }}
            </div>
            <!-- end of exam name //-->

            <!-- exam name  //-->
            <div class='text-xl py-6 font-semibold'>
                    {{ $invigilator->staff->staff_title->title }} 
                    {{ ucfirst(strtolower($invigilator->surname)) }}
                    {{ ucfirst(strtolower($invigilator->firstname)) }}
            </div>
            <!-- end of exam name //-->


            <!-- Invigilator allocations //-->
            <div class="border-0">
                            <!-- Schedule //-->
                    
                            @php
                                $counter = 0;
                            @endphp

                            @foreach($invigilations as $invigilation)
                            <table class="mb-8 border shadow-md w-full">
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
                                                                                @if ($invigilation->exam_schedule->course->department != null)
                                                                                        {{ $invigilation->exam_schedule->course->department->code  }}, 
                                                                                        {{ $invigilation->exam_schedule->course->department->college->code  }}
                                                                                @endif
                                                                    </div>

                                                            </td>
                                                    </tr>
                                                    
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

            </div>



            <!-- end of timtec allocations //-->

        </section>
        <!-- end of new venue type form //-->


    </div><!-- end of container //-->
</x-admin-layout>