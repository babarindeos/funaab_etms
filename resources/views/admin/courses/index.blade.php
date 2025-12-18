<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Courses</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.courses.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Course</a>

                    </div>
            </div>
        </section>
        <!-- end of page header //-->



        @if (count($courses) > 0)
                <section class="flex flex-col py-2 px-2 justify-end w-[95%] mx-auto md:px-4">
                    <form action="{{ route('admin.courses.index') }}" method="GET">
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
                                    <div class='flex border-0 items-center justify-center'>
                                                <button  class="bg-green-600 text-white py-2 px-4 
                                                                rounded-lg text-sm hover:bg-green-500"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
                    </form>
                    
                </section>

                <div class='py-2 w-[90%] md:w-[90%] mx-auto'>{{ $courses->links() }}</div>
                <section class="flex flex-wrap gap-6 mx-auto w-[90%] md:w-[90%] md:flex-row justify-center space-y-2 md:space-y-0  border-0 py-2 mb-16">
                                @foreach ($courses as $course)
                                        <div class='flex flex-col w-full md:flex-row md:w-[27%] border rounded-xl shadow-md px-5 py-6 bg-white'>
                                                                <div class='flex flex-col w-full items-center justify-center'>
                                                                        

                                                            
                                                                    <div class='flex flex-col text-lg font-semibold py-1 justify-center text-center items-center'>
                                                                                        <a class="hover:underline" href="{{ route('admin.courses.show', ['course'=>$course->id]) }}">
                                                                                            <div class='text-green-700'>{{ $course->code }}</div>
                                                                                            {{ $course->title }}                                             
                                                                                        </a>

                                                                    </div>
                                                                    <div class='flex flex-col justify-center items-center text-center text-sm'>
                                                                            {{ $course->department->code}}, {{ $course->department->college->code}}                                                            
                                                                    </div>
                                                                    <div>
                                                                                @if ($course->coordinators)
                                                                                    @foreach($course->coordinators as $coordinator)
                                                                                        <div>
                                                                                            <a href="{{ route('admin.profile.user_profile',['fileno' => $coordinator->coordinator->staff->fileno]) }}" class='hover:underline'>
                                                                                                {{ $coordinator->coordinator->staff->staff_title->title }} 
                                                                                                {{ ucfirst(strtolower($coordinator->coordinator->staff->surname)) }} 
                                                                                                {{ $coordinator->coordinator->staff->firstname }} ({{ $coordinator->coordinator->staff->fileno }} )
                                                                                            </a>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @endif
                                                                    </div>

                                                                    <div lass="text-center py-2">
                                                                                @if ($course->coordinator== null)
                                                                                        <span class="text-sm">
                                                                                            <a class="hover:bg-purple-500 bg-purple-400 text-white rounded-md 
                                                                                                    px-4 py-1 text-xs" href="{{ route('admin.courses.coordinators.create', ['course'=>$course->id])}}">Add Coordinator</a>
                                                                                        </span>
                                                                                @else
                                                                                        <span class="text-sm">
                                                                                            <a class="hover:bg-purple-500 bg-purple-400 text-white rounded-md 
                                                                                                    px-4 py-1 text-xs" href="{{ route('admin.courses.coordinators.create', ['course'=>$course->id])}}">Coordinator</a>
                                                                                        </span>

                                                                                @endif

                                                                    </div>

                                                                    <div class="text-center py-2">                                                           
                                                                            <span class="text-sm">
                                                                                <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                                                        px-4 py-1 text-xs" href="{{ route('admin.courses.edit', ['course'=>$course->id])}}">Edit</a>
                                                                            </span>
                                                                            <span> 
                                                                                <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                                        px-4 py-1 text-xs" href="{{ route('admin.courses.confirm_delete', ['course'=>$course->id]) }}"
                                                                                >Delete</a>
                                                                            </span>
                                                                    </div>

                                                                    

                                                                </div>
                                        </div>



                                @endforeach
                </section>
                <div class='py-2 w-[90%] md:w-[90%] mx-auto'>{{ $courses->links() }}</div>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                        <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                            There is currently no Course
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