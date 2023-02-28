<div class="flex p-6 min-h-screen justify-center bg-gray-50 dark:bg-gray-900">
    <div class="w-100 overflow-hidden rounded-lg">
        <section class="flex h-full items-stretch text-white ">
            <div class="lg:flex flex-col justify-end w-5/12 hidden bg-no-repeat bg-cover relative items-center"
                 style="background-color: rgb(107 119 141)">
                <div class="absolute -right-20 top-20 m-0 w-full border rounded-lg overflow-hidden z-10 p-6" style="background-color: rgb(38 56 89)">
                    {{ $text }}
                </div>
                <div class="bottom-0 text-center right-0 left-0 flex justify-center px-3">
                    <img src="{{asset('images/financial_login_background.png')}}" class="w-100 bg-gray">
                </div>
            </div>
            <div class="lg:w-7/12 w-full flex items-center justify-center text-center md:px-16 px-0 z-0"
                 style="background-color: rgb(23 34 59);">
                <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center"
                     style="background-color: rgb(23 34 59);">
                    <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
                </div>
                <div class="w-full z-20">
                    <div class="flex flex-col items-center mb-20">
                        <h1 class="">
                            <img src="{{asset('images/logo_hand.png')}}">
                        </h1>
                        <div>
                            <h2 class="font-sans text-3xl font-bold lg:text-6xl">FinancialApp</h2>
                        </div>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </section>
    </div>
</div>
