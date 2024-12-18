<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Exam Days</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.exams.index') }}" class="border-green-600 border text-green-600 py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-600 hover:text-white"> Exams</a>

                            <a href="{{ route('admin.exams.days.create',['exam'=>$exam->id]) }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Exam Day</a>
                            
                    </div>

                    
            </div>
        </section>
        <!-- end of page header //-->

        <section class="flex flex-col py-2 px-2 justify-end w-[100%] border-0 md:px-4">
            <div class='w-full px-3 md:px-2 md:w-1/2 border-0 mx-auto border'>
                    <div class="font-semibold text-xl">
                        {{ $exam->name }}
                    </div>
                    
            </div>
        </section>


        @if (count($exam_days) > 0)

                    <section class="flex flex-col py-2 px-2 justify-end w-[80%] md:w-[50%] mx-auto border-0 md:px-4 mt-4">
                        
                        <div class='flex flex-col md:flex-row w-full  border-0'>
                                    <div class='flex flex-col md:w-1/2 items-start justify-center text-xl '>
                                        Scheduled Exams ( {{$scheduled_exams->count()}} )
                                    </div>
                                    <div class="flex justify-end md:w-1/2 border-0">
                                    
                                            <input type="text" name="search" class="w-full md:w-3/5 border border-gray-400 bg-gray-50
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
                   
                    <section class="flex flex-col w-[95%] md:w-[50%] mx-auto px-2 md:px-4">

                       
                                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                                >
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th width='10%' class="text-center font-semibold py-2">SN</th>
                                                <th width='50%' class="font-semibold py-2 text-left">Title</th>                                      
                                                <th width='30%' class="font-semibold py-2 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = ($exam_days->currentPage() -1 ) * $exam_days->perPage();
                                            @endphp

                                                @foreach ($exam_days as $exam_day)
                                                <tr class="border border-b border-gray-200">
                                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                                    <td class="py-4">        
                                                            <a href="#" class="hover:underline font-semibold text-xl">                                
                                                                {{ $exam_day->name }}
                                                            </a>                                 
                                                            <div>
                                                                {{ \Carbon\Carbon::parse($exam_day->date)->format('l jS F, Y') }}
                                                            </div>
                                                            <div>
                                                                @php
                                                                    $exam_day_scheduled = 0;
                                                                @endphp
                                                                @foreach($scheduled_exams as $scheduled_exam)
                                                                    @if ($scheduled_exam->exam_day_id == $exam_day->id)
                                                                        @php
                                                                            ++$exam_day_scheduled
                                                                        @endphp
                                                                    @endif
                                                                @endforeach

                                                                <div class='text-sm py-2'>
                                                                    Scheduled Exams ({{ $exam_day_scheduled }})
                                                                </div>

                                                            </div>
                                                    </td>
                                                    
                                                    
                                                    <td class="text-center">
                                                        <span class="text-sm px-1">
                                                            <a class="hover:bg-purple-500 bg-purple-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.exams.exam_scheduler.scheduler',['exam_day'=>$exam_day->id]) }}">
                                                                    Scheduler
                                                            </a>
                                                        </span>
                                                        <span class="text-sm">
                                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.exams.days.edit', ['exam'=>$exam->id,'day'=>$exam_day->id]) }}">Edit</a>
                                                        </span>
                                                        <span> 
                                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.exams.days.confirm_delete', ['exam'=>$exam->id,'day'=>$exam_day->id]) }}"
                                                            >Delete</a>
                                                        </span>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            
                                            
                                        </tbody>

                                    </table>
                       

                        <div class="mt-1">
                            {{ $exam_days->links() }}

                        </div>


                    </section>
            </div>
        @else
                    <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                            <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                                There is currently no Exam Days
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

