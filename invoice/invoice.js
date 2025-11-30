(function () {
  const serviceListEl = document.getElementById("service-list");
  const totalNettoEl = document.getElementById("total-netto");
  const addServiceBtn = document.getElementById("add-service");
  const saveInvoiceBtn = document.getElementById("save-invoice");
  const historyEl = document.getElementById("invoice-history");

  let currentServices = [];
  let invoices = [];

  function renderServices() {
    serviceListEl.innerHTML = "";
    let total = 0;

    currentServices.forEach(function (srv, index) {
      const lineTotal = srv.qty * srv.price;
      total += lineTotal;

      const tr = document.createElement("tr");
      tr.innerHTML =
        "<td>" +
        (index + 1) +
        "</td>" +
        "<td>" +
        srv.name +
        "</td>" +
        "<td>" +
        srv.qty +
        "</td>" +
        "<td>" +
        srv.price.toFixed(2) +
        "</td>" +
        "<td>" +
        lineTotal.toFixed(2) +
        "</td>";
      serviceListEl.appendChild(tr);
    });

    totalNettoEl.textContent = total.toFixed(2);
  }

  addServiceBtn.addEventListener("click", function (e) {
    e.preventDefault();
    const nameInput = document.getElementById("service-name");
    const qtyInput = document.getElementById("service-qty");
    const priceInput = document.getElementById("service-price");

    const name = nameInput.value.trim();
    const qty = parseFloat(qtyInput.value);
    const price = parseFloat(priceInput.value);

    if (!name || isNaN(qty) || isNaN(price)) {
      alert("Uzupełnij nazwę usługi, ilość i cenę netto.");
      return;
    }

    currentServices.push({
      name: name,
      qty: qty,
      price: price,
    });

    nameInput.value = "";
    qtyInput.value = "";
    priceInput.value = "";

    renderServices();
  });

  function renderHistory() {
    historyEl.innerHTML = "";

    invoices.forEach(function (inv, index) {
      const article = document.createElement("article");
      article.className = "history-item";

      let rows = "";
      inv.services.forEach(function (srv, i) {
        const lineTotal = srv.qty * srv.price;
        rows +=
          "<tr>" +
          "<td>" +
          (i + 1) +
          "</td>" +
          "<td>" +
          srv.name +
          "</td>" +
          "<td>" +
          srv.qty +
          "</td>" +
          "<td>" +
          srv.price.toFixed(2) +
          "</td>" +
          "<td>" +
          lineTotal.toFixed(2) +
          "</td>" +
          "</tr>";
      });

      const historyTable =
        '<table>' +
        "<thead>" +
        "<tr>" +
        "<th>#</th>" +
        "<th>Usługa</th>" +
        "<th>Ilość</th>" +
        "<th>Cena netto</th>" +
        "<th>Wartość</th>" +
        "</tr>" +
        "</thead>" +
        "<tbody>" +
        rows +
        "</tbody>" +
        "<tfoot>" +
        "<tr>" +
        '<td colspan="4" class="sum-label">Suma netto</td>' +
        "<td>" +
        inv.totalNet +
        "</td>" +
        "</tr>" +
        "</tfoot>" +
        "</table>";

      article.innerHTML =
        "<h3>Faktura #" +
        (index + 1) +
        "</h3>" +
        "<p><strong>Sprzedawca:</strong> " +
        (inv.seller || "-") +
        "</p>" +
        "<p><strong>Nabywca:</strong> " +
        (inv.buyer || "-") +
        "</p>" +
        "<p><strong>Data:</strong> " +
        (inv.date || "-") +
        "</p>" +
        historyTable;

      historyEl.appendChild(article);
    });
  }

  saveInvoiceBtn.addEventListener("click", function (e) {
    e.preventDefault();

    if (currentServices.length === 0) {
      alert("Dodaj przynajmniej jedną usługę do faktury.");
      return;
    }

    const seller = document.getElementById("seller").value.trim();
    const buyer = document.getElementById("buyer").value.trim();
    const date = document.getElementById("date").value;

    const totalNet = currentServices.reduce(function (sum, srv) {
      return sum + srv.qty * srv.price;
    }, 0);

    invoices.push({
      seller: seller,
      buyer: buyer,
      date: date,
      services: currentServices.slice(),
      totalNet: totalNet.toFixed(2),
    });

    // wyczyść bieżącą listę usług
    currentServices = [];
    renderServices();
    renderHistory();
  });
})();