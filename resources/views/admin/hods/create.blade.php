<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Head of Department (HOD)</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.departments.hods.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> HODs</a>

                            <a href="{{ route('admin.departments.index') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Departments</a>
                    </div>                
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new department form //-->
        <section class="mb-8">
                <div>
                    <form  action="{{ route('admin.departments.hods.store', ['department'=>$department->id])}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Add HOD</h2>
                           
                        </div>


                        @include('partials._session_response')


                        <!-- Department long name //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="name" disabled class="readonly border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Department full name"
                                                                    
                                                                    value="{{ $department->name }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  
                                                                                                                                        

                                                                    @error('name')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of department name //-->


                        <!-- Users //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                            <select name="staff" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     required
                                                                     >
                                                                    <option value=''>-- Select Staff --</option>
                                                                        @foreach($staff as $person)
                                                                            <option class='py-4' value="{{$person->user->id}}">{{$person->surname}} {{$person->firstname}} ({{$person->fileno}}) </option>
                                                                        @endforeach                                                                       
                                                                    </select>

                                                                     @error('staff')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                     @enderror
                            
                        </div>
                        
                        <!-- end of Users //-->

                        
                        

                        
                        

                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Add HOD</button>
                        </div>
                        
                    </form><!-- end of new department form //-->
                <div>
        </section>
        <!-- end of new college form //-->


    </div><!-- end of container //-->
</x-admin-layout>