<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Academic Sessions</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.academic_sessions.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Academic Session</a>

                            
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        <!-- academic sessions table //-->
        @if (count($academic_sessions) > 0)
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
                                <th width='50%' class="font-semibold py-2 text-left">Academic Session</th>                                
                                <th width='20%' class="font-semibold py-2 text-left">Status</th>
                                <th width='20%' class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($academic_sessions->currentPage() -1 ) * $academic_sessions->perPage();
                            @endphp

                                @foreach ($academic_sessions as $academic_session)
                                <tr class="border border-b border-gray-200">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td>
                                        <a class="hover:underline" href="#">
                                            {{ $academic_session->name }} 
                                        </a>

                                        <div>
                                            <small>
                                               
                                            </small>
                                        </div>
                                        
                                    </td>
                                    
                                    <td>
                                        @if ($academic_session->current)
                                            <div class='text-sm'>
                                                    Current Academic Session
                                            </div>
                                        @endif

                                    </td>
                                    <td class="text-center ">
                                        <div class="flex flex-col md:flex-row border-0 justify-center md:space-x-1">
                                                

                                                        @if ($academic_session->current)
                                                            <form method="POST" action="{{ route('admin.academic_sessions.setoff_current_session', ['academic_session'=>$academic_session->id]) }}">
                                                                    @csrf
                                                                    <span class="text-sm">
                                                                        <button class="hover:bg-green-500 bg-green-400 text-white rounded-md 
                                                                            px-4 py-1 text-xs">Off Current
                                                                        </button>
                                                                    </span>
                                                            </form>
                                                        @else
                                                            <form method="POST" action="{{ route('admin.academic_sessions.seton_current_session', ['academic_session'=>$academic_session->id]) }}">
                                                                    @csrf
                                                                    <span class="text-sm">
                                                                        <button class="hover:bg-purple-500 bg-purple-400 text-white rounded-md 
                                                                            px-4 py-1 text-xs">Set Current
                                                                        </button>
                                                                    </span>
                                                            </form>
                                                        @endif
                                                
                                                
                                                <div>
                                                    <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                            px-4 py-1 text-xs" href="{{ route('admin.academic_sessions.edit', ['academic_session'=>$academic_session->id])}}">Edit</a>
                                                </div>
                                                <div> 
                                                    <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                            px-4 py-1 text-xs" href="{{ route('admin.academic_sessions.confirm_delete', ['academic_session'=>$academic_session->id]) }}"
                                                    >Delete</a>
                                                </div> 
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            
                            
                        </tbody>

                    </table>

                    <div class="mt-1">
                        {{ $academic_sessions->links() }}

                    </div>


                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                        <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                            There is currently no Academic Session
                        </div>
                </section>
        @endif




        <!-- end of academic sessions table //-->



        
        
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