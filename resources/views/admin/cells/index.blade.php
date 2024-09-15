<x-admin-layout>
    <div class="container border-1 border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-0 border-0 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Cells</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.cells.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Cell</a>

                            <a href="{{ route('admin.cell_types.index') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Cell Types</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->



        @if (count($cells) > 0)
                <section class="flex flex-col py-2 px-2 justify-end w-[93%] mx-auto md:px-1">
                    <div class="flex justify-end border-0">
                    
                        <input type="text" name="search" class="w-4/5 md:w-2/5 border border-1 border-gray-400 bg-gray-50
                                    p-2 rounded-md 
                                    focus:outline-none
                                    focus:border-blue-500 
                                    focus:ring
                                    focus:ring-blue-100" placeholder="Search"                
                                
                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                        
                        />  
                    </div>
                    
                </section>

                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
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
                                $counter = ($cells->currentPage() -1 ) * $cells->perPage();
                            @endphp

                                @foreach ($cells as $cell)
                                <tr class="border border-b border-gray-200">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td>
                                        {{ $cell->name }} ({{$cell->code}})

                                        <div>
                                            <small>
                                                @if ($cell->parent != '')
                                                    {{ $cell->parent_modal->name }} ({{$cell->parent_modal->code}})
                                                @endif
                                            </small>
                                        </div>
                                        
                                    </td>
                                    
                                    <td>
                                        {{ $cell->cell_type->name }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-sm">
                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.cells.edit', ['cell'=>$cell->id])}}">Edit</a>
                                        </span>
                                        <span> 
                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.cells.confirm_delete', ['cell'=>$cell->id]) }}"
                                            >Delete</a>
                                        </span>
                                    </td>

                                </tr>
                                @endforeach
                            
                            
                        </tbody>

                    </table>

                    <div class="mt-1">
                        {{ $cells->links() }}

                    </div>


                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4 py-4">
                        Currently no Cell
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