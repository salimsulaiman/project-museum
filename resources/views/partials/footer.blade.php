 <footer class="border-top py-4" style="background-color: rgba(4, 117, 188, 0.9); color: #fff;">
     <div class="container">
         <div class="row align-items-start">

             <!-- Kiri: Info Museum -->
             <div class="col-md-4 mb-4">
                 <div class="d-flex">
                     <img src="{{ asset('storage/' . $footerSection->logo) }}" alt="Museum" class="me-3 p-2 rounded"
                         style="width: 80px; height: auto; object-fit: contain; filter: brightness(0) invert(1);">
                     <div>
                         <strong>{{ $footerSection->title }}</strong><br>
                         <p>{{ $footerSection->address }}</p>
                     </div>
                 </div>
             </div>

             <!-- Tengah: Link -->
             <div class="col-md-3 mb-4">
                 <h6><strong>Link Terkait</strong></h6>
                 <ul class="list-unstyled">
                     @foreach ($footerSection->details as $link)
                         <li><a href="{{ $link->href }}"
                                 class="text-white text-decoration-none">{{ $link->navigation }}</a></li>
                     @endforeach
                 </ul>
             </div>

             <!-- Background Peta -->
             <div class="col-md-2 mb-4 d-none d-md-block">
                 <div
                     style="
          width: 100%;
          height: 100px;
          background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');
          background-size: cover;
          background-position: center;
          border-radius: 5px;
        ">
                 </div>
             </div>

             <!-- Kanan: Form Kirim Pesan -->
             <div class="col-md-3 mb-4">
                 <h6><strong>Kirim Pesan</strong></h6>
                 <form>
                     <input type="email" class="form-control mb-2" placeholder="Email">
                     <textarea class="form-control mb-2" rows="2" placeholder="Pesan"></textarea>
                     <button type="submit" class="btn btn-light btn-sm">Kirim</button>
                 </form>
             </div>

         </div>
     </div>
 </footer>
