<x-manager-layout>
    <div class="container mx-auto mb-8">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] mt-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Exam Scheduler</h1>
                    </div>  
                    <div>
                            <a href="{{ route('manager.exams.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Exams</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->







        <!-- Search //-->
        <section class="flex flex-col mt-1 py-2 px-2 justify-end w-[92%] border-0 md:px-0 mx-auto">
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

        <!-- scheduled Day Exams //-->

        <section class="flex flex-col mx-auto w-[92%] items-center justify-center border-0 mb-8">
             
             <!-- Added Venue Categories //-->
             <div class="flex flex-col border-red-900 w-[80%] md:w-[100%] py-2 border-0 mt-0">
                
                <div class="flex flex-row w-full py-2 border-b text-lg font-semibold py-1">
                    Scheduled Day Exam ({{ $scheduled_day_exams->count() }} of {{ $scheduled_exams->count() }})
                </div>

                @if (count($scheduled_day_exams))
                    
                        <table class="table-auto border-collapse border border-1 border-gray-200" >
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th width='5%' class="text-center font-semibold py-3">SN</th>
                                                <th width='25%' class="font-semibold py-2 text-left">Course</th> 
                                                <th width='15%' class="font-semibold py-2 text-left">Exam Type</th> 
                                                <th width='20%' class="font-semibold py-2 text-left">Venue</th> 
                                                <th width='15%' class="font-semibold py-2 text-left">Time Period</th>                                     
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = 0;
                                            @endphp

                                                @foreach ($scheduled_day_exams as $day_exam)
                                                <tr class="border border-b border-gray-200">
                                                    <td class='text-center py-8'>{{ ++$counter }}.</td>
                                                    <td class='py-4'>        
                                                            <a href="{{ route('admin.courses.show', ['course' => $day_exam->course->id]) }}" class="hover:underline">                                
                                                                    {{ $day_exam->course->title }}  ({{ $day_exam->course->code }}) </a> 
                                                                    <span class='text-sm'>@if ($day_exam->course->enrolment != null) -  [enrolment: {{ $day_exam->course->enrolment->enrolment }}] @endif</span>                                                  
                                                                     
                                                             
                                                        
                                                    </td>
                                                    <td>
                                                            {{ $day_exam->exam_type->name }}
                                                    </td>
                                                    <td class="py-8">
                                                            <a href="{{ route('admin.venues.show', ['venue' => $day_exam->venue->id]) }}" class="hover:underline">                                
                                                                    {{ $day_exam->venue->name }}  ( {{$day_exam->venue->venue_category->name }} )                                                     
                                                            </a>  
                                                            <div class='text-sm'>
                                                                    {{ $day_exam->venue->venue_type->name }}: {{$day_exam->venue->student_capacity}} student caps. <br/>Max. Invigilators: {{$day_exam->venue->max_invigilators}}
                                                            </div>
                                                    </td>
                                                    <td>
                                                            <div>
                                                                    {{$day_exam->time_period->name}}
                                                            </div>
                                                            <div class="text-sm">
                                                                    {{ \Carbon\Carbon::parse($day_exam->time_period->start_time)->format('g:i a') }} - {{\Carbon\Carbon::parse($day_exam->time_period->end_time)->format('g:i a') }} 

                                                            </div>
                                                    </td>
                                                    
                                                    
                                                    

                                                </tr>
                                                @if ($day_exam->support_venues->count())
                                                <tr>
                                                    <td></td>
                                                    <td colspan='5' class='py-4'>                                                        
                                                            <div class='text-sm font-semibold'>
                                                                Support Venues
                                                            </div>
                                                            <div>
                                                                @foreach($day_exam->support_venues as $support_venue)
                                                                    <div class='text-sm py-2 border-b'>
                                                                            <a class='hover:underline' href="{{ route('admin.venues.show', ['venue' => $support_venue->venue->id]) }}"> 
                                                                                {{ $support_venue->venue->name }}  ( {{$support_venue->venue->venue_category->name }} ) 
                                                                            </a>
                                                                                
                                                                            - {{ $support_venue->venue->venue_type->name }}: {{$support_venue->venue->student_capacity}} student caps. Max Invigilators: {{$support_venue->venue->max_invigilators}}

                                                                            <div class='py-2 space-x-2 hidden'>
                                                                                    <a class='text-xs py-1 px-4 border border-green-500 rounded-md hover:bg-green-500 hover:text-white' 
                                                                                              
                                                                                        href="{{ route('admin.exams.invigilator_allocation.allocator',['exam_day'=>$day_exam->exam_day_id]) }}?schedule={{ $day_exam->id }}&level=support">
                                                                                        Invigilator Allocation
                                                                                    </a>                                                                  
                                                                            </div>
                                                                    </div>
                                                                    
                                                                @endforeach
                                                            </div>
                                                    </td>
                                                </tr>
                                                @endif  <!-- end of support venue check //-->

                                                @endforeach
                                            
                                            
                                        </tbody>

                        </table>
                       



                @endif
                


            </div>


        </section>
        <!--end of added category //-->


        <!-- end of scheduled Day Exam //-->


    </div><!-- end of container //-->
</x-manager-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        
        $("#course").bind("keyup", function(){
            var courseCode = $(this).val().trim();
            var courseCodeLength = courseCode.length;

            if (courseCodeLength >= 4)
            {
                $.ajax({
                    url: "{{ route('admin.courses.fetch_course') }}",
                    method: 'GET',
                    data: { course_code: courseCode },
                    success: function(response){
                        console.log(response)
                        
                        if (!response || $.trim(response) === "" || response.length === 0) 
                        {
                            //console.log("empty");
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
                $("#suggestion-box").html("");
                $("#suggestion-box").hide();
            }

            
            
        });


        $("#suggestion-box").on("click", ".cursor-pointer", function(){
            var courseId = $(this).attr("id");
            var courseText = $(this).text();
            
            $("#course").val(courseText);
            $("#course_id").val(courseId);

            $("#suggestion-box").hide();
        })
    });


</script>