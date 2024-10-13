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
                <div class="flex flex-col px-0 border border-1 rounded-md mt-2 w-full md:w-2/5 py-8">
                        <div class="mx-auto ">   
                                @if($user->profile != null && $user->profile->avatar!='')
                                                <img class="w-64 h-64 rounded-full" src="{{ asset('storage/'.$user->profile->avatar)}}" />
                                                @else
                                                <img src="{{ asset('images/avatar_150.jpg')}}" />
                                @endif
                        </div>

                        <div class="flex flex-col border-0 w-full px-2 mx-auto py-2">
                                            <div class="font-medium mx-auto">
                                                {{ $user->staff->title }} 
                                                {{ $user->staff->surname }} 
                                                {{ $user->staff->firstname }}
                                                {{ $user->staff->middlename }}
                                            </div>
                                            <div class="text-sm mx-auto">
                                                @if ($user->profile != null)
                                                    {{ $user->profile->designation}}, 
                                                @endif
                                                
                                                {{ $user->staff->fileno}}
                                            </div>
                        </div>

                </div>
                <!-- end of left column //-->


                


                <!-- right column //-->
                <div class="flex flex-col flex-1 px-0 py-2 rounded-md mt-2">

                    <div>
                        <h2 class="text-xl font-semibold border-b py-2">
                            Permissions
                        </h2>
                    </div>

                    

                    <div class="py-4 border rounded-md mt-2 px-2">

                        <div>
                            <h3 class="text-xl">
                                Announcement
                            </h3>
                        </div>

                        <div class="flex flex-row justify-between py-2">
                                <div>
                                    Create Announcement
                                </div>
                                <div>                                   

                                        @if ($announcement==null)
                                            <form action="{{ route('admin.circles.permissions.create_announcement_set', ['cell'=>$cell->id, 'user'=>$user->id]) }}" method="POST">
                                                @csrf
                                                <button class="text-sm bg-blue-400 py-2 px-4 rounded-md text-white">
                                                    Set permission
                                                </button>
                                            </form>
                                        @elseif ($announcement->create)
                                            <form action="{{ route('admin.circles.permissions.create_announcement_off', ['cell'=>$cell->id, 'user'=>$user->id]) }}" method="POST">
                                                @csrf
                                                <button class="text-sm bg-green-400 hover:bg-red-400 py-2 px-4 rounded-md text-white">
                                                    Turn off permission
                                                </button>
                                            </form>
                                        @else 
                                            <form action="{{ route('admin.circles.permissions.create_announcement_on', ['cell'=>$cell->id, 'user'=>$user->id]) }}" method="POST">
                                                @csrf
                                                <button class="text-sm bg-blue-400 hover:bg-blue-500 py-2 px-4 rounded-md text-white">
                                                    Turn on permission
                                                </button>
                                            </form>

                                        @endif 

                                    
                                </div>
                        </div>


                    </div>

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