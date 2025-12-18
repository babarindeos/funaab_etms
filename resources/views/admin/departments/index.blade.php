<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Departments</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.departments.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Department</a>

                            <a href="{{ route('admin.colleges.index') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Colleges</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->



        @if (count($departments) > 0)
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

                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-2 md:px-4 mb-16">
                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                >
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='10%' class="text-center font-semibold py-4">SN</th>
                                <th width='35%' class="font-semibold py-2 text-left">Name</th>                                
                                <th width='10%' class="font-semibold py-2 text-left">Code</th>
                                <th width='25%' class="font-semibold py-2 text-left">HOD</th>
                                <th width='30%' class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($departments->currentPage() -1 ) * $departments->perPage();
                            @endphp

                                @foreach ($departments as $department)
                                <tr class="border border-b border-gray-200">
                                    <td class='text-center'>{{ ++$counter }}.</td>
                                    <td class='py-8'>
                                        <a class="hover:underline" href="{{ route('admin.departments.show', ['department'=>$department->id]) }}">
                                            {{ $department->name }} 
                                        </a>

                                        <div>
                                            <small>
                                                {{ $department->college->name }}, {{ $department->college->code }}   
                                            </small>
                                        </div>
                                        
                                    </td>
                                    
                                    <td>
                                        {{ $department->code }}
                                    </td>

                                    <td>
                                        @if ($department->hod != null)
                                            <a href="{{ route('admin.profile.user_profile', ['fileno'=>$department->hod->user->staff->fileno ]) }}" class="hover:underline">
                                                {{ ucfirst(strtolower($department->hod->user->staff->surname)) }} {{ $department->hod->user->staff->firstname }} 
                                            </a>
                                            <div class='text-xs'>
                                                {{ $department->hod->user->staff->fileno }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($department->hod == null)
                                            <span class="text-sm">
                                                <a class="hover:bg-purple-500 bg-purple-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.departments.hods.create', ['department'=>$department->id])}}">Add HOD</a>
                                            </span>
                                        @else
                                            <span class="text-sm">
                                                <a class="hover:bg-purple-500 bg-purple-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.departments.hods.edit', ['department'=>$department->id, 'hod'=>$department->hod->id]) }}">Update HOD</a>
                                            </span>
                                        @endif
                                        <span class="text-sm">
                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.departments.edit', ['department'=>$department->id])}}">Edit</a>
                                        </span>
                                        <span> 
                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.departments.confirm_delete', ['department'=>$department->id]) }}"
                                            >Delete</a>
                                        </span>
                                    </td>

                                </tr>
                                @endforeach
                            
                            
                        </tbody>

                    </table>

                    <div class="mt-1">
                        {{ $departments->links() }}

                    </div>


                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                        <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                            There is currently no Department
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