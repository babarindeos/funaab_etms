<x-staff-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        <section class="border-b border-gray-200 py-2 mt-4">
                <div class="text-2xl font-semibold ">
                    My Reports               
                </div>
                
        </section>
    
        
        
        @if (count($my_reports))
                
            <section class="flex flex-col py-1  mt-4 justif-end">
                <div class="flex justify-end border border-0">
                
                    <input type="text" name="search" class="w-3/5 md:w-2/5 border border-1 border-gray-400 bg-gray-50
                                p-2 rounded-md 
                                focus:outline-none
                                focus:border-blue-500 
                                focus:ring
                                focus:ring-blue-100" placeholder="Search"                
                            
                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                    
                    />  
                </div>
                
            </section>

            <section class="flex flex-col py-2 ">
                <table class="table-auto border-collapse border border-1 border-gray-200" 
                            >
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="text-center font-semibold py-4 w-16">SN</th>
                            <th class="font-semibold py-2 text-left">Subject</th>
                            <th class="font-semibold py-2 text-left">Message</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = ($my_reports->currentPage() - 1) * $my_reports->perPage();
                        @endphp
                        @foreach($my_reports as $report)
                            <tr class="border border-b border-gray-200 ">
                                <td width='6%' class='text-center py-8'>{{ ++$counter }}.</td>
                                <td class="py-2 pr-4">
                                    
                                    {{ $report->subject}}

                                    
                                    <div class="px-0 text-xs py-2">
                                            {{ $report->created_at->format('l jS F, Y @ g:i a')}}
                                    </div>
                                
                                </td>
                                <td width="60%" class="">
                               
                                    {{ $report->message }}

                                    @if ($report->file != null)
                                            <div class='text-xs underline py-2'>
                                                <i class="fa-solid fa-paperclip text-xs"></i> <a target='_blank' href="{{ asset('storage/'.$report->file) }}"> File Attachment</a>
                                            </div>
                                    @endif

                                </td>
                                
                            </tr>
                        @endforeach
                        
                    </tbody>

                </table>

                {{ $my_reports->links() }}


            </section>
        @else
            <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
                <div class="flex flex-row border-0 justify-center 
                            text-2xl font-semibold text-gray-300 py-8">
                        There is currently no Reports
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