       <!-- about-company-section -->
       <section class="about-company-section">
           <div class="container">
               <div class="row section-title">
                   <h3>تعرفوا أكثر علينا</h3>
                   <h2>تعريف ولمحة عن المؤسسة</h2>
               </div>
               <div class="row g-5">
                   @for ($i = 1; $i < 4; $i++)
                       <div class="col-lg-4">
                           <div class="company-option">
                               <a href="/front/page/{{ $pages[$i]->page_slug }}">
                                   <p>{{ $pages[$i]->title }}</p>
                               </a>

                           </div>
                       </div>
                   @endfor

               </div>
           </div>
       </section><!-- about-company-section end -->
