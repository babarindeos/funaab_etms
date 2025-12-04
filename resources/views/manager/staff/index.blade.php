<x-manager-layout>
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

        <section class="flex flex-col py-2 px-2 justify-end w-[95%] mx-auto md:px-4 ">
                    <form action="{{ route('manager.staff.index') }}" method="GET">
                    @csrf
                            <div class="flex justify-end border-0 gap-2">
                            
                                <input type="text" name="q" class="w-4/5 md:w-2/5 border border-1 border-gray-400 bg-gray-50
                                            p-2 rounded-md 
                                            focus:outline-none
                                            focus:border-blue-500 
                                            focus:ring
                                            focus:ring-blue-100" placeholder="Search"                
                                        
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                                
                                />  
                                <div class='flex border items-center justify-center'>
                                    <button  class="bg-green-600 text-white py-2 px-4 
                                                    rounded-lg text-sm hover:bg-green-500"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                    </form>
                    
        </section>



        @if ($staffs->count())
                <!-- Job Vacancy Applications  //-->
                <div class='py-2 w-[90%] md:w-[90%] mx-auto'>{{ $staffs->links() }}</div>

                <section class="flex flex-wrap gap-6 mx-auto w-[90%] md:w-[90%] md:flex-row justify-center space-y-2 md:space-y-0  border-0 py-2 mb-16">


                                @foreach ($staffs as $staff)
                                            
                                        <div class='flex flex-col w-full md:flex-row md:w-[27%] border rounded-xl shadow-md px-5 py-6 bg-white'>
                                                <div class='flex flex-col w-full items-center justify-center'>
                                                        <div class='flex justify-center border-0'>
                                                            @if ($staff->profile)
                                                                    <img class='w-36 h-36 rounded-full' src="{{ asset('storage/avatars/'.$staff->profile->avatar )}}" alt="User Avatar" />
                                                            @else
                                                                    <img class='w-24 h-24 rounded-full' src="{{ asset('images/avatar_64.jpg') }}" alt="Default Avatar" />
                                                            @endif
                                                        </div>

                                            
                                                    <div class='flex flex-col text-lg font-semibold py-1 justify-center text-center items-center'>
                                                                        <a class='hover:overline underline' href="#">
                                                                                {{$staff->surname}} {{$staff->firstname}} {{$staff->middlename}}
                                                                        </a>
                                                    </div>
                                                    <div class='flex flex-col justify-center items-center text-center text-sm'>
                                                            {{ $staff->fileno }} 
                                                            @if ($staff->department != null) ({{ $staff->department->code }})  @endif 
                                                    </div>

                                                    
                                                    

                                                </div>
                                        </div>
                                @endforeach

                                


                </section>
                <div class='py-2 w-[90%] md:w-[90%] mx-auto'>{{ $staffs->links() }}</div>
            
                <!-- Job Vacancy Applications  //-->
         @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                    <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                        No Staff record is found
                    </div>
                </section>
        @endif

        
    </div>
</x-manager-layout>

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