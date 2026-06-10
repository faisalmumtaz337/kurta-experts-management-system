export default class TableSearch {

    constructor(config) {

        this.input = document.querySelector(config.input);
        this.tableBody = document.querySelector(config.tableBody);
        this.url = config.url;

        this.timer = null;
        this.abortController = null;

        // 🟢 store original table HTML (per instance safe)
        this.originalHTML = null;

        if (!this.input || !this.tableBody) return;

        this.init();
    }

    init() {

        // cache original table state once
        this.originalHTML = this.tableBody.innerHTML;

        this.input.addEventListener('input', () => {

            clearTimeout(this.timer);

            this.timer = setTimeout(() => {
                this.search();
            }, 300);
        });
    }

    async search() {

        const query = this.input.value.trim();

        // 🟢 RESET STATE (no API call, no reload)
        if (query === '') {
            this.tableBody.innerHTML = this.originalHTML;
            return;
        }

        // cancel previous request
        if (this.abortController) {
            this.abortController.abort();
        }

        this.abortController = new AbortController();

        try {
            const response = await fetch(
                `${this.url}?search=${encodeURIComponent(query)}`,
                {
                    signal: this.abortController.signal,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            );

            const html = await response.text();

            this.tableBody.innerHTML = html;

        } catch (error) {

            if (error.name !== 'AbortError') {
                console.error('Search failed:', error);
            }
        }
    }
}