<x-admin-layout>
    <div class="flex flex-col w-full border-1 border-0 border-blue-900 mx-auto px-2 md:px-4">
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



        
                

        <section class="flex flex-col w-[95%] md:w-[95%] md:flex-row 
                        space-y-4 md:space-x-2 md:space-y-0 mx-auto border-0">

                <!-- left column //-->
                <div class="flex flex-col flex-1 px-0 border border-1 rounded-md mt-2 w-full">
                    <div class="flex flex-row justify-between border-b py-2 px-2">
                        <div class="font-semibold text-lg">
                                Users ({{ $cell->users->count() }})
                        </div>
                        <div>
                                <a href="#" class="underline" id="add_user_btn">
                                    Add User
                                </a>
                        </div>
                    </div>

                    <!-- add user form //-->

                    <div class="px-2">
                        @include('partials._session_response')
                    </div>

                    <div class="px-2 hidden" id="add_user_form">
                        <form action="{{ route('admin.circles.add_user', ['cell'=>$cell->id]) }}" method="POST" class="flex flex-row space-x-1">
                            @csrf

                                <!-- Staff FileNo //-->
                                <div class="flex flex-col border-red-900 py-3">
                                
                                    
                                    <input type="text" name="fileno" class="border border-1 border-gray-400 bg-gray-50
                                                                            p-1 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100 text-xs" placeholder="File No"
                                                                            
                                                                            value="{{ old('fileno') }}"
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                            required
                                                                            />  
                                                                                                                                                

                                                                            @error('fileno')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                    
                                </div><!-- end of fileno //-->

                                <!-- Role //-->
                                <div class="flex flex-col border-red-900 py-3">
                                
                                    
                                    <input type="text" name="role" class="border border-1 border-gray-400 bg-gray-50
                                                                            p-1 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100 text-xs" placeholder="Role in Circle"
                                                                            
                                                                            value="{{ old('role') }}"
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                            
                                                                            />  
                                                                                                                                                

                                                                            @error('role')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                    
                                </div><!-- end of role //-->


                                <div class="flex flex-col border-red-900 py-3 items-center justify-center">
                                    <button type="submit" class="border-0 bg-green-400 py-1 px-4 text-white 
                                                    hover:bg-green-500
                                                    rounded-md text-sm" style="font-family:'Lato';font-weight:500;">Add User</button>
                                </div>


                        </form>
                    </div>


                    <!-- end of add user form //-->


                    <!-- list of users //-->
                    <div class="flex flex-col px-2 py-2">
                            @foreach ($cell->users as $users )
                                <div class="flex flex-row py-3 space-x-2 border-b ">
                                        <div class="border-0 px-1">
                                                @if($users->user->profile != null)
                                                <img class="w-12 h-10 rounded-full" src="{{ asset('storage/'.$users->user->profile->avatar)}}" />
                                                @else
                                                <img class="w-12 h-10" src="{{ asset('images/avatar_64.jpg')}}" />
                                                @endif
                                        </div>
                                        <div class="flex flex-col border-0 w-full px-2">
                                            <div class="font-medium">
                                                {{ $users->user->staff->title }} 
                                                {{ $users->user->staff->surname }} 
                                                {{ $users->user->staff->firstname }}
                                                {{ $users->user->staff->middlename }}
                                            </div>
                                            <div class="text-sm">
                                                @if ($users->user->profile != null)
                                                    {{ $users->user->profile->designation}}, 
                                                @endif
                                                {{ $users->role }},
                                                ({{ $users->user->staff->fileno}})
                                            </div>

                                            <!-- links //-->
                                            <div class="flex flex-row border-0
                                                        justify-end space-x-2 text-sm">
                                                <div class="underline">
                                                    Permissions
                                                </div>
                                                <div class="underline">
                                                    Edit
                                                </div>
                                                <div class="underline">
                                                    Delete
                                                </div>   
                                            </div>
                                            <!-- end of links //-->
                                        </div>
                                        

                                </div>
                            @endforeach

                    </div>

                    <!-- end of list of users //-->


                </div>
                <!-- end of left column //-->


                


                <!-- right column //-->
                <div class="flex flex-col flex-1 px-0 py-2">

                    @if (count($circles) > 0)

                            <table class="table-auto border-collapse border border-1 border-gray-200" 
                                        >
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="text-center font-semibold py-2 w-16">SN</th>
                                        <th class="font-semibold py-2 text-left">Name</th>                                
                                        
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
                                                    {{ $circle->name }} ({{$circle->code}}) - 
                                                    <small>{{ $circle->cell_type->name }}</small>
                                                </a>

                                                
                                                
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

                    @else
                        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8">
                                <div class="flex flex-row justify-center font-semibold text-xl text-gray-300">
                                        Currently no Circle
                                </div>
                        </section>
                    @endif


                </div><!-- end of right column //-->
                
                
                    


    </section>
       
        






    </div><!-- end of container //-->




</x-admin-layout>

<script>
$(document).ready(function(){
    $("#add_user_btn").bind('click', function(){
        $("#add_user_form").toggle();
    });
});

</script>