<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->delete();
        $currencies = [
            ["code" => "AFN", "name" => "Afgano Afgano",                             "symbol" => "؋"],
            ["code" => "ALL", "name" => "Lek Albanés",                               "symbol" => "L"],
            ["code" => "DZD", "name" => "Dinar Argelino",                            "symbol" => "د.ج"],
            ["code" => "USD", "name" => "Dólar Estadounidense",                      "symbol" => "$"],
            ["code" => "EUR", "name" => "Euro",                                      "symbol" => "€"],
            ["code" => "AOA", "name" => "Kwanza Angoleño",                           "symbol" => "Kz"],
            ["code" => "XCD", "name" => "Dólar del Caribe Oriental",                 "symbol" => "$"],
            ["code" => "ARS", "name" => "Peso Argentino",                            "symbol" => "$"],
            ["code" => "AMD", "name" => "Dram Armenio",                              "symbol" => "֏"],
            ["code" => "AWG", "name" => "Florín de Aruba",                           "symbol" => "ƒ"],
            ["code" => "AUD", "name" => "Dólar Australiano",                         "symbol" => "$"],
            ["code" => "AZN", "name" => "Manat Azerbaiyano",                         "symbol" => "₼"],
            ["code" => "BSD", "name" => "Dólar de las Bahamas",                      "symbol" => "$"],
            ["code" => "BHD", "name" => "Dinar de Bahréin",                          "symbol" => ".د.ب"],
            ["code" => "BDT", "name" => "Taka de Bangladesh",                        "symbol" => "৳"],
            ["code" => "BBD", "name" => "Dólar de Barbados",                         "symbol" => "$"],
            ["code" => "BYN", "name" => "Rublo Bielorruso",                          "symbol" => "Br"],
            ["code" => "BZD", "name" => "Dólar de Belice",                           "symbol" => "$"],
            ["code" => "XOF", "name" => "Franco CFA de África Occidental",           "symbol" => "Fr"],
            ["code" => "BMD", "name" => "Dólar de las Bermudas",                     "symbol" => "$"],
            ["code" => "BTN", "name" => "Ngultrum Butanés",                          "symbol" => "Nu."],
            ["code" => "BOB", "name" => "Boliviano",                                 "symbol" => "Bs."],
            ["code" => "BAM", "name" => "Marca convertible de Bosnia y Herzegovina", "symbol" => "KM"],
            ["code" => "BWP", "name" => "Botswana Pula",                             "symbol" => "P"],
            ["code" => "BRL", "name" => "Real Brasileño",                            "symbol" => "R$"],
            ["code" => "BND", "name" => "Dólar de Brunei",                           "symbol" => "$"],
            ["code" => "BGN", "name" => "Lev Búlgaro",                               "symbol" => "лв"],
            ["code" => "BIF", "name" => "Franco Burundés",                           "symbol" => "Fr"],
            ["code" => "KHR", "name" => "Riel Camboyano",                            "symbol" => "៛"],
            ["code" => "XAF", "name" => "Franco CFA Centroafricano",                 "symbol" => "Fr"],
            ["code" => "CAD", "name" => "Dólar Canadiense",                          "symbol" => "$"],
            ["code" => "CVE", "name" => "Cape Verdean Shield",                       "symbol" => "Esc"],
            ["code" => "KYD", "name" => "Dólar de las Islas Caimán",                 "symbol" => "$"],
            ["code" => "CLP", "name" => "Peso Chileno",                              "symbol" => "$"],
            ["code" => "CNY", "name" => "Yuan Chino",                                "symbol" => "¥"],
            ["code" => "COP", "name" => "Peso Colombiano",                           "symbol" => "$"],
            ["code" => "KMF", "name" => "Franco Comorano",                           "symbol" => "Fr"],
            ["code" => "CDF", "name" => "Franco Congoleño",                          "symbol" => "FC"],
            ["code" => "CKD", "name" => "Dólar de las Islas Cook",                   "symbol" => "$"],
            ["code" => "CRC", "name" => "Colón Costarricense",                       "symbol" => "₡"],
            ["code" => "CUC", "name" => "Peso Cubano Convertible",                   "symbol" => "$"],
            ["code" => "CZK", "name" => "Corona Checa",                              "symbol" => "Kč"],
            ["code" => "DKK", "name" => "Corona Danesa",                             "symbol" => "kr"],
            ["code" => "DJF", "name" => "Franco Yibutiano",                          "symbol" => "Fr"],
            ["code" => "DOP", "name" => "Peso Dominicano",                           "symbol" => "$"],
            ["code" => "EGP", "name" => "Libra Egipcia",                             "symbol" => "£"],
            ["code" => "ERN", "name" => "Nakfa Eritreo",                             "symbol" => "Nfk"],
            ["code" => "ETB", "name" => "Birr Etíope",                               "symbol" => "Br"],
            ["code" => "FKP", "name" => "Libra de las Islas Malvinas",               "symbol" => "£"],
            ["code" => "FJD", "name" => "Dólar Fiyiano",                             "symbol" => "$"],
            ["code" => "XPF", "name" => "Franco CFP",                                "symbol" => "₣"],
            ["code" => "GMD", "name" => "Dalasi",                                    "symbol" => "D"],
            ["code" => "GEL", "name" => "Lari",                                      "symbol" => "₾"],
            ["code" => "GHS", "name" => "Cedi Ghanés",                               "symbol" => "₵"],
            ["code" => "GIP", "name" => "Libra de Gibraltar",                        "symbol" => "£"],
            ["code" => "GTQ", "name" => "Quetzal Guatemalteco",                      "symbol" => "Q"],
            ["code" => "GNF", "name" => "Franco Guineano",                           "symbol" => "Fr"],
            ["code" => "GYD", "name" => "Dólar Guyanés",                             "symbol" => "$"],
            ["code" => "HTG", "name" => "Gourde Haitiano",                           "symbol" => "G"],
            ["code" => "HNL", "name" => "Lempira Hondureña",                         "symbol" => "L"],
            ["code" => "HKD", "name" => "Dólar de Hong Kong",                        "symbol" => "$"],
            ["code" => "HUF", "name" => "Florín Húngaro",                            "symbol" => "Ft"],
            ["code" => "ISK", "name" => "Islandés Króna",                            "symbol" => "kr"],
            ["code" => "INR", "name" => "Rupia India",                               "symbol" => "₹"],
            ["code" => "IDR", "name" => "Rupia Indonesia",                           "symbol" => "Rp"],
            ["code" => "IRR", "name" => "Rial Iraní",                                "symbol" => "﷼"],
            ["code" => "IQD", "name" => "Dinar Iraquí",                              "symbol" => "ع.د"],
            ["code" => "ILS", "name" => "Nuevo Shekel Israelí",                      "symbol" => "₪"],
            ["code" => "JMD", "name" => "Dólar Jamaicano",                           "symbol" => "$"],
            ["code" => "JPY", "name" => "Yen Japonés",                               "symbol" => "¥"],
            ["code" => "JOD", "name" => "Dinar Jordano",                             "symbol" => "دا"],
            ["code" => "KZT", "name" => "Tenge Kazajo",                              "symbol" => "₸"],
            ["code" => "KES", "name" => "Chelín Keniano",                            "symbol" => "Sh"],
            ["code" => "KPW", "name" => "Won Norcoreano",                            "symbol" => "₩"],
            ["code" => "KRW", "name" => "Won Surcoreano",                            "symbol" => "₩"],
            ["code" => "KWD", "name" => "Dinar Kuwaití",                             "symbol" => "د.ك"],
            ["code" => "KGS", "name" => "Som Kirguís",                               "symbol" => "c"],
            ["code" => "LAK", "name" => "Lao Kip",                                   "symbol" => "₭"],
            ["code" => "LBP", "name" => "Libra Libanesa",                            "symbol" => "ل.ل"],
            ["code" => "LSL", "name" => "Lesotho Loti",                              "symbol" => "L"],
            ["code" => "LRD", "name" => "Dólar Liberiano",                           "symbol" => "$"],
            ["code" => "LYD", "name" => "Dinar Libio",                               "symbol" => "ل.د"],
            ["code" => "CHF", "name" => "Franco Suizo",                              "symbol" => "Fr"],
            ["code" => "MOP", "name" => "Pataca de Macao",                           "symbol" => "P"],
            ["code" => "MKD", "name" => "Denar",                                     "symbol" => "den"],
            ["code" => "MGA", "name" => "Ariary Malgache",                           "symbol" => "Ar"],
            ["code" => "MWK", "name" => "Kwacha Malawiano",                          "symbol" => "MK"],
            ["code" => "MYR", "name" => "Ringgit Malasio",                           "symbol" => "RM"],
            ["code" => "MVR", "name" => "Maldivas Rufiyaa",                          "symbol" => ".ރ"],
            ["code" => "MRU", "name" => "Ouguiya Mauritana",                         "symbol" => "UM"],
            ["code" => "MUR", "name" => "Rupia Mauriciana",                          "symbol" => "₨"],
            ["code" => "MXN", "name" => "Peso Mexicano",                             "symbol" => "$"],
            ["code" => "MDL", "name" => "Leu Moldavo",                               "symbol" => "L"],
            ["code" => "MNT", "name" => "Mongol Tögrög",                             "symbol" => "₮"],
            ["code" => "MAD", "name" => "Dirham Marroquí",                           "symbol" => "د.م."],
            ["code" => "MZN", "name" => "Metical Mozambiqueño",                      "symbol" => "MT"],
            ["code" => "MMK", "name" => "Kyat Birmano",                              "symbol" => "Ks"],
            ["code" => "NAD", "name" => "Dólar Namibio",                             "symbol" => "$"],
            ["code" => "NPR", "name" => "Rupia Nepalesa",                            "symbol" => "₨"],
            ["code" => "NZD", "name" => "Dólar Neozelandés",                         "symbol" => "$"],
            ["code" => "NIO", "name" => "Córdoba Nicaragüense",                      "symbol" => "C$"],
            ["code" => "NGN", "name" => "Nairas Nigerianos",                         "symbol" => "₦"],
            ["code" => "NOK", "name" => "Corona Noruega",                            "symbol" => "kr"],
            ["code" => "OMR", "name" => "Rial Omaní",                                "symbol" => "ر.ع."],
            ["code" => "PKR", "name" => "Rupia Pakistaní",                           "symbol" => "₨"],
            ["code" => "PAB", "name" => "Balboa Panameño",                           "symbol" => "B/."],
            ["code" => "PGK", "name" => "Kina de Papúa Nueva Guinea",                "symbol" => "K"],
            ["code" => "PYG", "name" => "Guaraní Paraguayo",                         "symbol" => "₲"],
            ["code" => "PEN", "name" => "Sol Peruano",                               "symbol" => "S/."],
            ["code" => "PHP", "name" => "Peso Filipino",                             "symbol" => "₱"],
            ["code" => "PLN", "name" => "Polaco Złoty",                              "symbol" => "zł"],
            ["code" => "QAR", "name" => "Rial Qatarí",                               "symbol" => "ر.ق"],
            ["code" => "RON", "name" => "Leu Rumano",                                "symbol" => "lei"],
            ["code" => "RUB", "name" => "Rublo Ruso",                                "symbol" => "₽"],
            ["code" => "RWF", "name" => "Franco Ruandés",                            "symbol" => "Fr"],
            ["code" => "GBP", "name" => "Libra Esterlina",                           "symbol" => "£"],
            ["code" => "WST", "name" => "Samoano Tālā",                              "symbol" => "T"],
            ["code" => "STN", "name" => "Santo Tomé y Príncipe Dobra",               "symbol" => "Db"],
            ["code" => "SAR", "name" => "Rial Saudí",                                "symbol" => "ر.س"],
            ["code" => "RSD", "name" => "Dinar Serbio",                              "symbol" => "дин."],
            ["code" => "SCR", "name" => "Rupia Seychellesa",                         "symbol" => "₨"],
            ["code" => "SLL", "name" => "Sierra Leona",                              "symbol" => "Le"],
            ["code" => "SGD", "name" => "Dólar de Singapur",                         "symbol" => "$"],
            ["code" => "SBD", "name" => "Dólar de las Islas Salomón",                "symbol" => "$"],
            ["code" => "SOS", "name" => "Chelín Somalí",                             "symbol" => "Sh"],
            ["code" => "ZAR", "name" => "Rand Sudafricano",                          "symbol" => "R"],
            ["code" => "SHP", "name" => "Libra de Santa Elena",                      "symbol" => "£"],
            ["code" => "SSP", "name" => "Libra Sudanesa",                            "symbol" => "£"],
            ["code" => "LKR", "name" => "Rupia de Sri Lanka",                        "symbol" => "Rs  රු"],
            ["code" => "SDG", "name" => "Libra Sudanesa",                            "symbol" => "PT"],
            ["code" => "SRD", "name" => "Dólar Surinamés",                           "symbol" => "$"],
            ["code" => "SZL", "name" => "Suazi Lilangeni",                           "symbol" => "L"],
            ["code" => "SEK", "name" => "Corona Sueca",                              "symbol" => "kr"],
            ["code" => "SYP", "name" => "Libra Siria",                               "symbol" => "£"],
            ["code" => "TWD", "name" => "Nuevo Dólar de Taiwán",                     "symbol" => "$"],
            ["code" => "TJS", "name" => "Somoni Tayiko",                             "symbol" => "SM"],
            ["code" => "TZS", "name" => "Chelín Tanzano",                            "symbol" => "Sh"],
            ["code" => "THB", "name" => "Baht Tailandés",                            "symbol" => "฿"],
            ["code" => "TOP", "name" => "Tongan Pa'anga",                            "symbol" => "T$"],
            ["code" => "TTD", "name" => "Dólar de Trinidad y Tobago",                "symbol" => "$"],
            ["code" => "TND", "name" => "Dinar Tunecino",                            "symbol" => "د.ت"],
            ["code" => "TRY", "name" => "Lira Turca",                                "symbol" => "₺"],
            ["code" => "TMT", "name" => "Turkmenistán Manat",                        "symbol" => "m"],
            ["code" => "UGX", "name" => "Chelín Ugandés",                            "symbol" => "Sh"],
            ["code" => "UAH", "name" => "Hryvnia Ucraniana",                         "symbol" => "₴"],
            ["code" => "AED", "name" => "Dirham de los Emiratos Árabes Unidos",      "symbol" => "د.إ"],
            ["code" => "UYU", "name" => "Peso Uruguayo",                             "symbol" => "$"],
            ["code" => "UZS", "name" => "Uzbekistani so'm",                          "symbol" => "so'm"],
            ["code" => "VUV", "name" => "Vanuatu Vatu",                              "symbol" => "Vt"],
            ["code" => "VES", "name" => "Bolívar Soberano Venezolano",               "symbol" => "Bs.S."],
            ["code" => "VND", "name" => "Vietnamita Dồng",                           "symbol" => "₫"],
            ["code" => "YER", "name" => "Rial Yemení",                               "symbol" => "﷼"],
            ["code" => "ZMW", "name" => "Kwacha Zambiano",                           "symbol" => "ZK"],
        ];
        DB::table('currencies')->insert($currencies);
        DB::statement('SELECT setval(\'currencies_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM currencies), 1), false)');
    }
}
