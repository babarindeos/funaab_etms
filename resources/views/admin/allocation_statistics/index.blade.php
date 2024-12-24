<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[100%] py-8 px-4 border-0 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Allocation Statistics</h1>
                    </div>  
                      
            </div>
            
        </section>
        <!-- end of page header //-->

       

            <!-- List of records //-->
            <div class="flex flex-col mx-auto w-[90%] md:w-[100%] md:px-2  items-center justify-center border-0 rounded-md ">
                <div class="flex flex-col border-0 border-gray-200 w-[100%] md:w-[60%]  md:px-2 py-2  mb-8">
                        <div class='text-lg font-medium py-2 mt-0 '>
                            {{ $exam->name }}
                        </div>
                        <table class="w-full border">
                            
                            <tbody>
                                
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td width='40%' class='text-left py-8 px-4'> Examination Schedules</td>
                                    <td class='py-4 '>
                                           {{ $exam_schedules_count }}
                                    </td>
                                    

                                </tr>

                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-left py-8 px-4'> Total Invigilator Slots</td>
                                    <td class='py-4'>
                                           {{ $exam_schedule_total_invigilators }}
                                    </td>
                                    

                                </tr>

                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-left py-8 px-4'> Availability</td>
                                    <td class='py-4'>
                                           {{ $availability_count }}
                                    </td>
                                    

                                </tr>

                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-left py-8 px-4'> No. of Professors</td>
                                    <td class='py-4'>
                                           {{ $professor_count }}
                                    </td>
                                    

                                </tr>

                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-left py-8 px-4'> Professors's Invigilator Slots</td>
                                    <td class='py-4'>
                                           {{ $professor_count * 5}}
                                    </td>
                                    

                                </tr>

                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-left py-8 px-4'> Other User's Status No.</td>
                                    <td class='py-4'>
                                           {{ $other_staff_except_prof }}
                                    </td>
                                    

                                </tr>

                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class='text-left py-8 px-4'> Other Roles Invigilator Slots</td>
                                    <td class='py-4'>
                                           {{ $other_staff_except_prof * 10}}
                                    </td>
                                    

                                </tr>
                                

                            </tbody>
                        </table>
                </div>
                    
            </div>
       



    </div><!-- end of container //-->

</x-admin-layout>