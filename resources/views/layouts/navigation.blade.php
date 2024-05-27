<header class="sticky top-0 z-10 bg-black shadow text-gray-300 text-cabin">
  <div class="max-w-7xl mx-auto">
    <nav class="Navbar md:flex justify-start gap-20 items-center py-6 mx-4">
      <ul class="flex items-center justify-between">
        <li>
          <a id="brand" href="/">
            <h1 class="text-xl font-semibold transition-all duration-500 text-londrina shhh">
              <span class="">Sh</span>hh.
            </h1>
          </a>
        </li>
        <button class="sm:hidden hover:bg-white px-3 py-1 transition-all rounded-lg cursor-pointer shadow"
          onClick="toggleMenu()" type="button">
          <span class="text-xl">&#9776;</span>
        </button>
      </ul>
      <div id="menu" class="hidden md:flex flex-row justify-between items-center w-full">
        <ul class="md:flex gap-5 transition-all duration-500">
          @if (auth()->user())
            <li class="my-5 md:my-0">
              <a href="{{ route('dashboard') }}" class="hover:text-white transition-all duration-500">Dashboard</a>
            </li>
            <li class="my-5 md:my-0">
              <a href="{{ route('messages') }}" class="hover:text-white transition-all duration-500">Messages</a>
            </li>
          @else
            <li class="text-gray-400 my-5 md:my-0">
              Tell your secret anonymously
            </li>
          @endif
        </ul>
        @guest
          <ul class="md:flex gap-5">
            @if (Route::has('login'))
              <li class="my-5 md:my-0">
                <a href="{{ route('login') }}" class="hover:text-white transition-all duration-500">Login</a>
              </li>
            @endif

            @if (Route::has('register'))
              <li class="my-5 md:my-0">
                <a href="{{ route('register') }}" class="hover:text-white transition-all duration-500">Register</a>
              </li>
            @endif
          </ul>
        @else
          <ul class="md:flex gap-5">
            <li class="my-5 md:my-0">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover:text-[#ff4e4e] transition-all duration-500">Logout</button>
              </form>
            </li>
          </ul>
          @endif
        </div>
      </nav>
    </div>
    <script>
      // burger button menu
      const toggleMenu = () => {
        const menu = document.getElementById("menu");
        menu.classList.toggle("hidden");
      };

      // Smooth scroll behavior when clicking on navigation links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();

          const targetElement = document.querySelector(this.getAttribute('href'));
          if (targetElement) {
            window.scrollTo({
              top: targetElement.offsetTop,
              behavior: 'smooth'
            });
          }
        });
      });
    </script>
  </header>
