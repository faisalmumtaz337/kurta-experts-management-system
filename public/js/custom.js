
// Logout customization
document.getElementById("customLogout").addEventListener("click", function(e) {
    e.preventDefault(); 
    document.getElementById("logoutForm").submit();
    document.getElementById("submitBtn").click();
});

// Upload Button
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.file-upload-browse').forEach(function(button) {
        button.addEventListener('click', function() {
            let fileInput = this.closest('.form-group').querySelector('.file-upload-default');
            fileInput.click();
        });
    });

    document.querySelectorAll('.file-upload-default').forEach(function(input) {
        input.addEventListener('change', function() {
            let fileName = this.files[0]?.name || '';
            let textInput = this.closest('.form-group').querySelector('.file-upload-info');
            textInput.value = fileName;
        });
    });

});

// Delete customization
// document.getElementById("customDelete").addEventListener("click", function(e) {
//     e.preventDefault(); 
//     document.getElementById("deleteForm").submit();
//     document.getElementById("submitBtn").click();
// });

// Counting Numbers
window.addEventListener("load", function () {

    setTimeout(() => {

        const counters = document.querySelectorAll('.counter');

        counters.forEach(counter => {

            let target = Number(counter.dataset.count || 0);
            let useSeparator = counter.dataset.separator === 'true';

            let current = 0;
            let step = Math.max(1, target / 100);

            let timer = setInterval(() => {

                current += step;

                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }

                let value = Math.floor(current);

                counter.innerText = useSeparator
                    ? value.toLocaleString()
                    : value;

            }, 20);

        });

    }, 300);

});
