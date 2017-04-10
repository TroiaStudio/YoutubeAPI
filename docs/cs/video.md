# Video objekt

## Properties

- id (id videa - string)
- title (titulek videa - string)
- description (popisek videa - string)
- published (datum publikování videa - \Nette\Utils\DateTime)
- views (počet shlédnutí videa - integer)
- url (url adresa videa - string)
- embed (embed adresa videa - string)
- thumbs (náhledové obrázky videa - array)

### Náhledové obrázky (thumbs)
- default (object)
- medium (object)
- high (object)
- standard (object)
- maxres (object)

#### Thumbnail properties
- url (url adresa náhledu videa - string)
- width (šířka náhledu videa - integer)
- height (výška náhledu videa - integer)