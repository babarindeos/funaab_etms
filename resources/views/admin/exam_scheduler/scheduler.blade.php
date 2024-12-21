<x-admin-layout>
    <div class="container mx-auto mb-8">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Exam Scheduler</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.exams.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Exams</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new exam type form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.exams.exam_scheduler.post_scheduler',['exam_day'=>$exam_day->id])}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
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
                                    
                                <!-- Course //-->
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                        
                                    
                                
                                    <select name="course" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                            required
                                                                            >

                                                                            
                                                                            <option value=''>-- Select Course --</option>
                                                                                @foreach($courses as $course)
                                                                                    @php
                                                                                            $is_scheduled = false;
                                                                                            $old_value = old('course');
                                                                                    @endphp
                                                                                    @foreach( $scheduled_exams as $scheduled_exam)
                                                                                        @if ($scheduled_exam->course_id == $course->id)
                                                                                            @php
                                                                                                $is_scheduled = true;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endforeach
                                                                                   

                                                                                    @if ($is_scheduled == false)
                                                                                        <option class='py-4' value="{{$course->id}}" @if ($old_value==$course->id) selected  @endif>{{ $course->title }} ({{ $course->code }})</option>
                                                                                    @endif

                                                                                @endforeach                                                    
                                                                            </select>

                                                                            @error('course')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                    
                                </div>
                                
                                <!-- end of Course //-->  

                               

                                <!-- Exam Types //-->
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                        
                                    
                                
                                    <select name="exam_type" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                            required
                                                                            >
                                                                            
                                                                            <option value=''>-- Select Exam Type --</option>
                                                                                @php
                                                                                    $old_value = old('exam_type');
                                                                                    
                                                                                @endphp
                                                                                
                                                                                @foreach($exam_types as $exam_type)                                                                                    
                                                                     
                                                                                        <option class='py-4' value="{{$exam_type->id}}" @if($old_value==$exam_type->id) selected @endif >{{ $exam_type->name }} </option>
                                                                                    
                                                                                @endforeach                                                    
                                                                            </select>

                                                                            @error('exam_type')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                    
                                </div>
                                
                                <!-- end of Exam Types //-->  
                                
                                 
                                
                                <!-- Venue //-->
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                        
                                    
                                
                                    <select name="venue" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                            required
                                                                            >
                                                                            
                                                                            <option value=''>-- Select Venue --</option>
                                                                                @php
                                                                                    $old_value = old('venue');                                                                                    
                                                                                @endphp

                                                                                @foreach($venues as $venue)
                                                                                    <option class='py-4' value="{{$venue->id}}"  @if($old_value==$venue->id) selected  @endif >{{$venue->name}} ({{ $venue->venue_type->name }}: {{$venue->student_capacity}} student caps) - {{$venue->venue_category->name}}</option>
                                                                                @endforeach                                      
                                                                            </select>

                                                                            @error('venue')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                    
                                </div>
                                
                                <!-- end of Venue //-->



                                <!-- Time Period //-->
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                        
                                    
                                
                                    <select name="time_period" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                            required
                                                                            >
                                                                            
                                                                            <option value=''>-- Select Time Period --</option>

                                                                                @php
                                                                                      $old_value = old('time_period');                                                                                    
                                                                                @endphp

                                                                                @foreach($exam_time_periods as $time_period)
                                                                                    <option class='py-4' value="{{$time_period->id}}" @if($old_value==$time_period->id) selected @endif >
                                                                                        {{$time_period->name}} 
                                                                                        ({{ \Carbon\Carbon::parse($time_period->start_time)->format('g:i a') }} - {{\Carbon\Carbon::parse($time_period->end_time)->format('g:i a') }} ) 
                                                                                    </option>
                                                                                @endforeach                         
                                                                            </select>

                                                                            @error('time_period')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                    
                                </div>
                                
                                <!-- end of Time period //-->
                                        
                         
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                                    <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                                hover:bg-gray-500
                                                rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Schedule</button>
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

        <!-- scheduled Day Exams //-->

        <section class="flex flex-col mx-auto w-[90%] items-center justify-center border-0 mb-8">
             
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
                                                <th width='10%' class="font-semibold py-2 text-center">Action</th>
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
                                                                     
                                                             <div class='py-2 space-x-2'>
                                                                    <a class='text-xs py-1 px-4 border border-green-500 rounded-md hover:bg-green-500 hover:text-white' 
                                                                        href="{{ route('admin.exams.invigilator_allocation.allocator',['exam_day'=>$day_exam->id]) }}">
                                                                        Invigilator Allocation
                                                                    </a> 

                                                                    <a class='text-xs py-1 px-4 border border-green-500 rounded-md hover:bg-green-500 hover:text-white' 
                                                                        href="{{ route('admin.exams.exam_scheduler.support_venue.index',['exam_day'=>$exam_day->id, 'schedule'=>$day_exam->id]) }}">
                                                                        Support Venue
                                                                    </a> 
                                                            </div>
                                                        
                                                    </td>
                                                    <td>
                                                            {{ $day_exam->exam_type->name }}
                                                    </td>
                                                    <td>
                                                            <a href="{{ route('admin.venues.show', ['venue' => $day_exam->venue->id]) }}" class="hover:underline">                                
                                                                    {{ $day_exam->venue->name }}  ( {{$day_exam->venue->venue_category->name }} )                                                     
                                                            </a>  
                                                            <div class='text-sm'>
                                                                    {{ $day_exam->venue->venue_type->name }}: {{$day_exam->venue->student_capacity}} student caps. <br/>Max. Invigilators: {{$day_exam->venue->max_invigilators}}
                                                            </div>
                                                    </td>
                                                    <td>
                                                            <div>
                                                                    {{$time_period->name}}
                                                            </div>
                                                            <div class="text-sm">
                                                                    {{ \Carbon\Carbon::parse($day_exam->time_period->start_time)->format('g:i a') }} - {{\Carbon\Carbon::parse($day_exam->time_period->end_time)->format('g:i a') }} 

                                                            </div>
                                                    </td>
                                                    
                                                    
                                                    <td class="text-center">
                                                        <div class='flex flex-row space-x-1 justify-center items-center'>
                                                                <div class="text-sm">
                                                                    <form action="{{ route('admin.exams.exam_scheduler.schedule.edit',['schedule'=>$day_exam->id]) }}" method="GET">
                                                                        @csrf
                                                                        <button class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                                            px-4 py-1 text-xs" href="">Edit</button>
                                                                    </form>
                                                                </div>

                                                                <div class="text-sm">
                                                                    <form action="{{ route('admin.exams.exam_scheduler.schedule.delete', ['schedule'=>$day_exam->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method("delete")
                                                                        <button class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                            px-4 py-1 text-xs">Delete</button>
                                                                    </form>
                                                                </div>
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
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                    </td>
                                                </tr>
                                                @endif 
                                                @endforeach
                                            
                                            
                                        </tbody>

                        </table>
                       



                @endif
                


            </div>


        </section>
        <!--end of added category //-->


        <!-- end of scheduled Day Exam //-->


    </div><!-- end of container //-->
</x-admin-layout>