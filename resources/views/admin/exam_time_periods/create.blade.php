<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Exam Time Period</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.exams.exam_time_periods.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Exam Time Periods</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new exam type form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.exams.exam_time_periods.store')}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >New Exam Time Period</h2>
                            
                        </div>


                        @include('partials._session_response')
                        
                        

                        <!-- Exam Time Period name //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="name" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Name of Exam Time Period"
                                                                    
                                                                    value="{{ old('name') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  

                                                                                                                                        

                                                                    @error('name')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of exam time period name //-->

                        <!-- Exam Time Period //-->
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            <!-- Start Time //-->
                            <div class="flex flex-col md:w-1/2">
                                        <input type="time" name="start_time" class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" placeholder="Start Time"
                                                                                
                                                                                value="{{ old('start_time') }}"
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                required
                                                                                />  
                                                                                <div>                                                                              
                                                                                        <div class="text-sm">
                                                                                                Start Time
                                                                                        </div>
                                                                                        <div>                                                                                                
                                                                                                @error('start_time')
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
                                        <input type="time" name="end_time" class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" placeholder="End Time"
                                                                                
                                                                                value="{{ old('end_time') }}"
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                required
                                                                                /> 
                                                                                <div>                                                                              
                                                                                        <div class="text-sm">
                                                                                                End Time
                                                                                        </div>
                                                                                        <div>                                                                                                
                                                                                                @error('end_time')
                                                                                                    <span class="text-red-700 text-sm">
                                                                                                        {{$message}}
                                                                                                    </span>
                                                                                                @enderror
                                                                                        </div>
                                                                                </div>                                                                                                                                                    
                

                            </div>
                            <!-- end of Time //-->
                                        
                        </div><!-- end of Exam Time Period //--> 



                        
                        

                        

                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Create Exam Time Period</button>
                        </div>
                        
                    </form><!-- end of new status form //-->
                <div>
        </section>
        <!-- end of new venue type form //-->


    </div><!-- end of container //-->
</x-admin-layout>