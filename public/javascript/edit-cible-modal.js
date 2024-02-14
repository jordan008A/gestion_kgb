document.querySelectorAll('.edit-cible-btn').forEach(btn => {
  btn.addEventListener('click', function() {
      const cibleId = this.dataset.cibleId;
    
      fetch(`${BASE_URL}/admin/cibles/details?cibleId=${cibleId}`)
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  const cible = data.data;
                  document.getElementById('edit-cible-id').value = cibleId;
                  document.getElementById('edit-nom').value = cible.Nom;
                  document.getElementById('edit-prenom').value = cible.Prenom;
                  document.getElementById('edit-dateNaissance').value = cible.DateNaissance;
                  document.getElementById('edit-nationalite').value = cible.Nationalite;

                  let editCibleModal = new bootstrap.Modal(document.getElementById('editCibleModal'));
                  editCibleModal.show();
              } else {
                  alert('Erreur lors de la récupération des données de la cible');
              }
          })
          .catch(error => console.error('Erreur:', error));
  });
});