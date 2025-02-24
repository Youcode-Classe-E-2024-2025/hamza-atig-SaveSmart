<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>smartsave</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="top-0 py-1 lg:py-2 w-full bg-transparent lg:relative z-50">
        <nav class="z-10 sticky top-0 left-0 right-0 max-w-4xl xl:max-w-5xl mx-auto px-5 py-2.5 lg:border-none lg:py-4">
            <div class="flex items-center justify-between">
                <button>
                    <div class="flex items-center space-x-2">
                        <h2 class="text-black  font-bold text-2xl">Smartsave</h2>
                    </div>
                </button>
                <div class="hidden lg:block">
                    <ul class="flex space-x-10 text-base font-bold text-black/60 ">
                        <li
                            class="hover:underline hover:underline-offset-4 hover:w-fit transition-all duration-100 ease-linear">
                            <a href="#">Home</a>
                        </li>
                        <li
                            class="hover:underline hover:underline-offset-4 hover:w-fit transition-all duration-100 ease-linear">
                            <a href="#">Our services</a>
                        </li>
                        <li
                            class="hover:underline hover:underline-offset-4 hover:w-fit transition-all duration-100 ease-linear">
                            <a href="#">About</a>
                        </li>
                        <li
                            class="hover:underline hover:underline-offset-4 hover:w-fit transition-all duration-100 ease-linear">
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="hidden lg:flex lg:items-center gap-x-2">
                    <a class="flex items-center text-black  justify-center px-6 py-2.5 font-semibold"
                        href="/signup">Sign up</a>
                    <a class="flex items-center justify-center rounded-md bg-[#4A3BFF] text-white px-6 py-2.5 font-semibold hover:shadow-lg hover:drop-shadow transition duration-200"
                        href="/login">Login</a>
                </div>
                <div class="flex items-center justify-center lg:hidden">
                    <button class="focus:outline-none text-slate-200 "><svg stroke="currentColor" fill="currentColor"
                            stroke-width="0" viewBox="0 0 20 20" aria-hidden="true"
                            class="text-2xl text-slate-800  focus:outline-none active:scale-110 active:text-red-500"
                            height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg></button>
                </div>
            </div>
        </nav>
    </header>
    <main class="h-[200vh]">
        <section class="mx-auto  max-w-[1440px] min-w-[280px] py-8 px-4 sm:px-8 md:px-10 lg:0px-20 ">
            <div
                class="w-full rounded-[50px] sm:rounded-[60px] md:rounded-[70px] lg:rounded-[80px] bg-[#f9b800]   flex flex-col lg:flex-row  items-center  py-6 sm:py-9 md:py-11 lg:py-14  px-2  sm:px-4 md:px-8 xl:px-16">
                <img class="w-full lg:w-1/2 xl:w-full max-w-[550px] lg:order-2" src="https://iili.io/2ysFUen.png"
                    alt="">
                <div class="text-center md:text-left">
                    <h1
                        class="text-4xl leading-[48px] md:text-5xl md:leading-[58px] lg:text-[50px] lg:leading-[70px] font-bold mb-6 md:mb-12">
                        Save Money with SmartSave
                    </h1>
                    <span class="text-xl leading-[34px] underline font-semibold sm:text-[24px] mb-3 mt-5">
                        Get Cashback on Your Purchases!

                    </span><br>
                    <p class="text-xl leading-[27px]  font-normal sm:text-[24px] mb-8 md:mb-12">
                        With SmartSave, you can earn cashback on your purchases, save money on your daily expenses, and
                        make the most of your hard-earned cash.

                    </p>
                    <button
                        class="w-full flex items-center  justify-between outline-gray-600 max-w-[350px] text-xl  font-bold sm:text-lg  rounded-[38px] bg-[#262626] text-white py-4 px-6 sm:px-9"><span>
                            Get Started
                        </span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            fill="#fff" height="20px" width="20px" version="1.1" viewBox="0 0 330 330"
                            xml:space="preserve">
                            <path id="XMLID_27_"
                                d="M15,180h263.787l-49.394,49.394c-5.858,5.857-5.858,15.355,0,21.213C232.322,253.535,236.161,255,240,255  s7.678-1.465,10.606-4.394l75-75c5.858-5.857,5.858-15.355,0-21.213l-75-75c-5.857-5.857-15.355-5.857-21.213,0  c-5.858,5.857-5.858,15.355,0,21.213L278.787,150H15c-8.284,0-15,6.716-15,15S6.716,180,15,180z">
                            </path>
                        </svg></button>
                </div>
            </div>
        </section>
        <section class="w-full h-screen">
            <h1 style="font-family: 'Lato', sans-serif;" class="text-5xl md:text-5xl font-semibold mb-2 mt-8 pl-10">
                Testimonials</h1>
            <div class="flex flex-col lg:grid lg:gap-4 2xl:gap-6 lg:grid-cols-4 2xl:row-span-2 2xl:pb-8 ml-2 pt-4 px-6">
                <!-- Beginning of the component about Daniel Clifford -->
                <div
                    class="bg-indigo-600 lg:order-1 lg:row-span-1 2xl:row-span-1 lg:col-span-2 rounded-lg shadow-xl mb-5 lg:mb-0">
                    <div class="mx-6 my-8 2xl:mx-10">
                        <img class="w-8 md:w-9 lg:w-10 2xl:w-20 h-8 md:h-9 lg:h-10 2xl:h-20 rounded-full border-2 ml-1 lg:ml-3 2xl:ml-0 md:-mt-1 2xl:-mt-4"
                            src="https://images.pexels.com/photos/3775534/pexels-photo-3775534.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
                        <h1
                            class="text-white text-xs md:text-base 2xl:text-2xl pl-12 lg:pl-16 2xl:pl-20 -mt-8 md:-mt-10 lg:-mt-11 2xl:-mt-20 2xl:mx-8">
                            Abigail Williams</h1>
                        <h2
                            class="text-white text-opacity-50 text-xs md:text-base 2xl:text-2xl pl-12 lg:pl-16 2xl:pl-20 2xl:my-2 2xl:mx-8">
                            Happy Saver</h2>
                    </div>
                    <div class="-mt-6 relative">
                        <p class="text-white text-xl 2xl:text-4xl font-bold px-7 lg:px-9 2xl:pt-6 2xl:mx-2">I was
                            able to save and manage my money easily using this website. It's really easy to use and
                            understand, and the customer support is top notch!</p>
                        <br />
                        <p
                            class="text-white text-opacity-50 font-medium md:text-sm 2xl:text-3xl px-7 lg:px-9 mb-3 2xl:pb-8 2xl:mx-2">
                            “ I was a bit skeptical at first, but once I started using the website, I was amazed at how
                            much I was able to save. The budgeting tools are really helpful and the customer support is
                            always there to help. I've already recommended this website to my friends and family. I've
                            been using it for a few months now and I've been able to save a significant amount of money.
                            The website is very user-friendly and easy to navigate, and the customer support is always
                            responsive and helpful. I've tried other budgeting apps before, but this one is by far the
                            best. I highly recommend it to anyone who wants to save money and manage their finances
                            effectively. ”</p>
                    </div>
                </div>
                <!-- Ending of the component about Daniel Clifford -->

                <!-- Beginning of the component about Jonathan Walters -->
                <div
                    class="bg-gray-900 lg:order-2 lg:row-span-1 2xl:row-span-1 lg:col-span-1 rounded-lg shadow-xl pb-4 mb-5 lg:mb-0">
                    <div class="mx-8 2xl:mx-10 my-10">
                        <img class="w-8 md:w-9 2xl:w-20 h-8 md:h-9 2xl:h-20 rounded-full border-2 -ml-1 -mt-2 lg:-mt-4"
                            src="https://images.pexels.com/photos/634021/pexels-photo-634021.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
                        <h1
                            class="text-white text-xs md:text-base 2xl:text-2xl pl-11 md:pl-12 2xl:pl-24 -mt-8 md:-mt-10 2xl:-mt-16">
                            Jonathan Walters</h1>
                        <h2
                            class="text-white text-xs md:text-base 2xl:text-2xl text-opacity-50 pl-11 md:pl-12 2xl:pl-24">
                            Happy Saver</h2>
                    </div>
                    <div class="-mt-8 mx-1 lg:mx-2">
                        <p
                            class="text-white text-lg lg:text-xl 2xl:text-4xl font-semibold pt-1 px-6 2xl:px-8 lg:pl-5 lg:pr-8">
                            I was able to save money easily using this website</p>
                        <br />
                        <p
                            class="text-white text-opacity-50 font-medium md:text-sm 2xl:text-3xl pl-6 lg:pl-5 pr-4 -mt-1 lg:mt-6 2xl:mt-2 2xl:px-8">
                            “ I was a bit skeptical at first, but once I started using the website, I was amazed at how
                            much I was able to save. The budgeting tools are really helpful and the customer support is
                            always there to help. I've already recommended this website to my friends and family. ”</p>
                    </div>
                </div>
                <!-- Ending of the component about Jonathan Walters -->

                <!-- Beginning of the component about Jeanette Harmon -->
                <div
                    class="bg-primary-color-white lg:order-3 lg:row-span-2 2xl:row-span-1 lg:col-span-1 rounded-lg shadow-xl mb-5 lg:mb-0 2xl:mb-8">
                    <div class="mx-8 my-10 lg:my-8">
                        <img class="w-8 md:w-9 lg:w-11 2xl:w-20 h-8 md:h-9 lg:h-11 2xl:h-20 rounded-full border-2 -mt-3 -ml-1 lg:-ml-0"
                            src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
                        <h1
                            class="primary-color-blackish-blue text-xs md:text-base 2xl:text-2xl pl-11 md:pl-12 lg:pl-14 2xl:pl-24 -mt-8 md:-mt-10 lg:-mt-11 2xl:-mt-16">
                            Jeanette Harmon</h1>
                        <h2
                            class="primary-color-blackish-blue-opacity text-xs md:text-base 2xl:text-2xl pl-11 md:pl-12 lg:pl-14 2xl:pl-24">
                            Happy Saver</h2>
                    </div>
                    <div class="-mt-4 ml-5 mr-11">
                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-bold px-2 lg:px-3 -mt-6 lg:-mt-5 2xl:mt-12 2xl:pb-6">
                            An excellent money saving system</p>
                        <br />
                        <p
                            class="primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl pl-2 lg:pl-3 lg:pr-4 mb-6 2xl:pt-2 -mt-3">
                            “ I was able to save money easily using this website. The budgeting tools are really helpful
                            and
                            the customer support is always there to help. I've already recommended this website to my
                            friends and family. ”</p>
                    </div>
                </div>
                <!-- Ending of the component about Jeanette Harmon -->

                <!-- Beginning of the component about Patrick Abrams -->
                <div
                    class="bg-purple-800 lg:order-4 lg:row-span-2 2xl:row-span-1 col-span-2 rounded-lg shadow-xl mb-5 lg:mb-0 2xl:mb-8 lg:pb-14 2xl:pb-20">
                    <div class="mx-8 my-8">
                        <img class="w-8 md:w-9 lg:w-10 2xl:w-20 h-8 md:h-9 lg:h-10 2xl:h-20 rounded-full border-2 lg:-mt-3"
                            src="https://images.pexels.com/photos/3778603/pexels-photo-3778603.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
                        <h1
                            class="text-white text-xs md:text-base 2xl:text-2xl pl-12 md:pl-14 2xl:pl-24 -mt-8 md:-mt-10 lg:-mt-11 2xl:-mt-16">
                            Achieving Dreams</h1>
                        <h2
                            class="text-white text-xs md:text-base 2xl:text-2xl text-opacity-50 pl-12 md:pl-14 2xl:pl-24">
                            Saving Money</h2>
                    </div>
                    <div class="px-3 -mt-3 mb-5 lg:mb-0">
                        <p class="text-white text-lg 2xl:text-4xl font-semibold px-4 -mt-3 lg:-mt-6 2xl:mt-8">Our
                            website system offers an exceptional money-saving experience.</p>
                        <br />
                        <p
                            class="text-white text-opacity-50 font-medium md:text-sm 2xl:text-3xl px-4 mt-1 lg:-mt-3 2xl:mt-6">
                            “ Using this platform, I've been able to save effortlessly and efficiently. The
                            comprehensive support and extensive resources provided have been nothing short of
                            outstanding, enabling me to take control of my financial future with confidence. The
                            intuitive interface and user-friendly features make managing my finances a breeze, and I now
                            feel truly empowered to achieve my financial goals. This platform is highly recommended for
                            anyone looking to improve their savings strategy and secure a more prosperous future. It's a
                            game-changer for personal finance management. ”</p>
                    </div>
                </div>
                <!-- Ending of the component about Patrick Abrams -->

                <!-- Beginning of the component about Kira Whittle -->
                <div
                    class="bg-primary-color-white lg:order-2 lg:row-span-4 lg:col-span-1 rounded-lg shadow-xl mb-5 lg:pb-4 2xl:h-[95.5%]">
                    <div class="mx-8 my-8 lg:pl-1">
                        <img class="w-8 md:w-9 lg:w-12 2xl:w-20 h-8 md:h-9 lg:h-12 2xl:h-20 rounded-full border-2 lg:-mt-4 -ml-1 lg:-ml-4"
                            src="https://images.pexels.com/photos/3762804/pexels-photo-3762804.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />
                        <h1
                            class="primary-color-blackish-blue text-xs md:text-base 2xl:text-2xl pl-10 md:pl-12 2xl:pl-24 -mt-8 md:-mt-10 lg:-mt-12 2xl:-mt-16">
                            Kira Whittle</h1>
                        <h2
                            class="primary-color-blackish-blue-opacity text-xs md:text-base 2xl:text-2xl pl-10 md:pl-12 2xl:pl-24">
                            Happy Saver</h2>
                    </div>
                    <div class="px-3 lg:px-5 lg:-mt-4 mb-5 lg:mb-0">
                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            Thanks to this website, I was able to save money easily</p>
                        <br />
                        <p
                            class="primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2">
                            “ I've been using this website for a while now, and I must say that it has been a
                            game-changer
                            for my savings. The platform is incredibly user-friendly, and the budgeting features make it
                            easy to track my expenses. The customer support team is also very responsive and helpful,
                            addressing all my queries in a timely manner. I've recommended this website to my friends
                            and family, and I'm confident that it can help anyone looking to improve their savings
                            strategy. The website is very well-designed, and the user interface is very intuitive. I've
                            been able to save more money than I ever thought possible, and I'm so grateful for this
                            platform!”</p>
                    </div>
                </div>
            </div>
            <footer class="w-full text-center bg-blue-600 text-white">

                <div class="px-6 py-8 md:py-14 xl:pt-20 xl:pb-12">
                    <h2 class="font-bold text-3xl xl:text-4xl leading-snug">
                        Ready to start saving money?<br>Join SmartSave today.
                    </h2>
                    <a class="mt-8 xl:mt-12 px-12 py-5 text-lg font-medium leading-tight inline-block bg-blue-800 rounded-full shadow-xl border border-transparent hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-sky-999 focus:ring-sky-500"
                        href="#">Join
                        SmartSave</a>
                    <div class="mt-14 xl:mt-20">
                        <nav class="flex flex-wrap justify-center text-lg font-medium">
                            <div class="px-5 py-2"><a href="#">About</a></div>
                            <div class="px-5 py-2"><a href="#">Features</a></div>
                            <div class="px-5 py-2"><a href="#">Pricing</a></div>
                            <div class="px-5 py-2"><a href="#">Blog</a></div>
                            <div class="px-5 py-2"><a href="#">Twitter</a></div>
                        </nav>
                        <p class="mt-7 text-base">© 2023 SmartSave, LLC</p>
                    </div>
                </div>
            </footer>
        </section>
    </main>
</body>

</html>