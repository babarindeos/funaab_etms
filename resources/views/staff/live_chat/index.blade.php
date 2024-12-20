<x-staff-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Exam Live Chat             
                </div>

                <div>

                            <a href="{{ route('staff.exams.invigilations.my_schedule',['exam'=>$exam->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">My Schedule</a>
                </div>
                
        </section>

       
        <!-- Current Session Semester Information //-->
        <section class="flex flex-col py-1 mt-4" >
                <div class="flex flex-col border border-0">
                        <div class='text-xl'>
                            {{ $exam->semester->academic_session->name }} Academic Session 
                        </div>
                        <div class='text-xl'>
                            {{ ucfirst(strtolower($exam->semester->name)) }} Semester
                        </div>
                </div>
        </section>
        <!-- end of current session semesters information //-->


    <!-- Create Chat  Section  //-->
    
       
    
        <section class="py-8">
                <div>
                    <form  action="{{ route('staff.exams.live_chat.store',['exam'=>$exam->id]) }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >{{ $exam->name }}</h2>
                            Share your thoughts ...
                        </div>
    
    
                        @include('partials._session_response')
                        
                        
                          
    
                       
    
                        <!-- Message //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <textarea name="message" rows="5" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" 
                                                                    
                                                                    value="{{ old('message') }}"
                                                                    maxlength = "200"
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    
                                                                    >  </textarea>
                                                                    <div class="text-xs text-gray-600">Max: 200 chars</div>
                                                                                                                                        
    
                                                                    @error('message')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of message //-->                        

                        
                        <!--  //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-1">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Submit Message</button>
                        </div>
                        <!-- //-->
                        
                    </form><!-- end of new Live Chat //-->
                <div>  
            

        </section>
        <!-- End of new Live Chat //-->




<!-- list of messages //-->
<!-- list of messages //-->
        <div class="flex flex-col w-[56%] mx-auto">
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
                                            <a href="#" class="font-semibold text-sm hover:underline">
                                                    
                                                    @php
                                                        $surname = ucfirst(strtolower($comment->sender->surname));
                                                    @endphp

                                                   {{ $comment->sender->staff_title->title }} {{ $surname }} {{ $comment->sender->firstname }}
                                            </a>
                                            <div class="text-xs">
                                                    {{ $comment->created_at->format('l jS F, Y @ g:i a') }}
                                            </div>
                                            <div class="text-sm py-2">
                                                {{ $comment->message }}
                                            </div>

                                            @if (Auth::user()->id == $comment->user_id)
                                                <div class="text-xs text-end px-2 py-1">
                                                    <form action="{{ route('staff.exams.live_chat.delete', ['comment'=>$comment->id]) }}" method="post">
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
        </div>
<!-- end of list of messages //-->






        <!-- end of list of messages //-->

    </div>

</x-staff-layout>