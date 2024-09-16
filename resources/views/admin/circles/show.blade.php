<x-admin-layout>
    <div class="container border-1 border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-0 border-0 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Circle</h1>
                    </div>
                    <div>
                            

                            <button onclick="window.history.back()" class="border border-green-600 text-green-600 py-2 px-4 
                                            text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500"> &laquo; Back</button>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        
        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto">
            <div class="py-2 text-lg font-medium">
                    {{ $cell->name }} ({{$cell->code}})
            </div>
        </section>



        @if (count($circles) > 0)
                

                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto">
                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                >
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="text-center font-semibold py-2 w-16">SN</th>
                                <th class="font-semibold py-2 text-left">Name</th>                                
                                <th class="font-semibold py-2 text-left">Type</th>
                                <th class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 0;
                            @endphp

                                @foreach ($circles as $circle)
                                <tr class="border border-b border-gray-200">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td>
                                        <a class="hover:underline" href="{{ route('admin.circles.show', ['cell'=>$circle->id]) }}">
                                            {{ $circle->name }} ({{$circle->code}})
                                        </a>

                                        <div>
                                            <small>
                                                
                                            </small>
                                        </div>
                                        
                                    </td>
                                    
                                    <td>
                                        {{ $circle->cell_type->name }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-sm">
                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.cells.edit', ['cell'=>$circle->id])}}">Edit</a>
                                        </span>
                                        <span> 
                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.cells.confirm_delete', ['cell'=>$circle->id]) }}"
                                            >Delete</a>
                                        </span>
                                    </td>

                                </tr>
                                @endforeach
                            
                            
                            
                        </tbody>

                    </table>

                    


                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8">
                        <div class="flex flex-row justify-center font-semibold text-xl text-gray-300">
                                Currently no Circle
                        </div>
                </section>
        @endif
        






    </div><!-- end of container //-->




</x-admin-layout>