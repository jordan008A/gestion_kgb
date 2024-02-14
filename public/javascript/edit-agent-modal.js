document.querySelectorAll('.edit-agent-btn').forEach(btn => {
  btn.addEventListener('click', function() {
      const agentId = this.dataset.agentId;
    
      fetch(`${BASE_URL}/admin/agents/details?agentId=${agentId}`)
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  const agent = data.data;
                  document.getElementById('edit-agent-id').value = agentId;
                  document.getElementById('edit-nom').value = agent.Nom;
                  document.getElementById('edit-prenom').value = agent.Prenom;
                  document.getElementById('edit-dateNaissance').value = agent.DateNaissance;
                  document.getElementById('edit-nationalite').value = agent.Nationalite;
                  
                  document.querySelectorAll('#edit-agent-form .form-check-input').forEach(checkbox => {
                      checkbox.checked = agent.specialites.includes(checkbox.value);
                  });

                  let editAgentModal = new bootstrap.Modal(document.getElementById('editAgentModal'));
                  editAgentModal.show();
              } else {
                  alert('Erreur lors de la récupération des données de l\'agent');
              }
          })
          .catch(error => console.error('Erreur:', error));
  });
});
