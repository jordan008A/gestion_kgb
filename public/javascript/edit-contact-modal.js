document.querySelectorAll('.edit-contact-btn').forEach(btn => {
  btn.addEventListener('click', function() {
      const contactId = this.dataset.contactId;
    
      fetch(`${BASE_URL}/admin/contacts/details?contactId=${contactId}`)
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  const contact = data.data;
                  document.getElementById('edit-contact-id').value = contactId;
                  document.getElementById('edit-nom').value = contact.Nom;
                  document.getElementById('edit-prenom').value = contact.Prenom;
                  document.getElementById('edit-dateNaissance').value = contact.DateNaissance;
                  document.getElementById('edit-nationalite').value = contact.Nationalite;

                  let editContactModal = new bootstrap.Modal(document.getElementById('editContactModal'));
                  editContactModal.show();
              } else {
                  alert('Erreur lors de la récupération des données du contact');
              }
          })
          .catch(error => console.error('Erreur:', error));
  });
});