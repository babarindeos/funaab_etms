<x-staff-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
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
                            {{ $circle->cell->name }} ({{ $circle->cell->code }})
                        </div>
                        <div class="text-gray-600 font-medium text-lg">
                            Announcements

                        </div>

                        

                    </div>
                    <div class="flex flex-row space-x-4">
                            @include('partials._circle_submenu')
                    </div>
            </div>
            <!-- end of navigation //-->
            
        </section>
        <!-- section //-->


        <!-- Announcement Section  //-->
        

        
        <section class="flex flex-col w-full py-2 mt-2 border-0">
                    <div class="flex flex-col">
                        <div class="flex justify-end py-1">
                                @if ($circle->user->announcement_permission != null && 
                                     $circle->user->announcement_permission->cell_id == $circle->cell_id && 
                                     $circle->user->announcement_permission == true)
                                        <a href="{{ route('staff.circles.create_announcement', ['circle'=>$circle->id]) }}" class="flex border border-1 bg-green-400 py-1 px-4 text-white 
                                            hover:bg-green-500
                                            rounded-md text-md" style="font-family:'Lato';font-weight:500;">New Announcement</a>
                                @endif
                        </div>
                    </div>


        @if ($announcements->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='8%' class="text-center font-semibold py-2 w-16">SN</th>
                                <th width='50%' class="font-semibold py-2 text-left">Subject</th>
                                <th width='22%' class="font-semibold py-2 text-left">Posted By</th>
                                <th width='20%' class="font-semibold py-2 text-left">Date Published</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($announcements->currentPage() - 1) * $announcements->perPage();
                            @endphp
                            @foreach($announcements as $announcement)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-2 pr-4">
                                    
                                    <div>
                                        <a href="" 
                                        class='text-blue-500 underline font-semibold' >
                                            <a class="font-semibold text-blue-800 underline" href="{{ route('staff.circles.show_announcement',['circle'=>$circle->id, 'announcement'=>$announcement->id]) }}">
                                                {{ $announcement->subject }}
                                            </a>
                                        
                                    </div>
                                    <div class='flex flex-col space-y-1 md:flex-row justify-between text-xs'>
                                        <div class="flex flex-col">
                                                <div class="flex flex-row space-x-2">
                                                    @if ($announcement->file != '' || $announcement->file != null)
                                                        <div>{{ $announcement->filetype }} ({{ $announcement->filesize }})</div>
                                                    @endif                                            
                                                </div>                                        
                                        </div>                                
                                    </div>
                                
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        @php
                                            $surname = ucfirst(strtolower($announcement->sender->surname))
                                        @endphp

                                            <div>
                                                    @if ($announcement->sender->profile != null || $announcement->sender->profile->avatar!="") 
                                                                <img src="{{ asset('storage/'.$announcement->sender->profile->avatar)}}" 
                                                                        class='w-8 h-8 rounded-full hover:ring hover:ring-gray-300' />
                                                    @else
                                                                <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" /> 
                                                    @endif
                                            </div>

                                            <div>
                                                            <a class="hover:underline" href="{{ route('staff.profile.email_user_profile',['email'=>$announcement->sender->email]) }}">
                                                                    @php
                                                                        $surname = ucfirst(strtolower($announcement->sender->surname))
                                                                    @endphp
                                                                    {{ $surname }} {{ $announcement->sender->firstname }}
                                                            </a>

                                            </div>
                                            
                                    </div>

                                </td>
                                <td width="20%" class="text-sm">
                                        <div class="px-0">
                                            {{ $announcement->created_at->format('l jS F, Y @ g:i a')}}
                                        </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $announcements->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Announcements
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Announcement Section //-->
    
        
    
    
        
    </div>
    


</x-staff-layout>