<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Exams</h1>
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
                    <form  action="{{ route('admin.exams.update',['exam'=>$exam->id])}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Edit Exam</h2>
                            
                        </div>


                        @include('partials._session_response')
                        
                    
                        <!-- Academic Semester //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                            
                            
                            <select name="semester" class="border border-1 border-gray-400 bg-gray-50
                                                                        w-full p-4 rounded-md 
                                                                        focus:outline-none
                                                                        focus:border-blue-500 
                                                                        focus:ring
                                                                        focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                        
                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                        required
                                                                        >
                                                                    <option value=''>-- Select Academic Semester --</option>
                                                                        @foreach($semesters as $semester)
                                                                            @php
                                                                                
                                                                                $semester_name = ucfirst($semester->name);
                                                                                $semester_name = $semester_name.' Semester';
                                                                            @endphp
                                                                            <option class='py-4' value="{{$semester->id}}"  @if($exam->semester_id==$semester->id) selected @endif>{{$semester_name}} ({{ ($semester->academic_session->name) }})</option>
                                                                        @endforeach                                                                    
                                                                    </select>

                                                                        @error('semester')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                        @enderror
                            
                        </div>
                        
                        <!-- end of Academic Semester //-->


                        <!-- Exam name //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="name" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Name of Exam"
                                                                    
                                                                    value="{{ $exam->name }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  

                                                                                                                                        

                                                                    @error('name')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of exam  name //-->

                        <!-- Exam Time Period //-->
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            <!-- Start Time //-->
                            <div class="flex flex-col md:w-1/2">
                                        <input type="date" name="start_date" class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" placeholder="Start Date"
                                                                                
                                                                                value="{{ $exam->start_date }}"
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                required
                                                                                />  
                                                                                <div>                                                                              
                                                                                        <div class="text-sm">
                                                                                                Start Date
                                                                                        </div>
                                                                                        <div>                                                                                                
                                                                                                @error('start_date')
                                                                                                    <span class="text-red-700 text-sm">
                                                                                                        {{$message}}
                                                                                                    </span>
                                                                                                @enderror
                                                                                        </div>
                                                                                </div>
                            </div>
                            <!-- Start Time //-->

                            <!-- End Time //-->
                            <div class="flex flex-col md:w-1/2">
                                        <input type="date" name="end_date" class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" placeholder="End Date"
                                                                                
                                                                                value="{{ $exam->end_date }}"
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                required
                                                                                /> 
                                                                                <div>                                                                              
                                                                                        <div class="text-sm">
                                                                                                End Time
                                                                                        </div>
                                                                                        <div>                                                                                                
                                                                                                @error('end_date')
                                                                                                    <span class="text-red-700 text-sm">
                                                                                                        {{$message}}
                                                                                                    </span>
                                                                                                @enderror
                                                                                        </div>
                                                                                </div>                                                                                                                                                    
                

                            </div>
                            <!-- end of Date //-->
                                        
                        </div><!-- end of Exam Date //--> 



                        
                        

                        

                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Update Exam</button>
                        </div>
                        
                    </form><!-- end of new status form //-->
                <div>
        </section>
        <!-- end of new venue type form //-->


    </div><!-- end of container //-->
</x-admin-layout>