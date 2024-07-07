<!-- login -->
<div class="auth modal fade" id="loginModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <i class="bi bi-x-lg" type="button" id="postcode_close" class="btn-close" style="color: #268639;"
                    data-bs-dismiss="modal"></i>
            </div>
            <form method="POST"  action="{{ route('login') }}">
                @csrf
                <div class="modal-body">

                    <div class="w-full max-w-md bg-white text-black flex flex-col justify-center space-y-4 pt-6 rounded-3xl overflow-hidden">

                        <div class="flex flex-col justify-center items-center space-y-5">
                            
                            <div class="w-[80%] flex justify-between items-center">
                                <div class="text-base font-bold"><a href="#" style="font-size: 25px;font-weight: 600;">Logga In</a></div> 
                                <!-- <div class="text-sm"><a href="/" class="text-black" style="font-family: avbryt">Annullera</a></div> -->
                            </div> 
                            <div class="w-[80%] p-2 bg-white text-gray-400 rounded-md overflow-hidden border-2 border-gray-300 shadow-sm">
                                <p class="text-base font-semibold">E-postadress</p>
                                <input type="email" class="w-full focus:ring-0 focus:outline-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
                                @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                            <div class="w-[80%] p-2 bg-white text-gray-400 rounded-md border-2 border-gray-300">
                                <p class="text-base font-semibold">Lösenord</p>
                                <input type="password" class="w-full focus:ring-0 focus:outline-none @error('password') is-invalid @enderror" name="password" >
                                @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <button type="submit"  class="items-center w-[80%] px-8 py-2 text-lg font-medium text-center text-white bg-green-700 rounded-md hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Logga in
                            </button>
                            <a href="{{ url('password/reset') }}" class="text-sm font-medium Glömttext-base  hover:underline-offset-4" style="padding:10px 20px; border-radius:5px;">Glömt mitt lösenord</a>
                            </form>
                            <div class="w-[80%] bg-gray-300 text-center py-3" style="border-radius: 0px 0px 20px 20px;">
                            <a href="{{route('register')}}"  class="text-md font-medium Glömttext-base  hover:underline-offset-4" >Jag vill bli kund</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>
