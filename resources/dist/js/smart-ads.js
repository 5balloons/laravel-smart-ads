fetch('/smart-ads-auto-placements')
  .then((response) => response.json())
  .then((ads) => {
    ads.forEach(function(ad){
      var adSelector = document.querySelector(ad.selector);
      adSelector.insertAdjacentHTML(ad.position, ad.body);
    });
});