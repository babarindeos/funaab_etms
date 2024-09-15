<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Create Cell</h1>
                    </div>  
                    <div>
                        <a href="{{ route('admin.cells.index') }}" class="bg-green-600 text-white py-2 px-4 
                                        rounded-lg text-xs md:text-sm hover:bg-green-500">Cells</a>

                        <a href="{{ route('admin.cell_types.index') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                        rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Cell Types</a>
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new college form //-->
        <section class="mb-8">
                <div>
                    <form  action="{{ route('admin.cells.store')}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >New Cell</h2>
                            Select Cell Type, Cell Parent and provide name, code
                        </div>


                        @include('partials._session_response')


                        <!-- Cell Type //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                            <select name="type" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     required
                                                                     >
                                                                    <option value=''>-- Select Cell Type --</option>
                                                                        @foreach($cell_types as $cell_type)
                                                                            <option class='py-4' value="{{$cell_type->id}}">{{$cell_type->name}} </option>
                                                                        @endforeach                                                                    
                                                                    </select>

                                                                     @error('cell_type')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                     @enderror
                            
                        </div>
                        
                        <!-- end of Cell Type //-->



                        <!-- Cell Parent //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                            <select name="parent" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     
                                                                     >
                                                                    <option value=''>Top Level Parent</option>
                                                                        @foreach($cells as $cell)
                                                                            <option class='py-4' value="{{$cell->id}}">{{$cell->name}} ({{$cell->cell_type->name}}) </option>
                                                                        @endforeach                                                                    
                                                                    </select>

                                                                     @error('parent')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                     @enderror
                            
                        </div>
                        
                        <!-- end of Cell Parent //-->

                        

                        <!-- Cell name //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="name" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Cell name"
                                                                    
                                                                    value="{{ old('name') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  
                                                                                                                                        

                                                                    @error('department_name')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of Cell name //-->

                        <!-- Cell code //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="code" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Cell code"
                                                                    
                                                                    value="{{ old('code') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  
                                                                                                                                        

                                                                    @error('code')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of Cell code //-->

                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Create Cell</button>
                        </div>
                        
                    </form><!-- end of new department form //-->
                <div>
        </section>
        <!-- end of new college form //-->


    </div><!-- end of container //-->
</x-admin-layout>