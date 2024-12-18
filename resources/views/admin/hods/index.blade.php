<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">HODs</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.departments.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500">Departments</a>

                            <a href="{{ route('admin.colleges.index') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Colleges</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->



        @if (count($hods) > 0)
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
                                <th width='35%' class="font-semibold py-2 text-left">HOD</th>                                
                                <th width='35%' class="font-semibold py-2 text-left">Department</th>                               
                                <th width='30%' class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($hods->currentPage() -1 ) * $hods->perPage();
                            @endphp

                                @foreach ($hods as $hod)
                                <tr class="border border-b border-gray-200">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td>
                                            <a class='hover:underline' href="{{ route('admin.profile.user_profile',['fileno'=>$hod->user->staff->fileno]) }}"'>
                                                {{ $hod->user->staff->staff_title->title }} 
                                                {{ ucwords(strtolower($hod->user->staff->surname)) }} {{ $hod->user->staff->firstname }}
                                                ({{ $hod->user->staff->fileno }})
                                            </a>
                                       
                                        
                                    </td>
                                    <td>
                                        <a class='hover:underline' href="{{ route('admin.departments.show',['department'=>$hod->department_id]) }}">
                                            {{ $hod->department->name }} ({{ $hod->department->code }})
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        
                                            <span class="text-sm">
                                                <a class="hover:bg-purple-500 bg-purple-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.departments.hods.edit', ['department'=>$hod->department_id, 'hod'=>$hod->id]) }}">Update HOD</a>
                                            </span>

                                    </td>

                                </tr>
                                @endforeach
                            
                            
                        </tbody>

                    </table>

                    <div class="mt-1">
                        {{ $hods->links() }}

                    </div>


                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                        <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                            There is currently no Heads of Departments (HODs)
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