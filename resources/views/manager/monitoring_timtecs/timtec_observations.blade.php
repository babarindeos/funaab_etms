<x-manager-layout>
    <div class="flex flex-col w-[90%] md:w-[85%] mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] mt-8 px-0 border-0 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Monitoring: Timtec Supervision</h1>
                    </div>  
                    <div>
                            <a href="{{ route('manager.monitoring.timtecs.select_exam_timtec') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Observers</a>
                           
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
                    {{ $timtec_member->staff->staff_title->title }} 
                    {{ ucfirst(strtolower($timtec_member->surname)) }}
                    {{ ucfirst(strtolower($timtec_member->firstname)) }}
            </div>
            <!-- end of exam name //-->


            <!-- timtec allocations //-->
            <div class="border-0">
                            <!-- Schedule //-->
                    
                            @php
                                $counter = 0;
                            @endphp

                            @foreach($timtec_allocations as $invigilation)
                                <table class="mb-8 border-0 border-red-900 w-[100%] shadow-md">
                                    <tbody>
                                        <tr class='border'>
                                            <td width='15%' class='text-center py-8 text-3xl w-[10%] md:w-[15%]'>{{ ++$counter }}.</td>
                                            <td class='py-8'>
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
                                                        <tr class=''>
                                                                <td width="60%" class='py-4'>
                                                                        <div class='border-0 flex flex-col md:flex-row'>
                                                                                <div class='text-lg pr-2 border-0 flex-2'>
                                                                                    {{ $invigilation->venue_category_group->name}} 
                                                                                </div>
                                                                                <div class='flex flex-col md:flex-row text-sm border-0 md:items-center'>
                                                                                    
                                                                                </div>
                                                                        </div>
                                                                </td>
                                                                <td width="40%" class="border-0 flex flex-col w-full py-4">
                                                                        <div class='flex flex-col md:flex-row md:items-center md:space-x-1 md:justify-center border-0'>
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

            </div>



            <!-- end of timtec allocations //-->

        </section>
        <!-- end of new venue type form //-->


    </div><!-- end of container //-->
</x-manager-layout>