<x-admin-layout>

    
    <div class="flex flex-col w-full mx-auto">
         <!-- page header //-->
         <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto">
        
                <div class="flex border-b border-gray-300 py-2 justify-between">
                        <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">User Profile</h1>
                        </div>
                        
                </div>
         </section>
    <!-- end of page header //-->
     

        
        <section class="flex flex-col md:flex-row rounded w-[95%] md:w-[93%] mx-auto mt-3 space-x-4">
                <div class="flex flex-col w-full  md:w-[30%] justify-center items-center 
                        border px-8 py-4 rounded-md">
                        <div class="">
                        @if ($userprofile->user->profile!=null && ($userprofile->user->profile->avatar != "" || $userprofile->user->profile->avatar != null))
                                <img src="{{ asset('storage/'.$userprofile->user->profile->avatar) }}" class="w-36 h-36 rounded-full" />
                        @else
                                <img src="{{ asset('images/avatar_150.jpg') }}" />
                        @endif
                        </div>
                        

                </div>
                <div class="flex flex-col justify-center md:border rounded-md md:w-[70%] py-4 px-4">
                        
                        <div class="mb-4  mx-[10%] md:mx-0 ">
                                <div class="text-xl font-semibold">
                                        {{ $userprofile->user->surname }} {{ $userprofile->user->firstname }} {{ $userprofile->user->middlename }}                                
                                </div>
                                @if ($userprofile->user->profile != null)
                                        <div class="text-sm">
                                                {{ $userprofile->user->profile->designation}}, {{ $userprofile->user->staff->fileno}}
                                        </div> 
                                @endif   
                                                       
                        </div>


                        <div class="py-4 mx-[10%] md:mx-0">
                                <div>
                                        {{ $userprofile->department->name}} ({{ $userprofile->department->code}})
                                </div>
                                <div>
                                        {{ $userprofile->department->college->name }} ({{ $userprofile->department->college->code}})
                                </div>                            
                        </div>


                        <div class="py-4 mx-[10%] md:mx-0">
                                <div>
                                        {{ $userprofile->user->email }}
                                </div>
                                <div>
                                        @if ($userprofile->user->profile != null)
                                                {{ $userprofile->user->profile->phone}}
                                        @endif
                                </div>

                        </div>
                </div>
        </section>


    


    </div>

</x-admin-layout>