<x-staff-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto mb-8">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Report            
                </div>

                <div>

                            <a href="{{ route('staff.exams.invigilations.my_schedule',['exam'=>$exam->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">My Schedule</a>
                </div>
                
        </section>

       
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


    <!-- Create Announcement Section  //-->
    
       
    
        <section class="py-2 mt-2">
                <div>
                    <form  action="{{ route('staff.exams.exam_schedules.report.store',['exam'=>$exam->id, 'exam_schedule'=>$exam_schedule->id]) }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >{{ $exam->name }}</h2>
                            Send examination report to TIMTEC Admin...
                        </div>
    
    
                        @include('partials._session_response')
                        
                        
    
                        <!--  Subject //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="subject" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Subject of Report"
                                                                    
                                                                    value="{{ old('subject') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  
                                                                                                                                        
    
                                                                    @error('subject')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of Report Subject //-->                      
    
                       
    
                        <!-- Message //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <textarea name="message" rows="10" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" 
                                                                    maxlength = "500"
                                                                    value="{{ old('message') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    
                                                                    >  </textarea>
                                                                    <div class="text-xs text-gray-600">Max: 500 words</div>
                                                                                                                                        
    
                                                                    @error('message')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of message //-->


                        

                        


                         <!-- Report file //-->
                         <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                    
                                    
                            <input type="file" name="file" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100" 
                              
                             style="font-family:'Lato';font-size:16px;font-weight:500;"
                             accept=".jpg, .jpeg, .png, .pdf, .doc, .docx, .xls, .xlsx"
                             />
                                
    
                             @error('file')
                                <span class="text-red-700 text-sm">
                                    {{$message}}
                                </span>
                             @enderror
                            
                        </div>
                        <!-- end of file //-->                   
    
                       
                        <!-- end of upload //-->
    
    
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Submit Report</button>
                        </div>
                        
                    </form><!-- end of new Announcement form //-->
                <div>
    
            

        </section>
        <!-- End of Create Announcement Section //-->



    </div>

</x-staff-layout>