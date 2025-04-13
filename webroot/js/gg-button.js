class GGButton extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
        this.loadStyles().then(() => this.render());
    }

    async loadStyles() {
        const cssText = await fetch('/css/gg-button.css').then(res => res.text());
        const sheet = new CSSStyleSheet();
        sheet.replaceSync(cssText);
        this.shadowRoot.adoptedStyleSheets = [sheet];
    }


    render() {
        this.shadowRoot.innerHTML = `
            <button part="button">
                <slot></slot>
            </button>
        `;
    }
}

customElements.define('gg-button', GGButton);
