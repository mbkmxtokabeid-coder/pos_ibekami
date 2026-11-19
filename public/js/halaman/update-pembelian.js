var cleaveDelimiters, cleaveBlocks, inputTerbayar, totalJual, cleaveNumeral;
document.querySelector("#cleave-delimiters") && (cleaveDelimiters = new Cleave("#cleave-delimiters", { delimiters: [".", ".", "-"], blocks: [3, 3, 3, 2], uppercase: !0 })),
  document.querySelector("#cleave-prefix") && (cleavePrefix = new Cleave("#cleave-prefix", { prefix: "PREFIX", delimiter: "-", blocks: [6, 4, 4, 4], uppercase: !0 })),
  // Numeral Mask
  document.querySelector("#input_bayar") && (inputTerbayar = new Cleave("#input_bayar", { numeral: !0, numeralThousandsGroupStyle: "thousand" })),
  document.querySelector("#total-harga") && (totalJual = new Cleave("#total-harga", { numeral: !0, numeralThousandsGroupStyle: "thousand" })),
  document.querySelector("#cleave-numeral") && (cleaveNumeral = new Cleave("#cleave-numeral", { numeral: !0, numeralThousandsGroupStyle: "thousand" })),
  document.querySelector("#phone-number") && (cleaveNumeral = new Cleave("#phone-number", { delimiters: [" "], blocks: [4, 4, 4, 1] }))
  ;
document.querySelectorAll('[data-cleave]').forEach(function (element) {
  var cleaveConfig = JSON.parse(element.getAttribute('data-cleave'));
  new Cleave(element, cleaveConfig);
});

// SHOW FORM
document.addEventListener("DOMContentLoaded", function () {
  var selectElement = document.getElementById('statuss')
  var divElement = document.getElementById('terbayar')
  selectElement.addEventListener('change', function () {
    if (selectElement.value.includes('Belum Lunas')) {
      divElement.style.display = 'block'
    }
    else {
      divElement.style.display = 'none'
    }
  })
})

var count = 1;
var usedIds = [];
function new_link() {
  // count++;
  Array.from(document.querySelectorAll('.product')).forEach(function (element) {
    var id = parseInt(element.id);
    usedIds.push(id);
  });
  var smallestUnusedId = 1;
  while (usedIds.includes(smallestUnusedId)) {
    smallestUnusedId++;
  }

  count = smallestUnusedId;

  var e = document.createElement("tr");
  e.id = count;
  e.className = "product";

  var t =
    '<th scope="row" class="product-id">' +
    count +
    '</th><td class="text-start"><div class="mb-2"><textarea class="form-control bg-light border-0" id="productDetails-'
    + count +
    '" name="deskripsi[]" rows="1" placeholder="Deskripsi Item"></textarea></td><td><input type="text" class="form-control product-price bg-light border-0" id="productRate-'
    + count +
    '" step="0" name="harga[]" data-cleave=\'{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }\' placeholder="Rp. 0.000" onchange="autoCalc(this)" required /><div class="invalid-feedback">Tolong masukkan Harga</div></td><td><div class="input-step"><input type="text" class="text-center" id="product-qty-'
    + count +
    '" name="qty[]" onchange="autoCalc(this)" value="1"></div></td><td class="text-end"><div><input type="text" class="form-control bg-light border-0 product-line-price" name="jumlah[]" id="productPrice-'
    + count + '" placeholder="Rp.0.000" readonly/></div></td><td class="product-removal"><a class="btn btn-success">Delete</a></td>';

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

  // isData();
  var inputElement = document.getElementById("productRate-" + count);
  var cleaveConfig = JSON.parse(inputElement.getAttribute('data-cleave'));
  new Cleave(inputElement, cleaveConfig);

  remove();
  resetRow();
};

function parseNominalPembelian(val) {
  if (val === null || val === undefined) return 0;
  var digits = String(val).replace(/[^0-9]/g, '');
  return digits ? parseInt(digits, 10) : 0;
}

function formatNominalPembelian(val) {
  var num = Math.round(Number(val) || 0);
  return num.toLocaleString('id-ID');
}

function autoCalc(v) {
  if (!v) return;
  var row = v.closest('tr.product') || v.closest('tr');
  if (!row) return;
  var hargaElem = row.querySelector('.product-price') || row.querySelector('[id^="productRate-"]');
  var qtyElem = row.querySelector('[id^="product-qty-"]') || row.querySelector('input[name^="qty"]');
  var priceElem = row.querySelector('.product-line-price') || row.querySelector('[id^="productPrice-"]');

  var formattedHarga = hargaElem ? parseNominalPembelian(hargaElem.value) : 0;
  var qty = qtyElem ? (parseFloat(qtyElem.value) || 0) : 0;

  if (!isNaN(formattedHarga) && !isNaN(qty)) {
    var jumlah = Math.round(formattedHarga * qty);
    if (priceElem) priceElem.value = formatNominalPembelian(jumlah);
    getTotal();
  }
}

function getTotal() {
  var sum = 0;
  var semuaHarga = document.querySelectorAll('[id^="productPrice-"]');
  for (let i = 0; i < semuaHarga.length; i++) {
    const harga = parseNominalPembelian(semuaHarga[i].value);
    if (!isNaN(harga)) {
      sum += harga;
    }
  }
  var totalEl = document.getElementById('total-harga');
  if (totalEl) totalEl.value = formatNominalPembelian(sum);
  totalPembayaran();
}

var semuaHargaElements = document.querySelectorAll('[id^="productPrice-"]');
semuaHargaElements.forEach(function (element) {
  element.addEventListener('change', getTotal);
});


function totalPembayaran() {
  var inputTerbayar = document.getElementById('input_bayar');
  var totalHargaEl = document.getElementById('total-harga');
  var sisaPembayaran = document.getElementById('sisa_bayar');
  if (!totalHargaEl || !sisaPembayaran) return;

  var inputTotal = parseNominalPembelian(totalHargaEl.value);
  var inputTerbayarVal = inputTerbayar ? parseNominalPembelian(inputTerbayar.value) : 0;
  var sisa = Math.max(0, inputTotal - inputTerbayarVal);
  sisaPembayaran.value = formatNominalPembelian(sisa);
}
if (document.getElementById('input_bayar')) {
  document.getElementById('input_bayar').addEventListener('input', totalPembayaran);
  document.getElementById('input_bayar').addEventListener('change', totalPembayaran);
}
remove();

// Batas
function remove() {
  Array.from(document.querySelectorAll(".product-removal a")).forEach(function (e) {
    e.addEventListener("click", function (e) {
      removeItem(e);
    });
  });
}
function resetRow() {
  Array.from(document.getElementById("newlink").querySelectorAll("tr")).forEach(function (e, t) {
    t += 1;
    e.querySelector(".product-id").innerHTML = t;
    e.id = t
    e.querySelectorAll("[id^='productName-'], [id^='productDetails-'], [id^='satuan-'], [id^='productRate-'], [id^='product-qty-'],[id^='productPrice-']").forEach(function (elem) {
      var oldId = elem.id
      var newId = oldId.replace(/-\d+$/, '-' + t)
      elem.id = newId
    })
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

}