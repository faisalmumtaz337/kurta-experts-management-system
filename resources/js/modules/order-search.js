import TableSearch from "../core/table-search";

new TableSearch({

  input: '#orderSearch',
  tableBody: '#orderTableBody',
  url: '/orders/search'

});