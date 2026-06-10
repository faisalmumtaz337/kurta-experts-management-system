import TableSearch from '../core/table-search';

new TableSearch({

    input: '#employeePaymentSearch',
    tableBody: '#employeePaymentTableBody',
    url: '/employee-payments/search'
    
});