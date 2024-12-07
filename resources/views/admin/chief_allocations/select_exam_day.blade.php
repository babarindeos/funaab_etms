<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Chief Allocation</h1>
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
                    <form  action="{{ route('admin.exams.chief_allocation.select_exam_day')}} " method="GET" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Select Exam</h2>
                            
                        </div>


                        @include('partials._session_response')
                        
                        

                        <!-- Exam //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                             
                        
                            <select name="exam" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     required
                                                                     >
                                                                     
                                                                    <option value=''>-- Select Exam --</option>
                                                                        @foreach($exams as $exam)
                                                                            <option class='py-4' value="{{$exam->id}}"  @if($exam_selected == $exam->id) selected @endif  >{{$exam->name}} ({{$exam->semester->academic_session->name}})</option>
                                                                        @endforeach                                                                    
                                                                    </select>

                                                                     @error('exam')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                     @enderror
                            
                        </div>
                        
                        <!-- end of Exam //-->    
                                
                         
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                                    <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                                hover:bg-gray-500
                                                rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Submit</button>
                                </div>
                        
                        
                    </form><!-- end of new status form //-->


                @if ($isPostBack && $exam_selected)

                    <form  action="{{ route('admin.exams.chief_allocation.load_chief_allocator')}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Select Exam Day</h2>
                            
                        </div>


                        @include('partials._session_response')
                        
                        

                        <!-- Exam //-->
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
                                                                     
                                                                    <option value=''>-- Select Exam Day --</option>
                                                                        @foreach($exam_days_data as $exam_day)
                                                                            <option class='py-4' value="{{$exam_day->id}}" >{{$exam_day->name}} </option>
                                                                        @endforeach                                                                    
                                                                    </select>

                                                                     @error('exam')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                     @enderror
                            
                        </div>
                        
                        <!-- end of Exam //-->           
                         
                        
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Load Allocator</button>
                        </div>
                        
                    </form><!-- end of new status form //-->

                    @endif
                <div>
        </section>
        <!-- end of new venue type form //-->


    </div><!-- end of container //-->
</x-admin-layout>