<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Venue Categories</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.venue_categories.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Categories</a>

                            
                    </div>
            </div>
        </section>
        <!-- end of page header //-->



        @if (count($venue_categories) > 0)
                <section class="flex flex-col py-2 px-2 justify-end w-[95%] mx-auto md:px-4">
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

                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-2 md:px-4">
                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                >
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='10%' class="text-center font-semibold py-2">SN</th>
                                <th width='50%' class="font-semibold py-2 text-left">Name</th>                      
                                <th width='30%' class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($venue_categories->currentPage() -1 ) * $venue_categories->perPage();
                            @endphp

                                @foreach ($venue_categories as $venue_category)
                                <tr class="border border-b border-gray-200">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td>
                                        <a class="hover:underline" href="">
                                            {{ $venue_category->name }} 
                                        </a>

                                        <div>
                                            <small>
                                               
                                            </small>
                                        </div>
                                        
                                    </td>
                                    
                                    
                                    <td class="text-center">
                                        <span class="text-sm">
                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.venue_categories.edit', ['venue_category'=>$venue_category->id])}}">Edit</a>
                                        </span>
                                        <span> 
                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.venue_categories.confirm_delete', ['venue_category'=>$venue_category->id]) }}"
                                            >Delete</a>
                                        </span>
                                    </td>

                                </tr>
                                @endforeach
                            
                            
                        </tbody>

                    </table>

                    <div class="mt-1">
                        {{ $venue_categories->links() }}

                    </div>


                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                        <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                            There is currently no Venue Categories
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