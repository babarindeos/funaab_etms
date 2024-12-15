<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Course Coordinator</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.courses.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Courses</a>

                            <a href="{{ route('admin.departments.index') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Departments</a>
                    </div>                
            </div>
            
        </section>
        <!-- end of page header //-->

        

        <!-- new coordinator form //-->
        <section class="mb-8">
                <div>
                    <form  action="{{ route('admin.courses.coordinators.store', ['course'=>$course->id])}} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Add Coordinator</h2>
                           
                        </div>


                        @include('partials._session_response')


                        <!-- Course long and short names //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="name" disabled class="readonly border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Course full name"
                                                                    
                                                                    value="{{ $course->title }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  
                                                                                                                                        

                                                                    @error('name')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of department name //-->


                        <!-- Users //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                            <select name="staff" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                     
                                                                     style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                     required
                                                                     >
                                                                    <option value=''>-- Select Staff --</option>
                                                                        @foreach($staff as $person)         
                                                                            @if ($coordinators->count())
                                                                                @foreach($coordinators as $coordinator)
                                                                                    @if ($person->user_id != $coordinator->user_id)
                                                                                        <option class='py-4' value="{{$person->user->id}}">{{$person->surname}} {{$person->firstname}} ({{$person->fileno}}) </option>

                                                                                    @endif
                                                                            
                                                                                @endforeach
                                                                            @else
                                                                                        <option class='py-4' value="{{$person->user->id}}">{{$person->surname}} {{$person->firstname}} ({{$person->fileno}}) </option>

                                                                            @endif
                                                                        @endforeach                                                                       
                                                                    </select>

                                                                     @error('staff')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                     @enderror
                            
                        </div>
                        
                        <!-- end of Users //-->

                        
                        

                        
                        

                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Add Coordinator</button>
                        </div>
                        
                    </form><!-- end of new department form //-->
                <div>
        </section>
        <!-- end of new coordinator form //-->


        <!-- reasons of coordinators //-->

        @if ($coordinators->count() )
        <section class="flex flex-col w-[80%] md:w-[60%] py-1 px-8 border-red-900 mx-auto ">
                <div class="flex flex-col w-[100%] mx-auto px-4">

                    <div class='py-4 font-semibold'>
                        Course Coordinators
                    </div>



                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                >
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='10%' class="text-center font-semibold py-2">SN</th>
                                <th width='35%' class="font-semibold py-2 text-left">Cooordinator</th>                                                
                                <th width='30%' class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach($coordinators as $coordinator)
                                <tr>
                                    <td class='text-center'>
                                        {{ ++$count }}.
                                    </td>
                                    <td class='py-4'>
                                        <a href="{{ route('admin.profile.user_profile',['fileno' => $coordinator->coordinator->staff->fileno]) }}" class='hover:underline'>
                                            {{ $coordinator->coordinator->staff->staff_title->title }} 
                                            {{ ucfirst(strtolower($coordinator->coordinator->staff->surname)) }} 
                                            {{ $coordinator->coordinator->staff->firstname }} ({{ $coordinator->coordinator->staff->fileno }} )
                                        </a>    

                                        
                                        <div class='text-xs'>
                                                {{ $coordinator->coordinator->staff->department->code }}, 
                                                {{ $coordinator->coordinator->staff->department->college->code }} 

                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.courses.coordinators.delete',['course'=>$coordinator->course_id, 'coordinator'=>$coordinator->id]) }}"  method="POST">
                                            @csrf
                                            @method('delete')
                                                <button class='border border-red-400 text-red text-xs px-4 py-2 rounded-lg 
                                                               hover:bg-red-400 hover:text-white'>Delete </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>


        </section>
        @endif


    </div><!-- end of container //-->
</x-admin-layout>