<x-staff-layout>

<div class="flex flex-col border-0 w-[95%] mx-auto">
        <section class="border-b border-gray-200 py-4 mt-2">
                <div class="text-2xl font-semibold ">
                    My Invigilation Schedule              
                </div>
                
        </section>
    
        
        
    @if ($current_semester != null)
                <!-- Current Session Semester Information //-->
                <section class="flex flex-col py-1 mt-4" >
                    <div class="flex flex-col border border-0">
                            <div class='text-xl'>
                                {{ $current_semester->academic_session->name }} Academic Session 
                            </div>
                            <div class='text-xl'>
                                {{ ucfirst(strtolower($current_semester->name)) }} Semester
                            </div>


                            <div class="w-1/2 mx-auto">
                                <div class="py-16 border-0 w-full ">
                                        <div class='text-3xl py-2 border-b'>
                                                Examinations
                                        </div>
                                        <div class='py-8'>
                                            <table>
                                                @foreach( $current_semester->exams as $exam)
                                                    <tr>
                                                        <td class='text-lg'>
                                                                <a class='hover:underline' href="{{ route('staff.exams.invigilations.my_schedule', ['exam'=> $exam->id]) }}">
                                                                        {{ $exam->name }}                                                                    
                                                                </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                </div>
                            </div>


                    </div>
                </section>
                <!-- end of current session semesters information //-->

           

            
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
                    <div class="flex flex-row border-0 justify-center 
                                text-2xl font-semibold text-gray-300 py-8">
                            No Academic Semeser is currently set
                    </div>
                </section>
        @endif
        
</div>
    
</x-staff-layout>

<script>
    $(document).ready(function() {
        $("input[name='search']").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            
            $("table tbody tr").filter(function() {
                // Get the text content excluding the title link
                // Get the text content excluding the title link
                var rowText = $(this).find("td").not(":first").text().toLowerCase();
                $(this).toggle(rowText.indexOf(value) > -1 || $(this).find("td").length === 1); // Keep the heading row visible
            });
        });
    });
</script>

