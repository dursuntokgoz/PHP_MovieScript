<?php $this->load->view('frontend/include/header');?>

<div class="row" id="main-container">
	<div class="title-hd-2">
		<h2>Keşfet</h2>
		<h4>Aradığınız filmi veya diziyi filtreleyerek bulun.</h4>		
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="small-title3">
			<p>
				<button id="movie_type1" name="movie_type" value="film">Filmler</button>
				<button id="movie_type2" name="movie_type" value="dizi">Diziler</button>
			</p>
		</div>
	</div>
	<div class="col-md-3 col-sm-12 col-xs-12">
		<form id="movie_filter_film">
			<div class="small-title3">
				<h4><i class="fal fa-hourglass-end"></i>Yıllara Göre</h4>
				<p>
					<span id="yearsSliderVal1">2000</span> ile <span id="yearsSliderVal2">2019</span> yılları arası
					<input id="years" name="movie_year" type="text" value="" data-slider-min="1990" data-slider-max="2019" data-slider-step="1" data-slider-value="[2000,2019]">
				</p>
			</div>

			<div class="small-title3">
				<h4><i class="fab fa-imdb"></i>Imdb Puanına Göre</h4>
				<p>
					<span id="imdbSliderVal1">0</span> ile <span id="imdbSliderVal2">10</span> puan arası
					<input id="imdb" name="movie_imdb" type="text" value="" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="[0,10]">
				</p>
			</div>

			<div class="small-title3">
				<h4><i class="fal fa-certificate"></i>Türlere Göre</h4>
				<div id="ck-buttons">
				<?php foreach(türler('film') as $type){ ?>
					<div id="ck-button">
					   <label>
						  <input name="movie_genre[]" type="checkbox" hidden value="<?php echo $type->tür ?>"><span><?php echo $type->tür ?></span>
					   </label>
					</div>
				<?php } ?>	
				</div>
			</div>
			<input name="filter_type" value="film" type="hidden">
		</form>

		<form id="movie_filter_dizi">
			<div class="small-title3">
				<h4><i class="fal fa-hourglass-end"></i>Yıllara Göre</h4>
				<p>
					<span id="yearsSliderVal1">2000</span> ile <span id="yearsSliderVal2">2019</span> yılları arası
					<input id="years" name="movie_year" type="text" value="" data-slider-min="1990" data-slider-max="2019" data-slider-step="1" data-slider-value="[2000,2019]">
				</p>
			</div>

			<div class="small-title3">
				<h4><i class="fab fa-imdb"></i>Imdb Puanına Göre</h4>
				<p>
					<span id="imdbSliderVal1">0</span> ile <span id="imdbSliderVal2">10</span> puan arası
					<input id="imdb" name="movie_imdb" type="text" value="" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="[0,10]">
				</p>
			</div>

			<div class="small-title3">
				<h4><i class="fal fa-certificate"></i>Türlere Göre</h4>
				<div id="ck-buttons">
				<?php foreach(türler('dizi') as $type){ ?>
					<div id="ck-button">
					   <label>
						  <input name="movie_genre[]" type="checkbox" hidden value="<?php echo $type->tür ?>"><span><?php echo $type->tür ?></span>
					   </label>
					</div>
				<?php } ?>	
				</div>
			</div>
			<input name="filter_type" value="dizi" type="hidden">
		</form>		
		
		
	</div>
	<div class="col-md-9 col-sm-12 col-xs-12">
		<div id="filter-result"></div>
	</div>

</div>

<?php $this->load->view('frontend/include/footer');?>
