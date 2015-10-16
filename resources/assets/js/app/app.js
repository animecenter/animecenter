$(document).ready(function() {
  var search = {
    init: function() {
      var values = document.location.search.substr(1).split('&');
      if (values && values[0] !== '') {
        for (var index in values) {
          this.setProperties(encodeURI(values[index]).split('=')[0], encodeURI(values[index]).split('=')[1]);
        }
      }
    },
    properties: [],
    setProperties: function(property, value) {
      if (property === 'genres') {
        if (this.properties['genres'] === undefined) {
          this.properties['genres'] = [value];
        } else {
          if (this.properties.genres.indexOf(value) === -1) {
            this.properties.genres.push(value);
          }
        }
      } else {
        this.properties[property] = value;
      }
    },
    fetchData: function() {
      document.location.search = this.getParams(this.properties);
    },
    getParams: function(values) {
      var params = '';
      for (var index in values) {
        params += (params ? '&' : '') + encodeURI(index) + '=' + encodeURI(values[index]);
      }
      return params;
    },
  };
  search.init();
  $('.dropdown-menu a').on('click', function() {
    var currentElement = $(this);
    currentElement.closest('.dropdown-menu').prev().html(currentElement.text() + '<span class="caret"></span>');
    search.setProperties(currentElement.closest('.dropdown-menu').data('id'), currentElement.data('value'));
    search.fetchData();
  });
});
$(window).load(function() {
  var episodeElement = document.querySelector('.grid-episode');
  var animeElement = document.querySelector('.grid-anime');
  if (animeElement) {
    var animeGrid = new Masonry(animeElement, {
      columnWidth: 170,
      itemSelector: '.grid-item',
    });
  }
  if (episodeElement) {
    var episodeGrid = new Masonry(episodeElement, {
      columnWidth: '.grid-sizer',
      itemSelector: '.grid-item',
      percentPosition: true,
    });
  }
});
