<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Venue Category</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.venue_categories.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Venue Category</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new college form //-->
        <section>
                <div>
                    <form  action=" " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-0 md:py-0  mt-8" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-0" >{{ $venue_category->name }}</h2>
                           
                        </div>

                        @include('partials._session_response')
                        
                        

                       

                        

                      
                        
                    </form><!-- end of new venue type form //-->
                <div>
        </section>
        <!-- end of new venue type form //-->



        <!-- Added Category //-->
         <section class="flex flex-col mx-auto w-[90%] items-center justify-center border-0">
             
             <!-- Added Venue Categories //-->
             <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-0 border-0 mt-4">
                
                <div class="flex flex-row w-full py-2 border-b text-lg">
                    Venues ({{ $venue_category->venues->count() }})
                </div>

                @if (count($venue_category->venues))
                        <div class='border'>
                                @php
                                    $counter = 0;
                                @endphp

                                <table width='100%' class="">
                                        <thead>
                                            <tr class='bg-gray-100'>
                                                <th width='10%' class='py-4'>SN</th>
                                                <th class='text-left'>                                                    
                                                            Venue
                                                    
                                                </th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($venue_category->venues as $venue)
                                                    <tr class=' py-6 items-center border-b'>
                                                        <td class='text-center py-6'>
                                                            {{ ++$counter }}. 
                                                        </td>
                                                        <td class=''>
                                                                <a class='hover:underline' href="{{ route('admin.venues.show', ['venue'=>$venue->id]) }}">
                                                                    {{ $venue->name  }}
                                                                </a>
                                                        </td>                                                   
                                                    
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                </table>
                        </div>
                @endif


            </div>


        </section>
        <!--end of added category //-->


    </div><!-- end of container //-->
</x-admin-layout>