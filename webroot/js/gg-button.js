/**
 * GGButton - A custom web component that renders a styled button.
 *
 * @example
 * <gg-button variant="black" size="medium">Click Me</gg-button>
 *
 * @customElement
 * @extends HTMLElement
 *
 * @attribute {string} variant - Visual style of the button.
 *    Options:
 *    - "black": Black background, white text (inverts on hover)
 *    - "white": White background, black text (inverts on hover)
 *
 * @attribute {string} size - Button size.
 *    Options:
 *    - "small": Smaller font and padding
 *    - "medium": Default size
 *    - "large": Larger font and padding
 *
 * @slot - The content inside the button.
 *
 */
class GGButton extends HTMLElement {
    /**
     * Constructs the GGButton component and attaches a shadow root.
     */
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
        this.loadStyles().then(() => this.render());
    }

    /**
     * Asynchronously loads the button's styles from an external CSS file
     * and applies them via adoptedStyleSheets.
     *
     * @returns {Promise<void>}
     */
    async loadStyles() {
        const cssText = await fetch('/css/gg-button.css').then(res => res.text());
        const sheet = new CSSStyleSheet();
        sheet.replaceSync(cssText);
        this.shadowRoot.adoptedStyleSheets = [sheet];
    }

    /**
     * Renders the internal structure of the button and sets up event listeners.
     */
    render() {
        this.shadowRoot.innerHTML = `
            <button part="button">
                <slot></slot>
            </button>
        `;
    }
}

customElements.define('gg-button', GGButton);
