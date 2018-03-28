function cookie (key, value, options) {
  if (arguments.length > 1 && String(value) !== "[object Object]") {
    options = $.extend({}, options);
    if (value === null || value === undefined) {
        options.expires = -1;
    }
    if (typeof options.expires === "number") {
        var days = options.expires,
            t = options.expires = new Date;
        t.setDate(t.getDate() + days);
    }
    value = String(value);
    return document.cookie = [encodeURIComponent(key), "=", options.raw ? value : encodeURIComponent(value), options.expires ? "; expires=" + options.expires.toUTCString() : "", options.path ? "; path=" + options.path : "; path=/", options.domain ? "; domain=" + options.domain : "", options.secure ? "; secure" : ""].join("");
  }
  options = value || {};
  var decode = options.raw ? function(s) {
      return s;
    } : decodeURIComponent,
    result = (new RegExp("(?:^|; )" + encodeURIComponent(key) + "=([^;]*)")).exec(document.cookie);
  return result && result[1] && result[1] !== "null" ? decode(result[1]) : null;
}
$(window).resize(function(){
  $(window).trigger('window:resize')
})

function printLegend(data){
  if ( data == '' ) return;
  $('.pairs-legend').prepend('<span class="pairs-legend-link"><i class="material-icons">help_outline</i> Exchange Pairs List</span>')
  data = JSON.parse(data)
  data.forEach(function(exchange){
    var exchange_pairs = '<ul class="list-unstyled pairs-legend-pairs-list">'
    $('.pairs-legend-inner').append('<h2>'+exchange.name+'</h2>')
    exchange.pairs.forEach(function(pair){
      exchange_pairs = exchange_pairs + '<li><span>'+pair[0]+'</span><b>'+pair[1]+'</b></li>'
    })
    $('.pairs-legend-inner').append(exchange_pairs)
  })
  $('.pairs-legend-link').click(function(){
    $(this).toggleClass('active')
    $('.pairs-legend-inner').toggleClass('active')
    gtag('event','Click',{'event_category':'Action','event_label':'Pairs Legend'})
  })
}

$(function(){
  $('.nav-charts').click(function(){
    if ( $('.nav-charts.active').length > 0 ){
      $('.subnav').remove()
      $('.nav-charts').removeClass('active')
    } else {
      $('.nav-charts').addClass('active')
      $('.top-bar').after('<div class="subnav"><a href="/">Home</a><a href="/charts/top-price-spreads"><i class="material-icons">tune</i> Today\'s Top Spreads</a><a href="/charts/acceleration"><i class="material-icons">network_check</i> Price Acceleration</a></div>')
    }
    return false
  })
})
