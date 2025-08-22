{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-cp-black w-full relative overflow-hidden mt-20">
  <div class="container max-w-[1130px] mx-auto flex flex-wrap gap-y-4 items-center justify-between pt-[100px] pb-[220px] relative z-10">
    <div class="flex flex-col gap-10">
      <div class="flex items-center gap-3">
        <div class="flex flex-col">
          <p id="CompanyName" class="font-extrabold text-xl leading-[30px] text-white">Wiskul Media</p>
          <p id="CompanyTagline" class="text-sm text-cp-light-grey">Social Media Agency</p>
        </div>
      </div>
      <div class="flex items-center gap-4">
        <a href="#"><img src="{{asset('assets/icons/youtube.svg')}}" class="w-6 h-6" alt="youtube"></a>
        <a href="#"><img src="{{asset('assets/icons/whatsapp.svg')}}" class="w-6 h-6" alt="whatsapp"></a>
        <a href="#"><img src="{{asset('assets/icons/facebook.svg')}}" class="w-6 h-6" alt="facebook"></a>
        <a href="#"><img src="{{asset('assets/icons/instagram.svg')}}" class="w-6 h-6" alt="instagram"></a>
      </div>
    </div>

    <div class="flex flex-wrap gap-[50px]">
      <div class="flex flex-col w-[200px] gap-3">
        <p class="font-bold text-lg text-white">Products</p>
        <a href="#" class="text-cp-light-grey hover:text-white transition">General Contract</a>
        <a href="#" class="text-cp-light-grey hover:text-white transition">Building Assessment</a>
        <a href="#" class="text-cp-light-grey hover:text-white transition">3D Paper Builder</a>
        <a href="#" class="text-cp-light-grey hover:text-white transition">Legal Constructions</a>
      </div>
      <div class="flex flex-col w-[200px] gap-3">
        <p class="font-bold text-lg text-white">About</p>
        <a href="#" class="text-cp-light-grey hover:text-white transition">We’re Hiring</a>
        <a href="#" class="text-cp-light-grey hover:text-white transition">Our Big Purposes</a>
        <a href="#" class="text-cp-light-grey hover:text-white transition">Investor Relations</a>
        <a href="#" class="text-cp-light-grey hover:text-white transition">Media Press</a>
      </div>
      <div class="flex flex-col w-[200px] gap-3">
        <p class="font-bold text-lg text-white">Useful Links</p>
        <a href="#" class="text-cp-light-grey hover:text-white transition">Privacy & Policy</a>
        <a href="#" class="text-cp-light-grey hover:text-white transition">Terms & Conditions</a>
        <a href="contact.html" class="text-cp-light-grey hover:text-white transition">Contact Us</a>
        <a href="#" class="text-cp-light-grey hover:text-white transition">Download Template</a>
      </div>
    </div>
  </div>

  <div class="absolute -bottom-[135px] w-full">
    <p class="font-extrabold text-[250px] leading-[375px] text-center text-white opacity-5">WISKUL</p>
  </div>
</footer>
