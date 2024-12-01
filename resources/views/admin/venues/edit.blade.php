<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Venue</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.venues.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Venues</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new venue form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.venues.update',['venue'=>$venue->id]) }} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf
                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Edit Venue</h2>
                            
                        </div>


                        @include('partials._session_response')
                        
                        

                        <!-- Venue name //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="name" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Venue name"
                                                                    
                                                                    value="{{ $venue->name }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  

                                                                                                                                        

                                                                    @error('name')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of venue name //-->


                        
                        <!-- Venue Types  //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                            <select name="venue_type" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     required
                                                                     >
                                                                    <option value=''>-- Select Venue Type --</option>
                                                                       

                                                                        @foreach($venue_types as $venue_type)                                                                                                                            

                                                                            
                                                                                 <option class='py-4' @if($venue->venue_type_id==$venue_type->id) selected @endif value="{{$venue_type->id}}">{{ $venue_type->name }} </option>
                                                                           

                                                                        @endforeach                                                                    
                                                                    </select>

                                                                    <div class="flex justify-between">
                                                                        <div>                                                                           
                                                                                @error('venue_type')
                                                                                    <span class="text-red-700 text-sm">
                                                                                        {{$message}}
                                                                                    </span>
                                                                                @enderror
                                                                        </div>
                                                                        <div class="text-sm py-1">
                                                                                <a class="hover:underline" href="{{ route('admin.venue_types.create') }}">
                                                                                    Create Venue Type
                                                                                </a>
                                                                        </div>
                                                                    </div>
                            
                        </div>
                        
                        <!-- end of Venue Types  //-->



                        <!-- Venue Categories //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                            <select name="venue_category" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     required
                                                                     >
                                                                    <option value=''>-- Select Venue Category --</option>
                                                                       

                                                                        @foreach($venue_categories as $venue_category)                                                                                                                            

                                                                            
                                                                                 <option class='py-4'  @if($venue->venue_category_id==$venue_category->id) selected  @endif value="{{$venue_category->id}}">{{ $venue_category->name }} </option>
                                                                           

                                                                        @endforeach                                                                    
                                                                    </select>

                                                                    <div class="flex justify-between">
                                                                        <div> 
                                                                                @error('venue_category')
                                                                                    <span class="text-red-700 text-sm">
                                                                                        {{$message}}
                                                                                    </span>
                                                                                @enderror
                                                                        </div>
                                                                        <div class="text-sm py-1">
                                                                                <a class="hover:underline" href="{{ route('admin.venue_categories.create') }}">
                                                                                    Create Venue Category
                                                                                </a>
                                                                        </div>
                                                                    </div>
                            
                        </div>
                        
                        <!-- end of Venue Categories  //-->

                        <!-- Student Capacity //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="number" name="student_capacity" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Student Capacity"
                                                                    
                                                                    value="{{ $venue->student_capacity }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  

                                                                                                                                        

                                                                    @error('student_capacity')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of student capacity //-->


                        <!-- Student Capacity //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="number" name="max_invigilators" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Maximum Invigilators"
                                                                    
                                                                    value="{{ $venue->max_invigilators }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  

                                                                                                                                        

                                                                    @error('max_invigilators')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of maximum Invigilator //-->


                        

                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Update Venue</button>
                        </div>
                        
                    </form><!-- end of new venue type form //-->
                <div>
        </section>
        <!-- end of new venue type form //-->


    </div><!-- end of container //-->
</x-admin-layout>