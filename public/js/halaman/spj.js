document.addEventListener('DOMContentLoaded', function () {
  const spjSelect = document.querySelector('select[name="spj"]');
  const nomorSpjInput = document.querySelector('input[name="nomor_spj"]');

  if (spjSelect && nomorSpjInput) {
    spjSelect.addEventListener('change', function() {
      const spjValue = this.value;
      if (!spjValue) {
        nomorSpjInput.value = '';
        return;
      }

      fetch(`/invoice/generate-spj-number?spj=${encodeURIComponent(spjValue)}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.nomor_spj) {
            nomorSpjInput.value = data.nomor_spj;
          }
        })
        .catch(err => {
          console.error('Error fetching nomor SPJ:', err);
        });
    });
  }
});





 
