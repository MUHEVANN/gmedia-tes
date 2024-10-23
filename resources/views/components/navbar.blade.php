<nav class="bg-none md:bg-primary w-full border-gray-200 dark:bg-gray-900 sticky top-0 z-[20]">
    <div class="max-w-screen-xl flex w-full  items-center justify-between mx-auto p-4">
        <a href="{{ route('dashboard') }}"
            class="md:text-white text-black flex text-xl md:text-2xl items-center space-x-3 font-normal md:font-bold rtl:space-x-reverse">
            MAS POS
        </a>

        <div class="  block md:w-auto">
            @if (Auth::check())
                <button type="button" data-dropdown-toggle="language-dropdown-menu"
                    class="inline-flex md:text-white items-center font-medium justify-center px-4 py-2 text-sm  dark:text-white rounded-lg cursor-pointer hover:bg-secondary dark:hover:bg-gray-700 dark:hover:text-white">

                    <div> <i class='bx bxs-user-circle text-2xl rounded-full me-3 '></i></div>
                    <span class="font-normal">{{ Auth::user()->username }}</span>

                </button>
            @else
                <p class="text-white capitalize">call us +62 817-1902-092</p>
            @endif
            <!-- Dropdown -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700"
                id="language-dropdown-menu">
                <ul class="py-2 font-medium" role="none">

                    <li>
                        <a href="/dashboard"
                            class="block px-4 hover:cursor-pointer py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">
                            @csrf
                            <button type="submit" class="inline-flex items-center">
                                <i class='bx bxs-dashboard me-3 text-2xl'></i>
                                Dashboard
                            </button>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST"
                            class="block px-4 hover:cursor-pointer py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">
                            @csrf
                            <button type="submit" class="inline-flex items-center">
                                <i class='bx bx-log-in me-3 text-2xl'></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
