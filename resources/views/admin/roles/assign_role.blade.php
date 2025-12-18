<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Assign Role</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.staff.roles.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> Roles</a>

                            
                    </div>
            </div>
        </section>
        <!-- end of page header //-->



            

                    
                    
            <div class="flex flex-col overflow-x-auto">
                   
                    <section class="flex flex-col w-[95%] md:w-[50%] mx-auto px-2 md:px-4 border-0">

                       <form action="{{ route('admin.staff.roles.store_assign_role',['role'=>$role->id]) }}" method="POST">
                            @csrf
                                
                            @include('partials._session_response')
                                    
                                    <div class="flex flex-row justify-center md:space-x-1">
                                                            <!-- Title name //-->
                                                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] justify-center ">
                                                                
                                                                    
                                                                <input type="text" name="name" readonly class="border border-1 border-gray-400 bg-gray-50
                                                                                                        w-full p-4 rounded-md 
                                                                                                        focus:outline-none
                                                                                                        focus:border-blue-500 
                                                                                                        focus:ring
                                                                                                        focus:ring-blue-100" placeholder="Role"
                                                                                                        
                                                                                                        value="{{ $role->name  }}"
                                                                                                        
                                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                        required
                                                                                                        />  

                                                                                                                                                                            

                                                                                                        @error('name')
                                                                                                            <span class="text-red-700 text-sm">
                                                                                                                {{$message}}
                                                                                                            </span>
                                                                                                        @enderror
                                                            
                                                            </div><!-- end of name //-->

                                
                                        
                                                        <!-- Staff //-->
                                                        <div class="flex flex-col border-red-900 w-[80%] md:w-[80%] py-2">
                                                            
                                                                <input type='hidden' name='user_id' id='user_id' />
                                                                <input name="user" id="user" class="border border-1 border-gray-400 bg-gray-50
                                                                                                    w-full p-4 rounded-md 
                                                                                                    focus:outline-none
                                                                                                    focus:border-blue-500 
                                                                                                    focus:ring
                                                                                                    focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                    
                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                    required
                                                                                                    />
                                                                <div id='suggestion-box' class='border py-2 px-2 w-[47.7%] bg-green-100 text-black' 
                                                                          style='position:absolute; top:249px; z-index:1000; display:none; padding-left:2px;'></div>

                                                                                                    
                                                                                                    @error('user')
                                                                                                        <span class="text-red-700 text-sm">
                                                                                                            {{$message}}
                                                                                                        </span>
                                                                                                    @enderror
                                                            
                                                        </div>                                        
                                                        <!-- end of User //-->
                                        

                                                        <div class='flex flex-col justify-center border-0 px-1'>
                                                                <button  class='bg-green-500 text-white py-4 px-6'>Assign</button>
                                                        </div>
                                    </div><!-- end of  Staff //--> 
                        </form>
                    
                    </section>
            </div>




           




            <!-- list of assigned staff to role //-->
            <section class="flex flex-col w-[95%] md:w-[50%] mx-auto px-2 md:px-4 border-0 mt-8">
            <div class="flex flex-col md:flex-row md:justify-between py-2 border-b">
                    <div class='flex flex-col justify-center'>
                        <h2 class='font-semibold'>Assigned Staff</h2>
                    </div>
                    <!-- search //-->
                    <div>
                            <input type="text" name="search" class="border border-1 border-gray-400 bg-gray-50
                                                                                                        w-full p-2 rounded-md 
                                                                                                        focus:outline-none
                                                                                                        focus:border-blue-500 
                                                                                                        focus:ring
                                                                                                        focus:ring-blue-100" placeholder="Search..."
                                                                                                        
                                                                                                       
                                                                                                        
                                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                        required
                                                                                                        />  

                    </div>
                    <!-- end of search //-->
            </div>

            <table>
            @php
                $counter = 0;
            @endphp
            @foreach($assigned as $assign)
                
                <tr class='border-b'>
                    <td width='7%' class='py-6 px-3'>{{ ++$counter }}.</td>
                    <td>
                        <a href="{{ route('admin.profile.user_profile', ['fileno'=>$assign->user->staff->fileno]) }}" class='hover:underline'>
                            {{ $assign->user->staff->surname }} {{ $assign->user->staff->firstname }} ({{ $assign->user->staff->fileno }})
                        </a>
                    </td>
                    <td>
                            <form action="{{ route('admin.staff.roles.remove_assigned_role',['assigned_role'=>$assign->id]) }}" method="post">
                                @csrf
                                <button class="border px-3 py-2 rounded-md border-red-500 text-xs hover:bg-red-400 hover:text-white">Remove</button>
                            </form>
                    </td>
                </tr>
            @endforeach
            </table>




            </section>







       
        
        
        
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
            $("#user").bind("keyup", function(){
                var fileno = $(this).val().trim()

                var fileno_length = fileno.length;

                if (fileno_length == 0)
                {
                    $("#user_id").val(''); 
                }

                //console.log(search_term_length);

                if (fileno_length >=3)
                {
                        $.ajax({
                            url: "{{ route('admin.staff.fetch_staff') }}",
                            method: 'GET',
                            data: {fileno: fileno}, 
                            success: function(response){
                                console.log(response)

                                if (!response || $.trim(response) === "" || response.length === 0)
                                {
                                    
                                }
                                else
                                {
                                    $("#suggestion-box").html(response);
                                    $("#suggestion-box").show();
                                }
                            },
                            error: function(){

                            }
                        });
                }
                else
                {
                    $("#suggestion-box").html();
                    $("#suggestion-box").hide();
                }
            })
    });


    $("#suggestion-box").on("click", ".cursor-pointer", function(){
        var userId = $(this).attr("id");
        var userText = $(this).text();

        $("#user").val(userText);
        $("#user_id").val(userId);


        $("#suggestion-box").hide();
    });

</script>
