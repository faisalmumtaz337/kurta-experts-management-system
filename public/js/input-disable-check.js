document.addEventListener("DOMContentLoaded", function () {

    const radios = document.querySelectorAll('input[name="cuff_type"]');
    const inputs = document.querySelectorAll('.cuff-input');

    function handleChange() {
        // sab inputs disable karo
        inputs.forEach(input => {
            input.disabled = true;
        });

        // jo radio checked hai uska next input enable karo
        let checkedRadio = document.querySelector('input[name="cuff_type"]:checked');

        if (checkedRadio) {
            let parentRow = checkedRadio.closest('.row');
            let input = parentRow.querySelector('.cuff-input');

            if (input) {
                input.disabled = false;
            }
        }
    }

    // initial run (page load pe)
    handleChange();

    // jab radio change ho
    radios.forEach(radio => {
        radio.addEventListener('change', handleChange);
    });

});
