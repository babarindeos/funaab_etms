<x-manager-layout>

<div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Announcements</h1>
                    </div>
                    <div>

                            <a href="{{ route('manager.announcements.create') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">New Announcement</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->





        <!-- Announcement Section  //-->     

        
        <section class="flex flex-col w-[95%] mx-auto py-2 mt-2 ">
                   


        @if ($announcements->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='10%' class="text-center font-semibold py-2 w-16">SN</th>
                                <th width='40%' class="font-semibold py-2 text-left">Subject</th>
                                <th width='20%' class="font-semibold py-2 text-left">Posted By</th>
                                <th width='10%' class="font-semibold py-2 text-left">Date Published</th> 
                                <th width='15%' class="font-semibold py-2 text-left">Actions</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($announcements->currentPage() - 1) * $announcements->perPage();
                            @endphp
                            @foreach($announcements as $announcement)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-8 pr-8">
                                    
                                    <div>
                                        <a href="" 
                                        class='text-blue-500 underline font-semibold' >
                                            <a class="font-semibold text-blue-800 underline" href="{{ route('manager.announcements.show',['announcement'=>$announcement->id]) }}">
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
                                                @if ($announcement->sender->profile != null) 
                                                    @if ($announcement->sender->profile->avatar != null || $announcement->sender->profile->avatar !='' )
                                                            <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" /> 
                                                    @else
                                                             
                                                            <img src="{{ asset('storage/'.$announcement->sender->profile->avatar)}}" 
                                                                        class='w-8 h-8 rounded-full hover:ring hover:ring-gray-300' />

                                                    @endif
                                                @else
                                                            
                                                            <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" /> 
                                                


                                                @endif
                                            </div>

                                            <div>
                                                            <a class="hover:underline" href="">
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
                                            {{ $announcement->created_at->format('l jS F, Y')}}
                                            <div class="text-xs">
                                                {{ $announcement->created_at->format('@ g:i a') }}
                                            </div>
                                        </div>
                                </td>
                                <td>
                                            <span class="px-1">
                                                <a class="bg-green-400 hover:bg-green-500 text-white rounded-md px-4 py-1 text-xs"
                                                    href="{{ route('manager.announcements.notify', ['announcement'=> $announcement->id]) }}">
                                                    Notify
                                                </a>
                                            </span>
                                            <span class="text-sm">
                                                <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('manager.announcements.edit', ['announcement' => $announcement->id]) }}">Edit</a>
                                            </span>
                                            <span> 
                                                <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('manager.announcements.confirm_delete', ['announcement'=> $announcement->id])}}"
                                                >Delete</a>
                                            </span>	

                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $announcements->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Announcements
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Announcement Section //-->
    
  

</div>

</x-manager-layout>