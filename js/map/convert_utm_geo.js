/**
 * Convierte coordenadas UTM a Geográficas (WGS84)
 * @param {number} easting - Coordenada Este en metros
 * @param {number} northing - Coordenada Norte en metros
 * @param {number} zoneNumber - Número de zona UTM (1-60)
 * @param {string} northernHemisphere - Booleano: true para Norte, false para Sur
 * @returns {object} { lat, lon }
 */
function utmToLatLon(easting, northing, zoneNumber, northernHemisphere) {
    const x = easting - 500000;
    const y = northernHemisphere ? northing : northing - 10000000;

    const k0 = 0.9996;
    const a = 6378137;
    const eccSquared = 0.00669438;
    const e1 = (1 - Math.sqrt(1 - eccSquared)) / (1 + Math.sqrt(1 - eccSquared));

    const lonOrigin = (zoneNumber - 1) * 6 - 180 + 3;

    const M = y / k0;
    const mu = M / (a * (1 - eccSquared / 4 - 3 * eccSquared * eccSquared / 64 - 5 * eccSquared * eccSquared * eccSquared / 256));

    const phi1Rad = mu + (3 * e1 / 2 - 27 * Math.pow(e1, 3) / 32) * Math.sin(2 * mu) 
                   + (21 * e1 * e1 / 16 - 55 * Math.pow(e1, 4) / 32) * Math.sin(4 * mu)
                   + (151 * Math.pow(e1, 3) / 96) * Math.sin(6 * mu);

    const N1 = a / Math.sqrt(1 - eccSquared * Math.sin(phi1Rad) * Math.sin(phi1Rad));
    const T1 = Math.tan(phi1Rad) * Math.tan(phi1Rad);
    const C1 = (eccSquared / (1 - eccSquared)) * Math.pow(Math.cos(phi1Rad), 2);
    const R1 = a * (1 - eccSquared) / Math.pow(1 - eccSquared * Math.sin(phi1Rad) * Math.sin(phi1Rad), 1.5);
    const D = x / (N1 * k0);

    let lat = phi1Rad - (N1 * Math.tan(phi1Rad) / R1) * (D * D / 2 - (5 + 3 * T1 + 10 * C1 - 4 * C1 * C1 - 9 * (eccSquared / (1 - eccSquared))) * Math.pow(D, 4) / 24 + (61 + 90 * T1 + 298 * C1 + 45 * T1 * T1 - 252 * (eccSquared / (1 - eccSquared)) - 3 * C1 * C1) * Math.pow(D, 6) / 720);
    lat = lat * 180 / Math.PI;

    let lon = (D - (1 + 2 * T1 + C1) * Math.pow(D, 3) / 6 + (5 - 2 * C1 + 28 * T1 - 3 * C1 * C1 + 8 * (eccSquared / (1 - eccSquared)) + 24 * T1 * T1) * Math.pow(D, 5) / 120) / Math.cos(phi1Rad);
    lon = lonOrigin + lon * 180 / Math.PI;

    return {
        lat: lat.toFixed(6),
        lon: lon.toFixed(6)
    };
}

// Ejemplo de uso (Madrid, zona 30 Norte):
console.log(utmToLatLon(440312, 4474312, 30, true));

export { utmToLatLon }