import TableSearch from '../core/table-search';

new TableSearch({

    input: '#orderCustomerSearch',
    tableBody: '#orderCustomerTableBody',
    url: '/order-customers/search'
    
});