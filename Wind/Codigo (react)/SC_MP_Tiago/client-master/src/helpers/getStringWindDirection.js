export const getStringWindDirection = (windDirection) => {
    if (windDirection >= 11.25 && windDirection < 33.75) return 'NNE';
    if (windDirection >= 33.75 && windDirection < 56.25) return 'NE';
    if (windDirection >= 56.25 && windDirection < 78.75) return 'ENE';
    if (windDirection >= 78.75 && windDirection < 101.75) return 'E';
    if (windDirection >= 101.25 && windDirection < 123.75) return 'ESSE';
    if (windDirection >= 123.55 && windDirection < 146.25) return 'SE';
    if (windDirection >= 146.25 && windDirection < 168.75) return 'SSE';
    if (windDirection >= 168.75 && windDirection < 191.25) return 'S';
    if (windDirection >= 191.25 && windDirection < 213.75) return 'SSO';
    if (windDirection >= 213.75 && windDirection < 236.25) return 'SO';
    if (windDirection >= 236.25 && windDirection < 258.75) return 'OSO';
    if (windDirection >= 258.75 && windDirection < 281.25) return 'O';
    if (windDirection >= 281.25 && windDirection < 303.75) return 'ONO';
    if (windDirection >= 303.75 && windDirection < 326.25) return 'NO';
    if (windDirection >= 326.25 && windDirection < 348.75) return 'NNO';
    if (windDirection >= 348.75 && windDirection < 11.25) return 'N';
};
