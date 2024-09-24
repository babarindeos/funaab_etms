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
                        <a href="{{ route('staff.circles.create_announcement', ['circle'=>$circle->id]) }}" class="flex border border-1 bg-green-400 py-1 px-4 text-white 
                         hover:bg-green-500
                           rounded-md text-md" style="font-family:'Lato';font-weight:500;">New Announcement</a>
                </div>
            </div>

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
                            <div>
                                {{ $announcement->sender->surname}} {{ $announcement->sender->firstname}}
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


        </section>

        <!-- end of Announcement Section //-->
    
        
    
    
        
    </div>
    


</x-staff-layout>