# Video object

## Properties

- id (video id - string)
- title (video title - string)
- description (video description - string)
- published (video date publish - \Nette\Utils\DateTime)
- views (video views count - integer)
- url (video url - string)
- embed (video embed url - string)
- thumbs (video thumbnails - array)

### Thumbnail (thumbs)
- default (object)
- medium (object)
- high (object)
- standard (object)
- maxres (object)

#### Thumbnail properties
- url (url to video thumbnail - string)
- width (video thumbnail width - integer)
- height (video thumbnail height - integer)