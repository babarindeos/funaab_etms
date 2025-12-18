<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Exam Time Periods</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.exams.exam_time_periods.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Exam Time Period</a>

                            
                    </div>
                    
            </div>
        </section>
        <!-- end of page header //-->



        @if (count($exam_time_periods) > 0)

                    <section class="flex flex-col py-2 px-2 justify-end w-[100%] border-0 md:px-4">
                        <div class='w-full px-3 md:px-2 md:w-4/5 border-0 mx-auto'>
                                    <div class="flex justify-end border-0">
                                    
                                            <input type="text" name="search" class="w-full md:w-2/5 border border-gray-400 bg-gray-50
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
                        
                    </section>
                    
                <div class="flex flex-col overflow-x-auto">
                   
                    <section class="flex flex-col w-[95%] md:w-4/5 mx-auto px-2 md:px-4 mb-16">

                       
                                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                                >
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th width='10%' class="text-center font-semibold py-4">SN</th>
                                                <th width='50%' class="font-semibold py-2 text-left">Name</th>  
                                                <th width='10%' class="font-semibold py-2 text-left">Start Time</th>
                                                <th width='10%' class="font-semibold py-2 text-left">End Time</th>                                      
                                                <th width='30%' class="font-semibold py-2 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = ($exam_time_periods->currentPage() -1 ) * $exam_time_periods->perPage();
                                            @endphp

                                                @foreach ($exam_time_periods as $exam_time_period)
                                                <tr class="border border-b border-gray-200">
                                                    <td class='text-center'>{{ ++$counter }}.</td>
                                                    <td class='py-8'>        
                                                            <a href="#" class="hover:underline">                                
                                                                {{ $exam_time_period->name }}                                                                
                                                            </a>         
                                                                              
                                                        
                                                    </td>
                                                    <td>
                                                            {{ \Carbon\Carbon::parse($exam_time_period->start_time)->format('g:i a') }}
                                                    </td>
                                                    <td>
                                                            {{ \Carbon\Carbon::parse($exam_time_period->end_time)->format('g:i a') }}
                                                    </td>
                                                    
                                                    
                                                    <td class="text-center">
                                                        <span class="text-sm">
                                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.exams.exam_time_periods.edit', ['exam_time_period'=>$exam_time_period->id])}}">Edit</a>
                                                        </span>

                                                        <span class="text-sm">
                                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.exams.exam_time_periods.confirm_delete', ['exam_time_period'=>$exam_time_period->id])}}">Delete</a>
                                                        </span>
                                                        
                                                    </td>

                                                </tr>
                                                @endforeach
                                            
                                            
                                        </tbody>

                                    </table>
                       

                        <div class="mt-1">
                            {{ $exam_time_periods->links() }}

                        </div>


                    </section>
            </div>
        @else
                    <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                            <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                                There is currently no Exam Time Periods
                            </div>
                    </section>
        @endif
        
        
        
    </div>
</x-admin-layout>


<script>
    $(document).ready(function(){
         $("input[name='search']").on('keyup', function(){
                var value = $(this).val().toLowerCase();
                
                $("table tbody tr").filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1 );
                });
         });
    });

</script>

