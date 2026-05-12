/**
 * Convierte Latitud/Longitud (WGS84) a coordenadas UTM
 * @param {number} lat - Latitud en grados decimales
 * @param {number} lon - Longitud en grados decimales
 * @returns {object} { easting, northing, zoneNumber, zoneLetter }
 */
function latLonToUTM(lat, lon) {
    const latRad = lat * Math.PI / 180;
    const lonRad = lon * Math.PI / 180;

    const zoneNumber = Math.floor((lon + 180) / 6) + 1;
    const lonOrigin = (zoneNumber - 1) * 6 - 180 + 3;
    const lonOriginRad = lonOrigin * Math.PI / 180;

    // Constantes WGS84
    const a = 6378137;
    const eccSquared = 0.00669438;
    const k0 = 0.9996;

    const eccPrimeSquared = (eccSquared) / (1 - eccSquared);
    const N = a / Math.sqrt(1 - eccSquared * Math.sin(latRad) * Math.sin(latRad));
    const T = Math.tan(latRad) * Math.tan(latRad);
    const C = eccPrimeSquared * Math.cos(latRad) * Math.cos(latRad);
    const A = Math.cos(latRad) * (lonRad - lonOriginRad);

    const M = a * ((1 - eccSquared / 4 - 3 * eccSquared * eccSquared / 64 - 5 * eccSquared * eccSquared * eccSquared / 256) * latRad 
                - (3 * eccSquared / 8 + 3 * eccSquared * eccSquared / 32 + 45 * eccSquared * eccSquared * eccSquared / 1024) * Math.sin(2 * latRad) 
                + (15 * eccSquared * eccSquared / 256 + 45 * eccSquared * eccSquared * eccSquared / 1024) * Math.sin(4 * latRad) 
                - (35 * eccSquared * eccSquared * eccSquared / 3072) * Math.sin(6 * latRad));

    const easting = k0 * N * (A + (1 - T + C) * A * A * A / 6 + (5 - 18 * T + T * T + 72 * C - 58 * eccPrimeSquared) * A * A * A * A * A / 120) + 500000.0;
    
    let northing = k0 * (M + N * Math.tan(latRad) * (A * A / 2 + (5 - T + 9 * C + 4 * C * C) * A * A * A * A / 24 + (61 - 58 * T + T * T + 600 * C - 330 * eccPrimeSquared) * A * A * A * A * A * A / 720));
    if (lat < 0) northing += 10000000.0; // Ajuste para el hemisferio sur

    return {
        easting: easting.toFixed(2),
        northing: northing.toFixed(2),
        zoneNumber: zoneNumber,
        zoneLetter: getUtmLetter(lat)
    };
}

function getUtmLetter(lat) {
    if (lat >= 72) return 'X'; else if (lat >= 64) return 'W'; else if (lat >= 56) return 'V';
    else if (lat >= 48) return 'U'; else if (lat >= 40) return 'T'; else if (lat >= 32) return 'S';
    else if (lat >= 24) return 'R'; else if (lat >= 16) return 'Q'; else if (lat >= 8) return 'P';
    else if (lat >= 0) return 'N'; else if (lat >= -8) return 'M'; else if (lat >= -16) return 'L';
    else if (lat >= -24) return 'K'; else if (lat >= -32) return 'J'; else if (lat >= -40) return 'H';
    else if (lat >= -48) return 'G'; else if (lat >= -56) return 'F'; else if (lat >= -64) return 'E';
    else if (lat >= -72) return 'D'; else if (lat >= -80) return 'C';
    else return 'Z';
}

// Ejemplo de uso:
console.log(latLonToUTM(40.4168, -3.7038)); // Madrid

export { latLonToUTM }