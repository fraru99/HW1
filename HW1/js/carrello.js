fetch('http://localhost/HW1/php/carrello.php').then(onResponse).then(onJson);

function onResponse(response) {
	return response.json();
}

function onJson(json) {
	console.log(json);
	for (i in json) {
		const sezione = document.querySelector('#pacchetti');

		const div = document.createElement('div');
		sezione.appendChild(div);
		div.classList.add('shadow-box');

		const h1 = document.createElement('h1');
		h1.textContent = json[i].nome;
		div.appendChild(h1);

		const h4 = document.createElement('h4');
		h4.textContent = json[i].sotto_descrizione;
		div.appendChild(h4);

		const img = document.createElement('img');
		img.src = json[i].immagine;
		div.appendChild(img);

		const p = document.createElement('p');
		p.textContent = json[i].descrizione;
		div.appendChild(p);
		//p.classList.add('hidden');

		const div2 = document.createElement('p');
		div.appendChild(div2);

		const p2 = document.createElement('p');
		p2.textContent = 'Prezzo:  ' + json[i].prezzo + '$';
		div2.appendChild(p2);
		p2.classList.add('prezzo');

		const img2 = document.createElement('img');
		img2.src = 'http://localhost/HW1/foto/carrello/carrello_out.png';
		div2.appendChild(img2);
		img2.classList.add('carrello');
		img2.id = json[i].id;
	}
	//----------------------AGGIUNGI AL CARRELLO-------------------------------------------------------------------------

	const carrelli = document.querySelectorAll('.carrello');
	for (carrello of carrelli) {
		carrello.addEventListener('click', deselectCarrello);
	}

	function deselectCarrello(event) {
		const pacchetto_id = event.currentTarget.id;
		console.log(pacchetto_id);

		const formData = new FormData();
		formData.append('pacchetto_id', event.currentTarget.id);

		fetch('http://localhost/HW1/php/rimuovi_pacchetto.php', { method: 'POST', body: formData })
			.then(id_remove_response)
			.then(id_remove_json);

		function id_remove_response(response) {
			return response.json();
		}

		function id_remove_json(json) {
			console.log(json);
		}

		const pss = event.currentTarget.parentNode.parentNode.querySelectorAll('h1');
		for (ps of pss) {
			const sezione = document.querySelector('#pacchetti div');
			document.querySelector('#pacchetti').classList.remove('shadow-box');

			sezione.remove();
		}

		event.currentTarget.src = 'http://localhost/HW1/foto/carrello/carrello_out.png';
		event.currentTarget.removeEventListener('click', deselectCarrello);
	}
	//--------------------CERCA PACCHETTO----------------------------------------------------------------

	const input = document.querySelector('#barra-ricerca');
	input.addEventListener('keyup', ricerca);

	function ricerca(event) {
		console.log(input.value);

		const divv = document.querySelectorAll('#pacchetti div');
		for (div of divv) {
			console.log(div);

			h1 = div.querySelector('h1');

			if (h1.textContent.toLowerCase().search(input.value.toLowerCase()) === -1) {
				div.classList.add('hidden');
			}

			if (h1.textContent.toLowerCase().search(input.value.toLowerCase()) !== -1) {
				div.classList.remove('hidden');
			}
		}
	}

	//-----------------menu mobile---------------------------------------------------------------------------------
	const open_menu = document.getElementById('mainbox');
	open_menu.addEventListener('click', apriMenu);

	function apriMenu(event) {
		document.querySelector('.sidemenu').style.width = '100%';
		close_menu.addEventListener('click', chiudiMenu);
		open_menu.removeEventListener('click', apriMenu);
	}

	const close_menu = document.querySelector('.closebtn');
	close_menu.addEventListener('click', chiudiMenu);

	function chiudiMenu(event) {
		document.querySelector('.sidemenu').style.width = '0px';
		open_menu.addEventListener('click', apriMenu);
		close_menu.removeEventListener('click', chiudiMenu);
	}
}
