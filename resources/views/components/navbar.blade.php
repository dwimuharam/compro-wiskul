<nav class="flex flex-wrap items-center justify-between bg-white p-[20px_30px] rounded-[20px] gap-y-3">
  {{-- Logo --}}
  <div class="flex items-center gap-3">
    <div class="flex shrink-0 h-[43px] overflow-hidden">
        {{-- Logo Image Here --}}
    </div>
    <div class="flex flex-col">
      <p id="CompanyName" class="font-extrabold text-xl leading-[30px]">Wiskul Media</p>
      <p id="CompanyTagline" class="text-sm text-cp-light-grey">Social Media Agency</p>
    </div>
  </div>

  {{-- Navigation Menu --}}
  <ul class="flex flex-wrap items-center gap-[30px]">
    <li class="{{request()->routeIs('front.index') ? 'text-cp-dark-blue' : ''}} font-semibold hover:text-cp-dark-blue transition-all duration-300">
      <a href="{{route('front.index')}}">Home</a>
    </li>
    <li class="font-semibold hover:text-cp-dark-blue transition-all duration-300">
      <a href="#">Our Services</a>
    </li>
    <li class="{{request()->routeIs('front.shop') ? 'text-cp-dark-blue' : ''}} font-semibold hover:text-cp-dark-blue transition-all duration-300">
      <a href="{{route('front.shop')}}">Product</a>
    </li>
    <li class="{{request()->routeIs('front.team') ? 'text-cp-dark-blue' : ''}} font-semibold hover:text-cp-dark-blue transition-all duration-300">
      <a href="{{route('front.team')}}">Company</a>
    </li>
    <li class="{{request()->routeIs('front.about') ? 'text-cp-dark-blue' : ''}} font-semibold hover:text-cp-dark-blue transition-all duration-300">
      <a href="{{route('front.about')}}">About</a>
    </li>
  </ul>

  {{-- CTA + Auth --}}
  <div class="flex items-center gap-4">
    
  @auth
  {{-- Cart Button --}}
  <a href="{{ route('cart.index') }}" class="relative flex items-center justify-center">
    <img src="{{asset('assets/icons/cart.png')}}" alt="cart" class="w-6 h-6">
    @if(session('cart') && count(session('cart')) > 0)
      <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1">
        {{ count(session('cart')) }}
      </span>
    @endif
  </a>

  {{-- Get a Quote --}}
  <a href="{{ route('front.appointment') }}" class="bg-cp-dark-blue p-[14px_20px] rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">
    Get a Quote
  </a>

  {{-- Profile Dropdown --}}
  <div class="relative">
    <button onclick="toggleUserDropdown()" class="w-8 h-8 flex items-center justify-center rounded-full border border-[#E8EAF2] bg-white">
      <img src="{{ asset('assets/icons/profile.svg') }}" alt="profile" class="w-5 h-5">
    </button>

    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-40 bg-white border border-[#E8EAF2] rounded-lg shadow-lg z-50">
      <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          Logout
        </button>
      </form>
    </div>
  </div>

@else
  {{-- Login & Register --}}
  <a href="{{ route('login') }}" class="text-cp-dark-blue font-semibold hover:underline">Login</a>
  <a href="{{ route('register') }}" class="text-cp-dark-blue font-semibold hover:underline">Register</a>
@endauth
<script>
  function toggleUserDropdown() {
    const menu = document.getElementById('userDropdown');
    if (menu) {
      menu.classList.toggle('hidden');
    }
  }

  // Menutup dropdown jika klik di luar
  document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const button = event.target.closest('button[onclick="toggleUserDropdown()"]');

    if (!button && dropdown && !dropdown.contains(event.target)) {
      dropdown.classList.add('hidden');
    }
  });
</script>


  </div>
</nav>
