<x-admin-layout>
    <div class="flex flex-col w-full mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Delete Academic Session</h1>
                    </div> 
                    <div>
                        <a href="{{ route('admin.academic_sessions.index') }}" class="bg-green-600 text-white py-2 px-4 
                                        rounded-lg text-xs md:text-sm hover:bg-green-500">Academic Sessions</a>

                    </div>                  
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- delete Academic Session form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.academic_sessions.confirm_delete', ['academic_session' => $academic_session->id]) }} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >
                                
                            </h2>
                            Do you really wish to delete this Academic Session  ?
                            
                            <div class="py-2 text-lg font-semibold">
                                {{ $academic_session->name }} 
                            </div>
                        </div>


                       
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-red-400 py-4 px-4 text-white 
                                           hover:bg-red-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Delete Academic Session</button>
                        </div>
                        
                    </form><!-- end of new Cell Type form //-->
                <div>
        </section>
        <!-- end of new Academic Session form //-->


    </div><!-- end of container //-->
</x-admin-layout>