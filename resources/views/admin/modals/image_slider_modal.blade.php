{{-- @include('admin.partial.header') --}}
	<div class="modal fade" id="image_slider" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			
			<div class="modal-content" style="background: rgba(0,0,0,0.5);">
				<div id="slider_body" class="modal-body" >
					<div class="slideshow-container position-relative ms-auto d-flex text-center" >
					
					</div>
					<button class="prev_slide position-absolute top-50 fs-5 text-light bg-dark fw-bold border-0" onclick="plusSlides(-1)">
						<span class="mdi mdi-arrow-left-bold"></span></button>
					<button class="next_slide position-absolute top-50 fs-5 text-light bg-dark fw-bold border-0" onclick="plusSlides(1)">
						<span class="mdi mdi-arrow-right-bold"></span>
						</button>

				</div>
			</div>
		</div>
	</div>
<script>
let slideIndex = 1;
// showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}


function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");	

  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "flex";  
}
</script>