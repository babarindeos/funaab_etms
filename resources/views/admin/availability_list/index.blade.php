<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[100%] py-8 px-4 border-0 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Availability List</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.exams.availability_list.confirm_truncate') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Clear List</a>

                            <a href="{{ route('admin.exams.availability_list.create') }}" class="border border-green-600 hover:bg-green-600 hover:text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Upload Records</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->

        @if ($availability_list->count())

            <!-- List of records //-->
            <div class="flex flex-col mx-auto w-[90%] md:w-[100%] md:px-2  items-center justify-center border-0 rounded-md ">
                <div class="flex flex-col border-0 border-red-800 w-[100%] md:w-[100%]  md:px-2 py-2  mb-8">
                        <div class='text-lg font-medium py-2 mt-0 '>
                            Availability List ({{ $availability_list->count() }})
                        </div>
                        <table class="w-full">
                            <thead>
                                <tr class='bg-green-100'>
                                    <th width='5%' class='py-4'>SN</th>
                                    <th width='25%' class='text-left'>Staff</th>
                                    <th width='40%' class='text-left'>Department</th>
                                    <th class='text-left'>College</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach($availability_list as $user)
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td class=''>
                                            <a class="hover:underline" href="{{ route('admin.profile.user_profile',['fileno'=>$user->staff->fileno]) }}">
                                                {{ $user->staff->staff_title->title  }} 
                                                {{ ucfirst(strtolower($user->surname))  }}
                                                {{ $user->firstname  }}
                                                ({{ $user->staff->fileno }})
                                            </a>
                                    </td>
                                    <td>
                                        {{ $user->department_name}} ({{ $user->department_code }})                                    
                                    </td>
                                    <td>
                                    <div>
                                        {{ $user->college_code }}
                                        
                                    </td>
                                    <td class='text-center py-4'>
                                        <form action="{{ route('admin.exams.availability_list.delete', ['user'=>$user->id]) }}" method="POST">
                                            @csrf
                                            @method("delete")

                                            <button class='border border-red-600 py-2 px-4 text-xs rounded-2xl hover:bg-red-500 hover:text-white'>
                                                Remove
                                            </button>
                                        </form>
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
                                There is currently no Availability List
                        </div>
                    </section>


        @endif




    </div><!-- end of container //-->

</x-admin-layout>