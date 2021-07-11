
const utils = {
    base_url: process.env.NODE_ENV === 'production' ? 'http://apimarvelrodolfo.ddns.net/api/v1/' : 'http://localhost:8000/api/v1/',
    heroes_selected: [1009368, 1009664, 1009351] // Ids de Heroies originais
}

export default utils;