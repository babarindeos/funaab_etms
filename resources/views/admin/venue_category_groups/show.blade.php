<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Venue Category Group</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.venue_categories_group.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Venue Category Groups</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new college form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.venue_categories_group.store_category',['group'=>$venue_category_group->id] )}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-0 md:py-0  mt-8" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-0" >{{ $venue_category_group->name }}</h2>
                           
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
                
                <div class="flex flex-row w-full py-1 border-b">
                    Added Categories ({{ $added_categories->count() }})
                </div>

                @if (count($added_categories))
                        <div>
                                @php
                                    $counter = 0;
                                @endphp

                                @foreach($added_categories as $added_category)
                                    <div class='flex flex-row py-4 items-center'>
                                        {{ ++$counter }}. 
                                        <span class='px-4'>
                                            {{ $added_category->venue_category->name  }}
                                        </span>

                                        <span>
                                            <form action="{{ route('admin.venue_categories_group.remove_category',['group_item'=>$added_category->id]) }}" method='POST'>
                                                @csrf
                                                <button class='border py-1 px-3 rounded-md text-sm border-red-500 hover:bg-red-500 hover:text-white'>Remove</button>
                                            </form>
                                        </span>
                                    
                                    </div>
                                @endforeach
                        </div>
                @endif


            </div>


        </section>
        <!--end of added category //-->


    </div><!-- end of container //-->
</x-admin-layout>