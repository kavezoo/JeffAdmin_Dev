- **Típus:** fejlesztői
- **Alkalmazás:** JeffAdmin_Dev / JeffAdmin
- **Verzió:** 1.7
- **Dátum:** 2026-09-15
- **Állapot:** érvényes
- **Felelős:** Saghysat

# JeffAdmin bake theme

## Cél

A JeffAdmin plugin CakePHP Bake theme-je JeffAdmin UI sablonokat és controller elemeket generál (lista, űrlap, view, Admin prefixes controller). A mintaalkalmazásban a theme be van kapcsolva; a Customers CRUD bake-kel újragenerálható.

## Előfeltételek

| Elem | Hely |
|------|------|
| Plugin betöltés | `config/plugins.php` → `'JeffAdmin' => []` |
| Bake theme | `config/bootstrap.php` → `Configure::write('Bake.theme', 'JeffAdmin')` |
| Theme fájlok | `plugins/JeffAdmin/templates/bake/` |
| Plugin composer | `plugins/JeffAdmin/composer.json` (`jeff/jeff-admin`) |
| Bake csomag | `composer require --dev cakephp/bake` (ha nincs) |

Windows: `php bin/cake.php …` (nem a `bin/cake` shell script).

## Érintett bake sablonok (JeffAdmin felülírás)

| Útvonal a pluginban | Generált kimenet |
|---------------------|------------------|
| `templates/bake/Template/index.twig` | `templates/{Prefix}/{Model}/index.php` |
| `templates/bake/Template/add.twig` | `…/add.php` |
| `templates/bake/Template/edit.twig` | `…/edit.php` |
| `templates/bake/Template/view.twig` | `…/view.php` (egy fájl, disabled űrlap + related) |
| `templates/bake/element/form.twig` | add/edit közös mezőblokk |
| `templates/bake/Controller/controller.twig` | controller osztály; prefixnél `{Prefix}\AppController` |
| `templates/bake/element/Controller/index.twig` | index + **aktív** header kereső (string/text + BelongsTo displayField) |
| `templates/bake/element/Controller/add.twig` | add + `$data` / kikommentelt `dd` + `rememberLastRecord` |
| `templates/bake/element/Controller/edit.twig` | edit + `$data` / kikommentelt `dd` + `rememberLastRecord` |
| `templates/bake/element/Controller/view.twig` | view + kikommentelt `dd` + BelongsTo listák + `rememberLastRecord` |

A Model / egyéb bake sablonok a pluginban a CakePHP alap másolatai; a JeffAdmin UI a fenti Template és Controller elemekre épül.

## Megjelenítési kapcsolók (`$show`)

### Globális alap

- Forrás: `plugins/JeffAdmin/config/show.php`
- Betöltés: `JeffAdminPlugin::bootstrap()` → `Configure::load('JeffAdmin.show')`
- Olvasás a sablonokban: `Configure::read('JeffAdmin')`, majd `array_merge($show['<action>'], $showLocal['<action>'])`

### `JeffAdmin.index`

| Kulcs | Szerep |
|-------|--------|
| `rowCheckbox` | Sorjelölő oszlop |
| `rowId` | `id` oszlop |
| `name` | `name` vagy (ha nincs name) `title` oszlop |
| `visible` | `visible` oszlop (`Icon->boolean`) |
| `pos` | `pos` oszlop |
| `created` / `modified` | közös datetime oszlop |
| `counts` | entitás `*_count` mezői külön oszlopokban |
| `viewButton` / `editButton` / `deleteButton` | műveletek |
| `rowDblClick` | `'edit'` \| `'view'` \| `'none'` |

### `JeffAdmin.add` / `edit` / `view`

| Action | Kulcsok |
|--------|---------|
| add, edit | `saveButton`, `cancelButton`, `posStep` (spinner lépés, alap 10) |
| view | `editButton`, `cancelButton`, `relatedTables`, `posStep` |

Helyi felülírás: a generált sablon `$showLocal` tömbjében a kívánt kulcs kikommentezése / `false` érték.

## Index bake szabályok

1. **Aktív oszlopok:** config szerint `id`, `name`\|`title`, `visible`, `pos`, `created`/`modified`, runtime `*_count`.
2. **Egyéb mezők** (BelongsTo FK, string, szám, …): a `th`/`td` blokk a fájlban megvan, de `<?php /* … */ ?>` között — uncommenttel bekapcsolható.
3. **CSS class a cellákon:** típus alapján (`string`, `email`, `integer`, `number`, `currency`, `boolean`, `date`, `time`, `datetime`, `pos`, `id-col`, `count`).
4. **Email mezőnév:** `email` class; kommentelt td-ben `mailto:` link minta.
5. **Pénzmező-név** (pl. `price`, `amount`, `*_price`): `number currency` class; érték: `$this->Format->money(…)`.
6. **Boolean:** `$this->Icon->boolean(…)` (zöld pipa / szürke üres négyzet).
7. **BelongsTo szülő link:** `record-link` class; tooltip (`View {asszociáció}: {név}`); szöveg után halvány `link-chain` ikon, hoverre fekete.
8. A `*_count` mezők nem kerülnek a „egyéb” kommentelt listába; a `counts` kapcsoló kezeli őket.

## Űrlap bake szabályok

| Mező / típus | Input |
|--------------|--------|
| BelongsTo FK | `form-select` + Tom Select (`data-tom-select`) + „…” gomb |
| boolean | checkbox (`form-check`) |
| text | textarea |
| email név | `type="email"` |
| decimal / currency / integer | sima `form-control` text input (nincs spinner) |
| `pos` | mindig spinner; lépés: `$show['posStep']` (alap `10`, `show.php` + `$showLocal`) |
| `visible` | checkbox, Settings fül |
| `created` / `modified` / `*_count` | nem kerül az űrlapra |

Add/edit: közös `element/form.twig`. View: ugyanaz a mezőstruktúra `disabled => true`, egy fájlban related táblákkal.

## Helperek

| Helper | Regisztráció | Használat |
|--------|--------------|-----------|
| `JeffAdmin.Icon` | `JeffAdminPlugin` `Controller.initialize` | `boolean()`, `visible()`, `outline()` |
| `JeffAdmin.Action` | ugyanott | `view` / `edit` / `delete` / `close` |
| `JeffAdmin.Format` | ugyanott | `money($amount, $currency = null)` |

### `Format::money`

- Locale `hu*` és pénznem `HUF`: formázott szám + `<span class="currency">Ft.</span>`.
- Egyéb locale vagy más / kikényszerített kód: `NumberHelper::currency` (pl. HUF szimbólum külföldi locale mellett).

## Header kereső

| Réteg | Hol | Viselkedés |
|-------|-----|------------|
| UI | `plugins/JeffAdmin/templates/element/header.php` | GET `action=index`, `name=search`; érték: `$listSearch` |
| Törlés | ugyanott | X ikon (`form-header__clear`), tooltip: „Clear the active search filter”; `?search=` (üres) + megőrzött sort |
| Session | `JeffAdmin\Controller\AppController` | `syncListStateFromRequest` / `buildListStateRestoreQuery` — `search` a `JeffAdmin.lastId.{Prefix.}{Controller}` state-ben |
| Query | bake `element/Controller/index.twig` | aktív: szóközök → `%…%`, saját string/text mezők + BelongsTo `displayField` |

Visszatérés ugyanehhez a controller indexhez: ha a requestben nincs `search`, a sessionből visszaáll, és a lista a szűrt találatokat mutatja. Új keresési szövegnél a lista oldal 1-re áll.

A header kereső mező **nem** nyitja a command palette modalt (az csak ⌘/Ctrl+K); kattintás után gépelés, Enter = GET keresés.

Ha a kért `page` kívül esik (szűrés után kevesebb oldal, vagy URL trükk), a `JeffAdmin\Controller\AppController::paginate()` az **1. oldalra** irányít (`?page=1` + session). A lista paginator linkjei minden oldalhoz (az 1.-hez is) beírják a `page` query paramétert (`templates/element/pagination.php` → `$query['page'] = $page`).

Munkakönyvtár: projektgyökér (`D:\www\JeffAdmin_Dev`).

```text
php bin/cake.php bake template Customers --prefix Admin --theme JeffAdmin --force
php bin/cake.php bake controller Customers --prefix Admin --theme JeffAdmin --force --no-test
```

Együtt (ha a controller szintaxis hibás, előbb a controller bake fusson, utána a template):

```text
php bin/cake.php bake controller Customers --prefix Admin --theme JeffAdmin --force --no-test
php bin/cake.php bake template Customers --prefix Admin --theme JeffAdmin --force
```

Kimenet:

- `src/Controller/Admin/CustomersController.php` — `App\Controller\Admin\AppController`
- `templates/Admin/Customers/{index,add,edit,view}.php`

`--force` felülírja a meglévő fájlokat.

## Manuális tesztlista

### Bake lefutás

1. Futtasd a fenti controller + template bake parancsokat.
2. Ellenőrizd: nincs PHP parse hiba (`php -l` a generált fájlokon).
3. Controller: `use App\Controller\Admin\AppController`, indexben **aktív** kereső, view/add/edit `rememberLastRecord`.
4. Header: keresés Enterrel; visszatéréskor `$listSearch` megmarad; X törli a szűrőt (tooltip).
5. Add/edit: `$data = $this->request->getData()` és kikommentelt `//dd(…)`.
6. View: `get()` után kikommentelt `//dd($id)`, `//dd($entity->toArray())`.

### Lista (`/admin/customers`)

1. Látszik: checkbox (ha be), id, name, visible (pipa/négyzet), pos, created/modified (ha be), actions.
2. `city_id` / `address` / `phone` a forrásban kommentben van; uncomment után megjelenik a táblázatban.
3. `$showLocal['index']` egy kulcsának `false` értéke elrejti az oszlopot / gombot.
4. Dupla kattintás: `rowDblClick` szerint edit vagy view.
5. Pagination: `JeffAdmin.pagination` element.

### Űrlap (add / edit)

1. Basic fül: city select (Tom Select), szöveges mezők.
2. Settings fül: visible checkbox; pos mindig spinner — lépés `$show['posStep']` (alap 10; `$showLocal` / `show.php` felülírható).
3. Mentés / Mégse a `$show` szerint; edit Mégse: `Action->cancelButton($id)` (`?last=` + listPage).
4. Close gomb: `Action->close`.

### View

1. Mezők disabled, kinézet mint az űrlap.
2. Related (Orders) a `$show['relatedTables']` szerint.
3. Lábléc: `Action->editButton($id)`, `Action->cancelButton($id)`.

### Pénznem / boolean (ha van megfelelő mező)

1. Currency nevű mező indexen: `Format->money`, magyar locale mellett `Ft.`.
2. Boolean: zöld `fa-check` / szürke `fa-square`.

## Packagist (későbbi telepítés)

A plugin csomagnév: `jeff/jeff-admin` (`plugins/JeffAdmin/composer.json`). Telepítés után a host appban:

1. Plugin betöltés (`Application` / `plugins.php`)
2. `Configure::write('Bake.theme', 'JeffAdmin')`
3. Admin prefix + `Admin\AppController` (JeffAdmin base / `rememberLastRecord`) a bake controllerhez

## Kapcsolódó fájlok

- `plugins/JeffAdmin/src/JeffAdminPlugin.php`
- `plugins/JeffAdmin/src/View/Helper/{Icon,Action,Format}Helper.php`
- `plugins/JeffAdmin/webroot/css/main.css` (típus- és boolean/currency stílusok)
- Minta: `templates/Admin/Customers/*`, `src/Controller/Admin/CustomersController.php`
