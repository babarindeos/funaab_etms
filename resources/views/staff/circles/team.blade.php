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
                            Team
                        </div>

                        

                    </div>
                    <div class="flex flex-row space-x-4">
                            @include('partials._circle_submenu')
                    </div>
            </div>
            <!-- end of navigation //-->
            
        </section>
        <!-- section //-->


        <!-- Team Section  //-->
        <!-- section //-->
        <section class="py-4 border-0">
            <div class="flex flex-col md:flex-row md:flex-wrap w-full mx-auto justify-center gap-4">
                @foreach ($circle->cell->users as $team)


                    <!-- Team member //-->
                    <div class="flex flex-col items-center p-8 border rounded-md shadow-lg w-full md:w-[calc(33%-1rem)]">
                        <div>
                            @if ($team->user->profile != null && $team->user->profile->avatar != '')
                                <img src="{{ asset('storage/'.$team->user->profile->avatar) }}" class="w-36 h-36 rounded-full" />
                            @else
                                <!-- Placeholder or alternate content -->
                                <img src="{{ asset('images/avatar.jpg')}}" class="w-36 h-36" />
                            @endif
                        </div>
                        <div class="p-2 text-lg font-medium text-center">
                            <a href="{{ route('staff.profile.email_user_profile', ['email' => $team->user->email]) }}" class="hover:underline">
                                {{ $team->user->surname }} {{ $team->user->firstname }}
                            </a>
                            <div class="text-sm">
                                {{ $team->user->profile->designation }}<br />{{ $team->role }}
                            </div>
                        </div>
                    </div>
                    <!-- end of team member //-->                   

                    

                @endforeach
            </div>
        </section>
        
        <!-- section //-->
    


        <!-- End of Team Section //-->

    </x-staff-layout>