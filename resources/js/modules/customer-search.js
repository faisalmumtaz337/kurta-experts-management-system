import TableSearch from '../core/table-search';

new TableSearch({

    input: '#customerSearch',
    tableBody: '#customerTableBody',
    url: '/customers/search'
    
});