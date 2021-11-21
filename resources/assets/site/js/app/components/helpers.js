// Svg icon generate
export function icon(name, mod = '') {
    const classes = name + ' ' + mod;

    return (`
        <svg class="icon ${classes.trim()}">
            <use xlink:href="#${name}"></use>
        </svg>
    `);
}
