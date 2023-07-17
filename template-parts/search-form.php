<div class="row my-2">
	<div class="col-12 mb-3">
		<select class="custom-select" id="contratto">
			<option value="vendita">Vendita</option>
			<option value="affitto">Affitto</option>
		</select>
	</div>
	
	<div class="col-12 mb-3">
		<select class="custom-select" id="tipologia">
			<optgroup label="Case e appartamenti">
				<option value="case">Case e appartamenti</option>
				<option value="appartamenti">Appartamenti</option>
				<option value="attici">Attici e mansarde</option>
				<option value="bilocali">Bilocali</option>
				<option value="case-indipendenti">Case indipendenti</option>
				<option value="monolocali">Monolocali</option>
				<option value="quadrilocali">Quadrilocali</option>
				<option value="rustici">Rustici</option>
				<option value="trilocali">Trilocali</option>
				<option value="ville">Ville</option>
			</optgroup>

			<optgroup label="Commerciali">
				<option value="commerciali">Commerciali</option>
				<option value="attivita-commerciali">Attività Commerciali</option>
				<option value="capannoni-industriali">Capannoni Industriali</option>
				<option value="magazzini">Magazzini</option>
				<option value="negozi">Negozi</option>
				<option value="uffici">Uffici</option>
			</optgroup>

			<optgroup label="Terreni">
				<option value="terreni">Terreni</option>
				<option value="terreni-agricoli">Terreni Agricoli</option>
				<option value="terreni-edificabili">Terreni Edificabili</option>
			</optgroup>
			
			<option value="box-posti-auto">Box e Posti auto</option>
		</select>
	</div>
	
	<div class="col-12 mb-3">
		 <input type="text" id="comune" placeholder="COMUNE" class="custom-select" required />
	</div>
	
	<div class="col-12">
		<button id="btn-cerca" class="btn btn-io-orange rounded-pill px-5 w-100">Cerca</button>
	</div>
</div>