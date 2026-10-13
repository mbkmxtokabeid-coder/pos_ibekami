window.onload = function () {
  brg(1);
}
$(document).on('click', '.hapus-btn', function (e) {
    e.preventDefault();

    var barang_id = $(this).data('id'); // Ambil ID dari data-id
    console.log("Barang ID: " + barang_id); // Debugging untuk cek apakah ID terbaca

    if (!barang_id) {
        alert("Gagal mendapatkan ID!"); // Debugging jika ID kosong
        return;
    }

    // Update form action
    $('#deleteForm').attr('action', '/invoice/deleteBarang/' + barang_id);
    console.log("Form Action: " + $('#deleteForm').attr('action')); // Debugging untuk cek apakah action sudah benar

    $('#deleteModal').modal('show');
});



function brg(kategoriId) {
  var elemenTeksPenjualan = document.getElementById('potensi_penjualan');
  var elemenTeksProfit = document.getElementById('potensi_profit');
  const buttons = document.getElementsByClassName('tombol');
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove('btn-info');
    buttons[i].classList.add('btn-soft-info');
  }
  const selectedButton = document.getElementById('btn_' + kategoriId);
  selectedButton.classList.remove('btn-soft-info');
  selectedButton.classList.add('btn-info');
  // Dapatkan elemen teks

  if (kategoriId == 1) {
    elemenTeksPenjualan.textContent = 'Jumlah Potensi Penjualan Stempel';
    elemenTeksProfit.textContent = 'Jumlah Potensi Profit Stempel';
  }
  else if (kategoriId == 2) {
    elemenTeksPenjualan.textContent = 'Jumlah Potensi Penjualan Digital Printing';
    elemenTeksProfit.textContent = 'Jumlah Potensi Profit Digital Printing';
  }
  else if (kategoriId == 3) {
    elemenTeksPenjualan.textContent = 'Jumlah Potensi Penjualan Tumbler';
    elemenTeksProfit.textContent = 'Jumlah Potensi Profit Tumbler';
  }
  else if (kategoriId == 4) {
    elemenTeksPenjualan.textContent = 'Jumlah Potensi Penjualan Plakat';
    elemenTeksProfit.textContent = 'Jumlah Potensi Profit Plakat';
  }
  else if (kategoriId == 6) {
    elemenTeksPenjualan.textContent = 'Jumlah Potensi Penjualan Souvenir';
    elemenTeksProfit.textContent = 'Jumlah Potensi Profit Souvenir';
  }
  else {
    elemenTeksPenjualan.textContent = 'Jumlah Seluruh Potensi Penjualan';
    elemenTeksProfit.textContent = 'Jumlah Seluruh Profit Penjualan';
  }

  if (kategoriId !== 0) {

    var baseUrl = window.location.origin;
    fetch(`${baseUrl}/invoice/get-barang-data/${kategoriId}`)
      .then(response => response.json())
      .then(data => {
        var counterValue = document.querySelector('.penjualan');
        var stok = document.querySelectorAll('.stok');
        if (counterValue && data) {
          var val = data.total_potensi_penjualan !== undefined ? Number(data.total_potensi_penjualan).toLocaleString('id-ID') : '0';
          counterValue.textContent = val;
          var totalStok = data.total_stok !== undefined ? Number(data.total_stok).toLocaleString('id-ID') : '0';
          stok.forEach(function (element) {
            element.textContent = totalStok;
          });
        }
      })
      .catch(error => {
        console.error('Terjadi kesalahan saat mengambil data:', error);
      });
    // fetch untuk potensi profit
    fetch(`${baseUrl}/invoice/get-potensi-profit/${kategoriId}`)
      .then(response => response.json())
      .then(data => {
        var counterValue = document.querySelector('.profit');
        if (counterValue && data) {
          var valProfit = data.total_profit !== undefined ? Number(data.total_profit).toLocaleString('id-ID') : '0';
          counterValue.textContent = valProfit;
        }
      })
      .catch(error => {
        console.error('Terjadi kesalahan saat mengambil data:', error);
      });
  }
}