<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Monitoring: Invigilators</h1>
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
                    <form  action="{{ route('admin.monitoring.invigilators.select_exam_invigilator')}} " method="GET" class="flex flex-col mx-auto w-[90%] items-center justify-center">
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



                    <!-- Records of Invigilator in the selected exams //-->
                    @if ($isPostBack && $exam_selected)
                    <div class="flex flex-col w-[80%] md:w-[54%] mx-auto">
                        

                            <div class="flex flex-col md:flex-row md:w-full border-0 justify-between mt-8">

                                    <div class='py-4 w-full md:w-1/2 font-semibold border-0 text-lg'>
                                        Invigilators
                                    </div>

                                    <div class='w-full px-3 md:px-0 md:w-1/2 border-0 mx-auto items-center justify-center'>
                                                <div class="flex justify-end border-0">
                                                
                                                        <input type="text" name="search" class="w-full md:w-full border border-gray-400 bg-gray-50
                                                                    p-2 rounded-l-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Search"                
                                                                
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                                                        
                                                        /> 
                                                        <button class="bg-green-600 text-white px-5 border-r rounded-r-md "><i class="fa-solid fa-magnifying-glass"></i><button> 
                                                </div>
                                    </div>
                            </div>


                            <div class="border flex flex-col items-center justify-center ">
                            
                                
                                    <table width='100%' class="table-auto border-collapse border border-1 border-gray-200" 
                                                >
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th width='15%' class="text-center font-semibold py-4">SN</th>
                                                <th width='85%' class="font-semibold py-2 text-left">Invigilator</th>                                                
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = 0;
                                            @endphp
                                            @foreach($exam_invigilators_allocations as $exam_invigilator)
                                            
                                                <tr class='border-b'>
                                                    <td class='text-center py-6'>{{ ++$counter }}.</td>
                                                    <td>
                                                        <a href="" class="hover:underline">
                                                            {{ $exam_invigilator->invigilator->staff->staff_title->title}} 
                                                            {{ ucfirst(strtolower($exam_invigilator->invigilator->staff->surname)) }} 
                                                            {{ $exam_invigilator->invigilator->staff->firstname }}
                                                        </a>
                                                    </td>
                                                    

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                    
                            
                                
                            </div>
                    </div>
                    @endif
                    <!-- end of records of Invigilator in the selected exams //-->










                <div>
        </section>
        <!-- end of new venue type form //-->


    </div><!-- end of container //-->
</x-admin-layout>