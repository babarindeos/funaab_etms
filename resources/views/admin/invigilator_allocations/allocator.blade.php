<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Invigilation Allocator</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.exams.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Exams</a>
                            

                            <a href="{{ route('admin.exams.invigilator_allocation.automatic_allocation',['exam'=>$exam_day->exam_id]) }}" class="border-green-800 border hover:text-white 
                                                                              py-2 px-4 text-green-800 
                                                                              hover:border-green-500
                                                                              rounded-lg text-xs md:text-sm 
                                                                              hover:bg-green-500"> Automatic Allocation</a>
                            
                            <a href="{{ route('admin.exams.index') }}" class="border-green-800 border hover:text-white 
                                                                              py-2 px-4 text-green-800 
                                                                              hover:border-green-500
                                                                              rounded-lg text-xs md:text-sm 
                                                                              hover:bg-green-500"> Clear Allocations</a>
                           
                    </div>  
                         
            </div>
            
        </section>
        <!-- end of page header //-->
        



        <!-- new exam type form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.exams.invigilator_allocation.post_allocator',['exam_day'=>$exam_day->id]) }} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >
                                    {{ $exam_day->name }} - {{ \Carbon\Carbon::parse($exam_day->date)->format('l jS F, Y') }}                         
                            </h2>
                            <div class='text-md'>
                                    
                                    {{ $exam_day->exam->name}}
                                
                            </div>
                            
                        </div>


                        @include('partials._session_response')
                                <input type="hidden" name="query_schedule" value="{{ $query_schedule }}" />

                                <input type="hidden" name="query_level" value="{{ $query_level }}" />

                                        


                                 <!-- Exam Schedules //-->
                                 <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                        
                                    
                                
                                            <select name="scheduled_exam" @if ($query_schedule) disabled @endif class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                required
                                                                                >
                                                                                
                                                                                <option value=''>-- Scheduled Examinations --</option>

                                                                                        @if ($exam_schedule)
                                                                                            <option class='py-4' value="{{$exam_schedule->id}}"  @if($exam_schedule->id == $query_schedule) selected  @endif >
                                                                                                [ {{ $exam_schedule->course->code }} ] -
                                                                                                {{$exam_schedule->venue->name }}
                                                                                                - {{ $exam_schedule->time_period->name }} 
                                                                                                ({{ \Carbon\Carbon::parse($exam_schedule->time_period->start_time)->format('g:i a') }} - 
                                                                                                {{ \Carbon\Carbon::parse($exam_schedule->time_period->end_time)->format('g:i a') }})
                                                                                            </option>
                                                                                        @else
                                                                                             @foreach($exam_day_schedules as $exam_schedule)
                                                                                                    <option class='py-4' value="{{$exam_schedule->id}}"  @if($exam_schedule->id == $query_schedule) selected  @endif >
                                                                                                        [ {{ $exam_schedule->course->code }} ] -
                                                                                                        {{$exam_schedule->venue->name }}
                                                                                                        - {{ $exam_schedule->time_period->name }} 
                                                                                                        ({{ \Carbon\Carbon::parse($exam_schedule->time_period->start_time)->format('g:i a') }} - 
                                                                                                        {{ \Carbon\Carbon::parse($exam_schedule->time_period->end_time)->format('g:i a') }})
                                                                                                    </option>
                                                                                                
                
                                                                                             @endforeach            
                                                                                        @endif
                                                                                    
    
                                                                                           
                                                                                                                         
                                                                                </select>
    
                                                                                @error('scheduled_exam')
                                                                                    <span class="text-red-700 text-sm">
                                                                                        {{$message}}
                                                                                    </span>
                                                                                @enderror
                                        
                                </div>
                                    
                                <!-- end of Exam Schedules //-->  
                                   
                                    
                                <!-- Invigilator //-->
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                        
                                    <input type='hidden' name='invigilator_id' id='invigilator_id' />
                                
                                    <input name="invigilator" id="invigilator" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                            required
                                                                            />
                                                                            
                                                                            <div id='suggestion-box' class='border py-2 px-2 w-[47.7%] bg-green-100 text-black' 
                                                                                 style='position:absolute; top:439px; z-index:1000; display:none; padding-left:2px;'></div>

                                                                            @error('invigilator')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                    
                                </div>
                                
                                <!-- end of Invigilator //-->  
                                 
                                
                                        
                         
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                                    <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                                hover:bg-gray-500
                                                rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Allocate</button>
                                </div>
                        
                        
                    </form><!-- end of new status form //-->


               
                <div>
        </section>
        <!-- end of new venue type form //-->




        <!-- Search //-->
        <section class="flex flex-col mt-8 py-2 px-2 justify-end w-[92%] border-0 md:px-4 mx-auto">
                        <div class='w-full px-3 md:px-0 md:w-full border-0 mx-auto'>
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
        <!-- end of Search //-->

        <!-- scheduled Venue Invigilation  //-->
        @if ($schedule_venue_invigilation != null)
                        <section class="flex flex-col mx-auto w-[90%] items-center justify-center border-0 mb-8">
                            
                            <!-- Added Venue Categories //-->
                            <div class="flex flex-col border-red-900 w-[80%] md:w-[100%] py-2 border-0 mt-0">
                                
                                <div class="flex flex-col w-full py-2 border-b text-lg font-semibold py-1">
                                    <!-- Invigilation Day Exam ({{ $invigilation_day_exams->count() }} of {{ $invigilation_exams_count }}) -->
                                    {{ $exam_schedule->venue->name }}
                                    <div>Invigilations ({{ $schedule_venue_invigilation->count() }})</div>
                                </div>

                                @if (count($schedule_venue_invigilation))
                                    
                                        <table class="table-auto border-collapse border border-1 border-gray-200" >
                                                        <thead>
                                                            <tr class="bg-gray-200">
                                                                <th width='5%' class="text-center font-semibold py-4">SN</th>
                                                                <th width='25%' class="font-semibold py-2 text-left">Invigilator</th> 
                                                                <th width='20%' class="font-semibold py-2 text-left">Venue</th> 
                                                                <th width='20%' class="font-semibold py-2 text-left">Time Period</th>                                      
                                                                <th width='10%' class="font-semibold py-2 text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $counter = 0;
                                                            @endphp

                                                                @foreach ($schedule_venue_invigilation as $invigilation)
                                                                <tr class="border border-b border-gray-200">
                                                                    <td class='text-center py-16'>{{ ++$counter }}.</td>
                                                                    <td>        
                                                                            <a href="{{ route('admin.profile.user_profile',['fileno'=>$invigilation->invigilator->staff->fileno]) }}" class="hover:underline"> 
                                                                                    {{ $invigilation->invigilator->staff->staff_title->title }}                               
                                                                                    {{ ucfirst(strtolower($invigilation->invigilator->staff->surname)) }}  
                                                                                    {{ $invigilation->invigilator->staff->firstname }}
                                                                                    ({{ $invigilation->invigilator->staff->fileno }})                                                      
                                                                            </a>     
                                                                            - <span class='text-xs hover:overline' style="cursor:pointer;" title="Gender" >
                                                                                    [ {{ $invigilation->invigilator->staff->gender }} ]
                                                                            </span>

                                                                            <div class='text-xs'>
                                                                                {{ $invigilation->invigilator->staff->department->code }}, {{ $invigilation->invigilator->staff->department->college->code }}
                                                                            </div>
                                                                                            
                                                                        
                                                                    </td>
                                                                    <td>
                                                                            <a href="{{ route('admin.venues.show',['venue'=>$invigilation->venue_id]) }}" class="hover:underline">                                
                                                                                    {{ $invigilation->venue->name }}  ( {{$invigilation->venue->venue_category->name }} )                                                     
                                                                            </a>  
                                                                            <div class='text-sm'>
                                                                                
                                                                                            {{ $invigilation->venue->venue_type->name }}: {{$invigilation->venue->student_capacity}} student caps. 
                                                                                            <br/>Max. Invigilators: {{ $invigilation->venue->max_invigilators }}
                                                                                    
                                                                            </div>
                                                                    </td>
                                                                    <td>
                                                                            <div>
                                                                                    {{$invigilation->time_period->name}}
                                                                            </div>
                                                                            <div class="text-sm">
                                                                                    {{ \Carbon\Carbon::parse($invigilation->time_period->start_time)->format('g:i a') }} - {{\Carbon\Carbon::parse($invigilation->time_period->end_time)->format('g:i a') }} 

                                                                            </div>
                                                                    </td>
                                                                    
                                                                    
                                                                    <td class="text-center">
                                                                        <div class='flex flex-row space-x-1 justify-center items-center'>
                                                                                

                                                                                <div class="text-sm">
                                                                                    <form action="{{ route('admin.exams.invigilator_allocation.destroy',['allocation'=>$invigilation->id]) }}" method="POST">
                                                                                        @csrf
                                                                                        @method("delete")
                                                                                        <button class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                                            px-4 py-1 text-xs">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                        </div>                                                        
                                                                    </td>

                                                                </tr>
                                                                @endforeach
                                                            
                                                            
                                                        </tbody>

                                        </table>
                                    



                                @endif
                                


                            </div>


                        </section>
        @endif
        <!--end of added category //-->


        <!-- end of scheduled Venue Invigilation //-->




        <!-- scheduled Day Exams //-->
        @if ($schedule_day_invigilation)
                    <section class="flex flex-col mx-auto w-[90%] items-center justify-center border-0 mb-8">
                        
                        <!-- Added Venue Categories //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[100%] py-2 border-0 mt-0">
                            
                            <div class="flex flex-row w-full py-2 border-b text-lg font-semibold py-1">
                                Invigilation Day Exam ({{ $invigilation_day_exams->count() }} of {{ $invigilation_exams_count }})
                            </div>

                            @if (count($invigilation_day_exams))
                                
                                    <table class="table-auto border-collapse border border-1 border-gray-200" >
                                                    <thead>
                                                        <tr class="bg-gray-200">
                                                            <th width='5%' class="text-center font-semibold py-4">SN</th>
                                                            <th width='25%' class="font-semibold py-2 text-left">Invigilator</th> 
                                                            <th width='20%' class="font-semibold py-2 text-left">Venue</th> 
                                                            <th width='20%' class="font-semibold py-2 text-left">Time Period</th>                                      
                                                            <th width='10%' class="font-semibold py-2 text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $counter = 0;
                                                        @endphp

                                                            @foreach ($invigilation_day_exams as $invigilation)
                                                            <tr class="border border-b border-gray-200">
                                                                <td class='text-center'>{{ ++$counter }}.</td>
                                                                <td >        
                                                                        <a href="{{ route('admin.profile.user_profile',['fileno'=>$invigilation->invigilator->staff->fileno]) }}" class="hover:underline"> 
                                                                                {{ $invigilation->invigilator->staff->staff_title->title }}                               
                                                                                {{ ucfirst(strtolower($invigilation->invigilator->staff->surname)) }}  
                                                                                {{ $invigilation->invigilator->staff->firstname }}
                                                                                ({{ $invigilation->invigilator->staff->fileno }})                                                      
                                                                        </a>     
                                                                        - <span class='text-xs hover:overline' style="cursor:pointer;" title="Gender" >
                                                                                [ {{ $invigilation->invigilator->staff->gender }} ]
                                                                        </span>

                                                                        <div class='text-xs'>
                                                                            {{ $invigilation->invigilator->staff->department->code }}, {{ $invigilation->invigilator->staff->department->college->code }}
                                                                        </div>
                                                                                        
                                                                    
                                                                </td>
                                                                <td class='py-8'>
                                                                        <a href="{{ route('admin.venues.show',['venue'=>$invigilation->venue_id]) }}" class="hover:underline">                                
                                                                                {{ $invigilation->venue->name }}  ( {{$invigilation->venue->venue_category->name }} )                                                     
                                                                        </a>  
                                                                        <div class='text-sm py-1'>
                                                                            
                                                                                        {{ $invigilation->venue->venue_type->name }}: {{$invigilation->venue->student_capacity}} student caps. 
                                                                                        <br/>Max. Invigilators: {{ $invigilation->venue->max_invigilators }}
                                                                                
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                        <div>
                                                                                {{$invigilation->time_period->name}}
                                                                        </div>
                                                                        <div class="text-sm">
                                                                                {{ \Carbon\Carbon::parse($invigilation->time_period->start_time)->format('g:i a') }} - {{\Carbon\Carbon::parse($invigilation->time_period->end_time)->format('g:i a') }} 

                                                                        </div>
                                                                </td>
                                                                
                                                                
                                                                <td class="text-center">
                                                                    <div class='flex flex-row space-x-1 justify-center items-center'>
                                                                            

                                                                            <div class="text-sm">
                                                                                <form action="{{ route('admin.exams.invigilator_allocation.destroy',['allocation'=>$invigilation->id]) }}" method="POST">
                                                                                    @csrf
                                                                                    @method("delete")
                                                                                    <button class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                                        px-4 py-1 text-xs">Delete</button>
                                                                                </form>
                                                                            </div>
                                                                    </div>                                                        
                                                                </td>

                                                            </tr>
                                                            @endforeach
                                                        
                                                        
                                                    </tbody>

                                    </table>
                                



                            @endif
                            


                        </div>


                    </section>
        <!--end of added category //-->

        @endif
        <!-- end of scheduled Day Exam //-->



    </div><!-- end of container //-->
</x-admin-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
            $("#invigilator").bind("keyup", function(){
                var searchTerm = $(this).val().trim()

                var search_term_length = searchTerm.length;

                //console.log(search_term_length);

                if (search_term_length >=3)
                {
                        $.ajax({
                            url: "{{ route('admin.invigilators.fetch_invigilator') }}",
                            method: 'GET',
                            data: {search_term: searchTerm}, 
                            success: function(response){
                                console.log(response)

                                if (!response || $.trim(response) === "" || response.length === 0)
                                {
                                    
                                }
                                else
                                {
                                    $("#suggestion-box").html(response);
                                    $("#suggestion-box").show();
                                }
                            },
                            error: function(){

                            }
                        });
                }
                else
                {
                    $("#suggestion-box").html();
                    $("#suggestion-box").hide();
                }
            })
    });


    $("#suggestion-box").on("click", ".cursor-pointer", function(){
        var invigilatorId = $(this).attr("id");
        var invigilatorText = $(this).text();

        $("#invigilator").val(invigilatorText);
        $("#invigilator_id").val(invigilatorId);


        $("#suggestion-box").hide();
    });

</script>