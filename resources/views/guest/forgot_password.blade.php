<x-guest-layout>
<div class="flex flex-col flex-1 w-full border-0">

    <div class="flex flex-col md:flex-row h-full">
    


            <!-- Right  panel //-->
            <div class="flex flex-col w-full  md:w-100%] items-center justify-center py-4">

                <section class="flex flex-col w-full border border-0">
                    <div class="flex flex-col w-full border border-0" >
                    <form  action="{{ route('guest.password.email_verification') }}" method="POST" class="flex flex-col mx-auto w-[30%] items-center justify-center space-y-2">
                            @csrf


                            @if (session('error'))
                                @if (session('status') == 'success')
                                    <div class='text-xl w-full md:w-[80%] text-center py-4'> {{ session('message') }} </div>
                                @endif
                            @endif

                            <div class="flex flex-col w-[80%] md:w-[80%] py-4 mt-4 font-serif" >
                                <h2 class="font-semibold text-xl py-1" >Password Reset</h2>                               
                                
                            </div>

                            <!-- username //-->
                            <div class="w-[80%] py-1">

                                <input type="text" name="email" class="border border-1 border-gray-400 bg-gray-50
                                                                        w-full p-4 rounded-md 
                                                                        focus:outline-none
                                                                        focus:border-blue-500 
                                                                        focus:ring
                                                                        focus:ring-blue-100" placeholder="Email"
                                                                        
                                                                        value="{{ old('email') }}"
                                                                        
                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                        required
                                                                        />  
                                                                                                                                            

                                                                        @error('email')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                        @enderror
                                
                            </div><!-- end of username //-->

                           

                           

                            <!-- submit //-->
                            <!-- submit button //-->
                            <div class="flex flex-col border-red-900 w-[80%] md:w-[80%] mt-8 py-1">
                                <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                               hover:bg-gray-500
                                               rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Submit</button>
                            </div>

                            <!-- end of submit //-->

                            


                        </form>
                    </div>
                </section>
                    
            </div>
            <!-- end of right panel //-->
    </div>


</div>
</x-guest-layout>