<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-1 mt-6 px-2 md:px-4 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Staff</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.staff.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-sm hover:bg-green-500">New Staff</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        @if ($staffs->count())
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
                                <th width='7%' class="text-center font-semibold py-3">SN</th>
                                <th class="font-semibold py-2 text-left">Staff No</th>
                                <th class="font-semibold py-2 text-left">Full name</th>                    
                                <th class="font-semibold py-2 text-left">Department</th>
                                <th class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php 
                                    $counter = 0;
                                    
                                    $counter = ($staffs->currentPage() - 1 ) * $staffs->perPage();
                                
                                @endphp

                                @foreach ($staffs as $staff)
                                    <tr class="border border-b border-gray-200 ">
                                        <td class='text-center py-6'>{{ ++$counter }}.</td>
                                        <td>{{ $staff->fileno }}</td>
                                        <td>
                                            <a class='hover:underline' href="{{ route('admin.profile.user_profile',['fileno'=>$staff->fileno]) }}">
                                                {{ $staff->surname }} {{ $staff->firstname }} {{ $staff->middlename }}
                                            </a>
                                            <div class='text-xs'>
                                                    @if ( $staff->profile != null)
                                                        {{ $staff->profile->designation }}
                                                    @endif
                                            </div>

                                        </td>

                                        <td>
                                                <a class='hover:underline' href="{{ route('admin.departments.show',['department'=>$staff->department_id]) }}">
                                                    {{ $staff->department->name }} ({{$staff->department->code}})
                                                </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="px-1">
                                                <a class="bg-green-400 hover:bg-green-500 text-white rounded-md px-4 py-1 text-xs"
                                                    href="{{ route('admin.profile.user_profile', ['fileno'=> $staff->fileno])}}">
                                                    View
                                                </a>
                                            </span>
                                            <span class="text-sm">
                                                <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.staff.edit', ['staff' => $staff->id]) }}">Edit</a>
                                            </span>
                                            <span> 
                                                <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="#"
                                                href=''>Delete</a>
                                            </span>	
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>

                    </table>

                    <div class="py-2">
                        {{ $staffs->links() }}
                    </div>
                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                    <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                        No Staff record is found
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
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            })
        });
    });

</script>