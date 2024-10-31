<x-admin-layout>
    <div class="flex flex-col w-full mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Semester</h1>
                    </div>  
                    <div>
                        <a href="{{ route('admin.semesters.index') }}" class="bg-green-600 text-white py-2 px-4 
                                        rounded-lg text-xs md:text-sm hover:bg-green-500">Semesters</a>

                        <a href="{{ route('admin.academic_sessions.index') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                        rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Academic Sessions</a>
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new Semester form //-->
        <section class="mb-8">
                <div>
                    <form  action="{{ route('admin.semesters.store')}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                                <h2 class="font-semibold text-xl py-1" >New Semester</h2>
                                Select Academic Session, provide semester
                        </div>


                        @include('partials._session_response')


                        <!-- Academic Session //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                            <select name="academic_session" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     required
                                                                     >
                                                                    <option value=''>-- Select Academic Session --</option>
                                                                        @foreach($academic_sessions as $academic_session)
                                                                            <option class='py-4' value="{{$academic_session->id}}">{{$academic_session->name}} @if ($academic_session->current) (Current) @endif </option>
                                                                        @endforeach                                                                    
                                                                    </select>

                                                                     @error('academic_session')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                     @enderror
                            
                        </div>
                        
                        <!-- end of Academic Session //-->



                        <!-- Semester //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                            <select name="semester" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     
                                                                     >
                                                                    <option value=''>-- Select Semester --</option>
                                                                        <option class='py-4' value="first">First Semester</option>
                                                                        <option class='py-4' value="second">Second Semester</option>
                                                                                                                                         
                                                                    </select>

                                                                     @error('semester')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                     @enderror
                            
                        </div>
                        
                        <!-- end of Semester //-->

                        

                        
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Create Semester</button>
                        </div>
                        
                    </form><!-- end of new department form //-->
                <div>
        </section>
        <!-- end of new college form //-->


    </div><!-- end of container //-->
</x-admin-layout>