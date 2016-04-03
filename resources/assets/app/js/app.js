$(document).ready(() => {
  const search = {
    init() {
      const values = document.location.search.substr(1).split('&');
      if (values && values[0] !== '') {
        for (const index in values) {
          this.setProperties(encodeURI(values[index]).split('=')[0],
              encodeURI(values[index]).split('=')[1]);
        }
      }
    },
    properties: [],
    setProperties(property, value) {
      if (property === 'genres') {
        if (this.properties.genres === undefined) {
          this.properties.genres = [value];
        } else {
          if (this.properties.genres.indexOf(value) === -1) {
            this.properties.genres.push(value);
          }
        }
      } else {
        this.properties[property] = value;
      }
    },
    fetchData() {
      document.location.search = this.getParams(this.properties);
    },
    getParams(values) {
      let params = '';
      for (const index in values) {
        params += `${(params ? '&' : '')} ${encodeURI(index)} = ${encodeURI(values[index])}`;
      }
      return params;
    },
  };
  search.init();
  $('.tab-content a').on('click', function () {
    const currentElement = $(this);
    search.setProperties(currentElement.closest('ul').data('id'), currentElement.data('value'));
    search.fetchData();
  });
});
