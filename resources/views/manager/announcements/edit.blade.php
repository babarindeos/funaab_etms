<x-manager-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Announcements             
                </div>

                <div>

                            <a href="{{ route('manager.announcements.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Announcements</a>
                </div>
                
        </section>

       


        <!-- Create Announcement Section  //-->
        
       
    
        <section class="py-8 mt-2">
                <div>
                    <form  action="{{ route('manager.announcements.update', ['announcement'=>$announcement->id]) }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Edit Announcement</h2>
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
                                                                    
                                                                    value="{{ $announcement->subject }}"
                                                                    
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
                                                                    
                                                                    > {{ $announcement->message }}  </textarea>
                                                                    <div class="text-xs text-gray-600">Max: 2,000 words</div>
                                                                                                                                        
    
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
                                                                    
                                                                    value="{{ $announcement->link }}"
                                                                    
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
                         
                        @if ($announcement->file!=null || $announcement->file=='')
                                    <div class="flex flex-row w-text-sm w-[80%] md:w-[60%] ">
                                            <i class="fa-solid fa-paperclip"></i> 
                                            <a href="{{ asset('storage/'.$announcement->file) }}" target="_blank" class="hover:underline">
                                                <span class='text-xs px-2'> {{ $announcement->filetype}} ({{ $announcement->filesize }})</span>
                                            </a>

                                    </div>
                        @endif
            
                            
                        <!-- end of upload //-->
                        
    
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Update Announcement</button>
                        </div>
                        
                    </form><!-- end of new Announcement form //-->
                <div>
    
            

        </section>
        <!-- End of Create Announcement Section //-->



    </div>

</x-manager-layout>