<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 border-0 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Availability List</h1>
                    </div>  
                    <div>
                            <a href="{{ route('admin.exams.availability_list.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Availability List</a>

                            <a href="{{ route('admin.exams.availability_list.create') }}" class="border border-green-600 hover:bg-green-600 hover:text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Upload Records</a>
                           
                    </div>              
            </div>
            
        </section>
        <!-- end of page header //-->


        <section class="flex flex-col w-[90%] md:w-[95%] py-0 px-4 border-red-900 mx-auto">
                    <form  action="{{ route('admin.exams.availability_list.upload')}} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-[80%] items-center justify-center">
                                @csrf

                                

                                <div class="flex flex-col w-[100%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                                    <h2 class="font-semibold text-xl py-1" >Upload File</h2>
                                    <span class='text-sm'>Upload csv file (containing SP No. of Available Staff. No column heading)</span> 
                                </div>


                                @include('partials._session_response')

                                <!-- document file //-->
                                <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-2">
                                
                                
                                            <input type="file" name="document" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" 
                                            
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                            accept=".csv"
                                            required />
                                                
                    
                                            @error('document')
                                                <span class="text-red-700 text-sm">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                            
                                </div>
                                <!-- end of document file //-->

                                <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] mt-1">
                                        <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                                      hover:bg-gray-500 rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Upload File</button>
                                </div>


                                @if ($failuploads->count())
                                        <!-- List of failed Upload //-->
                                        <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-8">
                                                <a id='btn_failupload' href="#" class='hover:underline text-lg text-red-800 font-semibold'>
                                                    Failed Upload ({{ $failuploads->count() }})
                                                </a>
                                                <table class="border hidden" id='tbl_failupload'>
                                                    <thead>
                                                        <tr class='bg-gray-100'>
                                                            <th width='20%' class='text-center py-4'>SN</th>
                                                            <th class="text-left">File No.</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $counter = 0;
                                                        @endphp
                                                        @foreach($failuploads as $failupload)
                                                            <tr class='odd:bg-white even:bg-gray-50'>
                                                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                                                <td>{{ $failupload->fileno }}</td>
                                                            </tr>
                                                        @endforeach                                            

                                                    </tbody>
                                                </table>
                                        </div>
                                        <!-- end of failed Upload //-->
                                @endif
                            
                           
                    </form>        
                    
                    
                   

        </section>


        @if ($availability_list->count())

            <!-- List of records //-->
            <div class="flex flex-col mx-auto w-[100%] md:w-[100%] mt-2 mb-8 md:px-10 items-center justify-center border rounded-md ">
                <div class="flex flex-col border-0 border-red-800 w-[100%] md:w-[100%]  md:px-2 py-2  mb-8">
                        <div class='text-lg font-medium py-2 mt-2 '>
                            Availability List ({{ $availability_list->count() }})
                        </div>
                        <table class="w-full">
                            <thead>
                                <tr class='bg-green-100'>
                                    <th width='5%' class='py-4'>SN</th>
                                    <th width='25%' class='text-left'>Staff</th>
                                    <th width='40%' class='text-left'>Department</th>
                                    <th class='text-left'>College</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach($availability_list as $user)
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td class=''>
                                            <a class="hover:underline" href="{{ route('admin.profile.user_profile',['fileno'=>$user->staff->fileno]) }}">
                                                {{ $user->staff->staff_title->title  }} 
                                                {{ ucfirst(strtolower($user->surname))  }}
                                                {{ $user->firstname  }}
                                                ({{ $user->staff->fileno }})
                                            </a>
                                    </td>
                                    <td>
                                        {{ $user->department_name}} ({{ $user->department_code }})                                    
                                    </td>
                                    <td>
                                    <div>
                                        {{ $user->college_code }}
                                        
                                    </td>
                                    <td class='text-center py-4'>
                                        <form action="{{ route('admin.exams.availability_list.delete', ['user'=>$user->id]) }}" method="POST">
                                            @csrf
                                            @method("delete")

                                            <button class='border border-red-600 py-2 px-4 text-xs rounded-2xl hover:bg-red-500 hover:text-white'>
                                                Remove
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                </div>
                    
            </div>
            <!-- end of records //-->
        @endif


    </div><!-- end of container //-->

</x-admin-layout>

<script>
$(document).ready(function(){
   $("#btn_failupload").bind('click', function(){
        $('#tbl_failupload').toggle();
   })
});
</script>