<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Venue</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.venues.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Venues</a>
                           
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
                            <h2 class="font-semibold text-xl py-0" >{{ $venue->name }}</h2>
                           
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
                
                
                                <table width='100%' class="">
                                        <tbody>
                                            <tr class="border-b border-t" >
                                                <td width='20%' class='py-6 px-2 bg-gray-100 font-medium'>Type</td> 
                                                <td class='px-4' >{{ $venue->venue_type->name }}</td>                                                                                        
                                            </tr>
                                            <tr class="border-b">
                                                <td width='20%' class='py-6 px-2 bg-gray-100 font-medium'>Category</td>     
                                                <td class='px-4' >{{ $venue->venue_category->name }}</td>                                                                                    
                                            </tr>
                                            <tr class="border-b">
                                                <td width='20%' class='py-6 px-2 bg-gray-100 font-medium'>Student Capacity</td>
                                                <td class='px-4'>{{ $venue->student_capacity }}</td>                                                                                         
                                            </tr>
                                            <tr class="border-b">
                                                <td width='20%' class='py-6 px-2 bg-gray-100 font-medium'>Max. Invigilators</td>
                                                <td class='px-4'>{{ $venue->max_invigilators }}</td>                                                                                         
                                            </tr>
                                        
                                        <tbody>
                                               
                                        </tbody>
                                </table>
                     


            </div>


        </section>
        <!--end of added category //-->


    </div><!-- end of container //-->
</x-admin-layout>