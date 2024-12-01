<x-admin-layout>
    <div class="flex flex-col w-full border-0 border-blue-900 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-2 mt-6 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Remuneration Rates</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.remuneration_rates.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Remuneration Rate</a>

                            
                    </div>
            </div>
        </section>
        <!-- end of page header //-->



        @if (count($remuneration_rates) > 0)
                

                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-2 md:px-4">
                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                >
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='10%' class="text-center font-semibold py-2">SN</th>
                                <th width='30%' class="font-semibold py-2 text-left">Name</th>                                
                                <th width='30%' class="font-semibold py-2 text-left">Amount</th>
                                <th width='10%' class="font-semibold py-2 text-left">Point</th>
                                <th width='30%' class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($remuneration_rates->currentPage() -1 ) * $remuneration_rates->perPage();
                            @endphp

                                @foreach ($remuneration_rates as $rate)
                                <tr class="border border-b border-gray-200">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td>                                        
                                            {{ $rate->name }}                                 
                                        
                                    </td>
                                    
                                    <td>   
                                        @php
                                            $amount = number_format($rate->amount,2)
                                        @endphp
                                        {{ $amount}}
                                    </td>
                                    <td>   
                                       
                                        {{ $rate->point}}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-sm">
                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.remuneration_rates.edit', ['rate'=>$rate->id])}}">Edit</a>
                                        </span>
                                        <span> 
                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.remuneration_rates.confirm_delete', ['rate'=>$rate->id]) }}"
                                            >Delete</a>
                                        </span>
                                    </td>

                                </tr>
                                @endforeach
                            
                            
                        </tbody>

                    </table>

                    <div class="mt-1">
                        {{ $remuneration_rates->links() }}

                    </div>


                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] border-0 mx-auto px-4 py-6">
                        <div class="flex flex-row justify-center items-center text-2xl font-bold text-gray-300">
                            There is currently no Remuneration Rates
                        </div>
                </section>
        @endif
        
        
    </div>
</x-admin-layout>

