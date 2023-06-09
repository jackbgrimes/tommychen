<?php

$countryList = [
    ['United States', 'USA', 'GBR', 'USD'],
    ['Canada', 'CAN', 'GBR', 'CAD'],
    ['United Kingdom', 'GBR', 'GBR', 'GBP'],
    ['Germany', 'DEU', 'GBR', 'EUR'],
    ['Sweden', 'SWE', 'GBR', 'SEK'],
    ['France', 'FRA', 'GBR', 'EUR'],
    ['Mexico', 'MEX', 'GBR', 'GBP'],
    ['Australia', 'AUS', 'GBR', 'AUD'],
    ['Japan', 'JPN', 'GBR', 'JPY'],
    ['Israel', 'ISR', 'GBR', 'GBP'],
    ['Switzerland', 'CHE', 'GBR', 'CHF'],
    ['Italy', 'ITA', 'GBR', 'EUR'],
    ['Brazil', 'BRA', 'GBR', 'GBP'],
    ['Greece', 'GRC', 'GBR', 'EUR'],
    ['Spain', 'ESP', 'GBR', 'EUR'],
    ['Austria', 'AUT', 'GBR', 'EUR'],
    ['Afghanistan', 'AFG', 'GBR', 'GBP'],
    ['Albania', 'ALB', 'GBR', 'GBP'],
    ['Algeria', 'DZA', 'GBR', 'GBP'],
    ['American Samoa', 'ASM', 'GBR', 'USD'],
    ['Andorra', 'AND', 'GBR', 'EUR'],
    ['Angola', 'AGO', 'GBR', 'GBP'],
    ['Anguilla', 'AIA', 'GBR', 'GBP'],
    ['Antarctica', 'ATA', 'GBR', 'GBP'],
    ['Antigua and Barbuda', 'ATG', 'GBR', 'GBP'],
    ['Argentina', 'ARG', 'GBR', 'GBP'],
    ['Armenia', 'ARM', 'GBR', 'GBP'],
    ['Aruba', 'ABW', 'GBR', 'GBP'],
    ['Azerbaijan', 'AZE', 'GBR', 'GBP'],
    ['Bahamas', 'BHS', 'GBR', 'GBP'],
    ['Bahrain', 'BHR', 'GBR', 'GBP'],
    ['Bangladesh', 'BGD', 'GBR', 'GBP'],
    ['Barbados', 'BRB', 'GBR', 'GBP'],
    ['Belarus', 'BLR', 'GBR', 'GBP'],
    ['Belgium', 'BEL', 'GBR', 'EUR'],
    ['Belize', 'BLZ', 'GBR', 'GBP'],
    ['Benin', 'BEN', 'GBR', 'GBP'],
    ['Bermuda', 'BMU', 'GBR', 'GBP'],
    ['Bhutan', 'BTN', 'GBR', 'GBP'],
    ['Bolivia', 'BOL', 'GBR', 'GBP'],
    ['Bonaire, Sint Eustatius and Saba', 'BES', 'GBR', 'USD'],
    ['Bosnia and Herzegovina', 'BIH', 'GBR', 'GBP'],
    ['Botswana', 'BWA', 'GBR', 'GBP'],
    ['Bouvet Island', 'BVT', 'GBR', 'NOK'],
    ['British Indian Ocean Territory', 'IOT', 'GBR', 'GBP'],
    ['Brunei Darussalam', 'BRN', 'GBR', 'GBP'],
    ['Bulgaria', 'BGR', 'GBR', 'GBP'],
    ['Burkina Faso', 'BFA', 'GBR', 'GBP'],
    ['Burundi', 'BDI', 'GBR', 'GBP'],
    ['Cambodia', 'KHM', 'GBR', 'GBP'],
    ['Cameroon', 'CMR', 'GBR', 'GBP'],
    ['Cape Verde', 'CPV', 'GBR', 'GBP'],
    ['Cayman Islands', 'CYM', 'GBR', 'GBP'],
    ['Central African Republic', 'CAF', 'GBR', 'GBP'],
    ['Chad', 'TCD', 'GBR', 'GBP'],
    ['Chile', 'CHL', 'GBR', 'GBP'],
    ['China', 'CHN', 'GBR', 'GBP'],
    ['Christmas Island', 'CXR', 'GBR', 'AUD'],
    ['Cocos (Keeling) Islands', 'CCK', 'GBR', 'AUD'],
    ['Colombia', 'COL', 'GBR', 'GBP'],
    ['Comoros', 'COM', 'GBR', 'GBP'],
    ['Congo', 'COG', 'GBR', 'GBP'],
    ['Congo, the Democratic Republic of the', 'COD', 'GBR', 'USD'],
    ['Cook Islands', 'COK', 'GBR', 'NZD'],
    ['Costa Rica', 'CRI', 'GBR', 'GBP'],
    ['Cote D\'Ivoire', 'CIV', 'GBR', 'GBP'],
    ['Croatia', 'HRV', 'GBR', 'GBP'],
    ['Cuba', 'CUB', 'GBR', 'GBP'],
    ['Curaçao', 'CUW', 'GBR', 'USD'],
    ['Cyprus', 'CYP', 'GBR', 'EUR'],
    ['Czech Republic', 'CZE', 'GBR', 'GBP'],
    ['Denmark', 'DNK', 'GBR', 'DKK'],
    ['Djibouti', 'DJI', 'GBR', 'GBP'],
    ['Dominica', 'DMA', 'GBR', 'GBP'],
    ['Dominican Republic', 'DOM', 'GBR', 'GBP'],
    ['Ecuador', 'ECU', 'GBR', 'GBP'],
    ['Egypt', 'EGY', 'GBR', 'GBP'],
    ['El Salvador', 'SLV', 'GBR', 'GBP'],
    ['Equatorial Guinea', 'GNQ', 'GBR', 'GBP'],
    ['Eritrea', 'ERI', 'GBR', 'GBP'],
    ['Estonia', 'EST', 'GBR', 'EUR'],
    ['Eswatini', 'SWZ', 'GBR', 'GBP'],
    ['Ethiopia', 'ETH', 'GBR', 'GBP'],
    ['Falkland Islands (Malvinas)', 'FLK', 'GBR', 'GBP'],
    ['Faroe Islands', 'FRO', 'GBR', 'GBP'],
    ['Fiji', 'FJI', 'GBR', 'GBP'],
    ['Finland', 'FIN', 'GBR', 'EUR'],
    ['French Guiana', 'GUF', 'GBR', 'EUR'],
    ['French Polynesia', 'PYF', 'GBR', 'GBP'],
    ['French Southern Territories', 'ATF', 'GBR', 'EUR'],
    ['Gabon', 'GAB', 'GBR', 'GBP'],
    ['Gambia', 'GMB', 'GBR', 'GBP'],
    ['Georgia', 'GEO', 'GBR', 'GBP'],
    ['Ghana', 'GHA', 'GBR', 'GBP'],
    ['Gibraltar', 'GIB', 'GBR', 'GBP'],
    ['Greenland', 'GRL', 'GBR', 'DKK'],
    ['Grenada', 'GRD', 'GBR', 'GBP'],
    ['Guadeloupe', 'GLP', 'GBR', 'EUR'],
    ['Guam', 'GUM', 'GBR', 'USD'],
    ['Guatemala', 'GTM', 'GBR', 'GBP'],
    ['Guernsey', 'GGY', 'GBR', 'GBP'],
    ['Guinea', 'GIN', 'GBR', 'GBP'],
    ['Guinea-Bissau', 'GNB', 'GBR', 'GBP'],
    ['Guyana', 'GUY', 'GBR', 'GBP'],
    ['Haiti', 'HTI', 'GBR', 'GBP'],
    ['Heard Island and McDonald Islands', 'HMD', 'GBR', 'AUD'],
    ['Holy See (Vatican City State)', 'VAT', 'GBR', 'GBP'],
    ['Honduras', 'HND', 'GBR', 'GBP'],
    ['Hong Kong', 'HKG', 'GBR', 'GBP'],
    ['Hungary', 'HUN', 'GBR', 'GBP'],
    ['Iceland', 'ISL', 'GBR', 'GBP'],
    ['India', 'IND', 'GBR', 'GBP'],
    ['Indonesia', 'IDN', 'GBR', 'GBP'],
    ['Iran', 'IRN', 'GBR', 'GBP'],
    ['Iraq', 'IRQ', 'GBR', 'GBP'],
    ['Ireland', 'IRL', 'GBR', 'EUR'],
    ['Isle of Man', 'IMN', 'GBR', 'GBP'],
    ['Jamaica', 'JAM', 'GBR', 'GBP'],
    ['Jersey', 'JEY', 'GBR', 'GBP'],
    ['Jordan', 'JOR', 'GBR', 'GBP'],
    ['Kazakhstan', 'KAZ', 'GBR', 'GBP'],
    ['Kenya', 'KEN', 'GBR', 'GBP'],
    ['Kiribati', 'KIR', 'GBR', 'GBP'],
    ['Kosovo', 'XKX', 'GBR', 'USD'],
    ['Kuwait', 'KWT', 'GBR', 'GBP'],
    ['Kyrgyzstan', 'KGZ', 'GBR', 'GBP'],
    ['Lao People\'s Democratic Republic', 'LAO', 'GBR', 'GBP'],
    ['Latvia', 'LVA', 'GBR', 'EUR'],
    ['Lebanon', 'LBN', 'GBR', 'GBP'],
    ['Lesotho', 'LSO', 'GBR', 'GBP'],
    ['Liberia', 'LBR', 'GBR', 'GBP'],
    ['Libya', 'LBY', 'GBR', 'GBP'],
    ['Liechtenstein', 'LIE', 'GBR', 'GBP'],
    ['Lithuania', 'LTU', 'GBR', 'EUR'],
    ['Luxembourg', 'LUX', 'GBR', 'EUR'],
    ['Macao', 'MAC', 'GBR', 'GBP'],
    ['Madagascar', 'MDG', 'GBR', 'GBP'],
    ['Malawi', 'MWI', 'GBR', 'GBP'],
    ['Malaysia', 'MYS', 'GBR', 'GBP'],
    ['Maldives', 'MDV', 'GBR', 'GBP'],
    ['Mali', 'MLI', 'GBR', 'GBP'],
    ['Malta', 'MLT', 'GBR', 'EUR'],
    ['Marshall Islands', 'MHL', 'GBR', 'GBP'],
    ['Martinique', 'MTQ', 'GBR', 'EUR'],
    ['Mauritania', 'MRT', 'GBR', 'GBP'],
    ['Mauritius', 'MUS', 'GBR', 'GBP'],
    ['Mayotte', 'MYT', 'GBR', 'EUR'],
    ['Micronesia, Federated States of', 'FSM', 'GBR', 'GBP'],
    ['Moldova, Republic of', 'MDA', 'GBR', 'GBP'],
    ['Monaco', 'MCO', 'GBR', 'EUR'],
    ['Mongolia', 'MNG', 'GBR', 'GBP'],
    ['Montenegro', 'MNE', 'GBR', 'USD'],
    ['Montserrat', 'MSR', 'GBR', 'GBP'],
    ['Morocco', 'MAR', 'GBR', 'GBP'],
    ['Mozambique', 'MOZ', 'GBR', 'GBP'],
    ['Myanmar', 'MMR', 'GBR', 'GBP'],
    ['Namibia', 'NAM', 'GBR', 'GBP'],
    ['Nauru', 'NRU', 'GBR', 'GBP'],
    ['Nepal', 'NPL', 'GBR', 'GBP'],
    ['Netherlands', 'NLD', 'GBR', 'EUR'],
    ['New Caledonia', 'NCL', 'GBR', 'GBP'],
    ['New Zealand', 'NZL', 'GBR', 'NZD'],
    ['Nicaragua', 'NIC', 'GBR', 'GBP'],
    ['Niger', 'NER', 'GBR', 'GBP'],
    ['Nigeria', 'NGA', 'GBR', 'GBP'],
    ['Niue', 'NIU', 'GBR', 'NZD'],
    ['Norfolk Island', 'NFK', 'GBR', 'AUD'],
    ['North Korea', 'PRK', 'GBR', 'GBP'],
    ['North Macedonia, Republic of', 'MKD', 'GBR', 'GBP'],
    ['Northern Mariana Islands', 'MNP', 'GBR', 'USD'],
    ['Norway', 'NOR', 'GBR', 'NOK'],
    ['Oman', 'OMN', 'GBR', 'GBP'],
    ['Pakistan', 'PAK', 'GBR', 'GBP'],
    ['Palau', 'PLW', 'GBR', 'GBP'],
    ['Panama', 'PAN', 'GBR', 'GBP'],
    ['Papua New Guinea', 'PNG', 'GBR', 'GBP'],
    ['Paraguay', 'PRY', 'GBR', 'GBP'],
    ['Peru', 'PER', 'GBR', 'GBP'],
    ['Philippines', 'PHL', 'GBR', 'GBP'],
    ['Pitcairn', 'PCN', 'GBR', 'NZD'],
    ['Poland', 'POL', 'GBR', 'GBP'],
    ['Portugal', 'PRT', 'GBR', 'EUR'],
    ['Puerto Rico', 'PRI', 'GBR', 'USD'],
    ['Qatar', 'QAT', 'GBR', 'GBP'],
    ['Reunion', 'REU', 'GBR', 'EUR'],
    ['Romania', 'ROU', 'GBR', 'GBP'],
    ['Russian Federation', 'RUS', 'GBR', 'GBP'],
    ['Rwanda', 'RWA', 'GBR', 'GBP'],
    ['Saint Barthélemy', 'BLM', 'GBR', 'USD'],
    ['Saint Helena', 'SHN', 'GBR', 'GBP'],
    ['Saint Kitts and Nevis', 'KNA', 'GBR', 'GBP'],
    ['Saint Lucia', 'LCA', 'GBR', 'GBP'],
    ['Saint Martin (French part)', 'MAF', 'GBR', 'USD'],
    ['Saint Pierre and Miquelon', 'SPM', 'GBR', 'EUR'],
    ['Saint Vincent and the Grenadines', 'VCT', 'GBR', 'GBP'],
    ['Samoa', 'WSM', 'GBR', 'GBP'],
    ['San Marino', 'SMR', 'GBR', 'EUR'],
    ['Sao Tome and Principe', 'STP', 'GBR', 'GBP'],
    ['Saudi Arabia', 'SAU', 'GBR', 'GBP'],
    ['Senegal', 'SEN', 'GBR', 'GBP'],
    ['Serbia', 'SRB', 'GBR', 'GBP'],
    ['Seychelles', 'SYC', 'GBR', 'GBP'],
    ['Sierra Leone', 'SLE', 'GBR', 'GBP'],
    ['Singapore', 'SGP', 'GBR', 'GBP'],
    ['Sint Maarten (Dutch part)', 'SXM', 'GBR', 'USD'],
    ['Slovakia', 'SVK', 'GBR', 'EUR'],
    ['Slovenia', 'SVN', 'GBR', 'EUR'],
    ['Solomon Islands', 'SLB', 'GBR', 'GBP'],
    ['Somalia', 'SOM', 'GBR', 'GBP'],
    ['South Africa', 'ZAF', 'GBR', 'GBP'],
    ['South Georgia and the South Sandwich Islands', 'SGS', 'GBR', 'GBP'],
    ['South Korea', 'KOR', 'GBR', 'GBP'],
    ['South Sudan', 'SSD', 'GBR', 'USD'],
    ['Sri Lanka', 'LKA', 'GBR', 'GBP'],
    ['State of Palestine', 'PSE', 'GBR', 'GBP'],
    ['Sudan', 'SDN', 'GBR', 'GBP'],
    ['Suriname', 'SUR', 'GBR', 'USD'],
    ['Svalbard and Jan Mayen', 'SJM', 'GBR', 'NOK'],
    ['Syrian Arab Republic', 'SYR', 'GBR', 'GBP'],
    ['Taiwan, Province of China', 'TWN', 'GBR', 'USD'],
    ['Tajikistan', 'TJK', 'GBR', 'GBP'],
    ['Tanzania, United Republic of', 'TZA', 'GBR', 'GBP'],
    ['Thailand', 'THA', 'GBR', 'GBP'],
    ['Timor-Leste', 'TLS', 'GBR', 'USD'],
    ['Togo', 'TGO', 'GBR', 'GBP'],
    ['Tokelau', 'TKL', 'GBR', 'NZD'],
    ['Tonga', 'TON', 'GBR', 'GBP'],
    ['Trinidad and Tobago', 'TTO', 'GBR', 'GBP'],
    ['Tunisia', 'TUN', 'GBR', 'GBP'],
    ['Turkey', 'TUR', 'GBR', 'GBP'],
    ['Turkmenistan', 'TKM', 'GBR', 'GBP'],
    ['Turks and Caicos Islands', 'TCA', 'GBR', 'USD'],
    ['Tuvalu', 'TUV', 'GBR', 'GBP'],
    ['Uganda', 'UGA', 'GBR', 'GBP'],
    ['Ukraine', 'UKR', 'GBR', 'GBP'],
    ['United Arab Emirates', 'ARE', 'GBR', 'GBP'],
    ['United States Minor Outlying Islands', 'UMI', 'GBR', 'USD'],
    ['Uruguay', 'URY', 'GBR', 'GBP'],
    ['Uzbekistan', 'UZB', 'GBR', 'GBP'],
    ['Vanuatu', 'VUT', 'GBR', 'GBP'],
    ['Venezuela', 'VEN', 'GBR', 'GBP'],
    ['Vietnam', 'VNM', 'GBR', 'GBP'],
    ['Virgin Islands, British', 'VGB', 'GBR', 'USD'],
    ['Virgin Islands, U.S.', 'VIR', 'GBR', 'USD'],
    ['Wallis and Futuna', 'WLF', 'GBR', 'GBP'],
    ['Western Sahara', 'ESH', 'GBR', 'GBP'],
    ['Yemen', 'YEM', 'GBR', 'GBP'],
    ['Zambia', 'ZMB', 'GBR', 'GBP'],
    ['Zimbabwe', 'ZWE', 'GBR', 'GBP'],
    ['Åland Islands', 'ALA', 'GBR', 'EUR']
];

function getCountryList()
{
    global $countryList;

    return $countryList;
}
function getCountryDetail($name) {
    global $countryList;
    foreach ($countryList as $country) {
        if (strtolower($name) == strtolower($country[1])) {
            return $country;
        }
    }
    return null;
}

function getCountryFromIP() {
    $ipAddress = $_SERVER["REMOTE_ADDR"];
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ipAddress));    
    if($ip_data && $ip_data->geoplugin_countryName != null){
        return [$ip_data->geoplugin_countryName, $ip_data->geoplugin_currencyCode];
    }
    return ["USA", "USD"];
}