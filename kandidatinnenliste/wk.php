<?php
function kandidatinnenliste_wahlkreisname($nummer) {
  switch ($nummer) {
	case 001:
		return 'Flensburg - Schleswig';
	case 002:
		return 'Nordfriesland - Dithmarschen Nord';
	case 003:
		return 'Steinburg - Dithmarschen S&uuml;d';
	case 004:
		return 'Rendsburg-Eckernf&ouml;rde';
	case 005:
		return 'Kiel';
	case 006:
		return 'Pl&ouml;n - Neum&uuml;nster';
	case 007:
		return 'Pinneberg';
	case 008:
		return 'Segeberg - Stormarn-Mitte';
	case 009:
		return 'Ostholstein - Stormarn-Nord';
	case 010:
		return 'Herzogtum Lauenburg - Stormarn-S&uuml;d';
	case 011:
		return 'L&uuml;beck';
	case 012:
		return 'Schwerin - Ludwigslust-Parchim I - Nordwestmecklenburg I';
	case 013:
		return 'Ludwigslust-Parchim II - Nordwestmecklenburg II - Landkreis Rostock I';
	case 014:
		return 'Rostock - Landkreis Rostock II';
	case 015:
		return 'Vorpommern-R&uuml;gen - Vorpommern-Greifswald I';
	case 016:
		return 'Mecklenburgische Seenplatte I - Vorpommern-Greifswald II';
	case 017:
		return 'Mecklenburgische Seenplatte II - Landkreis Rostock III';
	case 018:
		return 'Hamburg-Mitte';
	case 019:
		return 'Hamburg-Altona';
	case 020:
		return 'Hamburg-Eimsb&uuml;ttel';
	case 021:
		return 'Hamburg-Nord';
	case 022:
		return 'Hamburg-Wandsbek';
	case 023:
		return 'Hamburg-Bergedorf - Harburg';
	case 024:
		return 'Aurich - Emden';
	case 025:
		return 'Unterems';
	case 026:
		return 'Friesland - Wilhelmshaven - Wittmund';
	case 027:
		return 'Oldenburg - Ammerland';
	case 028:
		return 'Delmenhorst - Wesermarsch - Oldenburg-Land';
	case 029:
		return 'Cuxhaven - Stade II';
	case 030:
		return 'Stade I - Rotenburg II';
	case 031:
		return 'Mittelems';
	case 032:
		return 'Cloppenburg - Vechta';
	case 033:
		return 'Diepholz - Nienburg I';
	case 034:
		return 'Osterholz - Verden';
	case 035:
		return 'Rotenburg I - Heidekreis';
	case 036:
		return 'Harburg';
	case 037:
		return 'L&uuml;chow-Dannenberg - L&uuml;neburg';
	case 038:
		return 'Osnabr&uuml;ck-Land';
	case 039:
		return 'Stadt Osnabr&uuml;ck';
	case 040:
		return 'Nienburg II - Schaumburg';
	case 041:
		return 'Stadt Hannover I';
	case 042:
		return 'Stadt Hannover II';
	case 043:
		return 'Hannover-Land I';
	case 044:
		return 'Celle - Uelzen';
	case 045:
		return 'Gifhorn - Peine';
	case 046:
		return 'Hameln-Pyrmont - Holzminden';
	case 047:
		return 'Hannover-Land II';
	case 048:
		return 'Hildesheim';
	case 049:
		return 'Salzgitter - Wolfenb&uuml;ttel';
	case 050:
		return 'Braunschweig';
	case 051:
		return 'Helmstedt - Wolfsburg';
	case 052:
		return 'Goslar - Northeim - Osterode';
	case 053:
		return 'G&ouml;ttingen';
	case 054:
		return 'Bremen I';
	case 055:
		return 'Bremen II - Bremerhaven';
	case 056:
		return 'Prignitz - Ostprignitz-Ruppin - Havelland I';
	case 057:
		return 'Uckermark - Barnim I';
	case 058:
		return 'Oberhavel - Havelland II';
	case 059:
		return 'M&auml;rkisch-Oderland - Barnim II';
	case 060:
		return 'Brandenburg an der Havel - Potsdam-Mittelmark I - Havelland III - Teltow-Fl&auml;ming I';
	case 061:
		return 'Potsdam - Potsdam-Mittelmark II - Teltow-Fl&auml;ming II';
	case 062:
		return 'Dahme-Spreewald - Teltow-Fl&auml;ming III - Oberspreewald-Lausitz I';
	case 063:
		return 'Frankfurt (Oder) - Oder-Spree';
	case 064:
		return 'Cottbus - Spree-Nei&szlig;e';
	case 065:
		return 'Elbe-Elster - Oberspreewald-Lausitz II';
	case 066:
		return 'Altmark';
	case 067:
		return 'B&ouml;rde - Jerichower Land';
	case 068:
		return 'Harz';
	case 069:
		return 'Magdeburg';
	case 070:
		return 'Dessau - Wittenberg';
	case 071:
		return 'Anhalt';
	case 072:
		return 'Halle';
	case 073:
		return 'Burgenland - Saalekreis';
	case 074:
		return 'Mansfeld';
	case 075:
		return 'Berlin-Mitte';
	case 076:
		return 'Berlin-Pankow';
	case 077:
		return 'Berlin-Reinickendorf';
	case 078:
		return 'Berlin-Spandau-Charlottenburg Nord';
	case 079:
		return 'Berlin-Steglitz-Zehlendorf';
	case 080:
		return 'Berlin-Charlottenburg-Wilmersdorf';
	case 081:
		return 'Berlin-Tempelhof-Sch&ouml;neberg';
	case 082:
		return 'Berlin-Neuk&ouml;lln';
	case 083:
		return 'Berlin-Friedrichshain-Kreuzberg - Prenzlauer Berg Ost';
	case 084:
		return 'Berlin-Treptow-K&ouml;penick';
	case 085:
		return 'Berlin-Marzahn-Hellersdorf';
	case 086:
		return 'Berlin-Lichtenberg';
	case 087:
		return 'Aachen I';
	case 088:
		return 'Aachen II';
	case 089:
		return 'Heinsberg';
	case 090:
		return 'D&uuml;ren';
	case 091:
		return 'Rhein-Erft-Kreis I';
	case 092:
		return 'Euskirchen - Rhein-Erft-Kreis II';
	case 093:
		return 'K&ouml;ln I';
	case 094:
		return 'K&ouml;ln II';
	case 095:
		return 'K&ouml;ln III';
	case 096:
		return 'Bonn';
	case 097:
		return 'Rhein-Sieg-Kreis I';
	case 098:
		return 'Rhein-Sieg-Kreis II';
	case 099:
		return 'Oberbergischer Kreis';
	case 100:
		return 'Rheinisch-Bergischer Kreis';
	case 101:
		return 'Leverkusen - K&ouml;ln IV';
	case 102:
		return 'Wuppertal I';
	case 103:
		return 'Solingen - Remscheid - Wuppertal II';
	case 104:
		return 'Mettmann I';
	case 105:
		return 'Mettmann II';
	case 106:
		return 'D&uuml;sseldorf I';
	case 107:
		return 'D&uuml;sseldorf II';
	case 108:
		return 'Neuss I';
	case 109:
		return 'M&ouml;nchengladbach';
	case 110:
		return 'Krefeld I - Neuss II';
	case 111:
		return 'Viersen';
	case 112:
		return 'Kleve';
	case 113:
		return 'Wesel I';
	case 114:
		return 'Krefeld II - Wesel II';
	case 115:
		return 'Duisburg I';
	case 116:
		return 'Duisburg II';
	case 117:
		return 'Oberhausen - Wesel III';
	case 118:
		return 'M&uuml;lheim - Essen I';
	case 119:
		return 'Essen II';
	case 120:
		return 'Essen III';
	case 121:
		return 'Recklinghausen I';
	case 122:
		return 'Recklinghausen II';
	case 123:
		return 'Gelsenkirchen';
	case 124:
		return 'Steinfurt I - Borken I';
	case 125:
		return 'Bottrop - Recklinghausen III';
	case 126:
		return 'Borken II';
	case 127:
		return 'Coesfeld - Steinfurt II';
	case 128:
		return 'Steinfurt III';
	case 129:
		return 'M&uuml;nster';
	case 130:
		return 'Warendorf';
	case 131:
		return 'G&uuml;tersloh I';
	case 132:
		return 'Bielefeld - G&uuml;tersloh II';
	case 133:
		return 'Herford - Minden-L&uuml;bbecke II';
	case 134:
		return 'Minden-L&uuml;bbecke I';
	case 135:
		return 'Lippe I';
	case 136:
		return 'H&ouml;xter - Lippe II';
	case 137:
		return 'Paderborn - G&uuml;tersloh III';
	case 138:
		return 'Hagen - Ennepe-Ruhr-Kreis I';
	case 139:
		return 'Ennepe-Ruhr-Kreis II';
	case 140:
		return 'Bochum I';
	case 141:
		return 'Herne - Bochum II';
	case 142:
		return 'Dortmund I';
	case 143:
		return 'Dortmund II';
	case 144:
		return 'Unna I';
	case 145:
		return 'Hamm - Unna II';
	case 146:
		return 'Soest';
	case 147:
		return 'Hochsauerlandkreis';
	case 148:
		return 'Siegen-Wittgenstein';
	case 149:
		return 'Olpe - M&auml;rkischer Kreis I';
	case 150:
		return 'M&auml;rkischer Kreis II';
	case 151:
		return 'Nordsachsen';
	case 152:
		return 'Leipzig I';
	case 153:
		return 'Leipzig II';
	case 154:
		return 'Leipzig-Land';
	case 155:
		return 'Mei&szlig;en';
	case 156:
		return 'Bautzen I';
	case 157:
		return 'G&ouml;rlitz';
	case 158:
		return 'S&auml;chsische Schweiz-Osterzgebirge';
	case 159:
		return 'Dresden I';
	case 160:
		return 'Dresden II - Bautzen II';
	case 161:
		return 'Mittelsachsen';
	case 162:
		return 'Chemnitz';
	case 163:
		return 'Chemnitzer Umland - Erzgebirgskreis II';
	case 164:
		return 'Erzgebirgskreis I';
	case 165:
		return 'Zwickau';
	case 166:
		return 'Vogtlandkreis';
	case 167:
		return 'Waldeck';
	case 168:
		return 'Kassel';
	case 169:
		return 'Werra-Mei&szlig;ner - Hersfeld-Rotenburg';
	case 170:
		return 'Schwalm-Eder';
	case 171:
		return 'Marburg';
	case 172:
		return 'Lahn-Dill';
	case 173:
		return 'Gie&szlig;en';
	case 174:
		return 'Fulda';
	case 175:
		return 'Main-Kinzig - Wetterau II - Schotten';
	case 176:
		return 'Hochtaunus';
	case 177:
		return 'Wetterau I';
	case 178:
		return 'Rheingau-Taunus - Limburg';
	case 179:
		return 'Wiesbaden';
	case 180:
		return 'Hanau';
	case 181:
		return 'Main-Taunus';
	case 182:
		return 'Frankfurt am Main I';
	case 183:
		return 'Frankfurt am Main II';
	case 184:
		return 'Gro&szlig;-Gerau';
	case 185:
		return 'Offenbach';
	case 186:
		return 'Darmstadt';
	case 187:
		return 'Odenwald';
	case 188:
		return 'Bergstra&szlig;e';
	case 189:
		return 'Eichsfeld - Nordhausen - Unstrut-Hainich-Kreis I';
	case 190:
		return 'Eisenach - Wartburgkreis - Unstrut-Hainich-Kreis II';
	case 191:
		return 'Kyffh&auml;userkreis - S&ouml;mmerda - Weimarer Land I';
	case 192:
		return 'Gotha - Ilm-Kreis';
	case 193:
		return 'Erfurt - Weimar - Weimarer Land II';
	case 194:
		return 'Gera - Jena - Saale-Holzland-Kreis';
	case 195:
		return 'Greiz - Altenburger Land';
	case 196:
		return 'Sonneberg - Saalfeld-Rudolstadt - Saale-Orla-Kreis';
	case 197:
		return 'Suhl - Schmalkalden-Meiningen - Hildburghausen';
	case 198:
		return 'Neuwied';
	case 199:
		return 'Ahrweiler';
	case 200:
		return 'Koblenz';
	case 201:
		return 'Mosel/Rhein-Hunsr&uuml;ck';
	case 202:
		return 'Kreuznach';
	case 203:
		return 'Bitburg';
	case 204:
		return 'Trier';
	case 205:
		return 'Montabaur';
	case 206:
		return 'Mainz';
	case 207:
		return 'Worms';
	case 208:
		return 'Ludwigshafen/Frankenthal';
	case 209:
		return 'Neustadt - Speyer';
	case 210:
		return 'Kaiserslautern';
	case 211:
		return 'Pirmasens';
	case 212:
		return 'S&uuml;dpfalz';
	case 213:
		return 'Alt&ouml;tting';
	case 214:
		return 'Erding - Ebersberg';
	case 215:
		return 'Freising';
	case 216:
		return 'F&uuml;rstenfeldbruck';
	case 217:
		return 'Ingolstadt';
	case 218:
		return 'M&uuml;nchen-Nord';
	case 219:
		return 'M&uuml;nchen-Ost';
	case 220:
		return 'M&uuml;nchen-S&uuml;d';
	case 221:
		return 'M&uuml;nchen-West/Mitte';
	case 222:
		return 'M&uuml;nchen-Land';
	case 223:
		return 'Rosenheim';
	case 224:
		return 'Starnberg';
	case 225:
		return 'Traunstein';
	case 226:
		return 'Weilheim';
	case 227:
		return 'Deggendorf';
	case 228:
		return 'Landshut';
	case 229:
		return 'Passau';
	case 230:
		return 'Rottal-Inn';
	case 231:
		return 'Straubing';
	case 232:
		return 'Amberg';
	case 233:
		return 'Regensburg';
	case 234:
		return 'Schwandorf';
	case 235:
		return 'Weiden';
	case 236:
		return 'Bamberg';
	case 237:
		return 'Bayreuth';
	case 238:
		return 'Coburg';
	case 239:
		return 'Hof';
	case 240:
		return 'Kulmbach';
	case 241:
		return 'Ansbach';
	case 242:
		return 'Erlangen';
	case 243:
		return 'F&uuml;rth';
	case 244:
		return 'N&uuml;rnberg-Nord';
	case 245:
		return 'N&uuml;rnberg-S&uuml;d';
	case 246:
		return 'Roth';
	case 247:
		return 'Aschaffenburg';
	case 248:
		return 'Bad Kissingen';
	case 249:
		return 'Main-Spessart';
	case 250:
		return 'Schweinfurt';
	case 251:
		return 'W&uuml;rzburg';
	case 252:
		return 'Augsburg-Stadt';
	case 253:
		return 'Augsburg-Land';
	case 254:
		return 'Donau-Ries';
	case 255:
		return 'Neu-Ulm';
	case 256:
		return 'Oberallg&auml;u';
	case 257:
		return 'Ostallg&auml;u';
	case 258:
		return 'Stuttgart I';
	case 259:
		return 'Stuttgart II';
	case 260:
		return 'B&ouml;blingen';
	case 261:
		return 'Esslingen';
	case 262:
		return 'N&uuml;rtingen';
	case 263:
		return 'G&ouml;ppingen';
	case 264:
		return 'Waiblingen';
	case 265:
		return 'Ludwigsburg';
	case 266:
		return 'Neckar-Zaber';
	case 267:
		return 'Heilbronn';
	case 268:
		return 'Schw&auml;bisch Hall - Hohenlohe';
	case 269:
		return 'Backnang - Schw&auml;bisch Gm&uuml;nd';
	case 270:
		return 'Aalen - Heidenheim';
	case 271:
		return 'Karlsruhe-Stadt';
	case 272:
		return 'Karlsruhe-Land';
	case 273:
		return 'Rastatt';
	case 274:
		return 'Heidelberg';
	case 275:
		return 'Mannheim';
	case 276:
		return 'Odenwald - Tauber';
	case 277:
		return 'Rhein-Neckar';
	case 278:
		return 'Bruchsal - Schwetzingen';
	case 279:
		return 'Pforzheim';
	case 280:
		return 'Calw';
	case 281:
		return 'Freiburg';
	case 282:
		return 'L&ouml;rrach - M&uuml;llheim';
	case 283:
		return 'Emmendingen - Lahr';
	case 284:
		return 'Offenburg';
	case 285:
		return 'Rottweil - Tuttlingen';
	case 286:
		return 'Schwarzwald-Baar';
	case 287:
		return 'Konstanz';
	case 288:
		return 'Waldshut';
	case 289:
		return 'Reutlingen';
	case 290:
		return 'T&uuml;bingen';
	case 291:
		return 'Ulm';
	case 292:
		return 'Biberach';
	case 293:
		return 'Bodensee';
	case 294:
		return 'Ravensburg';
	case 295:
		return 'Zollernalb - Sigmaringen';
	case 296:
		return 'Saarbr&uuml;cken';
	case 297:
		return 'Saarlouis';
	case 298:
		return 'St. Wendel';
	case 299:
		return 'Homburg';
	default:
		return '';
  }
}
?>