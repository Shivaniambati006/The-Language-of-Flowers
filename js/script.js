document.addEventListener('DOMContentLoaded', () => {
    const randomBtn = document.getElementById('randomBtn');
    const loading   = document.getElementById('loading');
    const modal     = document.getElementById('flowerModal');
    const closeModal= document.getElementById('closeModal');
  
    randomBtn.addEventListener('click', () => {
      // show loading state
      loading.classList.remove('hidden');
      randomBtn.disabled = true;
  
      fetch('randomFlower.php')
        .then(res => res.json())
        .then(data => {
          setTimeout(() => {
            // hide loading state
            loading.classList.add('hidden');
            randomBtn.disabled = false;
  
            // populate modal fields
            document.getElementById('modalName').textContent      = data.name;
            document.getElementById('modalImage').src             = 'images/' + data.image_path;
            document.getElementById('modalImage').alt             = data.name;
            document.getElementById('modalColor').textContent     = data.color;
            document.getElementById('modalMeaning').textContent   = data.meaning;
            document.getElementById('modalOccasions').textContent = data.occasions;
  
            // show modal
            modal.classList.remove('hidden');
          }, 1500);
        })
        .catch(err => {
          console.error('Failed to load random flower:', err);
          loading.classList.add('hidden');
          randomBtn.disabled = false;
        });
    });
  
    // close logic
    closeModal.addEventListener('click', () => modal.classList.add('hidden'));
    window.addEventListener('click', e => { if (e.target === modal) modal.classList.add('hidden'); });
  });
  