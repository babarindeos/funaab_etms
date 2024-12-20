<x-staff-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        <section class="border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Announcement             
                </div>
                
        </section>      




        <!-- Announcement //-->
         

        <section class="py-2 mt-2">
            <div class="flex flex-col border-0 border-red-50 items-center">
                <div class="flex flex-col md:w-[60%] border-0  py-2 overflow-y-auto h-100"><!-- top panel //-->
                

                      
                        <div class="border w-full md:w-[98%] rounded-md px-4 py-4">

                            <!-- announcement header //-->
                            <div class="flex flex-col border-b pb-4 space-y-2 md:space-y-1">
                                    <div class="py-1 font-semibold text-lg">
                                            {{ $announcement->subject }}
                                    </div>
                                    <div class="flex flex-col md:flex-row text-sm md:space-x-6 border-0 md:items-center space-y-2 md:space-y-0">
                                            <div class="text-sm">
                                                {{ $announcement->created_at->format('l jS F, Y @ g:i a') }}
                                            </div>
                                            <div class="flex">
                                                <div>
                                                    @if ($announcement->sender->profile != null) 
                                                            @if ($announcement->sender->profile->avatar!=null || $announcement->sender->profile->avatar!=null )
                                                                    <img src="{{ asset('storage/'.$announcement->sender->profile->avatar)}}" 
                                                                                class='w-8 h-8 rounded-full hover:ring hover:ring-gray-200' />
                                                            @else 
                                                                    <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" />
                                                            @endif
                                                    @else
                                                                <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" /> 
                                                    @endif
                                                </div>
                                                <div class="flex items-center px-2">
                                                        <a class="hover:underline" href="{{ route('staff.profile.email_user_profile',['email'=>$announcement->sender->email]) }}">
                                                                @php
                                                                    $surname = ucfirst(strtolower($announcement->sender->surname))
                                                                @endphp
                                                                {{ $surname }} {{ $announcement->sender->firstname }}
                                                        </a>
                                                </div>
                                            </div>
                                    </div>

                                    <!-- file Attachment //-->
                                    @if ($announcement->file!="")
                                    <div class="text-sm">
                                            <i class="fa-solid fa-paperclip"></i> 
                                            <a href="{{ asset('storage/'.$announcement->file) }}" target="_blank" class="hover:underline">
                                                <span class='text-xs'> {{ $announcement->filetype}} ({{ $announcement->filesize }})</span>
                                            </a>

                                    </div>
                                    <!-- end of file attachment //-->
                                    @endif
                                </div>
                                <!-- end of announcement header //-->



                                <!-- announcement body //-->
                                <div class="py-8">
                                    {!!  nl2br(e($announcement->message)) !!}

                                </div>
                                <!-- announcement body //-->


                                <!-- announcement links //-->
                                 @if ($announcement->link !='')
                                    <div class="text-sm">
                                        <i class="fa-solid fa-globe "></i> 
                                        <a href="{{ $announcement->link }}" class="underline text-blue-800 px-1" target="_blank">
                                            {{ $announcement->link}}
                                        </a>

                                    </div>
                                @endif

                                <!-- end of announcement links //-->
                                
                        </div>
                       

                </div><!-- end of top pane //-->


                <!-- bottom panel //-->
                <div class="flex flex-col  md:w-[60%] md:px-3 py-2 mt-8"><!-- Bottom pane //-->
                    <form action="{{ route('staff.announcements.comments.store', ['announcement'=>$announcement->id]) }}" method="POST">
                            @csrf

                            <div class="py-1">
                                    Share your thoughts... 
                            </div>
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

                            @foreach ($comments as $comment)
                                <div class="flex flex-row my-2">
                                        <div class="px-3 border-0">
                                                @if ($comment->sender->profile!=null && $comment->sender->profile->avatar!="" )
                                                
                                                    <img src="{{ asset('storage/'.$comment->sender->profile->avatar)}}" class='w-12 h-11 rounded-full' />
                                                    
                                                @else
                                                    <img class="w-12" src="{{ asset('images/avatar_64.jpg')}}" />  
                                                @endif
                                                
                                        </div>
                                        <div class="px-3 py-1 rounded-md bg-gray-100 w-full">
                                                <a href="{{ route('staff.profile.email_user_profile', ['email'=>$comment->sender->email]) }}" class="font-semibold text-sm hover:underline">
                                                        
                                                        @php
                                                            $surname = ucfirst(strtolower($comment->sender->surname));
                                                        @endphp

                                                        {{ $surname }} {{ $comment->sender->firstname }}
                                                </a>
                                                <div class="text-xs">
                                                        {{ $comment->created_at->format('l jS F, Y @ g:i a') }}
                                                </div>
                                                <div class="text-sm py-2">
                                                       {{ $comment->message }}
                                                </div>

                                                @if (Auth::user()->id == $announcement->user_id)
                                                    <div class="text-xs text-end px-2 py-1">
                                                        <form action="{{ route('staff.announcements.comments.delete_comment', ['comment'=>$comment->id]) }}" method="post">
                                                            @csrf
                                                            @method('delete')                                
                                                                <button type="submit" class='border px-3 py-1 border-red-400 rounded-md 
                                                                       hover:text-white'><i class="fas fa-trash text-gray-500"></i></button>
                                                        </form>
                                                    </div>
                                                @endif

                                        </div>
                                </div>
                            @endforeach
                        
                    </div>
                    <!-- end of list of messages //-->

                    

                                                                                

                </div><!-- end of bottom panel //-->


                <!-- end of bottom panel //-->


                
            </div>             
        </section>

    
    
        





        <!-- end of announcement //-->





    </div>
</x-staff-layout>