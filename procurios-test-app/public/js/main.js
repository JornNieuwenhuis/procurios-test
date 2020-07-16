const delButton = document.getElementById('delete-entry-button');

if(delButton) {
	delButton.addEventListener('click', (event) => {
		if(confirm('Are you sure you want to delete this entry?')) {
			const id = event.target.getAttribute('data-id');
			
			fetch(`/entry/delete/${id}`, {
				method: 'DELETE'
			}).then(
				/* This should be redundant as delete function returns redirectToRoute. It returns the correct response but does not redirect */
				res => window.location.assign('/')
			);
		}
	});
}