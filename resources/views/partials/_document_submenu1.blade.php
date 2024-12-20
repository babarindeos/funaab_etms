<section class="flex flex-col md:flex-row md:space-x-4">
    
    @if ($invigilation != null && $invigilation->count())
        <a href="{{ route('staff.exams.current_session.exams') }}" class="border border-green-600 py-2 px-4 rounded-md mt-1 font-semibold 
                    hover:bg-green-600 hover:text-white hover:shadow-md">
                My Invigilation
        </a>
    @endif



    @if ($timtec != null && $timtec->count())
        <a href="{{ route('staff.documents.create') }}" class="border border-green-600 py-2 px-4 rounded-md mt-1 font-semibold 
                        hover:bg-green-600 hover:text-white hover:shadow-md">
            My Supervision
        </a>
    @endif


    @if (Auth::user()->coordinator->count())
        <a href="{{ route('staff.courses.my_courses') }}" class="border border-green-600 py-2 px-4 rounded-md mt-1 font-semibold 
                        hover:bg-green-600 hover:text-white hover:shadow-md">
            My Courses
        </a>
    @endif

</section>
