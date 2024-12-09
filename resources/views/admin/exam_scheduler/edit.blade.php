<x-admin-layout>
    <div class="container mx-auto">
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
                    <form  action="{{ route('admin.exams.exam_scheduler.schedule.update',['schedule'=>$schedule->id])}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >
                                {{ $schedule->exam->name }}                            
                            </h2>
                            <div class='text-md'>
                                    
                                   {{ $schedule->course->title }} ({{ $schedule->course->code }})
                                
                            </div>
                            
                        </div>


                        @include('partials._session_response')

                                 <!-- Exam Day //-->
                                 <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                        
                                    
                                
                                        <select name="exam_day" class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                required
                                                                                >
                                                                                
                                                                                <option value=''>-- Select Exam Days --</option>
                                                                                    @foreach($exam_days as $exam_day)
                                                                                        <option class='py-4' value="{{$exam_day->id}}"  @if($exam_day->id == $schedule->exam_day_id) selected  @endif >{{$exam_day->name}} ({{ \Carbon\Carbon::parse($exam_day->date)->format('l jS F, Y') }})</option>
                                                                                    @endforeach                                                    
                                                                                </select>
    
                                                                                @error('exam_day')
                                                                                    <span class="text-red-700 text-sm">
                                                                                        {{$message}}
                                                                                    </span>
                                                                                @enderror
                                        
                                </div>
                                    
                                <!-- end of Exam Day //-->  
                                   
                        

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
                                                                                    <option class='py-4' value="{{$course->id}}" @if($course->id == $schedule->course_id) selected  @endif >{{$course->title}} ({{$course->code}})</option>
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
                                                                                @foreach($exam_types as $exam_type)                                                                                    
                                                                     
                                                                                        <option class='py-4' value="{{$exam_type->id}}" @if($exam_type->id==$schedule->exam_type_id) selected @endif>{{ $exam_type->name }} </option>
                                                                                    
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
                                                                                @foreach($venues as $venue)
                                                                                    <option class='py-4' value="{{$venue->id}}" @if($venue->id == $schedule->venue_id) selected  @endif >{{$venue->name}} ({{ $venue->venue_type->name }}: {{$venue->student_capacity}} student caps) - {{$venue->venue_category->name}}</option>
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
                                                                                @foreach($exam_time_periods as $time_period)
                                                                                    <option class='py-4' value="{{$time_period->id}}" @if($time_period->id == $schedule->time_period_id) selected  @endif >
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
                                                rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Update Schedule</button>
                                </div>
                        
                        
                    </form><!-- end of new status form //-->


               
                <div>
        </section>
        <!-- end of new venue type form //-->




       

    </div><!-- end of container //-->
</x-admin-layout>