# Movies API v1
Egyszerű API a régi weboldalamhoz.

## Használata
Alap URL:

`http://users.atw.hu/polakosz/api/v1/`

### Végpontok

| Végpont neve 	| HTTP metódus 	|                    Végpont leírása                   	|
|:------------:	|:------------:	|:-------------------------------------------------:	|
| `movies.php` 	|      GET     	| Adatok lekérése az eddig megnézett filmeim közül. 	|
| `movies.php` 	|      POST     | FEATURE: Új adatok bevitele a movies táblába.      	|

### Paraméterek

#### Kötelező paraméterek

| Paraméter neve 	| Paraméter leírása                                                                                                 	|                Példa                	|
|:--------------:	|-------------------------------------------------------------------------------------------------------------------	|:-----------------------------------:	|
|    `fields`    	| Segítségével szabályozható a megjelenítendő oszlop (minimum egy oszlop megadása kötelező).<br><br>Elfogadott értékek: <ul><li>id</li><li>filmcim</li><li>port</li><li>csillag</li><li>cover_image</li><li>megjegyzes</li><li>datum</li></ul> 	| `movies.php?fields=filmcim,csillag` 	|

#### Tetszőleges paraméterek

| Paraméter neve 	| Paraméter leírása                                                                                                                 	|                                              Példa                                             	|
|:--------------:	|-----------------------------------------------------------------------------------------------------------------------------------	|:----------------------------------------------------------------------------------------------:	|
|     `order`    	| Segítségével rendezhető a megjelenített adathalmaz.<br>**Csak a `fields` paraméter értékei adhatóak meg rendezési szempontként!**<br><br>Rendezés fajtája szerint lehet:<br><ui><li>`ASC` - növekvő</li><li>`DESC` - csökkenő</li></ul>	|  `movies.php?fields=filmcim,csillag&order=filmcim:ASC,csillag:DESC` 	|
| `limit`        	| Segítségével szabályozható a megjelenítendő eredmények száma.<br><br>**Alapértelmezett:** 10db.<br>**Maximum:** 10db.                            	| `movies.php?fields=filmcim,csillag&limit=10`<br><br>`movies.php?fields=filmcim,csillag&limit=0,9`                                                    	