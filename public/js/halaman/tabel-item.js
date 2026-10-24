
function parseNominal(val) {
  if (val === null || val === undefined) return 0;
  var digits = String(val).replace(/[^0-9]/g, '');
  return digits ? parseInt(digits, 10) : 0;
}

function formatNominal(val) {
  var num = Math.round(Number(val) || 0);
  return num.toLocaleString('id-ID');
}

function autoCalc(v) {
  var row = v.closest('tr');
  var index = Array.from(row.parentNode.children).indexOf(row) + 1;

  var hargaElem = document.getElementById('productRate-' + index);
  var unformattedHarga = hargaElem ? parseNominal(hargaElem.value) : 0;
  var qtyElem = document.getElementById('product-qty-' + index);
  var qty = qtyElem ? (parseFloat(qtyElem.value) || 0) : 0;

  if (!isNaN(unformattedHarga) && !isNaN(qty)) {
    var jumlah = Math.round(unformattedHarga * qty);
    var productPriceElem = document.getElementById('productPrice-' + index);
    if (productPriceElem) {
      productPriceElem.value = formatNominal(jumlah);
    }
    getTotal();
  }
}

function getTotal() {
  var sum = 0;
  var semuaHarga = document.querySelectorAll('[id^="productPrice-"]');

  for (let i = 0; i < semuaHarga.length; i++) {
    const harga = parseNominal(semuaHarga[i].value);
    if (!isNaN(harga)) {
      sum += harga;
    }
  }

  var totalHargaElem = document.getElementById('total-harga');
  var totalPemElem = document.getElementById('total-pembelian');
  if (totalHargaElem) totalHargaElem.value = formatNominal(sum);
  if (totalPemElem) totalPemElem.value = formatNominal(sum);

  dP();
  totalPembayaran();
  sisaPembayaran();
  if (typeof window.calcTotals === 'function') {
    window.calcTotals();
  }
}

function dP() {
  var divRow = document.getElementById("div-dp-row");
  var divLabel = document.getElementById("div-label");
  var divElement = document.getElementById("dp");
  var dpInput = document.getElementById("input-dp");
  var totalPemElem = document.getElementById('total-pembelian') || document.getElementById('total-harga');
  var totalAkhir = totalPemElem ? parseNominal(totalPemElem.value) : 0;
  var jnsPemElem = document.getElementById('choices-payment-type');
  var jnsPem = jnsPemElem ? jnsPemElem.value : '';

  if (jnsPem === 'Transfer DP' || jnsPem === 'Cash Belum Lunas') {
    if (divRow) divRow.style.display = "";
    if (divLabel) divLabel.style.display = "block";
    if (divElement) divElement.style.display = "block";

    if (jnsPem === 'Transfer DP' && dpInput && (!window.userEditedDp || parseNominal(dpInput.value) <= 0) && totalAkhir > 0) {
      dpInput.value = formatNominal(Math.round(totalAkhir * 0.7));
    }
  } else {
    if (divRow) divRow.style.display = "none";
    if (divLabel) divLabel.style.display = "none";
    if (divElement) divElement.style.display = "none";
    if (dpInput && (jnsPem === 'Cash Lunas' || jnsPem === 'Transfer Lunas')) {
      dpInput.value = "0";
    }
  }
}

function totalPembayaran() {
  var total = 0;
  var selectLain = document.getElementById('choices-potongan');
  var inputPotElem = document.getElementById('input-potongan');
  var inputPotongan = inputPotElem ? parseNominal(inputPotElem.value) : 0;
  var totalHargaElem = document.getElementById('total-harga');
  var totalHarga = totalHargaElem ? parseNominal(totalHargaElem.value) : 0;

  if (selectLain != null) {
    if (selectLain.value == "-") {
      total = totalHarga;
    } else if (selectLain.value == "Diskon") {
      var diskon = inputPotongan;
      var potongan = (diskon * totalHarga) / 100;
      total = Math.max(0, totalHarga - potongan);
    } else if (selectLain.value == "Potongan") {
      var potongan = inputPotongan;
      total = Math.max(0, totalHarga - potongan);
    } else if (selectLain.value == "PPN") {
      var ppn = inputPotongan;
      var tambahan = (ppn * totalHarga) / 100;
      total = totalHarga + tambahan;
    } else {
      total = totalHarga;
    }
  } else {
    total = totalHarga;
  }

  var totalPemElem = document.getElementById('total-pembelian');
  if (totalPemElem) {
    totalPemElem.value = formatNominal(total);
  }

  sisaPembayaran();
}

function sisaPembayaran() {
  var totalPemElem = document.getElementById('total-pembelian');
  var dpElem = document.getElementById('input-dp');
  var sisaPemElem = document.getElementById('sisa-pembayaran');
  var jnsPemElem = document.getElementById('choices-payment-type');
  if (!totalPemElem || !sisaPemElem) return;

  var jnsPem = jnsPemElem ? jnsPemElem.value : '';
  if (jnsPem === 'Cash Lunas' || jnsPem === 'Transfer Lunas') {
    sisaPemElem.value = '0';
    return;
  }

  var totalPem = parseNominal(totalPemElem.value);
  var dp = (dpElem && dpElem.value) ? parseNominal(dpElem.value) : 0;

  var sisaPem = Math.max(0, totalPem - dp);
  sisaPemElem.value = formatNominal(sisaPem);
}

// Event listener
if (document.getElementById('total-harga')) {
  document.getElementById('total-harga').addEventListener('input', dP);
  document.getElementById('total-harga').addEventListener('change', dP);
}
if (document.getElementById('choices-payment-type')) {
  document.getElementById('choices-payment-type').addEventListener('change', function () {
    if (this.value === 'Transfer DP') {
      window.userEditedDp = false;
    }
    dP();
    sisaPembayaran();
    if (typeof window.calcTotals === 'function') {
      window.calcTotals();
    }
  });
}
if (document.getElementById('input-potongan')) {
  document.getElementById('input-potongan').addEventListener('change', totalPembayaran);
}
if (document.getElementById('choices-potongan')) {
  document.getElementById('choices-potongan').addEventListener('change', totalPembayaran);
}
if (document.getElementById('input-dp')) {
  document.getElementById('input-dp').addEventListener('input', function () {
    var raw = this.value;
    if (raw && raw.trim() !== '') {
      window.userEditedDp = true;
    } else {
      window.userEditedDp = false;
    }
    sisaPembayaran();
    if (typeof window.calcTotals === 'function') {
      window.calcTotals();
    }
  });
  document.getElementById('input-dp').addEventListener('change', function () {
    sisaPembayaran();
    if (typeof window.calcTotals === 'function') {
      window.calcTotals();
    }
  });
}
// document.getElementById('choices-invoice').addEventListener('change', new_link);

var count = 1;
var usedIds = [];
function new_link() {
  Array.from(document.querySelectorAll('.product')).forEach(function (element) {
    var id = parseInt(element.id);
    usedIds.push(id);
  });

  // Menemukan ID terkecil yang belum digunakan
  var smallestUnusedId = 1;
  while (usedIds.includes(smallestUnusedId)) {
    smallestUnusedId++;
  }

  count = smallestUnusedId; // Mengatur ulang nilai count


  var e = document.createElement("tr");
  e.id = count;
  e.className = "product";

  var t =
    '<th scope="row" class="product-id">' +
    count +
    '</th><td class="text-start"><div class="mb-2"><label class="visually-hidden" for="productName" >Item</label><select class="form-select " data-choices data-choices-sorting="true" id="productName-' +
    count +
    '" name="barang_id[]"><option selected disabled>Pilih Item</option>';

  fetch('/invoice/jenis-barang')
    .then(function (response) {
      return response.json();
    })
    .then(function (jenis) {
      jenis.forEach(function (jns) {
        t += '<option value="' + jns.id + '">' + jns.jenis_barang + '</option>';
      });

      t +=
        '</select></div><textarea class="form-control bg-light border-0" id="productDetails-' +
        count +
        '        " name="deskripsi_item[]" rows="2" placeholder="Deskripsi Item"></textarea></td><td><select class="form-select bg-light border-0" id="satuan-' + count + '" name="satuan[]" required><option value="">Pilih</option><option value="Pcs">Pcs</option><option value="Set">Set</option><option value="Und">Und</option><option value="Blok">Blok</option><option value="Rim">Rim</option><option value="Lbr">Lbr</option><option value="Ktk">Ktk</option><option value="Unit">Unit</option><option value="Kg">Kg</option><option value="Lainnya">Lainnya</option></select></td><td><input type="text" class="form-control product-price bg-light border-0" id="productRate-' 
        +count +
        '" name="hrg[]" data-cleave=\'{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }\' placeholder="Rp. 0.000" onChange="autoCalc(this)" required /></td><td><div class="input-step"><input type="number" class="text-center" id="product-qty-' +
        count +
        '" name="qty[]" onChange="autoCalc(this)" value="1"></div></td><td class="text-end"><div><input type="text" class="form-control bg-light border-0 product-line-price" id="productPrice-' +
        count +
        '" name="jlh_hrg[]"  placeholder="Rp.0.000" onChange="autoCalc(this)" readonly/></div></td><td class="product-removal"><a class="btn btn-success">Delete</a></td>';

      e.innerHTML = t;
      document.getElementById("newlink").appendChild(e);
      usedIds.push(count);
      
      var choicesElements = document.querySelectorAll("[data-choices]");
      Array.from(choicesElements).forEach(function (element) {
        new Choices(element, {
          placeholderValue: "This is a placeholder set in the config",
          searchPlaceholderValue: "This is a search placeholder",
        });
      });

      var inputElement = document.getElementById("productRate-" + count);
      var cleaveConfig = JSON.parse(inputElement.getAttribute('data-cleave'));
      new Cleave(inputElement, cleaveConfig);
      remove();
      resetRow();
    });
}

document.addEventListener("DOMContentLoaded", function () {
  var selectElement = document.getElementById("choices-potongan");
  var divElement = document.getElementById("harga-potongan");
  var divInput = document.getElementById("input-potongan");

  selectElement.addEventListener("change", function () {
    if (selectElement.value != "-") {
      if (selectElement.value == "Diskon") {
        divElement.style.display = "block";
        divInput.class = "form-control bg-light border-0";
        divInput.row = "1";
        divInput.name = "dskn";
        divInput.placeholder = "Diskon";
      }
      if (selectElement.value == "Potongan") {
        divElement.style.display = "block";
        divInput.class = "form-control bg-light border-0";
        divInput.row = "1";
        divInput.name = "ptg";
        divInput.placeholder = "Potongan";
      }
      if (selectElement.value == "PPN") {
        divElement.style.display = "block";
        divInput.class = "form-control bg-light border-0";
        divInput.row = "1";
        divInput.name = "ppn";
        divInput.placeholder = "PPN";
      }
    } else {
      divElement.style.display = "none";
    }
  });
});
totalPembayaran();
remove();

// Event delegation untuk tombol Delete item
$(document).on('click', '.product-removal a, .product-removal button', function (e) {
  e.preventDefault();
  removeItem(e);
});

// Batas
function remove() {
  // Legacy compatibility - delegation handles clicks
}

function resetRow() {
  Array.from(document.getElementById("newlink").querySelectorAll("tr")).forEach(function (e, t) {
    t += 1;
    e.querySelector(".product-id").innerHTML = t;
    e.id = t; // Menetapkan ulang ID elemen

    // Mengubah ID semua elemen dalam row
    e.querySelectorAll("[id^='productName-'], [id^='productDetails-'], [id^='satuan-'], [id^='productRate-'], [id^='product-qty-'],[id^='productPrice-']").forEach(function (elem) {
      var oldId = elem.id;
      var newId = oldId.replace(/-\d+$/, '-' + t);
      elem.id = newId;
    });
  });
}

function removeItem(e) {
  var row = e.target.closest("tr");
  var id = parseInt(row.id);
  row.remove();
  resetRow();
  updateValues();

  // Menghapus ID dari daftar usedIds
  var index = usedIds.indexOf(id);
  if (index !== -1) {
    usedIds.splice(index, 1);
  }
}

function updateValues() {
  getTotal();
  sisaPembayaran();
}
