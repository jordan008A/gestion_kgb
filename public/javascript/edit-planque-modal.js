document.querySelectorAll('.edit-planque-btn').forEach(btn => {
  btn.addEventListener('click', function() {
      const planqueId = this.dataset.planqueId;
    
      fetch(`${BASE_URL}/admin/planques/details?planqueId=${planqueId}`)
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  const planque = data.data;
                  document.getElementById('edit-planque-id').value = planqueId;
                  document.getElementById('edit-adresse').value = planque.Adresse;
                  document.getElementById('edit-pays').value = planque.Pays;
                  document.getElementById('edit-type').value = planque.Type;

                  let editPlanqueModal = new bootstrap.Modal(document.getElementById('editPlanqueModal'));
                  editPlanqueModal.show();
              } else {
                  alert('Erreur lors de la récupération des données de la planque');
              }
          })
          .catch(error => console.error('Erreur:', error));
  });
});