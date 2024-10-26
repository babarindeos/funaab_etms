<x-staff-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    Circles               
                </div>
                
        </section>

        <!-- section //-->
        <section class="py-2 border-0">

            <!-- navigation //-->
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:justify-between md:items-center border-0 ">
                    <div>
                        <div class="text-xl text-gray-800 font-semibold">
                            {{ $circle->cell->name }} ({{ $circle->cell->code }})
                        </div>
                        <div class="text-gray-600 font-medium text-lg">
                            New Announcement

                        </div>

                        

                    </div>
                    <div class="flex flex-row space-x-4">
                            @include('partials._circle_submenu')
                    </div>
            </div>
            <!-- end of navigation //-->
            
        </section>
        <!-- section //-->


        <!-- Create Announcement Section  //-->
        
       
    
        <section class="py-8 mt-2">
                <div>
                    <form  action="{{ route('staff.circles.store_announcement', ['circle'=>$circle->id])}} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Publish Announcement</h2>
                            Provide subject and information about the Announcement...
                        </div>
    
    
                        @include('partials._session_response')
                        
                        
    
                        <!-- Announcement Subject //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="subject" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Subject of Announcement"
                                                                    
                                                                    value="{{ old('subject') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  
                                                                                                                                        
    
                                                                    @error('subject')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of Announcement Subject //-->                      
    
                       
    
                        <!-- Message //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <textarea name="message" rows="10" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" 
                                                                    
                                                                    value="{{ old('message') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    maxlength="300"
                                                                    >  </textarea>
                                                                    <div class="text-xs text-gray-600">Message (300 words)</div>
                                                                                                                                        
    
                                                                    @error('message')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of message //-->


                        

                        <!-- External link //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="link" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="External Link"
                                                                    
                                                                    value="{{ old('link') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    
                                                                    />  
                                                                                                                                        
    
                                                                    @error('link')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of Announcement Subject //-->   



                         <!-- Announcement file //-->
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
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Publish Announcement</button>
                        </div>
                        
                    </form><!-- end of new Announcement form //-->
                <div>
    
            

        </section>
        <!-- End of Create Announcement Section //-->



    </div>

</x-staff-layout>