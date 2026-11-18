// =========================================================
// BARANG PAGE DYNAMICS: GLIDER, COUNTER ANIMATIONS & MODALS
// =========================================================

// Global store for running requestAnimationFrame IDs to prevent overlap
var activeNumAnimations = {};

function animateNumber(element, targetVal, duration) {
  if (!element) return;
  duration = duration || 550;
  targetVal = Number(targetVal) || 0;

  // Extract current numeric value from element text
  var currentText = (element.textContent || '0').replace(/[^0-9-]/g, '');
  var startVal = parseInt(currentText, 10);
  if (isNaN(startVal)) startVal = 0;

  // Element specific animation tracker
  var animKey = element.getAttribute('data-anim-key');
  if (!animKey) {
    animKey = 'anim_' + Math.random().toString(36).substr(2, 9);
    element.setAttribute('data-anim-key', animKey);
  }

  if (activeNumAnimations[animKey]) {
    cancelAnimationFrame(activeNumAnimations[animKey]);
    delete activeNumAnimations[animKey];
  }

  if (startVal === targetVal) {
    element.textContent = Number(targetVal).toLocaleString('id-ID');
    return;
  }

  var startTime = performance.now();

  function easeOutCubic(t) {
    return 1 - Math.pow(1 - t, 3);
  }

  function frame(now) {
    var elapsed = now - startTime;
    var progress = Math.min(elapsed / duration, 1);
    var eased = easeOutCubic(progress);
    var current = Math.round(startVal + (targetVal - startVal) * eased);

    element.textContent = current.toLocaleString('id-ID');

    if (progress < 1) {
      activeNumAnimations[animKey] = requestAnimationFrame(frame);
    } else {
      element.textContent = Number(targetVal).toLocaleString('id-ID');
      delete activeNumAnimations[animKey];
    }
  }

  activeNumAnimations[animKey] = requestAnimationFrame(frame);
}

// Function to move the sliding indicator (glider) underneath active tab
function moveGliderTo(btn) {
  var glider = document.getElementById('kategoriNavGlider');
  var nav = document.getElementById('kategoriSegmentedNav');
  if (!glider || !btn || !nav) return;

  var navRect = nav.getBoundingClientRect();
  var btnRect = btn.getBoundingClientRect();

  var left = btnRect.left - navRect.left + nav.scrollLeft;
  var top = btnRect.top - navRect.top;

  glider.style.width = btnRect.width + 'px';
  glider.style.height = btnRect.height + 'px';
  glider.style.transform = 'translate3d(' + left + 'px, ' + top + 'px, 0)';
  glider.style.opacity = '1';
}

// Keep glider aligned on window resize
window.addEventListener('resize', function () {
  var activeBtn = document.querySelector('.ibk-segmented-nav .tombol.btn-info');
  if (activeBtn) {
    moveGliderTo(activeBtn);
  }
});

// Category Switcher Function
function brg(kategoriId) {
  var elemenTeksPenjualan = document.getElementById('potensi_penjualan');
  var elemenTeksProfit = document.getElementById('potensi_profit');
  if (!elemenTeksPenjualan || !elemenTeksProfit) return;

  const buttons = document.getElementsByClassName('tombol');
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove('btn-info');
    buttons[i].classList.add('btn-soft-info');
  }

  const selectedButton = document.getElementById('btn_' + kategoriId);
  if (selectedButton) {
    selectedButton.classList.remove('btn-soft-info');
    selectedButton.classList.add('btn-info');
    moveGliderTo(selectedButton);
  }

  // 1. Label Text with micro-fade animation
  var katName = selectedButton ? selectedButton.textContent.trim() : '';
  var targetPenjualanText = 'Jumlah Potensi Penjualan ' + katName;
  var targetProfitText = 'Jumlah Potensi Profit ' + katName;

  var fadeElements = document.querySelectorAll('.ibk-fade-switch');
  fadeElements.forEach(function (el) {
    el.classList.add('ibk-fade-out');
  });

  setTimeout(function () {
    elemenTeksPenjualan.textContent = targetPenjualanText;
    elemenTeksProfit.textContent = targetProfitText;
    fadeElements.forEach(function (el) {
      el.classList.remove('ibk-fade-out');
    });
  }, 120);

  // 2. Add subtle card refreshing feedback
  var cardPenjualan = document.getElementById('kpiCardPenjualan');
  var cardProfit = document.getElementById('kpiCardProfit');
  if (cardPenjualan) cardPenjualan.classList.add('ibk-kpi-refreshing');
  if (cardProfit) cardProfit.classList.add('ibk-kpi-refreshing');

  // 3. Fetch data with animated number rolling
  if (kategoriId !== 0) {
    var baseUrl = window.location.origin;

    // Fetch potensi penjualan & stok
    fetch(`${baseUrl}/invoice/get-barang-data/${kategoriId}`)
      .then(response => response.json())
      .then(data => {
        var counterValue = document.querySelector('.penjualan');
        var stok = document.querySelectorAll('.stok');
        if (data) {
          var targetVal = data.total_potensi_penjualan !== undefined ? Number(data.total_potensi_penjualan) : 0;
          if (counterValue) animateNumber(counterValue, targetVal, 550);

          var targetStok = data.total_stok !== undefined ? Number(data.total_stok) : 0;
          stok.forEach(function (element) {
            animateNumber(element, targetStok, 450);
          });
        }
      })
      .catch(error => {
        console.error('Terjadi kesalahan saat mengambil data:', error);
      })
      .finally(function () {
        if (cardPenjualan) cardPenjualan.classList.remove('ibk-kpi-refreshing');
      });

    // Fetch potensi profit
    fetch(`${baseUrl}/invoice/get-potensi-profit/${kategoriId}`)
      .then(response => response.json())
      .then(data => {
        var counterValue = document.querySelector('.profit');
        if (data) {
          var targetProfit = data.total_profit !== undefined ? Number(data.total_profit) : 0;
          if (counterValue) animateNumber(counterValue, targetProfit, 550);
        }
      })
      .catch(error => {
        console.error('Terjadi kesalahan saat mengambil data:', error);
      })
      .finally(function () {
        if (cardProfit) cardProfit.classList.remove('ibk-kpi-refreshing');
      });
  }
}

// Initial load
window.addEventListener('DOMContentLoaded', function () {
  var firstBtn = document.querySelector('.ibk-segmented-nav .tombol');
  if (firstBtn) {
    var idMatch = firstBtn.id.match(/\d+/);
    var firstId = idMatch ? parseInt(idMatch[0], 10) : 1;
    brg(firstId);
    setTimeout(function () {
      moveGliderTo(firstBtn);
    }, 150);
  }
});

// Delete Modal Handler
$(document).on('click', '.hapus-btn', function (e) {
  e.preventDefault();
  var barang_id = $(this).data('id');
  if (!barang_id) {
    alert("Gagal mendapatkan ID!");
    return;
  }
  $('#deleteForm').attr('action', '/invoice/deleteBarang/' + barang_id);
  $('#deleteModal').modal('show');
});
