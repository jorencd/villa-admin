// Dummy Data
const data = {
  annual: [
    { id: 1, date: "2024", income: 100000 },
    { id: 2, date: "2023", income: 95000 },
  ],
  monthly: [
    { id: 1, date: "January 2025", income: 8500 },
    { id: 2, date: "December 2024", income: 8000 },
  ],
  daily: [
    { id: 1, date: "2025-01-10", income: 300 },
    { id: 2, date: "2025-01-09", income: 250 },
  ],
};

// Update Report Content
function updateReport() {
  const reportType = document.getElementById("reportType").value;
  const reportTitle = document.getElementById("reportTitle");
  const reportTableBody = document.getElementById("reportTableBody");
  const totalIncome = document.getElementById("totalIncome");

  // Clear existing rows
  reportTableBody.innerHTML = "";

  // Update title
  reportTitle.textContent =
    reportType.charAt(0).toUpperCase() + reportType.slice(1) + " Income";

  // Populate table rows
  let total = 0;
  data[reportType].forEach((row) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
<td>${row.id}</td>
<td>${row.date}</td>
<td>$${row.income.toFixed(2)}</td>
`;
    reportTableBody.appendChild(tr);
    total += row.income;
  });

  // Update total income
  totalIncome.textContent = `$${total.toFixed(2)}`;
}

// Export to PDF
async function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({
    orientation: "portrait",
    unit: "mm",
    format: "a4",
  });

  // Add header
  const title = document.getElementById("reportTitle").textContent;
  doc.setFontSize(16);
  doc.text(title, 105, 20, { align: "center" });

  // Add content
  const reportContent = document.getElementById("reportContent");
  await doc.html(reportContent, {
    x: 10,
    y: 30,
    width: 190, // A4 width minus margins
  });

  // Add footer
  const pageHeight = doc.internal.pageSize.height;
  doc.setFontSize(10);
  doc.text(
    "Generated on: " + new Date().toLocaleDateString(),
    10,
    pageHeight - 10
  );
  doc.text("Page 1 of 1", 190, pageHeight - 10, { align: "right" });

  // Save PDF
  doc.save(`${title.replace(" ", "_")}_Report.pdf`);
}

// Initialize default report
updateReport();
