/**
 * Convierte Latitud/Longitud Decimal a UTM (WGS84)
 * @param {number} lat - Latitud en grados decimales
 * @param {number} lon - Longitud en grados decimales
 * @returns {object} {easting, northing, zoneNumber, zoneLetter}
 */
function decimalToUTM(lat, lon) {
    const deg2rad = Math.PI / 180;

    // Parámetros WGS84
    const a = 6378137.0; // Radio ecuatorial
    const eccSquared = 0.00669438; // Excentricidad al cuadrado
    const k0 = 0.9996;

    let zoneNumber = Math.floor((lon + 180) / 6) + 1;

    // Manejo de zonas especiales (Noruega/Svalbard)
    if (lat >= 56.0 && lat < 64.0 && lon >= 3.0 && lon < 12.0) zoneNumber = 32;
    if (lat >= 72.0 && lat < 84.0) {
        if (lon >= 0.0 && lon < 9.0) zoneNumber = 31;
        else if (lon >= 9.0 && lon < 21.0) zoneNumber = 33;
        else if (lon >= 21.0 && lon < 33.0) zoneNumber = 35;
        else if (lon >= 33.0 && lon < 42.0) zoneNumber = 37;
    }

    const lonOrigin = (zoneNumber - 1) * 6 - 180 + 3;
    const lonOriginRad = lonOrigin * deg2rad;

    const latRad = lat * deg2rad;
    const lonRad = lon * deg2rad;

    const eccPrimeSquared = (eccSquared) / (1 - eccSquared);

    const N = a / Math.sqrt(1 - eccSquared * Math.sin(latRad) * Math.sin(latRad));
    const T = Math.tan(latRad) * Math.tan(latRad);
    const C = eccPrimeSquared * Math.cos(latRad) * Math.cos(latRad);
    const A = Math.cos(latRad) * (lonRad - lonOriginRad);

    const M = a * ((1 - eccSquared / 4 - 3 * eccSquared * eccSquared / 64 - 5 * eccSquared * eccSquared * eccSquared / 256) * latRad
        - (3 * eccSquared / 8 + 3 * eccSquared * eccSquared / 32 + 45 * eccSquared * eccSquared * eccSquared / 1024) * Math.sin(2 * latRad)
        + (15 * eccSquared * eccSquared / 256 + 45 * eccSquared * eccSquared * eccSquared / 1024) * Math.sin(4 * latRad)
        - (35 * eccSquared * eccSquared * eccSquared / 3072) * Math.sin(6 * latRad));

    const easting = (k0 * N * (A + (1 - T + C) * A * A * A / 6
        + (5 - 18 * T + T * T + 72 * C - 58 * eccPrimeSquared) * A * A * A * A * A / 120)
        + 500000.0);

    let northing = (k0 * (M + N * Math.tan(latRad) * (A * A / 2 + (5 - T + 9 * C + 4 * C * C) * A * A * A * A / 24
        + (61 - 58 * T + T * T + 600 * C - 330 * eccPrimeSquared) * A * A * A * A * A * A / 720)));

    if (lat < 0) northing += 10000000.0; // Ajuste para el hemisferio sur

    return {
        easting: parseFloat(easting.toFixed(2)),
        northing: parseFloat(northing.toFixed(2)),
        zoneNumber: zoneNumber,
        zoneLetter: getUtmLetter(lat)
    };
}

function getUtmLetter(lat) {
    if (lat >= 84 || lat < -80) return 'Z'; // Fuera de UTM
    const letters = "CDEFGHJKLMNPQRSTUVWXX";
    return letters[Math.floor((lat + 80) / 8)];
}

// Ejemplo de uso:
// console.log(decimalToUTM(40.4168, -3.7038)); // Madrid

export { decimalToUTM }