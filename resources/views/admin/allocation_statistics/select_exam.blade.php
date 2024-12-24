<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[100%] py-8 px-4 border-0 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Allocation Statistics</h1>
                    </div>  
                      
            </div>
            
        </section>
        <!-- end of page header //-->

        @if ($exams->count())

            <!-- List of records //-->
            <div class="flex flex-col mx-auto w-[90%] md:w-[100%] md:px-2  items-center justify-center border-0 rounded-md ">
                <div class="flex flex-col border-0 border-red-800 w-[100%] md:w-[60%]  md:px-2 py-2  mb-8">
                        <div class='text-lg font-medium py-2 mt-0 '>
                            Examinations ({{ $exams->count() }})
                        </div>
                        <table class="w-full">
                            <thead>
                                <tr class='bg-green-100'>
                                    <th width='5%' class='py-4'>SN</th>
                                    <th width='25%' class='text-left'>Examination</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach($exams as $exam)
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td class='py-4'>
                                            <a class="hover:underline" href="{{ route('admin.exams.allocation_statistics.index',['exam'=>$exam->id]) }}">
                                                {{ $exam->name}}
                                            </a>
                                    </td>
                                    

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                </div>
                    
            </div>
            <!-- end of records //-->
        @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Examination
                        </div>
                    </section>


        @endif




    </div><!-- end of container //-->

</x-admin-layout>