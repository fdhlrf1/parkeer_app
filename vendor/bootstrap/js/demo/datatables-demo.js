$(document).ready(function () {
  var table = $('#dataTable').DataTable({
    searching: false, // Aktifkan fitur pencarian
    paging: false, // Nonaktifkan paging
    info: false, // Nonaktifkan informasi jumlah entri
    language: {
      url: '../vendor/datatables/Indonesian.json'
      // url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
    },
  });
});