# PlayList object

## Properties

- id (string)
- kind (string)
- etag (string)
- totalResults (int) `(celkový počet videí)`
- resultsPerPage (int) `(počet shlédnutí videa)`
- items (array) `(seznam videí)`

### Methods
- searchByTag - search videos by one tag
- searchByTags - search videos by more tags (video must contain minimal one of tags)
- searchByTagsStrict - search videos by more tags (video must contain all of tags)
