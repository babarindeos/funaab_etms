<x-staff-layout>

    <div class="flex flex-col container mx-4 border border-0 md:mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    Circles               
                </div>
                
        </section>

        <!-- section //-->
        <section class="py-2 border-0">

            <!-- navigation //-->
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:justify-between md:items-center border-0 ">
                    <div>
                        <div class="text-xl text-gray-800 font-semibold">
                            {{ $cell->name }} ({{ $cell->code }})
                        </div>
                        <div class="text-gray-600 font-medium text-lg">
                            General Room

                        </div>

                        

                    </div>
                    <div class="flex flex-row space-x-4">
                            <div class="hover:underline">General Room</div>
                            <div class="hover:underline">Announcements</div>
                            <div class="hover:underline">Projects</div>
                            <div class="hover:underline">Staff</div>
                            

                    </div>
            </div>
            <!-- end of navigation //-->
            
        </section>
        <!-- section //-->


        <!-- General Room Section  //-->

        <section class="py-2 mt-2">
            <div class="flex flex-col md:flex-row border-0">
                <div class="flex  md:w-[30%] border-0 px-2 py-2 overflow-y-auto h-100 mr-2"><!-- left panel //-->
                        
                    
                        <!-- Cell Users - Circle Members //-->
                        <div class="w-full mt-2">
                            @foreach($cell->users as $circle)
                                <div class="w-full py-1">
                                        <div class="flex flex-row w-full text-sm border-b ">
                                                <div class="flex flex-col justify-center px-4 py-2 items-center">
                                                        @if ($circle->user->profile!=null && $circle->user->profile->avatar!='')
                                                            <img class="w-12 h-10 rounded-full" src="{{ asset('storage/'.$circle->user->profile->avatar)}}" />
                                                        @else
                                                            <img class="w-12" src="{{ asset('images/avatar_64.jpg')}}" />
                                                        @endif
                                                                                                                       
                                                </div>
                                                <div class="flex flex-col py-2 w-full">
                                                    <a href="{{ route('staff.profile.user_profile', ['fileno'=>$circle->user->staff->fileno]) }}" class="font-bold hover:underline">
                                                        {{ $circle->user->staff->surname}}  {{ $circle->user->staff->firstname}}
                                                    </a>

                                                    @if ($circle->user->profile != null)
                                                        <div>{{ $circle->user->profile->designation}} </div>
                                                    @endif 

                                                    <div class="w-full">
                                                        @if (Auth::user()->id != $circle->user_id)
                                                            <div class="flex text-end justify-end "> 
                                                                <a href="{{ route('staff.workflows.private_message.index', ['document'=>$document->id, 'recipient'=>$contributor->user_id]) }}" class="flex text-xs border border-1 border-green-500 px-2 py-1 rounded-md 
                                                                        hover:bg-green-500 hover:text-white">   
                                                                    Message
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- end of workflow contributors //-->


                </div><!-- end of left pane //-->


                <div class="flex flex-col md:border-l  md:w-[60%] px-3 py-2"><!-- Right pane //-->
                    <form action="{{ route('staff.circles.general_room.store', ['cell' => $cell->id]) }}" method="POST">
                            @csrf
                            <!-- textarea //-->
                            <div class="flex items-center py-1">
                                    <textarea name="message" rows="3" class="overflow-hidden border border-1 border-gray-400 bg-gray-50
                                            w-full p-2 rounded-md 
                                            focus:outline-none
                                            focus:border-blue-500 
                                            focus:ring
                                            focus:ring-blue-100" 
                                            
                                            value="{{ old('message') }}"
                                            required
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                            maxlength="140">  </textarea>
                            </div>
                            <!-- end of textarea //-->

                            <!-- button //-->
                            <div class="flex justify-between">

                                <div class="flex text-xs text-gray-500">
                                    140 characters max
                                </div>
                                
                                <div>    
                                    <button type="submit" class="border border-1 border-green-500
                                    bg-green-500 text-white rounded-md py-2 px-4 text-xs font-semibold">
                                            Send
                                    </button>
                                </div>
                            </div>
                            <!-- end of button //-->
                    </form>



                    <!-- list of messages //-->
                    <div class="flex flex-col border-0 border-blue-900 h-50 overflow-y-auto py-2 mt-2">
                            
                        @foreach ($messages as $message)
                            <div class="flex flex-row my-2">
                                    <div class="px-3 border-0">
                                            @if ($message->sender->profile!=null && $message->sender->profile->avatar!="" )
                                            
                                                <img src="{{ asset('storage/'.$message->sender->profile->avatar)}}" class='w-12 h-10 rounded-full' />
                                                
                                            @else
                                                <img class="w-12" src="{{ asset('images/avatar_64.jpg')}}" />  
                                            @endif
                                            
                                    </div>
                                    <div class="px-3 py-1 rounded-md bg-gray-100 w-full">
                                            <a href="{{ route('staff.profile.user_profile', ['fileno'=>$message->sender->staff->fileno]) }}" class="font-semibold text-sm hover:underline">
                                                    {{ $message->sender->surname }} {{ $message->sender->firstname }}
                                            </a>
                                            <div class="text-xs">
                                                    {{ $message->created_at->format('l jS F, Y @ g:i a') }}
                                            </div>
                                            <div class="text-sm py-2">
                                                    {{ $message->message}}
                                            </div>

                                    </div>
                            </div>
                        @endforeach
 
                    </div>
                    <!-- end of list of messages //-->

                    <div>
                        {{ $messages->links()}}
                    </div>

                                                                                

                </div><!-- end of right panel //-->
            </div>             
        </section>

        <!-- end of General Room Section //-->
    
        
    
    
        
    </div>
    


</x-staff-layout>