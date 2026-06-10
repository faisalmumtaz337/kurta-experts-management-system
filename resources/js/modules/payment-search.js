import TableSearch from '../core/table-search';

new TableSearch({

    input: '#paymentSearch',
    tableBody: '#paymentTableBody',
    url: '/order-payments/search'
    
});