# PlayList objekt

## Properties

- id (string)
- kind (string)
- etag (string)
- totalResults (int) `(celkový počet videí)`
- resultsPerPage (int) `(počet shlédnutí videa)`
- items (array) `(seznam videí)`

### Metody
- searchByTag - hledat videa podle jednoho tagu
- searchByTags - hledat videa podle více tagů (video musí mít alespoň jeden z tagů)
- searchByTagsStrict - hledat videa podle více tagů (video musít mít všechny tagy)
